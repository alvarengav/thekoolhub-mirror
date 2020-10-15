<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
      <h1 class="page-title txt-color-blueDark"><?= (strpos($appTitleIco, "material-icons") === FALSE) ? "<i class='page-title-ico {$appTitleIco}'></i>" : $appTitleIco ?> <?= prep_app_title($appTitle) ?></h1>
    </div>
    <? $this->load->view("app/element/buttons-header", array('alt' => true)) ?>
      </div>
  <section class="widget-form-content">
    <div class="row">
        </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
      	        <div class="row">

<? $field = 'first_name'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nombre'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'last_name'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Apellido'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  <div class="clerafix"></div>
<? $field = 'age'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Edad'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'country'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('País'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'mail'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Mail'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?><? $field = 'club'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Club'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  <div class="clearfix"></div>
  <? $field = 'newsletter'; $this->load->view('app/form', array('item' => array(
      'columns' => 2,
      'type' => 'checkbox',
      'checked' => $dataItem[$field]=='on',
      'form' => $wgetId,
      'name' => $field,
      'label' => $this->lang->line('Newsletter'),
      'value' => $dataItem[$field],
      'error' => $this->validation->error($field),
      'class' => $this->validation->error_class($field),
      'placeholder' => ''
    ))) ?>
    
  <? $field = 'type'; $this->load->view('app/form', array('item' => array(
      'type' => 'number',
      'columns' => 2,
      'type' => 'checkbox',
      'checked' => $dataItem[$field]=='1',
      'form' => $wgetId,
      'name' => $field,
      'label' => $this->lang->line('Avísame'),
      'value' => $dataItem[$field],
      'error' => $this->validation->error($field),
      'class' => $this->validation->error_class($field),
      'placeholder' => ''
    ))) ?>
      <? $field = 'type'; $this->load->view('app/form', array('item' => array(
      'type' => 'number',
      'columns' => 2,
      'type' => 'checkbox',
      'checked' => $dataItem[$field]=='2',
      'form' => $wgetId,
      'name' => $field,
      'label' => $this->lang->line('Infórmame'),
      'value' => $dataItem[$field],
      'error' => $this->validation->error($field),
      'class' => $this->validation->error_class($field),
      'placeholder' => ''
    ))) ?>
      </div>
      </fieldset>
      <div class="clear-sm"></div>
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
  <? if($idItem && !$quickOpen): ?>
  App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
  <? endif ?>
  formGlobal.validate({
    rules : {
      /*'first_name': 'required',
      'last_name': 'required',
      'age': 'required',
      'country': 'required',
      'newsletter': 'required',
      'type': 'required',
      'mail': 'required' */
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
  
});
</script>
<? $this->load->view("common/footer") ?>
