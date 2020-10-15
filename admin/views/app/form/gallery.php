<?php $uniqid = uniqid(); ?>
<div class="col-md-<?= isset($columns) ? $columns : '12' ?>" id="file_<?= $uniqid ?>">

    <div id="gallery_<?= $uniqid ?>">
    <? $this->load->view('app/form', array('item' => array(
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
        'label' => isset($label) ? $label : $this->lang->line('Adjuntar Imágenes'),
        'value' => isset($value) ? $value : false,
        'placeholder' => ''
        ))) ?>
   </div>
  
    <script>
        (function() {
            $(document).ready(function() {
                var formGlobal = $('#widget-form-<?= $wgetId ?>');
                <?  $this->load->view('script/filemanager/gallery.js', array('item' => array(
                    'form' => $wgetId,
                    'max_size' => 700,
                    'name' =>$field
                ))) ?>
            });
        }());
    </script>
</div>