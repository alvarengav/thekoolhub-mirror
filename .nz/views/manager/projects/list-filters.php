<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-2">
        <label for="id_clientFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Cliente') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectClient'], '', "id='id_clientFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>     
      <section class="col col-4">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
        </label>
      </section>
      <section class="col-filter col col-2">
        <label for="finishFormChk<?= $wgetId ?>" class="checkbox">
          <input id='finishFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='finish' />
          <i></i>
          <?= $this->lang->line('Incluir terminados') ?>
        </label>
      </section>
      <section class="col-filter col col-1-5">
        <label for="activeFormChk<?= $wgetId ?>" class="checkbox">
          <input id='activeFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='active' />
          <i></i>
          <?= $this->lang->line('Incluir inactivos') ?>
        </label>
      </section>   
      <section class="col col-2">
        <button type="button" id="button-datatable-search<?= $wgetId ?>" class="btn btn-primary pull-left element-no-label">
          <?= $this->lang->line("Buscar") ?>
        </button>
      </section>
    </div>
  </fieldset>
</div>