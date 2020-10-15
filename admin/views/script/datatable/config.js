var colFilterPDF = [];
for (var i = 0; i < ((colFilterPDF.length>8) ? colFilterPDF.length : 8); i++) {
  colFilterPDF.push(colFilter[i]);
}
var iDisplayStart = 0, iDisplayLength = 25, aaSorting = [[ 1, "desc" ]], iFixedColumns = 2, iFixedColumnsRight = 1;
<? if ($appDSess->listStart): ?>
iDisplayStart = <?= $appDSess->listStart ?>;
<? endif ?>
<? if ($appDSess->listPagination): ?>
iDisplayLength = Math.max(iDisplayLength, <?= $appDSess->listPagination ?>);
<? endif ?>
var _iDisplayLengthPrev = 0;
var configDT = {
  "sAjaxSource": "<?= base_url() . "{$appController}/{$appFunction}" ?>/json",
  "sServerMethod": "POST",
  "bServerSide": true,
  "aLengthMenu": [[25, 50, 100, 200], [25, 50, 100, 200]],
  "tablePagination": true,
  "tableMinRows": 10,
  "fnInitComplete" : function(oSettings, json) {
    $(this).closest('#dt_table_tools_wrapper').find('.DTTT.btn-group').addClass('table_tools_group').children('a.btn').each(function() {
      $(this).addClass('btn-sm btn-default');
    });
    $('.widget-datatable .DTTT_button_collection').click(function(event) {
      var oSettings = DataT.fnSettings();
      _iDisplayLengthPrev = oSettings._iDisplayLength;
      oSettings._iDisplayLength = 1000*1000*1000;
      DataT.fnDraw();
      event.stopPropagation();
      $('body').one('click', function(){
        var oSettings = DataT.fnSettings();
        if(oSettings._iDisplayLength == _iDisplayLengthPrev) return;
        oSettings._iDisplayLength = _iDisplayLengthPrev;
        DataT.fnDraw();
      })
    });
  },
  "aaSorting": aaSorting,
  "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
    $(nRow).attr('data-id', aData['id']);
    $('.table-actions a', nRow).click(function(event){
      event.stopPropagation();
    }).addClass('tooltip-nz-app ttactive');
    App.loaderLink($('.app-loader', nRow));
    $('.no-propagation', nRow).click(function(event){
      event.stopPropagation();
    });
    $(nRow).click(function(event){
      $('.checkbox-select-row', nRow).click();
    });
    $('.checkbox-select-row', nRow).click(function(event){
      event.stopPropagation();
      $(nRow).toggleClass('row-selected');
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

    /*tooltip: function() {
      return {
        selector: '.tooltip-chat.tooltip-active',
        title: function(){
          return $(this).attr('data-title');
        },
        container: 'body',
        template: '<div class="tooltip tooltip-close-chat" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        placement: 'top'
      };*/

    $('.edit-button', nRow).click(function(event){
      var href = $(this).attr('href');
      App.loadURL(href, false);
      event.preventDefault();
      return false;
    });
    $('.duplicate-button', nRow).click(function(event){
      var href = $(this).attr('href');
      App.loadURL(href, true);
      event.preventDefault();
      return false;
    });
    $('.delete-button', nRow).click(function(event){
			event.preventDefault();
			var ths = $(this), href = ths.attr('href');
			if(ths.hasClass('action-sent'))
			{
				return false;
			}
			ths.addClass('action-sent').blur();
			var modal_html = App.Default('modal.confirm', {
					title : $('.page-title').html(),
					body 	: $('.page-title').attr('data-text-delete') || '<?= $this->lang->line('¿Estás seguro qué deseas eliminar este elemento?') ?>'
				})
			, modal = $(modal_html)
				.appendTo('body')
				.modal()
				.on('hidden.bs.modal', function (e) {
				  ths.removeClass('action-sent');
				  modal.remove();
				})
				.on('click', '.button-confirm', function(event) {
					event.preventDefault();
					$.ajax({
						url: href,
						type: "GET",
						dataType: "json",
						success:function(json){
							if(!json || (!parseInt(json.success) && !parseInt(json.result)))
							{
								return $.ambiance(App.Default('ambiance.error', {
									message: json.text || "<?= $this->lang->line('La acción no pudo ser realizada') ?>"
								}));
							}
							$.ambiance(App.Default('ambiance.success', {
								message: json.text || "<?= $this->lang->line('Elemento eliminado') ?>"
							}));
							ths.closest('tr[data-id]').fadeOut('200', function() {
								DataT._fnAjaxUpdate();
							});
						}
					});
				})
				.find('.button-confirm').removeClass('btn-primary').addClass('btn-danger')
			;

			return false;

    });
    $('.deactivate-button', nRow).click(function(event){
			event.preventDefault();
			var ths = $(this), href = ths.attr('href');
			if(ths.hasClass('action-sent'))
			{
				return false;
			}
			ths.addClass('action-sent').blur();
			var modal_html = App.Default('modal.confirm', {
					title : $('.page-title').html(),
					body 	: $('.page-title').attr('data-text-deactivate') || '<?= $this->lang->line('¿Estás seguro qué deseas desactivar este elemento?') ?>'
				})
			, modal = $(modal_html)
				.appendTo('body')
				.modal()
				.on('hidden.bs.modal', function (e) {
				  ths.removeClass('action-sent');
				  modal.remove();
				})
				.on('click', '.button-confirm', function(event) {
					event.preventDefault();
					$.ajax({
						url: href,
						type: "GET",
						dataType: "json",
						success:function(json){
              if(!json || (!parseInt(json.success) && !parseInt(json.result)))
							{
								return $.ambiance(App.Default('ambiance.error', {
									message: json.text || "<?= $this->lang->line('La acción no pudo ser realizada') ?>"
								}));
							}
							$.ambiance(App.Default('ambiance.success', {
								message: json.text || "<?= $this->lang->line('Elemento desactivado') ?>"
							}));
							DataT._fnAjaxUpdate();
						}
					});
				})
				.find('.button-confirm').removeClass('btn-primary').addClass('btn-danger')
			;

			return false;

    });
    $('.activate-button', nRow).click(function(event){
			event.preventDefault();
			var ths = $(this), href = ths.attr('href');
			if(ths.hasClass('action-sent'))
			{
				return false;
			}
			ths.addClass('action-sent').blur();
			var modal_html = App.Default('modal.confirm', {
					title : $('.page-title').html(),
					body 	: $('.page-title').attr('data-text-activate') || '<?= $this->lang->line('¿Estás seguro qué deseas activar este elemento?') ?>'
				})
			, modal = $(modal_html)
				.appendTo('body')
				.modal()
				.on('hidden.bs.modal', function (e) {
				  ths.removeClass('action-sent');
				  modal.remove();
				})
				.on('click', '.button-confirm', function(event) {
					event.preventDefault();
					$.ajax({
						url: href,
						type: "GET",
						dataType: "json",
						success:function(json){
              if(!json || (!parseInt(json.success) && !parseInt(json.result)))
							{
								return $.ambiance(App.Default('ambiance.error', {
									message: json.text || "<?= $this->lang->line('La acción no pudo ser realizada') ?>"
								}));
							}
							$.ambiance(App.Default('ambiance.success', {
								message: json.text || "<?= $this->lang->line('Elemento activado') ?>"
							}));
							DataT._fnAjaxUpdate();
						}
					});
				})
				.find('.button-confirm').removeClass('btn-primary').addClass('btn-danger')
			;

			return false;

    });
  },
  "sDom" : "<'dt-top-row'l<'filter-box'f<'smart-form filter-button'>>>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
  iDisplayStart: iDisplayStart,
  iDisplayLength: iDisplayLength,
  oLanguage:
    <? $this->load->view("app/lang/datatable/{$this->MApp->lang}") ?>

};
