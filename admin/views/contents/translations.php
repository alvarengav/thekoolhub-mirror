<? if(!AJAX) $this->load->view("common/header"); ?>
<? //ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR'); ?>

<script src="<?= layout() ?>js/plugin/select2/select2.js"></script>

<div id="main">
  <div class="widget-form-content">
    <form action="<?= current_url() ?>" method="post" class="smart-form" autocomplete='off'  id="widget-form-<?= $wgetId ?>">
    <div class="btn-group" style="padding:10px 0px">
     <? foreach($custom_lang as $key => $l): ?>
     <a href="<?= base_url() . "{$appController}/{$appFunction}/{$key}" ?>" class="btn ng-untouched ng-pristine ng-valid<?= $lang == $key ? ' active btn-primary' : ' btn-default' ?>"><?= $l ?></a>
    <? endforeach; ?>
  </div>
    <div class="well-white smart-form">
        <section>

        <header class="title-form">Remplaza las palabras por su traducción</header>
          <fieldset>
            <div class="row">
           
            <?
            if( !$this->uri->segment(4, false) ) {
                $hide_new_line = 1; ////comentar para agregar nuevos
            }
            $field = 'data';
            $label = '';
            $this->load->view('app/form/multiCustomLine', array('item' => [
            'label' => $label,
            'hide_new_line' => $hide_new_line, 
            'elements' => [
              [
                'field' => 'original',
                'label' => 'Original (CA)',
                'width' => 40,
                'type'=>'text'
              ],
              [
                'field' => 'replace',
                'label' => 'Traducción ('. strtoupper( $lang ) .')',
                'width' => 60,
                'type'=>'text'
              ],
            ],
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'placeholder' => ''
          ])) ?>

      </div>

        </div>

    <div class="pull-right" style="margin: 20px 0;">
        
        <button type="submit" class="btn btn-success"><?= $this->lang->line("Guardar") ?></button>
        
        <a href="<?= base_url() ?>" class="btn btn-default"><?= $this->lang->line("Cancelar") ?></a>
        
      </div>
      
    </div>
  </form>
  <? $this->load->view("script/ckeditor/includes") ?>

<? if($hide_new_line): ?>
<style>
    tbody.ui-sortable .form-post-original {
        background: lightgray;
        pointer-events: none;
        border: gray;
    }
    .ui-sortable-handle {
        pointer-events: none;
    }
    .ui-sortable-handle * {
        display:none;
    }
</style>
<? endif ?>
  
<script>
  $(document).ready(function() {



    <? $this->load->view("common/ckeditor/config", ['idItem' => 0]) ?>;

    ckCfg.height = 400;

    // CKEDITOR.replace('screen_aboutus3_textForm<?= $wgetId ?>', ckCfg);

  });
</script>
<?php $this->load->view("common/footer") ?>