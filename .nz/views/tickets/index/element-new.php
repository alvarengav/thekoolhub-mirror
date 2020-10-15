<?
unset($select['SelectTicketCategory']['']);
unset($select['SelectTicketReproducibility']['']);
unset($select['SelectTicketSeverity']['']);
unset($select['SelectTicketPriority']['']);
?>
<fieldset>        
<div class="row">
<? $field = 'id_category'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectTicketCategory'],
    'label' => $this->lang->line('Categoría'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  <? $field = 'id_project'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $this->DataG->SelectProjectTickets($this->lang->line('Sin definir')),
    'label' => $this->lang->line('Proyecto'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_reproducibility'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectTicketReproducibility'],
    'label' => $this->lang->line('Reproducibilidad'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_severity'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectTicketSeverity'],
    'label' => $this->lang->line('Severidad'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
</div>
<div class="row">
<? $field = 'title'; $this->load->view('app/form', array('item' => array(
    'columns' => 10,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Título'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_priority'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectTicketPriority'],
    'label' => $this->lang->line('Prioridad'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
</div>
<div class="row">
<? $field = 'details'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Descripción'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'steps_to_reproduce'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Pasos para reproducir	'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'additional_info'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 6,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Información Adicional'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'id_gallery'; $this->load->view('app/form', array('item' => array(
    'type' => 'gallery',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fmg1',    
    'global' => true,
    'label' => $this->lang->line('Archivos'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
</div>
</fieldset>
<div class="clear-sm"></div>