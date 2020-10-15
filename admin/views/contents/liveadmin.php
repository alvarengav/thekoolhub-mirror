<? if(!AJAX) $this->load->view("common/header"); ?>
<? //ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR'); ?>

<script src="<?= layout() ?>js/plugin/select2/select2.js"></script>

<div id="main">
  <div class="widget-form-content">
    <form action="<?= current_url() ?>" method="post" class="smart-form" autocomplete='off'  id="widget-form-<?= $wgetId ?>">

    <div class="well-white smart-form">
        <section>

        <header class="title-form">Editor de contenido
</header>
          <fieldset>
        <? $secretToken = md5('prev-kool'); ?>
           
        <a href="<?= $this->config->config['base_sys'].'es'.'/'.$secretToken;  ?>" target="_blank" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Editar web en vivo</a>
        <? /*foreach($custom_lang as $key => $l): ?>
    <? endforeach;*/ ?>
<br>
<br>
<br>
<i>* La versión live puede presentar leves diferencias respecto a la real.
</i>
<br>
    <i>* Se recomienda utilizar un ordenador de sobremesa o portátil para la edición de los contenidos.</i>
        </div>

      
    </div>
  </form>
  <? $this->load->view("script/ckeditor/includes") ?>
        

  
<script>
  $(document).ready(function() {

    // $('body').addClass('minified');
  });
</script>
<?php $this->load->view("common/footer") ?>