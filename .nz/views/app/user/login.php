<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-user">
    <div class="well no-padding">
      <form method="post" action="<?= base_url() ?>app/user/login" id="login-form" class="smart-form client-form" autocomplete='off'>
        <header><?= $this->lang->line("Iniciar sesión") ?></header>
        <fieldset>
          <section>
            <label class="label"><?= $this->lang->line("E-mail") ?></label>
            <label class="input<? if($errorForm == 1): ?> state-error<? endif ?>"> <i class="icon-append fa fa-user"></i>
              <input autocomplete='off' value="<?= $this->input->post('mail') ? $this->input->post('mail') : $this->session->userdata('prelogmail') ?>" type="email" name="mail">
            </label>
            <div class="note note-error<? if(!$errorForm || $errorForm != 1): ?> hide<? endif ?>">
            <?= $this->lang->line("Parece que hay un error en la cuenta ingresada, intente nuevamente.") ?>
            </div>
          </section>
          <section>
            <label class="label"><?= $this->lang->line("Contraseña") ?></label>
            <label class="input<? if($errorForm == 2): ?> state-error<? endif ?>"> <i class="icon-append fa fa-lock"></i>
              <input autocomplete='off' value="<?= $this->input->post('password') ?>" type="password" name="password">
            </label>                
            <div class="note note-error<? if(!$errorForm || $errorForm != 2): ?> hide<? endif ?>">
            <?= $this->lang->line("La contraseña ingresada no es correcta, intente nuevamente.") ?>
            </div> 
          </section>
        </fieldset>
        <footer>
          <?php /*
          <div class="btn-link-container pull-left">
            <a class="btn-forgotpassword btn-link app-loader" href="<?= base_url() ?>app/user/forgotpassword"><?= $this->lang->line("Olvide mi contraseña") ?></a>
            <a class="btn-link app-loader" href="<?= base_url() ?>app/user/register"><?= $this->lang->line("Registrarme") ?></a>
          </div>
          */ ?>
          <button type="submit" class="btn btn-primary"><?= $this->lang->line("Ingresar") ?></button>
        </footer>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
  $('#login-form input').attr('autocomplete', 'off');
  $("#login-form").validate({
    submitHandler: function(form) {
      form.submit()
    },
    rules : {
      mail : {
        required : true,
        email : true
      },
      password : {
        required : true,
        minlength : 3,
        maxlength : 20
      }
    },
    messages : {
      mail : {
        required : '<?= $this->lang->line("Introduzca su dirección de correo electrónico") ?>',
        email : '<?= $this->lang->line("Por favor, introduce una dirección de correo electrónico válida") ?>'
      },
      password : {
        required : '<?= $this->lang->line("Por favor, introduzca su contraseña") ?>'
      }
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});
</script>
<?php $this->load->view("common/footer") ?>
