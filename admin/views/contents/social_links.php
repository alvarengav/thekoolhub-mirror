<? if(!AJAX) $this->load->view("common/header"); ?>
<? ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR'); ?>
<script src="<?= layout() ?>js/plugin/select2/select2.js"></script>

<div id="main">
  <div class="widget-form-content">
    <form action="<?= current_url() ?>" method="post" class="smart-form" autocomplete='off'  id="widget-form-<?= $wgetId ?>">
    <div class="well-white smart-form">
        <section>
          
          <fieldset>
            <div class="row">

            <?
          $field = 'linkedin';
          $label = '<b>REDES</b> Linkedin';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'https://.../...'
            
            ])) ?> 
                
          <?
          $field = 'instagram';
          $label = '<b>REDES</b> Instagram';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'https://.../...'
            
            ]));

             ?>

            <?
          $field = 'facebook';
          $label = '<b>REDES</b> Facebook';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'https://.../...'
            
            ])) ?> 
          <?
          $field = 'twitter';
          $label = '<b>REDES</b> Twitter';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'https://.../...'
            
            ])) ?> 
      </div>

      

    <div class="pull-right" style="margin: 20px 0;">
        
        <button type="submit" class="btn btn-success"><?= $this->lang->line("Guardar") ?></button>
        
        <a href="<?= base_url() ?>" class="btn btn-default"><?= $this->lang->line("Cancelar") ?></a>
        
      </div>
      
    </div>
  </form>
  <? $this->load->view("script/ckeditor/includes") ?>

<script>
  $(document).ready(function() {



    <? $this->load->view("common/ckeditor/config", ['idItem' => 0]) ?>;

    ckCfg.height = 400;

    // CKEDITOR.replace('screen_aboutus3_textForm<?= $wgetId ?>', ckCfg);

  });
</script>
<?php $this->load->view("common/footer") ?>