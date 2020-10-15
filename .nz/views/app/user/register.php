<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">  
  <div class="widget-app-user">
    <div class="well no-padding">
      <form method="post" action="<?= base_url() ?>app/user/register" id="register-form" class="smart-form client-form">
        <header><?= $this->lang->line("Registro de nuevo usuario") ?></header>
        <fieldset>
          <? if( isset($formOK)): ?>
          <p class="alert alert-success">
            <i class="fa fa-check"></i> <strong><?= $this->lang->line("LISTO!") ?></strong> 
            <?= $this->lang->line("Aguarda ser confirmado por el administrador y recibirás un e-mail con una contraseña temporal para poder ingresar al sistema.") ?>
          </p>
          <? else: ?>
          <section>
            <label class="label"><?= $this->lang->line("Empresa") ?></label>
            <label class="select"> 
              <?= form_dropdown('company', $companiesList, $this->input->post('company'),'') ?>
              <i></i>
            </label>
          </section>
          <section>
            <label class="label"><?= $this->lang->line("Nombre") ?></label>
            <label class="input"> <i class="icon-append fa fa-user"></i>
              <input type="text" name="name" autocomplete="off" value="<?= $this->input->post('name') ?>">
            </label>
          </section>
          <section>
            <label class="label"><?= $this->lang->line("Apellido") ?></label>
            <label class="input"> <i class="icon-append fa fa-user"></i>
              <input type="text" name="lastname" autocomplete="off" value="<?= $this->input->post('lastname') ?>">
            </label>
          </section>
          <section>
            <label class="label"><?= $this->lang->line("E-mail") ?></label>
            <label class="input<? if($errorForm == 1): ?> state-error<? endif ?>"> <i class="icon-append fa fa-envelope"></i>
              <input type="email" name="mail" autocomplete="off" value="<?= $this->input->post('mail') ? $this->input->post('mail') : $this->session->userdata('prelogmail')  ?>">
            </label>
            <div class="note note-error<? if(!$errorForm): ?> hide<? endif ?>">
            <?= $this->lang->line("La dirección de correo electrónico ya se encuentra registrada, intente nuevamente.") ?>
            </div>
          </section>
          <? endif ?>
        </fieldset>
        <footer>
        <? if( !isset($formOK)): ?>
          <div class="action-return pull-left">
            <a class="app-loader" href="<?= base_url() ?>app/user/login"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Volver") ?></a>
          </div>
          <button type="submit" class="btn btn-primary">
            <?= $this->lang->line("Enviar") ?>
          </button>
        <? else: ?>            
          <div class="action-return note">
            <a class="app-loader" href="<?= base_url() ?>app/user/login"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Volver") ?></a>
          </div>
        <? endif ?>
        </footer>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
<? if( !isset($formOK)): ?>
$(function() {
  $("#register-form").validate({
    submitHandler: function(form) {
      form.submit()
    },
    rules : {
      email : {
        required : true,
        email : true
      },
      name : {
        required : true
      },
      lastname : {
        required : true
      }
    },
    messages : {
      email : {
        required : '<?= $this->lang->line("Introduzca su dirección de correo electrónico") ?>',
        email : '<?= $this->lang->line("Por favor, introduce una dirección de correo electrónico válida") ?>'
      },
      name : {
        required : '<?= $this->lang->line("Introduzca su nombre") ?>'
      },
      lastname : {
        required : '<?= $this->lang->line("Introduzca su apellido") ?>'
      }
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});
<? endif ?>
</script>
<?php $this->load->view("common/footer") ?>