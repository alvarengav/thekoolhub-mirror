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
        <div style="margin:0 -8px" class="row">
          <div class="col col-inset col-9 ">
        
<? $field = 'id_type'; unset($select['SelectUserType']['']);
  if($this->MApp->user->type != 1)
    unset($select['SelectUserType'][1]);
  $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'readonly' => ($this->MApp->user->type > 2),
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUserType'],
    'label' => $this->lang->line('Tipo de usuario'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_company'; unset($select['SelectCompany']['']); $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'readonly' => $idItem ? ($this->MApp->user->type != 1) : ($this->MApp->user->atype != 1),
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCompany'],
    'label' => $this->lang->line('Empresa'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'mail'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('E-mail'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'name'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Nombre'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'lastname'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Apellido'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
          <? if(($this->MApp->secure->edit && $this->MApp->user->type < 3 && (!isset($dataItem['valid']) || $dataItem['valid'] != 1)) || $this->MApp->user->type == 1 ):?>
<? $field = 'password'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Contraseña'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
        <? endif ?>
  <? $field = 'obs'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Observaciones'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
</div>
<div class="col col-inset col-3">

          <? if($this->MApp->secure->edit && $idItem && ! $dataItem['valid']):?>
          <section class="col col-12"> 
            <a class="app-loader btn btn-primary pull-left element-no-label " href="<?= base_url() . "{$appController}/{$appFunction}/validate/{$idItem}" ?>">
              <?= $this->lang->line($dataItem['valid'] ? "Volver a enviar validación" : "Validar nuevo usuario") ?>
            </a>
          </section>
          <? endif ?>
<? $field = 'id_file'; $this->load->view('app/form', array('item' => array(
    'type' => 'filemanager',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'global' => true,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fm1',
    'label' => $this->lang->line('Imagen de perfil'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
</div>
      </div>
      </fieldset>
      <? if($idItem && $dataItem['id_company']) $this->load->view("{$appController}/{$appFunction}/secure") ?>
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
  <? if($idItem): ?>
  App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
  <? endif ?>
  formGlobal.validate({ 
    rules : {
      'id_type': 'required',
      'id_company': 'required',
      'name': 'required',
      'lastname': 'required',
      'mail': {
        'required':true,
        'email':true,
        remote: {
          url: "<?= base_url() ?>manager/users/data",
          type: "post",
          data: {
            action: 'mail',
            mail: function() {
              return $(".form-post-mail", formGlobal).val();
            },
            id: function() {
              return '<?= $idItem ?>';
            }
          }
        }
      },
      'password': 'required'     
    },
    messages : {
      mail : {
        required : '<?= $this->lang->line("Introduzca su dirección de correo electrónico") ?>',
        remote: '<?= $this->lang->line("La dirección de correo electrónico ya se encuentra registrada") ?>'
      }
    }
  });  
  $.each($('#TableSecure tbody tr input:disabled'), function(index, el){ 
    $(el).parents('.checkbox').addClass('checkbox-disabled');
  });
  $('#TableSecure tbody tr.row-menu').each(function(index, item){
    $('.col-global input:enabled', item).click(function(){
      $('#TableSecure tbody tr.row-menu-' + $(item).attr('data-id') + ' input:enabled').prop('checked', $(this).prop('checked'));      
    });
    $('.col-type input', item).click(function(){
      $('#TableSecure tbody tr.row-menu-' + $(item).attr('data-id') + ' .col-type-' + $(this).attr('data-type') + ' input:enabled').prop('checked', $(this).prop('checked'));      
    });
  });
  $('#TableSecure tbody tr.row-submenu').each(function(index, item){
    $('.col-global-item input:enabled', item).click(function(){
      $('.col-type input:enabled', item).prop('checked', $(this).prop('checked'));
    });
  });
  $('.btn.save-action',formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('0');
    formGlobal.submit();
  });
  $('.btn.save-action-close', formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('1');
    formGlobal.submit();
  });
  <? $field = 'id_file'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?>
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
<?php $this->load->view("common/footer") ?>
