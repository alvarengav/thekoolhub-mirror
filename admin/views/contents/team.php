<? if (!AJAX) $this->load->view("common/header"); ?>
<? ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR'); ?>

<script src="<?= layout() ?>js/plugin/select2/select2.js"></script>
<div id="main">
  <form action="<?= current_url() ?>" method="post" class="smart-form" autocomplete='off' id="widget-form-<?= $wgetId ?>">
    <div class="widget-form-content">

      <div class="btn-group" style="padding:10px 0px">
         <? foreach($custom_lang as $key => $l): ?>
         <a href="<?= base_url() . "{$appController}/{$appFunction}/{$key}" ?>" class="btn ng-untouched ng-pristine ng-valid<?= $lang == $key ? ' active btn-primary' : ' btn-default' ?>"><?= $l ?></a>
        <? endforeach; ?>
      </div>

      <div class="well-white smart-form">
        

        <header class="title-form">Encabezados</header>
          <?
          $field = 'seo_title';
          $label = '<b>SEO</b> Titulo Principal Home';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;

          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => ''

          ])) ?>

          <?
          $field = 'seo_description';
          $label = '<b>SEO</b> Descripción Principal Home';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;

          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => ''

          ])) ?>
          <?
          $_field = 'id_file_main';
          $field = $_field;
          $this->load->view("app/form/file", [
            'label' => 'Imagen Share (1200px x 630px)',
            'field' => $field,
            'id_file' => isset($dataItem->$_field) ? $dataItem->$_field : false,
          ]) ?>

            <div class="col col-md-12">
              <hr>

            </div>

          <?
          $field = 'title';
          $label = 'Titulo';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;

          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => ''

          ])) ?>

          <?
          $field = 'subtitle';
          $label = 'Subtitulo';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;

          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'textarea',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => ''

          ])) ?>



       

          <div class="clearfix"></div>
      

          <header class="title-form">Miembros del equipo</header>
          <div class="col-md-12 col">
            <br>
            <a href="<?= base_url() ?>contents/team" class="btn btn-primary" target="_blank"><i class="fa fa-arrow-right"></i> Agregar nuevo o editar</a>
            <br>
            <br>
          </div>


<div class="clearfix"></div>

          
        <div class="pull-right" style="margin: 20px 0;">

          <button type="submit" class="btn btn-success"><?= $this->lang->line("Guardar") ?></button>

          <a href="<?= base_url() ?>" class="btn btn-default"><?= $this->lang->line("Cancelar") ?></a>

        </div>

    </div>

    <iframe style="height: 0px; visiblity:hidden" src="<?= $this->config->config['base_sys'].'/'.$lang; ?>" frameborder="0"></iframe>

  </form>
</div>

<? $this->load->view("script/ckeditor/includes") ?>

<script>
  $(document).ready(function() {



    <? $this->load->view("common/ckeditor/config", ['idItem' => 0]) ?>;

    ckCfg.height = 400;

    // CKEDITOR.replace('screen_aboutus3_textForm<?= $wgetId ?>', ckCfg);

  });
</script>


<?php $this->load->view("common/footer") ?>