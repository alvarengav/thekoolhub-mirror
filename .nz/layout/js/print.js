var pdfPage = {
  width: 11.7, // inches
  height: 8.3, // inches
  margins: {
    top: 2/25.4,
    left: 2/25.4,
    right: 2/25.4,
    bottom: 26/25.4
  }
};

/**
 * The distance to bottom of which if the element is closer, it should moved on
 * the next page. Should be at least the element (TR)'s height.
 *
 * @type {Number}
 */
var splitThreshold = 42;

/**
 * Class name of the tables to automatically split.
 * Should not contain any CSS definitions because it is automatically removed
 * after the split.
 *
 * @type {String}
 */
var splitClassName = 'splitForPrint';


var debug = false;
var profile = false;
var startTime = 0;
var endTime = 0;
var tableProcessStart = 0;
var tableProcessEnd = 0;
var profileDivsList = [];
var profileDiv = $('<div>');

$(window).load(function() {
  startTime = new Date().getTime();
  // get document resolution
  var _dpi = {
    v: 0,
    get: function (noCache) {
       if (noCache || _dpi.v == 0) {
          e = document.body.appendChild(document.createElement('DIV'));
          e.style.width = '1in';
          e.style.padding = '0';
          _dpi.v = e.offsetWidth;
          e.parentNode.removeChild(e);
       }
       return _dpi.v;
    }
  }
  //for some reason _dpi.get always returns 96 which wasn't really looking good in resulting pdf
  var dpi = 120;

  var pageWidth = (pdfPage.width - pdfPage.margins.left - pdfPage.margins.right) * dpi;
  // page height in pixels
  var pageHeight = (pdfPage.height - pdfPage.margins.top - pdfPage.margins.bottom) * dpi;
  // temporary set body's width and padding to match pdf's size
  var $body = $('body .report_data'); //a single div should wrap whole pdf content
  $body.css('width', pageWidth);
  $body.css('margin-left', pdfPage.margins.left + 'in');
  $body.css('margin-right', pdfPage.margins.right + 'in');
  $body.css('margin-top', pdfPage.margins.top + 'in');
  $body.css('margin-bottom', pdfPage.margins.bottom + 'in');

  var currentPageZero = 0; //the offset for the currentPage. Will go with pageHeight increments page by page
  var tablesModified = true;
  /** div with page-break logic
   * css should include
   * page-break-before: always;
   */
  var breaker = $('<div class="page-break"></div>');
  var pageOffset = 0;
  /**
   * Table splitting logic lives in this method
   * table - table to split, should be a jQuery object
   * tableIndex - and index from original page where this table is sitting, allows to properly insert table back to where it belonged
   * onTableSplittedCallback - a function that will be caleed when table will be splitted out - allows to do some post-processing if required
   */
  function splitTable(table, tableIndex, onTableSplittedCallback) {

    /**
     * Logic of appending a new table
     * container - jQuery object where we will append our table (NOTE: a collectable 'div' is used for each table in the script for memory optimization, it should be passed here)
     * trs - array of <tr> objects (non jQuery) for our new table
     * isLastBatch - passed as 'true' if we have tr's left over from processing and we don't want a page break because there still can be some place left on the page
     */
    function appendTable(container, trs, isLastBatch) {
      if (trs.length === 0) {
        container.append(breaker.clone());
        currentPageZero += breaker.outerHeight();
        return;
      }

      var splitTable = templateTable.clone();
      var splitTableBody = splitTable.find('tbody');
      splitTableBody.append(trs);
      
      //pass a new table to a custom process function for some post-processing if required
      if ($.isFunction(onTableSplittedCallback)) {
        splitTable = onTableSplittedCallback(splitTable);
      }
      //also add a page break after each new table
      container.append(splitTable);
      if (!isLastBatch) {
        container.append(breaker.clone());
      }
    }

    var trWalkProcessStart = 0;
    var trWalkProcessEnd = 0;
    var resultsApppendStart = 0;
    var resultsApppendEnd = 0;
    if (profile) {
      tableProcessStart = new Date().getTime();
    }

    table.css('width', pageWidth);

    var parent = table.parent();
    
    table.removeClass(splitClassName);

    if (table.hasClass('charts')) {
      var a = breaker.clone();
      if (debug) {
        a.text(pageOffset);
      }
      table.before(a);
      return;  
    }

    //The idea here is that we grab our header from original table, clone it, add some modifications and use it for all our future tables
    //find our header
    var originalHeader = table.find('tr.heading1');
    var tableHeader;
    var tableHeaderHeight;
    if (originalHeader.length > 0) {
      tableHeader = originalHeader.clone();
      tableHeader.addClass('page-split'); //mark header so we could display that this one is splitted
      /*
      * In my project we had to add ellipsis before header on each new page
      * Feel free to modify this part.
      * Idea here is that first row of the table determines all column widths, and if it will not be exactly as our header row - table will be messed up significantly
      * So, we have to make a copy of our header, clean it from the text and add some ellipsis
      */
      var ellipsis = tableHeader.clone();
      ellipsis.removeClass('heading1');
      ellipsis.find('th,td').each(function(i, e) {
        $(e).text("");
      });
      var ellipsisDiv = $('<div>').addClass('ellipsis').text("...");
      ellipsis.find('th:eq(0),td:eq(0)').append(ellipsisDiv);
      //!careful here. first row of table determines column widths!
      tableHeader = tableHeader.before(ellipsis);
    }

    //This will be template table that we will use for all splitted tables on new pages
    //we clone it so it would be the same as original, but remove all tr's, and add our customised header
    var templateTable = table.clone();
    templateTable.find('tbody > tr').remove();
    templateTable.append(tableHeader); //add common header to every template table
    //Again, this was project-specific, I had to add this row to make styling work properly. Feel free to remove.
    templateTable.append("<tr class='noborder'><td></td></tr>");

    var tmpTables = []; //this array will store temporarry tables - we will append them after splitting logic is finished
    var tmpTrs = []; //this array will store rows for each temporarry table
    var collectableDiv = $('<div>'); //this div will collect our splitted table

    /*Feel free to strip out debuggin and profiling to minimize script size*/
    if (debug) {
      var tt = $('tbody tr:eq(0)');
      var aa = $('<div>');
      table.before(aa);
    }
    if (profile) {
      trWalkProcessStart = new Date().getTime();
    }

    $('tbody tr', table).each(function() {
      var tr = $(this);
      //get offset for current page, taking custom pageOffset into consideration
      var trTop = tr.offset().top - currentPageZero - pageOffset;

      if (debug) {
        aa.text(aa.text() + "(o:" + tr.offset().top + " : t:" + trTop + " || ");
      }

      //if we fit the page with threshold - go ahead and push tr into tmpTrs array
      if (trTop >= pageHeight - splitThreshold) { //else go to the next page
        if (tmpTrs.length == 1 && $(tmpTrs[0]).hasClass('heading1')) {
          tmpTables.push([]); //if the only row we have fit the page is a header - add a page split and move on - we don't need a single header left in the end of the page
        } else {
          //another special case. if we hit the page end and  prev.row is 'heading2' - don't leave it last on the page
          if ($(tmpTrs[tmpTrs.length - 1]).hasClass('heading2')) {
            var heading2Row = tmpTrs.pop();
            var heading1Row = null;
            if ($(tmpTrs[tmpTrs.length - 1]).hasClass('heading1')) { //if it turnes out that heading1 is before - pop it also
              heading1Row = tmpTrs.pop();
            }
            tmpTables.push(tmpTrs);
            tmpTrs = [];
            if (heading1Row) {
              tmpTrs.push(heading1Row);
            }
            tmpTrs.push(heading2Row);
          } else {
            //save table and start new
            tmpTables.push(tmpTrs);
            tmpTrs = [];
          }
        }
        
        currentPageZero += pageHeight;
      }
      tmpTrs.push(tr[0]);
    });

    /*Feel free to strip out debuggin and profiling to minimize script size*/
    if (profile) {
      trWalkProcessEnd = new Date().getTime();
      profileDivsList.push("<div>== walk divs took:" + (trWalkProcessEnd - trWalkProcessStart) + "</div>")
    }

    //save leftower for the page and remove the original table away
    tmpTables.push(tmpTrs);
    tmpTrs = [];

    var originalTableHeight = table.outerHeight();    
    collectableDiv.css('width', table.width());
    table.remove();
    
    //append each splitted table to a collectable div
    $.each(tmpTables, function(i, trs) {
      appendTable(collectableDiv, trs, i === tmpTables.length - 1);
    })

    /*Feel free to strip out debuggin and profiling to minimize script size*/
    if (profile) {
      resultsApppendStart = new Date().getTime();
    }

    //add that div to the page and particular index - this is where rendering will take place
    var elementInParent = parent.children().eq(tableIndex);
    if (elementInParent.length > 0) {
      elementInParent.before(collectableDiv);
    } else {
      parent.children().eq(tableIndex - 1).after(collectableDiv);
    }
    pageOffset += (collectableDiv.outerHeight() - originalTableHeight); //new table can be greater then the original because we added some new headers

    /*Feel free to strip out debuggin and profiling to minimize script size*/
    if (profile) {
      resultsApppendEnd = new Date().getTime();
      profileDivsList.push("<div>== append results took:" + (resultsApppendEnd - resultsApppendStart) + "</div>")
    }
    if (profile) {
      tableProcessEnd = new Date().getTime();
      profileDivsList.push("<div>== process table at " + tableIndex + " took:" + (tableProcessEnd - tableProcessStart) + "</div>")
    }
  }

  while (tablesModified) {
    tablesModified = false;
    while($('table.' + splitClassName).length > 0) {
      var table = $('table.' + splitClassName + ':eq(0)');
      splitTable(table, table.index(), function(splittedTable) {
        //some custom post-processing for each new table. This aslo was project-specific, feel free to modify
        var headers = splittedTable.find('.heading1');
        if (headers.length > 1) {
          splittedTable.find('.ellipsis').addClass('hidden');
          splittedTable.find('.heading1.page-split').addClass('hidden');
        }
        if (splittedTable.find('.page-split').length > 0) {
          splittedTable.removeClass('new_section');
        }
        if (splittedTable.find('.page-split.hidden').length > 0) {
          splittedTable.addClass('new_section');
        }
        return splittedTable;
      });
    } 
  }

  /*Feel free to strip out debuggin and profiling to minimize script size*/
  endTime = new Date().getTime();
  var diffAdded = false;
  if (profile) {
    if (diffAdded) {
      return;
    }
    var timeDiv = $('<div>');
    var diff = endTime - startTime;
    if (diff > 0) {
      timeDiv.text(diff);
    }
    profileDivsList.push(timeDiv);
    diffAdded = true;

    $.each(profileDivsList, function(i, e) {
      var e = $(e);
      e.css('font-size', '18px');
      e.css('color', 'red');
      e.css('font-weight', 'bold');
      profileDiv.append(e);
    });

    profileDiv.css('position', 'absolute');
    profileDiv.css('left', '0');
    profileDiv.css('top', '250px');
    profileDiv.css('background-color', 'white');
    $('body').append(profileDiv);
  }
  
  // restore body's padding
  $body.css('padding-left', 0);
  $body.css('padding-right', 0);
});