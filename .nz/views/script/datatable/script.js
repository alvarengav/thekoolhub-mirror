App.changeURI('<?= current_url() ?>');

var DataCROptions = {
  "fnReorderCallback": function () {
    createColumnFilter();
    saveSessionColumns();
  },
  "iFixedColumnsRight": iFixedColumnsRight,
  "iFixedColumns": iFixedColumns
};
var DataTShowColButton = true;
<? 
if ($appDSess->listColumns): ?>
var aiOrder = [];
$.each($.parseJSON('<?= $appDSess->listColumns ?>'), function(index,el){
  var found = false;
  $.each(configDT.aoColumns, function(col,item){
    if(found) return;
    if(item['mData'] == el['id'] && !configDT.aoColumns[col].bMatchCK)
    {
      aiOrder.push(col);
      configDT.aoColumns[col].bMatchCK = true;
      configDT.aoColumns[col].bVisible = el['visible'];
      found = true;
    }
  });
});
if(aiOrder.length)
  DataCROptions.aiOrder = aiOrder;
<? endif ?>

if(!configDT.tablePagination)
{
  var dLen = 1000;
  configDT.iDisplayLength = (configDT.iDisplayLength < dLen) ? dLen : configDT.iDisplayLength;
}


var DataT = $('#datatable<?= $wgetId ?>').dataTable(configDT);
window.DataT = DataT;
var saveSessionColumns = function(){
  var orderC = [];
  $.each($('.widget-datatable-columns .widget-datatable-columns-list .checkbox input.checkbox-input'), function(index, el){
    orderC.push({'id': $(el).attr('data-key'),'visible': $(el).prop('checked')});
  });
  $.ajax({
    url: '<?= base_url() ?>app/session',
    type: "POST",
    data: {
      'item': '<?= "{$appController}-{$appFunction}" ?>',
      'values': {
        'listColumns': JSON.stringify(orderC)
      }
    },
    dataType: "json"
  });
}
var createColumnFilter = function(){
  $('.widget-datatable-columns .widget-datatable-columns-list').children().remove();
  $.each(DataT.fnSettings().aoColumns, function(index, el){
    if(el['bVisible'] == undefined) el['bVisible'] = true;
    if(!el['bVisible'])
    {
      DataTShowColButton = true;
    }
    var element = $('<label class="checkbox'+ ((!index || el['mData'] == 'id')? ' hide' : '' )+'"><input data-key="'+el['mData']+'" data-index="'+index+'" data-column="'+index+'" ' + (el['bVisible'] ? 'data-checked="true" checked="checked" ' : '' ) + 'type="checkbox" class="checkbox-input" /> <i></i> '+el['sTitle']+'</label>');
    element.appendTo($('.widget-datatable-columns .widget-datatable-columns-list'));
    $('input.checkbox-input',element).change(function(){
      DataT.fnSetColumnVis( $(this).attr('data-column'),  $(this).prop('checked') );
      saveSessionColumns();
      $(window).resize();
    });
  });
}
var DataFH = new $.fn.dataTable.FixedHeader( DataT );
var DataCR = new $.fn.dataTable.ColReorder( DataT, DataCROptions);
$(window).on('resize', function () {
  DataFH._fnUpdateClones(true);
  $('.widget-datatable .widget-body-toolbar').height($('#datatable<?= $wgetId ?>_wrapper .filter-box').height());
  if(DataT.width() > DataT.parent('.dt-wrapper').width())
    $('.FixedHeader_Header').addClass('hide');
  else
    $('.FixedHeader_Header').removeClass('hide');
  $('.FixedHeader_Header').addClass('dataTables_wrapper');
});

$('.widget-datatable-columns .widget-datatable-columns-list').sortable({
  stop: function( event, ui ){
    var order = [];
    $.each($('.widget-datatable-columns .widget-datatable-columns-list .checkbox input.checkbox-input'), function(index, el){
      $(el).attr('data-column', index);
      order.push(parseInt($(el).attr('data-index')));
      $(el).attr('data-index', index);
    });
    saveSessionColumns();
    DataCR.fnOrder(order);
    $(window).resize();
  }
});
DataT.on('draw', function () {

    var minRows = configDT.tableMinRows, totalRows = $('> tbody > tr', DataT).length;
    $('> tbody > tr.extra-row', DataT).remove();

    <? if(!isset($disableMinRows)): ?>
    if(DataT.fnSettings()._iRecordsDisplay && totalRows < minRows)
    {
      var row = $('> tbody > tr', DataT).last();
      for(i = 0; i < minRows - totalRows; i++)
      {
        var clone = row.clone();
        $('td', clone).attr('class', '').html('&nbsp;').css('background', '');
        clone.attr('class', '').addClass('extra-row').removeAttr('data-id').appendTo($('tbody', DataT));
      }
    }
    <? endif ?>
    var dp = DataT.fnSettings()._iDisplayLength, dt = DataT.fnSettings()._iRecordsTotal;
    if(dp >= dt)
    {
      $('#datatable<?= $wgetId ?>_wrapper .dataTables_paginate').hide();
    }
    else
    {
      $('#datatable<?= $wgetId ?>_wrapper .dataTables_paginate').show();
    }
    if(configDT.tablePagination)
    {
      if(dp <= 25 && dp > dt)
      {
        $('#datatable<?= $wgetId ?>_wrapper .dataTables_length').hide();
        $('#datatable<?= $wgetId ?>_wrapper .DTTT.btn-group').css('right', 6);
      }
      else
      {
        $('#datatable<?= $wgetId ?>_wrapper .dataTables_length').show().css('right', 6);
        $('#datatable<?= $wgetId ?>_wrapper .DTTT.btn-group').css('right', 85);
      }
    }
    else
    {
      $('#datatable<?= $wgetId ?>_wrapper .dataTables_length').hide();
      $('#datatable<?= $wgetId ?>_wrapper .DTTT.btn-group').css('right', 6);
    }

  $('#datatable<?= $wgetId ?>_wrapper .dataTables_paginate:visible a').click(function(event) {
    $('html, body').stop().animate({scrollTop : 0}, 200);
  });

  $('#datatable<?= $wgetId ?>_wrapper .filter-button').html('<button type="button" class="btn btn-color-coral button-show-filters button-toggle hide"><?= $this->lang->line("Más filtros") ?></button><button type="button" class="btn btn-color-coral button-hide-filters button-toggle"><?= $this->lang->line("Ocultar filtros") ?></button><button type="button" class="btn btn-color-orange button-show-columns hide"><?= $this->lang->line("Más columnas") ?></button><button type="button" class="btn-danger btn btn-color-red button-remove-filters"><?= $this->lang->line("Borrar filtros") ?></button><button type="button" class="btn-danger btn btn-default button-count-selected button-delete-selected hide<?= $this->MApp->secure->delete ? "" : " force-hide"?>" data-label="<?= $this->lang->line("Borrar seleccionados") ?>"></button><button type="button" class="btn-info btn btn-default button-count-selected button-edit-selected hide" data-label="<?= $this->lang->line($this->MApp->secure->edit ? "Abrir seleccionados" : "Abrir seleccionados") ?>"></button><span class="app-cb"></span>');
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-remove-filters').off('click').on('click', function(){
    $('.widget-datatable .widget-datatable-filters .select select').val('');
    $('.widget-datatable .widget-datatable-filters .input input').val('');
    $('.widget-datatable .widget-datatable-filters .checkbox input').prop('checked', false);
    DataT.fnFilter('');
    $(window).resize();
  });
  $('.widget-datatable .dataTables_filter .input-group input').attr('placeholder', '<?= $this->lang->line("Filtrar") ?>');
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-edit-selected').off('click').on('click', function(){
    var trs = $('> tbody > tr.row-selected', DataT);
    if (!trs.length) return;
    var url = false, window_options = 'height=' + ($(window).height()+10) + 'px,width=' + $(window).width() + 'px,resizable=yes,scrollbars=yes,toolbar=yes,menubar=yes,location=yes';
    $('> tbody > tr.row-selected .table-actions a', DataT).each(function(index, el) {
    	var href = $(el).attr('href');
    	if(href.lastIndexOf('/element/') > -1)
    	{
    		url = href.substr(0, href.lastIndexOf('/element/')) + '/element/${id}/quick';
    		return false;
    	}
    });
    if (!url)
    {
    	return;
    }  	 
    if(trs.length == 1)
    {
      return window.open(url.replace('${id}', trs.eq(0).attr('data-id')), '_blank', window_options);
    }
    event.preventDefault();
    var ths = $(this);
    if(ths.hasClass('action-sent'))
    {
    	return false;
    }
    ths.addClass('action-sent').blur();
    var modal_html = App.Default('modal.confirm', {
    		title : $('.page-title').html(),
    		body 	: "<?= $this->lang->line('¿Estás seguro qué deseas abrir {1} elementos?') ?>".replace('{1}', trs.length)
    	})
    , modal = $(modal_html)
    	.appendTo('body')
    	.modal()
    	.on('hidden.bs.modal', function (e) {
    	  ths.removeClass('action-sent');
    	  modal.remove();
    	})
    	.on('click', '.button-confirm', function(event) {
      	$.each($('> tbody > tr.row-selected', DataT), function(index, el){
      	   setTimeout(function(){
      	    window.open(url.replace('${id}', $(el).attr('data-id')), '_blank', window_options)
      	   }, 300 + 250 * index);
      	});
    	})
    ;

    return false;
  });
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-delete-selected').off('click').on('click', function(){
    var len = $('> tbody > tr.row-selected', DataT).length;
  	event.preventDefault();
  	var ths = $(this), href = ths.attr('href');
  	if(ths.hasClass('action-sent'))
  	{
  		return false;
  	}
  	ths.addClass('action-sent').blur();
  	var modal_html = App.Default('modal.confirm', {
	  		title : $('.page-title').html(),
	  		body 	: ($('.page-title').attr('data-text-deletem') || "<?= $this->lang->line('¿Estás seguro qué deseas eliminar {1} elementos?') ?>").replace('{1}', len)
	  	})
	  	, modal = $(modal_html)
	  	.appendTo('body')
	  	.modal()
	  	.on('hidden.bs.modal', function (e) {
	  		ths.removeClass('action-sent');
	  		modal.remove();
	  	})
	  	.on('click', '.button-confirm', function(event) {
	  		var ids = new Array();
	  		$.each($('> tbody > tr.row-selected', DataT), function(index, el){
	  		   ids.push($(el).attr('data-id'));
	  		});
	  		$.ajax({
	  		  url: "<?= base_url() . "{$appController}/{$appFunction}" ?>/deletem",
	  		  type: "POST",
	  		  data: { ids : ids.join(',') },
	  		  dataType: "json",
	  		  success:function(result){
	  		    DataT._fnAjaxUpdate();
	  		  }
	  		});
	  	})
			.find('.button-confirm').removeClass('btn-primary').addClass('btn-danger')	  	
  	;
  	return false;
  });
  $('.dataTable .checkbox-select-all').off("click").on("click", function(){
    if($(this).prop('checked'))
    {
      $('> tbody > tr', DataT).addClass('row-selected');
      $('> tbody > tr .checkbox-select-row', DataT).prop('checked', true);
    }
    else
    {
      $('> tbody > tr', DataT).removeClass('row-selected');
      $('> tbody > tr .checkbox-select-row', DataT).prop('checked', false);
    }
    var len = $('> tbody > tr.row-selected', DataT).length;
    if(len)
    {
      $.each($('#datatable<?= $wgetId ?>_wrapper .filter-button .button-count-selected'), function(index, el){
        var el = $(el);
        el.html(el.attr('data-label') + ' (' + len + ')');
        el.removeClass('hide');
      });
    }
    else
      $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-count-selected').addClass('hide');
  });

  if($('.widget-datatable .widget-datatable-filters .col-filter').length)
    $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-show-filters').removeClass('hide');
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-show-filters').click(function(){
    $('#textFormInput<?= $wgetId ?>').val($('#datatable<?= $wgetId ?>_wrapper .filter-box .dataTables_filter input').val());
    $('#datatable<?= $wgetId ?>_wrapper .filter-box .dataTables_filter input').val('');
    $('#datatable<?= $wgetId ?>_wrapper .filter-box').addClass('showing');
    $('.widget-datatable .widget-datatable-filters').addClass('show');
    DataT.fnFilter('');
    $(window).resize();
  });

  if(DataTShowColButton)
    $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-show-columns').removeClass('hide');

  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-show-columns').off('click').on('click', function(){
    createColumnFilter();
    $('#datatable<?= $wgetId ?>_wrapper .filter-box').addClass('showing-columns');
    $('.widget-datatable .widget-datatable-columns').addClass('show');
    $(window).resize();
  });

  <? if ( ! empty($showFilters)): ?>
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-hide-filters').addClass('hide');
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-show-filters').addClass('hide');
  $('#datatable<?= $wgetId ?>_wrapper .filter-box').addClass('showing');
  $('.widget-datatable .widget-datatable-filters').addClass('show');
  $(window).resize();
  <? endif ?>


  $('.widget-datatable .widget-datatable-columns .button-reset-columns').off('click').on('click', function(){
    $.ajax({
      url: '<?= base_url() ?>app/session',
      type: "POST",
      data: {
        'item': '<?= "{$appController}-{$appFunction}" ?>',
        'values': {
          'listColumns': '',
          'listSort': '',
          'listSortType': '',
          'listStart': ''
        }
      },
      dataType: "json",
      success:function(result){
        App.loadURL('<?= base_url() . "{$appController}/{$appFunction}" ?>');
      }
    });
  });
  $('.widget-datatable .widget-datatable-columns .button-hide-columns').off('click').on('click', function(){
    $('#datatable<?= $wgetId ?>_wrapper .filter-box').removeClass('showing-columns');
    $('.widget-datatable .widget-datatable-columns').removeClass('show');
    $(window).resize();
  });
  $('#datatable<?= $wgetId ?>_wrapper .filter-button .button-hide-filters').off('click').on('click', function(){
    $('#datatable<?= $wgetId ?>_wrapper .filter-box .dataTables_filter input').val($('#textFormInput<?= $wgetId ?>').val());
    $('#textFormInput<?= $wgetId ?>').val('');
    $('#datatable<?= $wgetId ?>_wrapper .filter-box').removeClass('showing');
    $('.widget-datatable .widget-datatable-filters').removeClass('show');
    $(window).resize();
  });
  $(window).resize();
});
$('#textFormInput<?= $wgetId ?>').off('keydown').on('keydown', function(e){
  if(e.keyCode == 13)
    DataT._fnAjaxUpdate();
});
$('#button-datatable-search<?= $wgetId ?>').off('click').on('click', function(){
  DataT._fnAjaxUpdate();
});
