<script type="text/javascript">
var DataTableFn = function(){
  var colFilter = [1<? $i = 2; foreach($fields as $field) { if($field->type != 'text') { echo ", {$i}"; $i++; } } ?>];
  
  <a? $this->load->view("script/datatable/config.js") ?a>
  
  configDT.fnServerParams = function ( aoData ) {
<? $i = 0; foreach ($fields as $field) : ?><? if( substr($field->name,0,3) == 'id_' && ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : if( substr($field->name,0,7) != 'id_file' ): ?>
    aoData.push( { "name": "filter-<?= $field->name ?>", "value": $('#<?= $field->name ?>FormSelect<a?= $wgetId ?a>').val() } );
<? endif; $i++; elseif($field->type == 'boolean' || $field->type == 'bit' || ($field->type == 'tinyint' && $field->max_length == 1 && substr($field->name,0,3) != 'id_') ) : ?>
    if($('#<?= $field->name ?>FormChk<a?= $wgetId ?a>').prop('checked'))
      aoData.push( { "name": "filter-<?= $field->name ?>", "value": 1 } );
<? endif ?><? endforeach ?>
    aoData.push( { "name": "filter-text", "value": $('#textFormInput<a?= $wgetId ?a>').val() } );
    <a? $this->load->view("script/datatable/order.js") ?a>
  };
  configDT.aoColumns = [
    { "sTitle": "<input class='checkbox-select-all' type='checkbox' />", "sWidth": "10px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<span class="checkbox"><input value="" name="" class="checkbox-select-row" type="checkbox"><i></i></span>';
    }},
    { "sTitle": "<a?= $this->lang->line("ID") ?a>", "sWidth": "40px", "mData": "id", "sType": "string"}<? $g = 1; $f = 1; $i = 0; foreach ($fields as $field) : if( !$field->primary_key ) : ?><? if(substr($field->name,0,7) == 'id_file') : ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sWidth": "60px", "sClass": "text-align-center widget-filemanager", "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "fm<?= $f?>file", "sType":"html", "mRender" : function( data, type, full ){ 
      var type = 0;
      if(data) type = full["fm<?= $f?>type"];
      return (data ? '<a class="no-propagation" href="<a?= upload() ?a>'+ full["fm<?= $f?>file"] +'<a?= thumb_version() ?a>" target="_blank">' : '') + '<div data-type="'+type +'" class="file-info type-'+ type +'"><div class="file-ico">' + ((data  && type == 1) ? '<img src="<a?= thumb_url() ?a>'+ full["<?= $field->name ?>"] +'<a?= thumb_version() ?a>" />' : '' ) +'</div></div>' + (data ? '</a>' : '');
    }}<? $f++; 
    elseif(substr($field->name,0,10) == 'id_gallery') : ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sWidth": "30px", "sClass": "text-align-center td-gallery-items",  "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "fmg<?= $g ?>", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!full["<?= $field->name ?>"] || !data || !parseInt(data)) return "<a?= $this->lang->line("Vacía") ?a>";
      if(data == 1)
        return "<a?= $this->lang->line("1 elemento") ?a>";
      return "<a?= $this->lang->line("{1} elementos") ?a>".replace('{1}', data);
    }}<? $g++; 
    elseif(substr($field->name,0,3) == 'id_') : ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "<?= substr($field->name,3) ?>", "sType": "string"}<? 
    elseif( $field->type == "datetime" || $field->type == "timestamp" ): ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sClass": "text-align-center", "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "<?= $field->name ?>", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00 00:00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy hh:mm:ss");
    }}<? elseif( $field->type == "date" ): ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sClass": "text-align-center", "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "<?= $field->name ?>", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || data == '0000-00-00') return '-';
      return Date.fromMysql(data).format("dd/MM/yyyy");
    }}<? elseif($field->type == 'boolean' || ($field->type == 'tinyint' && $field->max_length == 1) || $field->type == 'bit'): ?>,
    { "sClass": "text-align-center", "sWidth": "40px", "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "<?= $field->name ?>", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data || !parseInt(data)) return '<a?= $this->lang->line("No") ?a>';
      return '<a?= $this->lang->line("Si") ?a>';
    }}<? elseif( $field->type == "time" ): ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sClass": "text-align-center", "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "<?= $field->name ?>", "sType": "html", "mRender" : function( data, type, full ){ 
      if(!data) return '-';
      return data.substr(0,5);
    }}<? elseif($field->type != 'text'): ?>,
    { <? if($i > 8): ?>"bVisible": false, <? endif ?>"sClass": "text-align-center", "sTitle": "<a?= $this->lang->line("<?= $field->label ?>") ?a>", "mData": "<?= $field->name ?>", "sType": "string"}<? endif; $i++; endif ?><? endforeach ?>,
    { "sTitle": "<a?= $this->lang->line("Acciones") ?a>", "sWidth": "60px", "mData": "id", "bSortable": false, "bSearchable": false, "sType": "html", "mRender" : function( data, type, full ){ 
      return '<ul class="table-actions smart-form">' +         
      '<li><a title="<a?= $this->lang->line($this->MApp->secure->edit ? "Editar" : "Ver") ?a>" href="<a?= base_url() . "{$appController}/{$appFunction}" ?a>/element/' + data + '" class="btn btn-xs btn-default edit-button" type="button"><i class="fa fa-actions <a?= $this->MApp->secure->edit ? "fa-pencil" : "fa-search" ?a>"></i></a></li>' +
      <a? if($this->model->mconfig['duplicate']): ?a>'<li><a title="<a?= $this->lang->line("Duplicar") ?a>" href="<a?= base_url() . "{$appController}/{$appFunction}" ?a>/duplicate/' + data + '" class="btn btn-xs btn-default duplicate-button<a?= ($this->model->mconfig['new-element'] && $this->MApp->secure->edit) ? "" : " disabled" ?a>" type="button"><i class="fa fa-actions fa-copy"></i></a></li>' + <a? endif ?a>
      '<li><a title="<a?= $this->lang->line("Eliminar") ?a>" href="<a?= base_url() . "{$appController}/{$appFunction}" ?a>/delete/' + data + '" class="btn btn-xs btn-default delete-button<a?= $this->MApp->secure->delete ? "" : " disabled" ?a>" type="button"><i class="fa fa-actions fa-trash-o"></i></a></li>' + 
      '</ul>';
    }}
  ];
  
  <a? $this->load->view("script/datatable/script.js") ?a>  
  
};
$(document).ready(function() {
  setTimeout(DataTableFn, 10);
});
</script>