<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-form widget-manager-preferences">
    <div class="well no-padding">
      <form id="widget-form-<?= $wgetId ?>" method="post" class="smart-form" autocomplete='off'>
        <header class="title-form"><?= prep_app_title($appTitle) ?><div class="header-link pull-right"><a href="<?= base_url() ?>manager/password" class="app-loader"><i class="fa fa-lock"></i><?= $this->lang->line("Cambiar contraseña") ?></a></div></header>
        <fieldset class="inset">
          <div class="row">
            <div class="col col-info col-inset col-8">
            <? $field = 'company'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'disabled' => true,
              'name' => $field,
              'label' => $this->lang->line('Empresa'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>
            <? $field = 'name'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('Nombre'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>
            <? $field = 'lastname'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('Apellido'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>
            <? $field = 'mail'; $this->load->view('app/form', array('item' => array(
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('E-mail'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>
            </div>
            <div class="col col-4">
            <? $field = 'id_file'; $this->load->view('app/form', array('item' => array(
              'type' => 'filemanager',
              'form' => $wgetId,
              'name' => $field,
              'global' => true,
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
              'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
              'data' => $dataItem,
              'prefix' => $dataItem[$field] ? 'fm1' : 'fm2',
              'label' => $this->lang->line('Imagen de perfil'),
              'value' => $dataItem[$field] ? $dataItem[$field] : $dataItem['company_file'],
              'placeholder' => ''
            ))) ?>
            </div>
          </div>
          <? if(isset($actionResult)) :?><div class="alert alert-success"><?= $actionResult ?></div><? endif ?>
        </fieldset>
        <div class="clear-sm"></div>
        <footer>
          <div class="action-return pull-left">
            <a href="<?= base_url() ?>" class="app-loader"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Cerrar") ?></a>
          </div>
          <button type="submit" class="btn btn-primary"><?= $this->lang->line("Guardar cambios") ?></button>
        </footer>
      </form>
    </div>
  </div>
</div>

<? if(isset($actionResult)) $this->load->view("script/userdata") ?>
<script type="text/javascript">
$(document).ready(function() {
  $('#header .user-info').addClass('active');
  $('#left-panel nav ul li a.active').removeClass('active');
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
  <? if(isset($actionResult)) :  ?>
  <? if($this->MApp->user->picture) :  ?>
  $('header .user-info .user-picture').removeClass('no-picture').attr('src','<?= thumb($this->MApp->user->picture, 20, 20, true, true) ?>');
  <? else: ?>
  $('header .user-info .user-picture').addClass('no-picture');
  <? endif ?>
  $('header .user-info .user-name').text('<?= $this->MApp->user->name ?>');
  <? endif ?>
  formGlobal.validate({
    rules : {
      name : "required",
      lastname : "required",      
      'mail': {
        required: true,
        email: true,
        remote: {
          url: "<?= base_url() ?>manager/users_data",
          type: "post",
          data: {
            action: 'mail',
            mail: function() {
              return $(".form-post-mail", formGlobal).val();
            },
            id: function() {
              return '<?= $this->MApp->user->id ?>';
            }
          }
        }
      }
    },
    messages : {
      mail : {
        required : '<?= $this->lang->line("Introduzca su dirección de correo electrónico") ?>',
        remote: '<?= $this->lang->line("La dirección de correo electrónico ya se encuentra registrada") ?>'
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