<?php $uniqid = uniqid(); $field = $item['name'] ?>
<div class="col-md-<?= $item['columns'] ?>" id="multiselect_<?= $uniqid ?>">
  <? $this->load->view('app/form', array('item' => array(
      'type' => 'select',
      'columns' => 9,
      'form' => $item['form'],
      'name' => $field,
      'label' => $item['label'],
      'data' => $item['data'],
      'placeholder' => $item['placeholder']
    ))) ?>
    <div class="col col-inset col-3">
      <span style="margin-top:20px" class="btn btn-primary add-new"><i class="glyphicon glyphicon-plus"></i> Agregar</span>
    </div>
    <div style="clear:both"></div>
    <!-- <small class="col alert alert-info" style="padding-top: 0 padding-bottom: 10px"><i class="fa fa-warning"></i> Si modificas las posiciones, las presentaciones se restableceran</small> -->
    <div style="clear:both"></div>
    <ul class="list-items">
    </ul>
      <?php if (isset($item['article_presetantation']) ) : ?> 
      <? endif; ?>
<script>
  (function() {
    String.prototype.replaceAll = function(search, replacement) {
      var target = this;
      return target.split(search).join(replacement);
    }
    function htmlentities(str) {
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    $(document).ready(function() {


      var LIST = $('#multiselect_<?= $uniqid ?>');
      var SELECT = $('select', LIST).select2();
      $('.list-items',LIST).sortable();

        SELECT.attr('name', '');
        var create_field = function(id, text){
          var li = $('<li/>');
          var index = $('.list-items li',LIST).length;

          if($('.list-items li:visible',LIST).length><?= $item['max'] - 1 ?>) 
            return;
          else if(index == <?= $item['max'] - 1 ?>)
            $('.add-new', LIST).addClass('disabled');
          else
            $('.add-new', LIST).removeClass('disabled');

            
          var _li = '<span class="delete-item" style="cursor:pointer;margin-left:20px"><i class="glyphicon glyphicon-trash"></i></span> <? 
              if( isset( $item['article_presetantation'] ) ) {
                $ap = $item['article_presetantation'];

                $ap['sync'] = $field.'[_INDEX_][id]';
                $ap['values'] = false;
                echo btn_article_presentation($ap);
              }
             ?> \
            <input type="hidden" value="' + id + '" name="<?= str_replace('"', "\'", $field) ?>['+index+'][id]">\
            <input type="hidden" value="' + htmlentities(text) + '" name="<?= str_replace('"', "\'", $field) ?>['+index+'][el]">';

          _li = _li.replaceAll('_INDEX_', index);


          li.html(text + _li);
          var dapv = $('#data-custom<?= $uniqid ?> [data-index="'+index+'"]').html();

          $('.btn-home_article_presentation',li).attr('data-ap-values', dapv);
          li.css('margin-bottom', '5px');
          $('.delete-item', li).click(function(){
            $('.add-new', LIST).removeClass('disabled');
            li.html('').hide();
          })
          $('.list-items',LIST).append(li);
        };
        $('.add-new', LIST).click(function(){
          if(!SELECT.val())
            return;
          create_field($(SELECT).val(), $('option:selected', SELECT).text());
        });

         <?

         
      $items = isset( $item['value'] ) ? $item['value'] : false;
          if($items):
         if($items && count($items)):
          foreach($items as $item): ?>
          create_field('<?= $item->id ?>','<?= addslashes($item->el) ?>');
        <? endforeach  ?>
        <? endif  ?>
        <? endif  ?>

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
  #multiselect_<?= $uniqid ?> .list-items {
    padding: 0 1em;
    margin: 0;
    list-style: none;
  }
  #multiselect_<?= $uniqid ?> .list-items li { 
    cursor: move;
    margin-bottom: 5px;
    padding: 5px;
      -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
  }
  #multiselect_<?= $uniqid ?> .list-items li:before { 
    content: "\00BB \0020";
    margin-right: 0.5em;
  }
  #multiselect_<?= $uniqid ?> .list-items li:hover { 
    margin-bottom: 5px;
    background: #ddefff;
  }

</style>
</div>