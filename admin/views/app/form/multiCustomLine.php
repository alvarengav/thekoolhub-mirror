<?php

use function GuzzleHttp\json_decode;

$uniqid = uniqid(); $field = $item['name'] ?>
<div class="multiCustomLine col col-md-<?= $item['columns'] ?>" id="multiCustomLine_<?= $uniqid ?>">
    <label><?= isset($item['label']) ? $item['label'] : '' ?></label>
    <br>

    <table class="table table-contoured table-striped table-hover table-rates-adv-season">
        <thead>
          <tr>
            <th class="handle" style="width:1%"></th>
            <? 
            foreach($item['elements'] as $e) : 
                $w = ($e['width'] * 97) / 100;
                ?>
            <th style="width:<?= $w ?>%"><?= $e['label'] ?></th>
            <? endforeach ?>
            <th class="handle" style="width:3%"></th>
          </tr>
        </thead>
        <tbody>
          <tr class="pg-basic-tr">            
          <td style="width:1%" class="handle"><i class="fa fa-arrows"></i></td>
            <? 
            foreach($item['elements'] as $e) : 
                $w = ($e['width'] * 97) / 100;
                ?>
            <th style="width:<?= $w ?>%">
                <? 
                $type = isset($e['type']) ? $e['type'] : 'text';
                 if($type=='select') {
                    $this->load->view('app/form', array('item' => array(
                      'form' => $wgetId,
                      'name' => $e['field'],
                      'data' => $e['data'],
                      'type' => 'select',
                      'placeholder' => $e['label']
                    )));
                 } else {
                   $this->load->view('app/form', array('item' => array(
                   'form' => $wgetId,
                   'name' => $e['field'],
                   'type' => ($type=='ckeditor')?'textarea':'text',
                   'placeholder' => $e['label']
                   )));
                 }
                 ?>
            </th> 
            <? endforeach ?>

            <td  style="width:2%" style="text-align:center"><a class="btn btn-xs btn-default delete-row-button tooltip-nz-app ttactive" type="button" data-title="Eliminar"><i class="fa fa-actions fa-trash-o"></i></a></td>
          </tr>
        </tbody>
        <? if( !(isset($item['hide_new_line']) && $item['hide_new_line']) ) : ?>
        <tfoot>
          <tr>
            <td colspan="5">
              <a class="add-new-td-row" href="#"><?= $this->lang->line("Agregar nuevo dato") ?></a>
            </td>
          </tr>
        </tfoot>
        <? endif; ?>
      </table>
      <? 
      $items = [];
      if(is_array($dataItem)) {
        $items = $dataItem[$field];
      }
      elseif( is_object($dataItem) )
        $items = $dataItem->$field;

        
      $items = (array)$items;
      ?>

<script>
  (function() {
      $(document).ready(function() {
      var formGlobal = $('#widget-form-<?= $wgetId ?>');
      var ITEM = $('#multiCustomLine_<?= $uniqid ?>');

      $('#multiCustomLine_<?= $uniqid ?> table .pg-basic-tr .form-control', formGlobal).each(function(index,input){
        input = $(input)
        input.attr('data-name', input.attr('name'));
        input.attr('name', '');
      });

      var cloneItem = function(){
        var last = $('#multiCustomLine_<?= $uniqid ?> table tbody tr:not(.pg-basic-tr)', formGlobal).last();
        var clone = $('#multiCustomLine_<?= $uniqid ?> table .pg-basic-tr', formGlobal).clone().removeClass('pg-basic-tr')
        var indexC = last.length ? parseInt(last.attr('data-index')) + 1 : 0;
        clone.attr('data-index', indexC);
        $('.form-control', clone).each(function(index,input){
        input = $(input)
        input.attr('name', '<?= $field ?>[' + indexC + '][' + input.attr('data-name') + ']');
        });
        $('.delete-row-button', clone).click(function(e){
        clone.remove();
        App.clearGarbage();
        });
        clone.appendTo($('#multiCustomLine_<?= $uniqid ?> table tbody', formGlobal));
        $('#multiCustomLine_<?= $uniqid ?> table tbody', formGlobal).sortable("refresh");
        
        <? if( isset($e['type']) && $e['type']=='ckeditor' ) : ?>

            var config = {};
            config.height  = 150;
            config.removeButtons = 'Save,NewPage,Preview,Print,About,Font';
            // config.timestamp='2';
            config.allowedContent = true;
            config.enterMode = CKEDITOR.ENTER_BR;
            config.shiftEnterMode = CKEDITOR.ENTER_BR;
            config.extraAllowedContent = 'div(*)';
            config.toolbarGroups = [
              // { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
              // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
            // { name: 'insert', groups: [ 'insert' ] },
            { name: 'document', groups: [ 'mode'] },
            // { name: 'styles', groups: [ 'styles' ] },
            { name: 'basicstyles', groups: [ 'cleanup', 'basicstyles' ] },
            // { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            // { name: 'colors', groups: [ 'colors' ] },
            // { name: 'about', groups: [ 'about' ] }
          ];
          // config.extraPlugins = 'stylesheetparser';
          config.contentsCss  = ['<?= base_url('app/ckeditorcss') ?>'];
          
          // console.dir(clone);
          var EDITOR = CKEDITOR.replace( $('textarea',clone)[0], config );

          // $(clone).on('click', function() {
          //   alert('ckeditor');
          // });
        <? endif ?>

        return clone;
    };

      $('#multiCustomLine_<?= $uniqid ?> table tbody', formGlobal).sortable({ items: 'tr:not(.pg-basic-tr)',  cursor: "move", forcePlaceholderSize: true, axis: "y", handle: ".handle" });
      var cItem = false;
      <? if($items): 
      foreach($items as $d): 
      if($d):
      $d = (array)$d; ?>
      cItem = cloneItem();

      <? foreach($d as $k => $v):?>

      if( ('.form-post-<?= $k ?>', cItem).not("select") ) {
        $('.form-post-<?= $k ?>', cItem).val("<?= str_replace( PHP_EOL, "\\r\\n", addslashes($v) ) ;  ?>");
      }
      else {
        $('.form-post-<?= $k ?>', cItem).html("<?= str_replace( PHP_EOL, " \\\r\n", addslashes($v) ) ;  ?>");
      }
      <? endforeach ?>

      <? endif ?>
      <? endforeach ?>
      <? endif ?>
    
        $('#multiCustomLine_<?= $uniqid ?> .add-new-td-row', formGlobal).click(function(e){
            e.preventDefault();
            cloneItem();    
        });
    });
  }());
</script>
<style>
  #multiCustomLine_<?= $uniqid ?> .pg-basic-tr {
    display: none;
  }
</style>
</div>
