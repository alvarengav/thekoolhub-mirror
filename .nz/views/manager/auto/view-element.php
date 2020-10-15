<?
$langActive = false;
$itemFActive = false;
$filemanager = false;
$ckEditor = false;
$title_ico = '<a?= (strpos($appTitleIco, "material-icons") === FALSE) ? "<i class=\'page-title-ico {$appTitleIco}\'></i>" : $appTitleIco ?a>';
$langsArr = array();
foreach ($fields as $field) :
  if($field->name == 'active') $itemFActive = true;
  if( (substr($field->name,0,7) == 'id_file' || substr($field->name,0,10) == 'id_gallery' ) && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) $filemanager = true;
  if (substr($field->name, -5) == '_lang')
  {
  	$rr = str_replace('_lang', '', $field->name);
  	$langsArr[$rr] = $rr;
  	$langActive = true;
  }
  if($field->type == 'text' && substr($field->name, -5) != '_lang') $ckEditor = true;
endforeach;
?><a? if( !AJAX ) $this->load->view("common/header") ?a>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<a?= $wgetId ?a>" method="post" action="<a?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?a>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
    <? if($itemFActive): ?>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
      <h1 class="page-title txt-color-blueDark"><?= $title_ico ?> <a?= prep_app_title($appTitle) ?a></h1>
    </div>
    <? else: ?>
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
      <h1 class="page-title txt-color-blueDark"><?= $title_ico ?> <a?= prep_app_title($appTitle) ?a></h1>
    </div>
    <a? $this->load->view("app/element/buttons-header", array('alt' => true)) ?a>
    <? endif ?>
  </div>
  <section class="widget-form-content">
    <div class="row">
    <? if($itemFActive): ?>
      <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="onoffswitch-container">
          <span class="onoffswitch-title"><a?= $this->lang->line("Estado") ?a></span>
          <span class="onoffswitch">
            <input name="active" value="1" type="checkbox" <a? if($dataItem['active'] == 1 || (!$idItem && !$this->input->post())): ?a>checked="checked"<a? endif ?a> class="onoffswitch-checkbox" id="activeForm<a?= $wgetId ?a>">
            <label class="onoffswitch-label" for="activeForm<a?= $wgetId ?a>">
              <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span>
              <span class="onoffswitch-switch"></span>
            </label>
          </span>
        </div>
      </div>
      <a? $this->load->view("app/element/buttons-header") ?a>
      <? endif ?>
    </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
      	<?php if ($langActive): ?>
        <a? $this->load->view("app/lang") ?a>
      	<?php endif ?>
        <div class="row">

<? $g = 1; $f = 1; $i = 0; $im = 0; foreach ($fields as $field) : ?><? if($field->type == 'date') : ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'date',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => mysql_to_calendar($dataItem[$field]),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => $this->lang->line("Seleccione fecha")
  ))) ?a>
<? elseif($field->type == 'time') : ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'timepicker',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => substr($dataItem[$field],0,5),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => $this->lang->line("Seleccione hora")
  ))) ?a>
<? elseif( substr($field->name,0,7) == 'id_file' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'filemanager',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fm<?= $f ?>',
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?a>
<? $f++; $i++; elseif( substr($field->name,0,10) == 'id_gallery' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'gallery',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fmg<?= $g ?>',
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?a>
<? $g++; $i++; elseif( substr($field->name,0,3) == 'id_' && ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['<?= TableToModel(set_value('lj'.$im)) ?>'],
    'label' => $this->lang->line('<?= $field->label ?>'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?a>
<? $i++;$im++; elseif($field->type == 'text') : ?>
<?php if (substr($field->name, -5) != '_lang'): ?>
<?php if ($langActive && isset($langsArr[$field->name])): ?>
	<a? foreach($this->model->langs as $l): ?a>
	<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 160,
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'lang' => $l,
    'data' => $dataItem,
  ))) ?a>
  <a? endforeach ?a>
  <div class="app-hh"></div>
<?php else: ?>
	<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 160,
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?a>
<?php endif ?>
<?php endif ?>
<? elseif($field->type == 'boolean' || ($field->type == 'tinyint' && $field->max_length == 1) || $field->type == 'bit') : if($field->name == 'active') continue; ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'columns' => 2,
    'type' => 'checkbox',
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'checked' => ($dataItem[$field] > 0)
  ))) ?a>
<? elseif($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint'  || $field->type == 'decimal' || $field->type == 'double' ) : ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'type' => 'number',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?a>
<? elseif($field->type != 'timestamp') : ?>
<?php if ($langActive && isset($langsArr[$field->name])): ?>
	<a? foreach($this->model->langs as $l): ?a>
	<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'columns' => <?= ($field->type == 'varchar') ? 4 : 2 ?>,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'lang' => $l,
    'data' => $dataItem,
  ))) ?a>
  <a? endforeach ?a>
  <div class="app-hh"></div>
<?php else: ?>
<a? $field = '<?= $field->name ?>'; $this->load->view('app/form', array('item' => array(
    'columns' => <?= ($field->type == 'varchar') ? 4 : 2 ?>,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('<?= $field->label ?>'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?a>
<? endif ?>
<? endif ?><? endforeach ?>
      </div>
      </fieldset>
      <div class="clear-sm"></div>
    </div>
    <a? $this->load->view("app/element/buttons-footer") ?a>
  </section>
</form>
</div>
<? if($filemanager):?>
<a? $this->load->view("script/filemanager/includes") ?a>
<? endif ?>
<?php if ($langActive): ?>
<a? $this->load->view("script/lang") ?a>
<?php endif ?>
<?php if ($ckEditor): ?>
<a? $this->load->view("script/ckeditor/includes") ?a>
<?php endif ?>
<script>
$(document).ready(function() {
  var formGlobal = $('#widget-form-<a?= $wgetId ?a>');

<?php if ($ckEditor): ?>
  <a? $this->load->view("common/ckeditor/config") ?a>;
  ckCfg.height = 400;
	<?php if ($langActive): ?><a? foreach($this->model->langs as $l): ?a>
  CKEDITOR.replace('text_<a?= $l ?a>Form<a?= $wgetId ?a>', ckCfg);
	<a? endforeach ?a>
	<?php else: ?>CKEDITOR.replace('textForm<a?= $wgetId ?a>', ckCfg);
	<?php endif ?><?php endif ?>

<a? if(!$this->MApp->secure->edit):?a>
  formGlobal.addClass('form-disabled');
  formGlobal.submit(function(e){
    e.preventDefault();
    e.stopPropagation();
    return false;
  });
<a? else: ?a>
  <a? if($idItem && !$quickOpen): ?a>
  App.changeURI('<a?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?a>');
  <a? endif ?a>
  formGlobal.validate({
<?php if ($ckEditor): ?>
    submitHandler: function(form) {
      for (instance in CKEDITOR.instances)
      {
        if(CKEDITOR.instances[instance])
        {
          CKEDITOR.instances[instance].updateElement();
        }
      }
      App.postForm(form);
    },
		<?php endif ?>
    rules : {
      /*<? $arr = array(); foreach ($fields as $field) :
    if( !$field->primary_key ) :
    if(substr($field->name,0,7) == 'id_file' || $field->type == 'text' || $field->type == 'boolean' || ($field->type == 'tinyint' && $field->max_length == 1) || $field->type == 'bit'):

    elseif( ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' || $field->type == 'decimal' || $field->type == 'double') ):
      $arr[] = "'{$field->name}': 'required'";
    else :
      $arr[] = "'{$field->name}': 'required'";
    endif;
    endif;
    endforeach;
    echo implode(',
      ', $arr); ?> */
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
  <a? endif ?a>
  <a? if($quickOpen): ?a>
  $('.action-close', formGlobal).click(function(e){
    e.preventDefault();
    window.close();
    return false;
  });
  <a? endif ?a>
  <? foreach ($fields as $field) : ?><? if($field->type == 'date') : ?>
  var datepickerItem = $('.form-calendar.form-post-<?= $field->name ?>', formGlobal);
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
<? elseif( substr($field->name,0,7) == 'id_file' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    <a? $field = '<?= $field->name ?>'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?a>
<? elseif( substr($field->name,0,10) == 'id_gallery' && ($field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : ?>
    <a? $field = '<?= $field->name ?>'; $this->load->view('script/filemanager/gallery.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?a>
<? elseif($field->type == 'time') : ?>
  var timepickerItem = $('.form-timepicker.form-post-<?= $field->name ?>', formGlobal);
  timepickerItem.timepicker({
    minuteStep: 5,
    showMeridian:false
  });
  $('.input-group-addon', timepickerItem.parents('.input')).click(function(){
    timepickerItem.timepicker('showWidget');
  });
<? endif ?><? endforeach ?>

});
</script>
<a? $this->load->view("common/footer") ?a>
