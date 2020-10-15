<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-form">
    <div class="well no-padding">
      <form action="<?= current_url() ?>" method="post" class="smart-form" autocomplete='off'>
        <header class="title-form"><?= prep_app_title($appTitle) ?></header>
        <fieldset>
          <section>
              <? $this->load->view('app/form', array('item' => array(
                'form' => $wgetId,
                'type' => 'textarea',
                'name' => 'git',
                'label' => $this->lang->line('Commando Git'),
                'value' => set_value('git'),
                'error' => $this->validation->error('git'),
                'class' => $this->validation->error_class('git'),
                'style-input' => 'height:100px',
              ))); ?>
            <? if(isset($actionResult)) :?><div class="note"><?= $actionResult ?></div><? endif ?>
            <? if(isset($actionResultError)) :?><div class="note note-error"><?= $actionResultError ?></div><? endif ?>
          </section>
        </fieldset>
        <footer>
          <div class="action-return pull-left">
            <a href="<?= base_url() ?>" class="app-loader"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Cerrar") ?></a>
          </div>
          <button type="submit" class="btn btn-primary"><?= $this->lang->line("Ejecutar") ?></button>
        </footer>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
  $("#main form").validate({
    rules : {
      git : {
        required : true
      }
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});
</script>
<?php $this->load->view("common/footer") ?>
