<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">
      <? if($this->MApp->user->atype == 1 && $this->MApp->user->type < 3): 
      if($this->MApp->user->type != 1) unset($select['SelectUserType'][1]);
      ?>
      <section class="col-filter col col-4">
        <label for="id_companyFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Empresa') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectCompany'], '', "id='id_companyFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section> 
      <section class="col-filter col col-4">
        <label for="id_clientFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Cliente') ?></label>
        <label class="select">
          <?= form_dropdown('', $this->DataG->SelectClient('', $this->lang->line('Todos los clientes')), '', "id='id_clientFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section> 
      <? endif ?>     
      <? if($this->MApp->user->atype == 1 && $this->MApp->user->type < 3): 
      if($this->MApp->user->type != 1) unset($select['SelectUserType'][1]);
      ?><section class="col-filter col col-4">
        <label for="id_typeFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Tipo de usuario') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectUserType'], '', "id='id_typeFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>   
      <? endif ?>       
      <section class="col col-4">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
        </label>
      </section>
      <section class="col-filter col col-1-5">
        <label for="activeFormChk<?= $wgetId ?>" class="checkbox">
          <input id='activeFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='active' />
          <i></i>
          <?= $this->lang->line('Solo activos') ?>
        </label>
      </section>
      <section class="col-filter col col-1-5">
        <label for="validFormChk<?= $wgetId ?>" class="checkbox">
          <input id='validFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='valid' />
          <i></i>
          <?= $this->lang->line('Solo válidos') ?>
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