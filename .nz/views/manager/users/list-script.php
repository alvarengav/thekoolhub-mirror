<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1, 2, 3, 4, 5, 6, 7, 8];
  
  <? $this->load->view("script/datatable/config.js") ?>
  
  configDT.fnServerParams = function ( aoData ) {
    aoData.push( { "name": "filter-id_type", "value": $('#id_typeFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_client", "value": $('#id_clientFormSelect<?= $wgetId ?>').val() } );
    aoData.push( { "name": "filter-id_company", "value": $('#id_companyFormSelect<?= $wgetId ?>').val() } );
    if($('#activeFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-active", "value": 1 } );
    if($('#validFormChk<?= $wgetId ?>').prop('checked'))
      aoData.push( { "name": "filter-valid", "value": 1 } );
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<?= $wgetId ?>').val() } );
    <? $this->load->view("script/datatable/order.js") ?>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){  
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},    
    { "sWidth": "60px", "sClass": "text-align-center widget-filemanager", "sTitle": "<?= $this->lang->line("Imagen") ?>", "mData": "fm1file", "sType":"html", "mRender" : function( data, type, full ){ 
      var type = 0;
      if(data) type = full["fm1type"];
      return (data ? '<a class="no-propagation" href="<?= upload('', true) ?>'+ full["fm1file"] +'" target="_blank">' : '') + '<div data-type="'+type +'" class="file-info type-'+ type +'"><div class="file-ico">' + ((data  && type == 1) ? '<img src="<?= thumb_url('', true) ?>'+ full["id_file"] +'<?= thumb_version() ?>" />' : '' ) +'</div></div>' + (data ? '</a>' : '');
    }},
    { "sTitle": "<?= $this->lang->line("Nombre") ?>", "mData": "name", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Apellido") ?>", "mData": "lastname", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("E-mail") ?>", "mData": "mail", "sType": "string"},
    { "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<?= $this->lang->line("Activo") ?>", "mData": "active", "sType": "html", "mRender" : function( data, type, full ){  
      if(!data || !parseInt(data)) return '<?= $this->lang->line("No") ?>';
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "sClass": "text-align-center", "sWidth": "100px", "sTitle": "<?= $this->lang->line("Válido") ?>", "mData": "valid", "sType": "html", "mRender" : function( data, type, full ){ 
      <? if($this->MApp->secure->edit): ?>
      if(!data || !parseInt(data))
        return '<a href="<?= base_url() . "{$appController}/{$appFunction}" ?>/validate/' + full.id + '" class="no-propagation highlight-warning app-loader validate-user-button"><i class="fa fa-warning"></i> <?= $this->lang->line("Validar") ?></a>'      
      if(parseInt(data) == 2)
      {
        return '<?= $this->lang->line("Pendiente") ?>';
        return '<a href="<?= base_url() . "{$appController}/{$appFunction}" ?>/validate/' + full.id + '" class="no-propagation highlight-warning app-loader validate-user-button"><i class="fa fa-warning"></i> <?= $this->lang->line("Reenviar") ?></a>';
      }
      <? else: ?>
      if(!data || parseInt(data) != 1)
        return '<?= $this->lang->line("No") ?>';
      <? endif ?>
      return '<?= $this->lang->line("Si") ?>';
    }},
    { "sWidth": "60px", "sClass": "text-align-center", "sTitle": "<?= $this->lang->line("Empresa") ?>", "mData": "company", "sType": "html", "mRender" : function( data, type, full ){  
      if(!data || !parseInt(full['id_company'])) return '-';
      return '<a class="app-loader" href="<?= base_url() ?>manager/companies/element/' + full['id_company'] + '/back?uri=<?= current_url() ?>">' + data + '</a>';
    }},
    { "sClass": "text-align-center", "sWidth": "50px", "sTitle": "<?= $this->lang->line("Tipo de usuario") ?>", "mData": "type", "sType": "string"},
    { "sTitle": "<?= $this->lang->line("Acciones") ?>", "sWidth": "60px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){  
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
