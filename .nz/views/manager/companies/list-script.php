<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    if($('#activeFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-active", "value": 1 } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){  
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sWidth": "60px", "sClass": "text-align-center widget-filemanager", "sTitle": "<?= $this->lang->line("Logo") ?>", "mData": "fm1file", "sType":"html", "mRender" : function( data, type, full ){ 
      var type = 0;
      if(data) type = full["fm1type"];
      return (data ? '<a class="no-propagation" href="<?= upload('', true) ?>'+ full["fm1file"] +'" target="_blank">' : '') + '<div data-type="'+type +'" class="file-info type-'+ type +'"><div class="file-ico">' + ((data  && type == 1) ? '<img src="<?= thumb_url('', true) ?>'+ full["id_file"] +'<?= thumb_version() ?>" />' : '' ) +'</div></div>' + (data ? '</a>' : '');
    }},
    { "sTitle": "<?= $this->lang->line("Empresa") ?>", "mData": "company", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("E-Mail") ?>", "mData": "mail", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Activa") ?>", "mData": "active", "sType": "html", "mRender" : function( data, type, full ){  
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "sClass": "text-align-center", "sWidth": "70px",  "sTitle": "<?= $this->lang->line("Tipo de empresa") ?>", "mData": "id_type", "sType": "html", "mRender" : function( data, type, full ){
      if(parseInt(data) == 1)
        return full['type'];
      if(!full['client'])
        return '';
      return full['type'] + '<br>' + '<a class="app-loader" href="<?= base_url() ?>manager/clients/element/' + full['id_client'] + '/back?uri=<?= current_url() ?>">' + full['client'] + '</a>';
    }},
    { "sClass": "text-align-center", "sWidth": "50px",  "sTitle": "<?= $this->lang->line("Relaciones") ?>", "mData": "relations", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "50px",  "sTitle": "<?= $this->lang->line("Proyectos") ?>", "mData": "projects", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "50px",  "sTitle": "<?= $this->lang->line("Usuarios") ?>", "mData": "users", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Acciones") ?>", "sWidth": "40px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){  
      return '<ul class="table-actions smart-form">' +         
      '<li><a title="<?= $this->lang->line($this->MApp->secure->edit ? "Editar" : "Ver") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/element/' + data + '" class="btn btn-xs btn-default edit-button" type="button"><i class="fa fa-actions <?= $this->MApp->secure->edit ? "fa-pencil" : "fa-search" ?>"></i></a></li>' +
      <? if($this->model->mconfig['duplicate']): ?>'<li><a title="<?= $this->lang->line("Duplicar") ?>" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/duplicate/' + data + '" class="btn btn-xs btn-default duplicate-button<?= ($this->model->mconfig['new-element'] && $this->MApp->secure->edit) ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-copy"></i></a></li>' + <? endif ?>
      '</ul>';
    }}
  ];
  
  <? $this->load->view("script/datatable/script.js") ?>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>
