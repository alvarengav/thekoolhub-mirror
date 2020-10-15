<?
unset($select['SelectTicketCategory']['']);
unset($select['SelectTicketReproducibility']['']);
unset($select['SelectTicketSeverity']['']);
unset($select['SelectTicketPriority']['']);
unset($select['SelectTicketState']['']);
unset($select['SelectTicketResolution']['']);
?>
<fieldset>        
<div class="row">
<? $field = 'id_category'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'disabled' => true,
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
    'disabled' => true,
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
</div>
<? if($this->MApp->user->type == 1 || $this->MApp->user->atype == 1 ):?>
<div class="row">
<? $field = 'id_state'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectTicketState'],
    'label' => $this->lang->line('Estado'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_resolution'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 3,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectTicketResolution'],
    'label' => $this->lang->line('Resolución'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'id_assigned'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectUser'],
    'label' => $this->lang->line('Usuario asignado'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'no-notification'; $this->load->view('app/form', array('item' => array(
    'type' => 'checkbox',
    'columns' => 2,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('No enviar notificación'),
    'value' => 1,
    'checked' => 0
  ))); ?>
</div>
<? endif ?>
</fieldset>