<?php 
$field = $item['name'];
$id = $field . 'Form' . $item['form']; 
 ?>
<div class="col col-md-<?= $item['columns'] ?> element" id="content_datetime_<?= $id ?>">
  <label for="<?= $id ?>"><?= isset($item['label']) ? $item['label'] : '' ?></label>
  <div class="input" style="padding-right:15px">
    <div class='input-group date' id="datetime_<?= $id ?>">
        <input type='text' name="<?= $field ?>" class="form-control" id="<?= $id ?>" placeholder="<?= isset($item['placeholder']) ? $item['placeholder'] : '' ?>" value="<?= isset($item['value']) ? $item['value'] : '' ?>"  />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
  </div>
<script>
  (function() {
    $(document).ready(function() {
       $('#datetime_<?= $id ?>').datetimepicker({
        'format':'YYYY/MM/DD HH:mm:ss'
       });
    });
  }());
</script>
</div>