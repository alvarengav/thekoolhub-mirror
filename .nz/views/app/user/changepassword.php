<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-user">
    <div class="well no-padding">
      <form method="post" action="<?= base_url() ?>app/user/password" id="login-form" class="smart-form client-form" autocomplete='off'>
        <header><?= $this->lang->line("Cambiar contraseña") ?></header>
        <fieldset>        
          <section>
            <label class="label"><?= $this->lang->line("E-mail") ?></label>
            <label class="input"> <i class="icon-append fa fa-user"></i>
              <input autocomplete='off' value="<?= $this->MApp->user->mail ?>" disabled="disabled" />
            </label>   
          </section>
          <section>
            <label class="label"><?= $this->lang->line("Nueva contraseña") ?></label>
            <label class="input"> <i class="icon-append fa fa-lock"></i>
              <input id="password-input-form" autocomplete='off' value="<?= $this->input->post('password') ?>" type="password" name="password">
            </label>   
          </section>
          <section>
            <label class="label"><?= $this->lang->line("Repetir contraseña") ?></label>
            <label class="input"> <i class="icon-append fa fa-lock"></i>
              <input autocomplete='off' value="<?= $this->input->post('password2') ?>" type="password" name="password2">
            </label>   
          </section>
        </fieldset>
        <footer>
          <a class="btn-link pull-left close-session" href="<?= base_url() ?>app/logout"><?= $this->lang->line("Cerrar sesión") ?></a>
          <button type="submit" class="btn btn-primary"><?= $this->lang->line("Cambiar") ?></button>
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
      password : {
        required : true,
        minlength : 3,
        maxlength : 20
      },
      password2 : {
        required : true,
        equalTo: "#password-input-form"
      }
    },
    messages : {
      password : {
        required : '<?= $this->lang->line("Por favor, introduzca su contraseña") ?>'
      },
      password2 : {
        required : '<?= $this->lang->line("Por favor, repita la contraseña") ?>',
        equalTo : '<?= $this->lang->line("Las contraseñas no coinciden") ?>'
      }
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});
</script>
<?php $this->load->view("common/footer") ?>