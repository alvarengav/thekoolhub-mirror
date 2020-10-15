<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-form widget-manager-auto">
    <div class="well no-padding">
      <form method="post" class="smart-form" autocomplete='off'>
        <header class="title-form"><?= prep_app_title($appTitle) ?></header>
        <fieldset>        
          <section>
            <div class="no-break">
              <? $this->load->view('app/form', array('item' => array(
                'form' => $wgetId,
                'name' => 'title',
                'label' => $this->lang->line('Título'),
                'value' => set_value('title'),
                'error' => $this->validation->error('title'),
                'class' => $this->validation->error_class('title')
              ))); ?>
              <? $this->load->view('app/form', array('item' => array(
                'form' => $wgetId,
                'error' => $this->validation->error('subtitle'),
                'name' => 'subtitle',
                'label' => $this->lang->line('Subtítulo'),
                'value' => set_value('subtitle'),
                'class' => $this->validation->error_class('subtitle')
              ))); ?>
              <? $field = 'table'; $this->load->view('app/form', array('item' => array(
                'type' => 'select',
                'form' => $wgetId,
                'error' => $this->validation->error($field),
                'name' => $field,
                'label' => $this->lang->line('Tabla'),
                'value' => set_value($field),
                'data' => $this->model->AllTables($this->lang->line('Seleccionar tabla')),
                'class' => $this->validation->error_class($field)
              ))); ?>              
              <? $field = 'controller'; $this->load->view('app/form', array('item' => array(
                'form' => $wgetId,
                'error' => $this->validation->error($field),
                'name' => $field,
                'label' => $this->lang->line('Controlador'),
                'value' => set_value($field),
                'maxlength' => 50,
                'class' => $this->validation->error_class($field)
              ))); ?>
              <? $field = 'function'; $this->load->view('app/form', array('item' => array(
                'form' => $wgetId,
                'error' => $this->validation->error($field),
                'name' => $field,
                'label' => $this->lang->line('Función'),
                'value' => set_value($field),
                'maxlength' => 50,
                'class' => $this->validation->error_class($field)
              ))); ?>              
          </div>
          
          <? $field = 'menu'; $this->load->view('app/form', array('item' => array(
              'type' => 'checkbox',
              'form' => $wgetId,
              'error' => $this->validation->error($field),
              'name' => $field,
              'label' => $this->lang->line('Generar accesos en el menú'),
              'value' => 1,
              'checked' => set_value($field, 1),
              'class' => $this->validation->error_class($field)
            ))); ?>

<? $i = 0; if( isset($fields) ) foreach ($fields as $field) : ?><? if(substr($field->name,0,3) == 'id_' && substr($field->name,0,7) != 'id_file' && substr($field->name,0,10) != 'id_gallery') : 
$ret = FieldToTable($i,set_value('controller'), set_value('function'), $field->name); ?>
          <div class="no-break"><? if( $totalIndex > 1): ?><hr/><? endif ?>
              <? $ff = 'lj'.$i; $this->load->view('app/form', array('item' => array(
                'type' => 'select',
                'form' => $wgetId,
                'error' => $this->validation->error($ff),
                'name' => $ff,
                'label' => $this->lang->line('Tabla para:') . ' <span>'. mb_strtoupper($field->name, 'UTF-8') .'</span>',
                'value' => $ret[0],
                'data' => $this->model->AllTables($this->lang->line('Seleccionar tabla')),
                'class' => $this->validation->error_class($ff)
              ))); ?> 
              <? if(set_value('lj'.$i)) :?>
              <? $ff = 'lj'.$i.'-id'; $this->load->view('app/form', array('item' => array(
                'type' => 'select',
                'form' => $wgetId,
                'error' => $this->validation->error($ff),
                'name' => $ff,
                'label' => $this->lang->line('Índice para') .' <span>'. mb_strtoupper($field->name, 'UTF-8') .'</span>',
                'value' => $ret[1],
                'data' => $this->model->FieldsTable(set_value('lj'.$i), $this->lang->line('Seleccionar campo índice')),
                'class' => $this->validation->error_class($ff)
              ))); ?>  
              <? $ff = 'lj'.$i.'-text'; $this->load->view('app/form', array('item' => array(
                'type' => 'select',
                'form' => $wgetId,
                'error' => $this->validation->error($ff),
                'name' => $ff,
                'label' => $this->lang->line('Texto para') .' <span>'. mb_strtoupper($field->name, 'UTF-8') .'</span>',
                'value' => $ret[2],
                'data' => $this->model->FieldsTable(set_value('lj'.$i), $this->lang->line('Seleccionar campo texto')),
                'class' => $this->validation->error_class($ff)
              ))); ?>  
              <? endif ?>
          </div>
<? $i++; endif ?><? endforeach ?><? if(isset($actionResult)) :?><div class="alert alert-success"> <?= $actionResult ?></div><? endif ?>         
          </section>
        </fieldset>
        <footer>
          <div class="action-return pull-left">
            <a href="<?= base_url() ?>" class="app-loader"><i class="fa fa-arrow-left"></i><?= $this->lang->line("Cerrar") ?></a>
          </div>
          <? if(isset($actionResult)) :?>
          <a href="<?= base_url() . set_value('controller') . '/' . set_value('function') ?>" target="_blank" style="margin-left:40px" class="btn btn-primary"><?= $this->lang->line("Acceder") ?></a>
          <? endif ?>   
          <button type="submit" class="btn btn-primary"><?= $this->lang->line("Generar") ?></button>
        </footer>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
  $("#main form").validate({
    rules : {
      title : "required",
      subtitle : "required",
      controller : "required",
      "function" : "required",
      table : { select: true }
    },
    messages:{
      table : {
        minlength : "<?= $this->lang->line("Campo obligatorio") ?>"
      }
    }
  });
});
</script>
<?php $this->load->view("common/footer") ?>