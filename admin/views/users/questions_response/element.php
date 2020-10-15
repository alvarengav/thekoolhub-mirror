<?

use function GuzzleHttp\json_decode;

if( !AJAX ) $this->load->view("common/header") ?>
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

<? $field = 'id_user'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUser'],
    'label' => $this->lang->line('Usuario'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  <? $field = 'datetime'; $this->load->view('app/form/datetime', array('item' => array(
      'columns' => 2,
      'form' => $wgetId,
      'name' => $field,
      'label' => $this->lang->line('Fecha'),
      'value' => $dataItem[$field],
      'error' => $this->validation->error($field),
      'class' => $this->validation->error_class($field),
      'placeholder' => ''
    ))) ?>
    <div class="clearfix"></div>
	<? /*$field = 'responses'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'height' => 160,
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Respuestas'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  )))*/
    // var_dump( );
    /*foreach( $responses as $r ) : ?>
    <? endforeach*/ ?>
    <?
  $field = 'responses';
  $label = 'Preguntas';
  // $responses = json_decode($dataItem['responses']); ?>
  <div class="col col-md-12">
  <table class="table table-contoured table-striped table-hover table-rates-adv-season">
    <thead>
      <tr>
        <!-- <th class="handle" style="width:1%"></th> -->
        <th style="">Pregunta</th>
        <th style="">Respuestas</th>
        <!-- <th class="handle" style="width:3%"></th> -->
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataItem[$field] as $q):  ?>
      <tr>
        <!-- <th class="handle" style="width:1%"></th> -->
        <th style=""><?= $q->questinon ?></th>
        <th style="">
          <ul style=" padding: 0; list-style: none; ">
            <?php foreach ($q->qanwers as $a): ?>
              <li style="<?= $a->answer_check == 1 ? 'color: green;' : 'ext-decoration: line-through; color: #c7c7c7;' ?>"><?= $a->answer ?></li>
            <? endforeach; ?>
          </ul>
        </th>
        <!-- <th class="handle" style="width:3%"></th> -->
      </tr>
    <? endforeach; ?>
    </tbody>
  </table>
  </div>

</div>
      </fieldset>
      <div class="clear-sm"></div>
    </div>
    <? $this->load->view("app/element/buttons-footer") ?>
  </section>
</form>
</div>
<? $this->load->view("script/ckeditor/includes") ?>
<style>
  .table-rates-adv-season tfoot,
  .table-rates-adv-season .btn,
  .table-rates-adv-season .fa {
    display:none
  }
  .input-group-addon,
  select,
  input {
    pointer-events: none;
  }
</style>
<script>

$(document).ready(function() {
  var formGlobal = $('#widget-form-<?= $wgetId ?>');

  <? $this->load->view("common/ckeditor/config") ?>;
  ckCfg.height = 400;
	CKEDITOR.replace('textForm<?= $wgetId ?>', ckCfg);
	
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
		    rules : {
      /*'id_user': 'required',
      'datetime': 'required' */
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
