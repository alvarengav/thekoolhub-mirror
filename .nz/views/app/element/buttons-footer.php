<div class="clear-sm"></div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-right text-right">
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
</div>
<div class="clear-lg"></div>
<? if($traceBack): ?>
<input type="hidden" value="<?= $backUrl ?>" name="gobackuri"  />
<script>
$(document).ready(function() {
  $(window).scrollTop(0);
});
</script>
<? endif ?>