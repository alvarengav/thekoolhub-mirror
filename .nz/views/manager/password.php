<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-form widget-manager-preferences widget-manager-password">
    <div class="well no-padding">
      <form id="widget-form-<?= $wgetId ?>" method="post" class="smart-form" autocomplete='off'>
        <header class="title-form"><?= prep_app_title($appTitle) ?><div class="header-link pull-right"><a href="<?= base_url() ?>manager/preferences" class="app-loader"><i class="fa fa-cogs"></i><?= $this->lang->line("Preferencias") ?></a></div></header>
        <fieldset class="inset">
          <div class="row">
          <? $field = 'oldpassword'; $this->load->view('app/form', array('item' => array(
            'form' => $wgetId,
            'name' => $field,
            'type' => 'password',
            'label' => $this->lang->line('Contraseña actual'),
            'value' => '',
            'error' => $this->validation->error($field),
            'class' => $this->validation->error_class($field),
            'placeholder' => ''
          ))) ?>
          <? $field = 'password'; $this->load->view('app/form', array('item' => array(
            'form' => $wgetId,
            'name' => $field,
            'type' => 'password',
            'label' => $this->lang->line('Nueva contraseña '),
            'value' => '',
            'error' => $this->validation->error($field),
            'class' => $this->validation->error_class($field),
            'placeholder' => ''
          ))) ?>
          <? $field = 'password2'; $this->load->view('app/form', array('item' => array(
            'form' => $wgetId,
            'name' => $field,
            'type' => 'password',
            'label' => $this->lang->line('Vuelva a escribir la contraseña'),
            'value' => '',
            'error' => $this->validation->error($field),
            'class' => $this->validation->error_class($field),
            'placeholder' => ''
          ))) ?>
          </div>
          <? if(isset($actionResult)) :?><div class="alert alert-success"><?= $actionResult ?></div><? endif ?>         
  
        </fieldset>
        <div class="clear-sm"></div>
        <footer>
          <div class="action-return pull-left">
            <a href="<?= base_url() ?>" class="app-loader"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Cerrar") ?></a>
          </div>
          <button type="submit" class="btn btn-primary"><?= $this->lang->line("Cambiar") ?></button>
        </footer>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#header .user-info').addClass('active');
  $('#left-panel nav ul li a.active').removeClass('active');
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
  formGlobal.validate({
    rules : {
      oldpassword : "required",
      password : "required",      
      password2 : {
        required: true,
        equalTo: $('.form-post-password', formGlobal)
      }
    }
  });  
  <? $field = 'id_file'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?> 
});
</script>
<?php $this->load->view("common/footer") ?>