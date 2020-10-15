<div class="col-xs-12 col-sm-12 col-md-7 col-lg-<?= isset($alt) ? "4" : "7" ?> pull-right text-right button-right">          
  <div class="btn-group">
    <? if($this->MApp->secure->edit):?>
    <button type="button" class="btn btn-success save-action<?= $quickOpen ? " hide" : "" ?>">
      <?= $this->lang->line("Guardar") ?>
    </button>
    <button type="button" class="btn btn-default save-action-close<?= $quickOpen ? " btn-success" : "" ?>">
      <?= $this->lang->line($traceBack ? "Guardar y volver" : "Guardar y cerrar") ?>
    </button>
    <? endif ?>
    <a href="<?= $backUrl ?>" class="btn btn-default action-close app-loader">
      <?= $this->lang->line($traceBack ? "Volver" : "Cerrar") ?>
    </a>
  </div>
</div>