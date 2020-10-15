<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-form widget-manager-actions">
    <div class="well no-padding">
      <form id="widget-form-<?= $wgetId ?>" method="post" class="smart-form" autocomplete='off'>
        <header class="title-form"><?= prep_app_title($appTitle) ?></header>
        <fieldset class="inset">
          <div class="row row-actions">
            <a href="<?= base_url() ?>manager/actions/1" class="btn btn-primary"><?= $this->lang->line("Borrar archivos") ?></a>
            <a href="<?= base_url() ?>manager/actions/2" class="btn btn-primary"><?= $this->lang->line("Borrar carpetas") ?></a>
            <a href="<?= base_url() ?>manager/actions/3" class="btn btn-primary"><?= $this->lang->line("Borrar miniaturas") ?></a>
            <a href="<?= base_url() ?>manager/actions/4" class="btn btn-primary"><?= $this->lang->line("Borrar miniaturas antiguas") ?></a>
            <a href="<?= base_url() ?>manager/actions/5" class="btn btn-primary"><?= $this->lang->line("Restablecer menú") ?></a>
            <a href="<?= base_url() ?>manager/actions/6" class="btn btn-primary"><?= $this->lang->line("Reinciar permisos") ?></a>
            <a href="<?= base_url() ?>manager/actions/7" class="btn btn-primary"><?= $this->lang->line("Truncar sistema") ?></a>
            <a href="<?= base_url() ?>manager/actions/8" class="btn btn-primary"><?= $this->lang->line("Vaciar datos de usuario") ?></a>
          </div>
          <? if(isset($actionResult)) :?><div class="alert alert-success"><?= $actionResult ?></div><? endif ?>
        </fieldset>
        <div class="clear-sm"></div>
        <footer>
          <div class="action-return pull-left">
            <a href="<?= base_url() ?>" class="app-loader"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Cerrar") ?></a>
          </div>
        </footer>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('.widget-manager-actions .row-actions a').click(function(event){
    var href = $(this).attr('href');
    event.preventDefault();
    $.SmartMessageBox({
      sound:false,
      title : $(this).text(),
      content : "<?= $this->lang->line('¿Estás seguro qué deseas realizar esta acción?') ?>",
      buttons : '[<?= $this->lang->line('No') ?>][<?= $this->lang->line('Si') ?>]'
    }, function(ButtonPressed) {
      if(ButtonPressed == "<?= $this->lang->line('Si') ?>") 
      {
        App.loadURL(href, false);
      }
    });   
    $("#MsgBoxBack .MessageBoxMiddle").addClass('MessageBoxMiddleLogout');
    $($("#MsgBoxBack .MessageBoxButtonSection button")[1]).addClass('btn-danger');
    return false;
  });
  App.changeURI('<?= base_url() ?>manager/actions');
  $('#header .user-info').removeClass('active');
});
</script>
<?php $this->load->view("common/footer") ?>