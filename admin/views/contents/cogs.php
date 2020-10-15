<? if(!AJAX) $this->load->view("common/header"); ?>
<? ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR'); ?>
<script src="<?= layout() ?>js/plugin/select2/select2.js"></script>

<div id="main">
  <div class="widget-form-content">
    <form action="<?= current_url() ?>" method="post" class="smart-form" autocomplete='off'  id="widget-form-<?= $wgetId ?>">
    <div class="well-white smart-form">
        <section>
          
        <header class="title-form">Configuración del sitio</header>
          <fieldset>
            <div class="row">
            <?
              $_field = 'id_file_favicon1';
              $field = $_field;
              $this->load->view("app/form/file", [
              'label'=>'Favicon Mini',
              'field'=>$field,
              'columns'=>6,
              'id_file'=>isset($dataItem->$_field) ? $dataItem->$_field : false,
              ]);

              $_field = 'id_file_favicon2';
              $field = $_field;
              $this->load->view("app/form/file", [
              'label'=>'FavIcon Grande',
              'field'=>$field,
              'columns'=>6,
              'id_file'=>isset($dataItem->$_field) ? $dataItem->$_field : false,
              ]);
?>

      




<?
          $field = 'mails';
          $label = '<b>GENERAL</b> Mails principales';


          $this->load->view('app/form/multiCustomLine', array('item' => [
            'label' => $label,
            'elements' => [
              [
                'field' => 'mail',
                'label' => '@',
                'type' => 'text',
                'width' => 50
              ],
              [
                'field' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'width' => 50,
              ],
            ],
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => ''
          ]));
          
          
          $field = 'header_langs';
          $label = '<b>GENERAL</b> Activar idiomas';


$this->load->view('app/form/multiCustomLine', array('item' => [
            'label' => $label,
            'elements' => [
              [
                'field' => 'lang',
                'label' => 'Idioma',
                'type' => 'select',
                'width' => 50,
                'data'=> $custom_lang
              ],
              [
                'field' => 'text',
                'label' => 'Visible',
                'type' => 'text',
                'width' => 50,
              ],
            ],
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => ''
          ]))
          ?>

     
          
         



      
<?
          $field = 'ga';
          $label = '<b>GENERAL</b> Codigo Google Analitycs  <a target="_blank" href="https://support.google.com/analytics/answer/7372977"><i class="fa fa-external-link"></i></a>';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'XX-XXXXXX-XX'
            
            ])) ?> 

      
<?
          $field = 'fbpixel';
          $label = '<b>GENERAL</b> Pixel de Facebook <a target="_blank" href=https://support.shareaholic.com/hc/en-us/articles/360000428223-How-do-I-find-my-Facebook-Pixel-ID-"><i class="fa fa-external-link"></i></a>';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 12,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'XXXXXXXXXX'
            ])) ?> 

<?
          $field = 'mailchimp_key';
          $label = '<b>GENERAL</b> Mailchip Private Kay <a target="_blank" href="https://mailchimp.com/es/help/about-api-keys/"><i class="fa fa-external-link"></i></a>';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 6,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'XXXXXXXXXX'
            ])) ?> 

<?
          $field = 'mailchimp_list';
          $label = '<b>GENERAL</b> Mailchip N° de lista <a target="_blank" href="https://mailchimp.com/es/help/find-audience-id/"><i class="fa fa-external-link"></i></a>';
          $value = isset($dataItem->$field) ? $dataItem->$field : $dataItem->$field;
          
          $this->load->view('app/form', array('item' => [
            'label' => $label,
            'type' => 'input',
            'columns' => 6,
            'form' => $wgetId,
            'name' => $field,
            'value' => $value,
            'placeholder' => 'XXXXXXXXXX'
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