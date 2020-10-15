<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
        
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico <?= $appTitleIco ?>"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
      </div>
  <section class="widget-form-content">
    <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="onoffswitch-container">
          <span class="onoffswitch-title"><?= $this->lang->line("Estado") ?></span> 
          <span class="onoffswitch">
            <input name="active" value="1" type="checkbox" <? if($dataItem['active'] == 1 || (!$idItem && !$this->input->post())): ?>checked="checked"<? endif ?> class="onoffswitch-checkbox" id="activeForm<?= $wgetId ?>">
            <label class="onoffswitch-label" for="activeForm<?= $wgetId ?>"> 
              <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
              <span class="onoffswitch-switch"></span>
            </label> 
          </span>
        </div>
      </div>
      <? $this->load->view("app/element/buttons-header") ?>   
          </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
        <div class="row">
        
<? $field = 'id_client'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectClient'],
    'label' => $this->lang->line('Cliente'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'date'; $this->load->view('app/form', array('item' => array(
    'type' => 'date',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Inicio'),
    'value' => mysql_to_calendar($dataItem[$field]),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => $this->lang->line("Seleccione fecha")
  ))) ?>
<? $field = 'finish'; $this->load->view('app/form', array('item' => array(
    'columns' => 2,
    'type' => 'checkbox',
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Terminado'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?>
      </div>
        <div class="row">
<? $field = 'project'; $this->load->view('app/form', array('item' => array(
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Proyecto'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'url'; $this->load->view('app/form', array('item' => array(
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('URL'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
      </div>
        <div class="row">
<? $field = 'obs'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Observaciones'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_file'; $this->load->view('app/form', array('item' => array(
    'type' => 'filemanager',
    'global' => true,
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fm1',
    'label' => $this->lang->line('Imagen'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
      </div>
        <div class="row">
          <section style="margin-bottom:0" class="col col-12 widget-project-companies">
            <div class="widget-title"><?= $this->lang->line('Empresas asignadas') ?> <span class="alt">(<?= $this->lang->line('arrastrar para reordenar') ?>)</span></div>
            <div class="companies-list">
              <? $companies = $this->model->Companies($idItem);
              $items = "";
              foreach($companies as $c): 
              $checked = $c->project;
              if(!$idItem && !$checked && $c->type == 1)
                $checked = true;
              ?>
              <div class="companies-item">
                <label class="checkbox">
                  <input name="companies[<?= $c->idcompany ?>]" <?= $checked ? "checked='checked' " : "" ?>type="checkbox" />
                  <i></i> <?= $c->company ?>
                </label>
              </div>
              <? endforeach ?>
            </div>
          </section>
        </div>      
        
      </fieldset>
      
      <fieldset class="widget-project-info">
        <div class="widget-title"><?= $this->lang->line('Información adicional') ?></div>

      <table class="table table-contoured table-striped table-hover table-rates-adv-season">
        <thead>
          <tr>
            <th class="handle" style="width:1%"></th>
            <th style="width:20%"><?= $this->lang->line("Información") ?></th>
            <th style="width:19%"><?= $this->lang->line("Clave") ?></th>
            <th style="width:58%"><?= $this->lang->line("Valor") ?></th>
            <th style="width:2%"></th>
          </tr>
        </thead>
        <tbody>
          <tr class="pg-basic-tr">
            <td style="width:1%" class="handle">:</td>
            <td style="width:20%">
            <? $field = 'name'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'name' => $field,
              'placeholder' => $this->lang->line("Nombre")
            ))) ?>
            </td> 
            <td style="width:19%">
            <? $field = 'key'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'name' => $field,
              'placeholder' => $this->lang->line("Clave")
            ))) ?>
            </td>
            <td style="width:58%">
            <? $field = 'value'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'name' => $field,
              'placeholder' => $this->lang->line("Valor")
            ))) ?>
            </td>
            <td  style="width:2%" style="text-align:center"><a class="btn btn-xs btn-default delete-row-button tooltip-nz-app ttactive" type="button" data-title="Eliminar"><i class="fa fa-actions fa-trash-o"></i></a></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5">
              <? if($this->MApp->secure->edit):?>
              <a class="add-new-td-row" href="#"><?= $this->lang->line("Agregar nuevo dato") ?></a>
              <? endif ?>
            </td>
          </tr>
        </tfoot>
      </table>
        
      </fieldset>
    </div>
    <? $this->load->view("app/element/buttons-footer") ?>   
  </section>     
</form>
</div>

<script>
$(document).ready(function() {
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
<? if(!$this->MApp->secure->edit):?>
  formGlobal.addClass('form-disabled');
  formGlobal.submit(function(e){
    e.preventDefault();
    e.stopPropagation();
    return false;
  });
<? else: ?>
  <? if($idItem): ?>
  App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
  <? endif ?>
  $('.widget-project-info table .pg-basic-tr input', formGlobal).each(function(index,input){
    input = $(input)
    input.attr('data-name', input.attr('name'));
    input.attr('name', '');
  });
  var cloneItem = function(){
    var last = $('.widget-project-info table tbody tr:not(.pg-basic-tr)', formGlobal).last();
    var clone = $('.widget-project-info table .pg-basic-tr', formGlobal).clone().removeClass('pg-basic-tr')
    var indexC = last.length ? parseInt(last.attr('data-index')) + 1 : 0;
    clone.attr('data-index', indexC);
    $('input', clone).each(function(index,input){
      input = $(input)
      input.attr('name', 'data[' + indexC + '][' + input.attr('data-name') + ']');
    });
    $('.delete-row-button', clone).click(function(e){
      clone.remove();
      App.clearGarbage();
    });
    clone.appendTo($('.widget-project-info table tbody', formGlobal));
    $('.widget-project-info table tbody', formGlobal).sortable("refresh");
    return clone
  };
  $('.widget-project-info table tbody', formGlobal).sortable({ items: 'tr:not(.pg-basic-tr)',  cursor: "move", forcePlaceholderSize: true, axis: "y", handle: ".handle" });
  var cItem = false;
  <? if($dataItem['data']): 
  $dataItem['data'] = json_decode($dataItem['data']);
  if(is_array($dataItem['data'])):
  foreach($dataItem['data'] as $d): $d = (array)$d;?>
  cItem = cloneItem();
  <? foreach($d as $k => $v):?>
  $('.form-post-<?= $k ?>', cItem).val('<?= addslashes($v) ?>');
  <? endforeach ?>
  <? endforeach ?>
  <? endif ?>
  <? endif ?>
  $('.widget-project-info .add-new-td-row', formGlobal).click(function(e){
    e.preventDefault();
    cloneItem();    
  });
  $('.widget-project-companies .companies-list', formGlobal).sortable({delay: 150});
  formGlobal.validate({   
    rules : {
      'id_client': 'required',
      'date': 'required',
      'project': 'required'
    },
    messages : {
    }
  });  
  
  $('.btn.save-action',formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('0');
    formGlobal.submit();
  });
  $('.btn.save-action-close', formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('1');
    formGlobal.submit();
  });
  <? endif ?>  
  <? if($quickOpen): ?>
  $('.action-close', formGlobal).click(function(e){
    e.preventDefault();
    window.close();
    return false;
  });
  <? endif ?>
  var datepickerItem = $('.form-calendar.form-post-date', formGlobal);
  datepickerItem.datepicker({
    defaultDate: "-1w",
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd/mm/yy",
    numberOfMonths: 2,
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
    onClose: function (selectedDate) {}
  });
  $('.input-group-addon', datepickerItem.parents('.input')).click(function(){
    datepickerItem.datepicker('show');
  });
  <? $field = 'id_file'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?>
  
});
</script>
<?php $this->load->view("common/footer") ?>