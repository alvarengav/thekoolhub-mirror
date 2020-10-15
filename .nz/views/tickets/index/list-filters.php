<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row">    
      <section class="col-filter col col-4">
        <label for="id_categoryFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Categoría') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketCategory'], '', "id='id_categoryFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
      <section class="col-filter col col-4">
        <label for="id_projectFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Proyecto') ?></label>
        <label class="select">
          <?= form_dropdown('', $this->DataG->SelectProjectTickets($this->lang->line('Todos los proyectos')), '', "id='id_projectFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>   
      <section class="col-filter col col-4">
        <label for="id_reproducibilityFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Reproducibilidad') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketReproducibility'], '', "id='id_reproducibilityFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section> 
    </div>
    <div class="row">      
      <section class="col-filter col col-4">
        <label for="id_severityFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Severidad') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketSeverity'], '', "id='id_severityFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>   
      <section class="col-filter col col-4">
        <label for="id_priorityFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Prioridad') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketPriority'], '', "id='id_priorityFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>     
      <section class="col-filter col col-4">
        <label for="id_resolutionFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Resolución') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketResolution'], '', "id='id_resolutionFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>  
<?/*
      <section class="col-filter col col-2">
        <label for="id_visibilityFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Visibilidad') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketVisibility'], '', "id='id_visibilityFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>    
*/?>      
      <section class="col-filter col col-2-5">
        <label for="id_stateFormSelect<?= $wgetId ?>" class="label"><?= $this->lang->line('Estado') ?></label>
        <label class="select">
          <?= form_dropdown('', $select['SelectTicketState'], '', "id='id_stateFormSelect{$wgetId}'") ?>
          <i></i>
        </label>
      </section>   
      <section class="col col-3">
        <label class="label"><?= $this->lang->line("Contenido") ?></label>
        <label class="input">
          <input type="text" id="textFormInput<?= $wgetId ?>" placeholder="<?= $this->lang->line("Escriba una palabra") ?>">
        </label>
      </section>
      <section class="col-filter col col-1-5">
        <label for="closedFormChk<?= $wgetId ?>" class="checkbox">
          <input id='closedFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='closed' />
          <i></i>
          <?= $this->lang->line('Incluir cerradas') ?>
        </label>
      </section>
      <section class="col-filter col col-2">
        <label for="tclientFormChk<?= $wgetId ?>" class="checkbox">
          <input id='tclientFormChk<?= $wgetId ?>' value='1' type='checkbox' class='post' name='tclient' />
          <i></i>
          <?= $this->lang->line('Incluir otros clientes') ?>
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