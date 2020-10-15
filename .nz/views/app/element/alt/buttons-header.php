<div class="col-xs-12 col-sm-12 col-md-7 col-lg-<?= isset($alt) ? "4" : "7" ?> pull-right text-right button-right">          
  <div class="btn-group">
    <? if($this->MApp->secure->edit):?>
    <button type="button" class="btn btn-success save-action<?= $quickOpen ? " hide" : "" ?>">
      <?= $this->lang->line("Guardar") ?>
    </button>
    <? else: ?>
    <a href="<?= base_url() ?>" class="btn btn-default action-close app-loader">
      <?= $this->lang->line($traceBack ? "Volver" : "Cerrar") ?>
    </a>
    <? endif ?>
  </div>
</div>