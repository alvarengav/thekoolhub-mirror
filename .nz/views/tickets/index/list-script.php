<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_project", "value": $('#id_projectFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_category", "value": $('#id_categoryFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_reproducibility", "value": $('#id_reproducibilityFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_severity", "value": $('#id_severityFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_priority", "value": $('#id_priorityFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_state", "value": $('#id_stateFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_resolution", "value": $('#id_resolutionFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_visibility", "value": $('#id_visibilityFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_reporter", "value": $('#id_reporterFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_monitor", "value": $('#id_monitorFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_assigned", "value": $('#id_assignedFormSelect<?= $wgetId ?>').val() } );
    if($('#closedFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-closed", "value": 1 } );
    if($('#tclientFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-client", "value": 1 } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){  
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sWidth": "40px", "sTitle": "<?= $this->lang->line("ID") ?>", "mData": "id", "sType": "html", "mRender" : function( data, type, full ){  
      return ('000000' + data).slice(-5);
    }},
    { "sWidth": "10px", "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Notas") ?>", "mData": "notes", "sType": "string"},
    { "sWidth": "150px", "sTitle": "<?= $this->lang->line("Categoría") ?>",  "mData": "category", "sType": "html", "mRender" : function( data, type, full ){  
      if(full['id_category'] != 1)
        return data;
      return data + '<br>' + full['project'];
    }},
    { "sTitle": "<?= $this->lang->line("Severidad") ?>", "sWidth": "30px", "sClass": "text-align-center", "mData": "severity", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Prioridad") ?>", "sWidth": "30px", "sClass": "text-align-center", "mData": "priority", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Estado") ?>", "sWidth": "50px", "sClass": "text-align-center td-state-color", "mData": "state", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "50px", "sTitle": "<?= $this->lang->line("Actualizada") ?>", "mData": "modification", "sType": "html", "mRender" : function( data, type, full ){  
      if(!data || data == '0000-00-00 00:00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy hh:mm:ss");
    }},
    { "sTitle": "<?= $this->lang->line("Título") ?>", "mData": "title", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Acciones") ?>", "sWidth": "60px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){  
      return '<ul class="table-actions smart-form">' +         
      '<li><a title="<?= $this->lang->line("Revisar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/view/' + data + '" class="btn btn-xs btn-default edit-button" type="button"><i class="fa fa-actions fa-search"></i></a></li>' +
      <? if($this->model->mconfig['duplicate']): ?>'<li><a title="<?= $this->lang->line("Duplicar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/duplicate/' + data + '" class="btn btn-xs btn-default duplicate-button<?= ($this->model->mconfig['new-element'] && $this->MApp->secure->edit) ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-copy"></i></a></li>' + <? endif ?>
      '</ul>';
    }}
  ];
  var fnRowCallbackX = configDT.fnRowCallback;
  configDT.fnRowCallback = function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
    fnRowCallbackX( nRow, aData, iDisplayIndex, iDisplayIndexFull );
    if(!App.userData || (parseInt(aData['id_reporter']) != parseInt(App.userData.id) && !(App.userData.root || App.userData.atype == 1 || App.userData.type == 2)))
      $('.delete-button', nRow).addClass('disabled');
    $('.td-state-color', nRow).addClass('td-state-' + aData['id_state']);
  };
  
  <? $edit = $this->MApp->secure->edit; $this->MApp->secure->edit = false;
  $this->load->view("script/datatable/script.js");
  $this->MApp->secure->edit = $edit;
  ?>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>