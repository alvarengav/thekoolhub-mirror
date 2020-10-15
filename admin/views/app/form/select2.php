<?php $uniqid = uniqid(); $field = $item['name'] ?>
<div class="col-md-<?= $item['columns'] ?>" id="multiselect_<?= $uniqid ?>">
    
  <? $this->load->view('app/form', array('item' => array(
      'type' => 'select',
      'columns'=>12,
      'form' => $item['form'],
      'name' => $field,
      'label' => isset($item['label']) ? $item['label'] : '',
      'data' => $item['data'],
      'value' => $item['value'],
      'placeholder' => $item['placeholder']
    ))) ?>
<script>
  (function() {
    $(document).ready(function() {
      var ITEM = $('#multiselect_<?= $uniqid ?>');
      $('select', ITEM).select2();
    });
  }());
</script>
<style>
  #multiselect_<?= $uniqid ?> .select2-container .select2-choice {
    border: none;
    padding: 0;
    margin: -6px 0px;
    height: 30px;
  }
  #multiselect_<?= $uniqid ?> .select2-container .select2-arrow {
    display: none;
  }
</style>
</div>