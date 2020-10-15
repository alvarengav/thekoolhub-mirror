<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">  
  <div class="widget-app-user">
    <div class="well no-padding">
      <form method="post" action="<?= base_url() ?>app/user/forgotpassword" id="forgotpassword-form" class="smart-form client-form forgotpassword-form">
        <header><?= $this->lang->line("Recuperar contaseña") ?></header>
        <fieldset>
          <? if( isset($formOK)): ?>
          <p class="alert alert-success">
            <i class="fa fa-check"></i> <strong><?= $this->lang->line("LISTO!") ?></strong> 
            <?= $this->lang->line("Recibirás un e-mail a tu cuenta <i>$1</i> con una contaseña temporal.", array($this->input->post('mail'))) ?><br>
            <?= $this->lang->line("Logueate con esa contraseña para ingresar.") ?>
          </p>
          <? else: ?>
          <section>
            <label class="label"><?= $this->lang->line("Ingrese su correo electrónico") ?></label>
            <label class="input<? if($errorForm == 1): ?> state-error<? endif ?>"> <i class="icon-append fa fa-envelope"></i>
              <input type="email" name="mail" autocomplete="off" value="<?= $this->input->post('mail') ? $this->input->post('mail') : $this->session->userdata('prelogmail') ?>">
            </label>
            <div class="note note-error<? if(!$errorForm || $errorForm != 1): ?> hide<? endif ?>">
            <?= $this->lang->line("Parece que hay un error en la cuenta ingresada, intente nuevamente.") ?>
            </div>
            <div class="note note-error<? if(!$errorForm || $errorForm != 2): ?> hide<? endif ?>">
            <?= $this->lang->line("Debes esperar unos minutos para solicitar nuevamente tu contraseña.") ?>
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
            <i class="fa fa-refresh"></i> <?= $this->lang->line("Recuperar contraseña") ?>
          </button>
        <? else: ?>            
          <div class="note action-return">
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
  $("#forgotpassword-form").validate({
    submitHandler: function(form) {
      form.submit()
    },
    rules : {
      mail : {
        required : true,
        email : true
      }
    },
    messages : {
      mail : {
        required : '<?= $this->lang->line("Introduzca su dirección de correo electrónico") ?>',
        email : '<?= $this->lang->line("Por favor, introduce una dirección de correo electrónico válida") ?>'
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