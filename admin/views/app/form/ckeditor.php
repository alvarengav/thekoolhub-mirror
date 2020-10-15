<?php $uniqid = uniqid(); $field = $item['name'] ?>
<? $this->load->view("script/ckeditor/includes") ?>

<div class="col-md-<?= $item['columns'] ?>" id="ckeditor_<?= $uniqid ?>">

  <? $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 12,
    'form' => $item['form'],
    'name' => $field,
    'value' => str_replace('&quot;', "'", html_entity_decode($item['value'], ENT_QUOTES)),
    'label' => isset($item['label']) ? $item['label'] : '',
    'height' => isset($item['height']) ? $item['height'] : 650,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => isset($item['placeholder']) ? $item['placeholder'] : ''
  ))) ?>
  <div class="modal fade" backdrop="static" dropdo id="ckeditor_embed_code_<?= $uniqid ?>" tabindex="-1" role="dialog" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
            </button>
            <h4 class="modal-title">Incrustar HTML, Tweets, Etc</h4>
          </div>
          <div class="modal-body">
            <div class="row">

            <? $this->load->view('app/form', array('item' => array(
              'type' => 'textarea',
              'columns' => 12,
              'form' => $item['form'],
              'name' => "ckeditor_embed_code_".$uniqid,
              'label' => '',
              'height' => 250,
            ))) ?>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancelar
            </button>
            <button type="button" class="btn btn-primary btn-embedCode-insert">
              Insertar
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

  <div class="modal fade" backdrop="static" id="ckeditor_embed_youtube_<?= $uniqid ?>" tabindex="-1" role="dialog" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              ×
            </button>
            <h4 class="modal-title">Incrustar video Youtube wide</h4>
          </div>
          <div class="modal-body">
            <div class="">

            <? $this->load->view('app/form', array('item' => [
              'label' => 'Copia unicamente el código del la url del video. <br> Ejemplo: https://youtu.be/<strong style="color:red">OX3yDWyMpHU</strong>',
              'type' => 'input',
              'form' => $wgetId,
              'name' => "ckeditor_embed_youtube_".$uniqid,
              'placeholder' => $this->lang->line('OX3yDWyMpHU')
            ])) ?>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancelar
            </button>
            <button type="button" class="btn btn-primary btn-embedYoutube-insert">
              Insertar
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

  <div class="modal fade" backdrop="static" id="ckeditor_embedImage_<?= $uniqid ?>" tabindex="-1" role="dialog" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="">
            <? 

              $old_field = $field;

              $field = 'ck_img_'.$uniqid;
              $this->load->view("app/form/file", [
              'field'=>$field,
              'id_file'=>false,
              ]);

              $field = $old_field;
            ?>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancelar
            </button>
            <button type="button" class="btn btn-primary btn-embedImage-insert">
              Insertar
            </button>
            <!-- <button type="button" class="btn btn-primary btn-embedImage-insert download"> -->
              <!-- Insertar con enlace de descarga.
            </button> -->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" backdrop="static" id="ckeditor_embedGallery_<?= $uniqid ?>" tabindex="-1" role="dialog" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="">
            <? 

              $old_field = $field;

              $field = 'id_gallery_'.$uniqid;
              $this->load->view("app/form/gallery", [
              'field'=>$field,
              'id_gallery'=>false,
              ]);

              $field = $old_field;
            ?>

            
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancelar
            </button>
            <button type="button" class="btn btn-primary btn-embedGallery-insert">
              Insertar
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>


<script>
  (function() {
    $(document).ready(function() {
      var ITEM = $('#ckeditor_<?= $uniqid ?>');

      <? if( isset( $item['full'] ) ) : ?>
      var config = {};
        config.height  = <?= isset($item['height']) ? $item['height'] : 650 ?>;
        // config.removeButtons = 'Save,NewPage,Preview,Print,About,Font';
        // config.timestamp='2';
        config.allowedContent = true;
        config.enterMode = CKEDITOR.ENTER_P;
        config.shiftEnterMode = CKEDITOR.ENTER_BR;
        config.extraAllowedContent = 'div(*)';
        config.pasteFromWordPromptCleanup = true;
  //  config.pasteFromWordRemoveFontStyles = true;
   config.forcePasteAsPlainText = true;
  //  config.ignoreEmptyParagraph = true;
  //  config.removeFormatAttributes = true;
        config.toolbarGroups = [
          // { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
          // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'links', groups: [ 'links' ] },
        // { name: 'insert', groups: [ 'insert' ] },
        { name: 'document', groups: [ 'mode'] },
        '/',
        // { name: 'styles', groups: [ 'styles' ] },
        { name: 'basicstyles', groups: [ 'cleanup', 'basicstyles' ] },
        { name: 'paragraph', groups: [ 'list',/*, 'indent',*/ 'blocks', 'align' ] },
        // { name: 'colors', groups: [ 'colors' ] },
        // { name: 'about', groups: [ 'about' ] }
      ];
      // config.extraPlugins = 'stylesheetparser';
      // config.removeButtons = 'Image';
      // config.removeButtons = 'Table';
      // config.removeButtons = 'Iframe';
      // config.removeButtons = 'Flash';

      config.contentsCss  = ['<?= layout() ?>main-ckeditor.css?v=5'];
      <? else: ?>
      
      var config = {};
        config.height  = <?= isset($item['height']) ? $item['height'] : 300 ?>;
        config.removeButtons = 'Save,NewPage,Preview,Print,About,Font';
        // config.timestamp='2';
        config.allowedContent = true;
        config.enterMode = CKEDITOR.ENTER_BR;
        config.shiftEnterMode = CKEDITOR.ENTER_BR;
        config.extraAllowedContent = 'div(*)';
        config.pasteFromWordPromptCleanup = true;
   config.pasteFromWordRemoveFontStyles = true;
   config.forcePasteAsPlainText = true;
   config.ignoreEmptyParagraph = true;
   config.removeFormatAttributes = true;
        config.toolbarGroups = [
          // { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
          // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        <?= isset($item['links']) && $item['links'] ? "{ name: 'links', groups: [ 'links' ] }," : '' ?>
        // { name: 'insert', groups: [ 'insert' ] },
        { name: 'document', groups: [ 'mode'] },
        // '/',
        // { name: 'styles', groups: [ 'styles' ] },
        { name: 'basicstyles', groups: [ 'cleanup', 'basicstyles' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'colors', groups: [ 'colors' ] },
        // { name: 'about', groups: [ 'about' ] }
      ];
      // config.extraPlugins = 'stylesheetparser';
      config.contentsCss  = ['<?= base_url('app/ckeditorcss') ?>'];
      <? endif ?>
      
      var EDITOR = CKEDITOR.replace( '<?= $field ?>Form<?= $item['form'] ?>', config );

      
      
      // add embed code
      var MODAL_EMBED = $("#ckeditor_embed_code_<?= $uniqid ?>");
      EDITOR.ui.addButton('EmbedCode', {
          label: "Incrustar HTML",
          title: "Incrustar HTML",
          id: 'embedCode',
          command: 'embedCode',
          toolbar: 'links'
      });
      
      // add embed youtube
      var MODAL_YT = $("#ckeditor_embed_youtube_<?= $uniqid ?>");
      EDITOR.ui.addButton('EmbedYoutube', {
          label: "Incrustar Youtube wide",
          title: "Incrustar Youtube wide",
          id: 'embedYoutube',
          command: 'embedYoutube',
          toolbar: 'links'
      });
      
      
      // add embed extra block
      var MODAL_IMG = $("#ckeditor_embedImage_<?= $uniqid ?>");
      EDITOR.ui.addButton('embedImage', {
          label: "Incrustar Imagen",
          title: "Incrustar Imagen",
          id: 'embedImage',
          command: 'embedImage',
          toolbar: 'links'
      });

      // add embed extra block
      var MODAL_GALLERY = $("#ckeditor_embedGallery_<?= $uniqid ?>");
      // EDITOR.ui.addButton('embedGallery', {
      //     label: "Incrustar Galería",
      //     title: "Incrustar Galería",
      //     id: 'embedGallery',
      //     command: 'embedGallery',
      //     toolbar: 'links'
      // });


      
      EDITOR.addCommand('embedImage', {
        exec : function(editor) {
          MODAL_IMG.modal('show');
        }
      });
      
      EDITOR.addCommand('embedGallery', {
        exec : function(editor) {
          MODAL_GALLERY.modal('show');
        }
      });



      EDITOR.addCommand('embedCode', {
        exec : function(editor) {
          MODAL_EMBED.modal('show');
        }
      });
      


      EDITOR.addCommand('embedYoutube', {
        exec : function(editor) {
          MODAL_YT.modal('show');
        }
      });

      
      
      $('.btn-embedGallery-insert',MODAL_GALLERY).addClass('disabled');
      $('.widget-gallery-items .gallery-item',MODAL_GALLERY).bind("DOMNodeInserted",function(){

        if( $('.gallery-item[data-id]',this).length == 0 ) {
          $('.btn-embedGallery-insert',MODAL_GALLERY).addClass('disabled');
        } 
      });
      $('.widget-filemanager.widget-gallery-input').on('successUpload', function() {
        $('.btn-embedGallery-insert',MODAL_GALLERY).removeClass('disabled');
      });
      
      $(MODAL_GALLERY).on('hidden.bs.modal', function (e) {
        $('.widget-gallery-items',MODAL_GALLERY).html('');
        $('.btn-embedGallery-insert',MODAL_GALLERY).addClass('disabled');
      })

      

      // // add image
      // var MODAL_YT = $("#ckeditor_embed_youtube_<?= $uniqid ?>");
      // EDITOR.ui.addButton('EmbedYoutube', {
      //     label: "Incrustar Imagen wide",
      //     title: "Incrustar Imagen wide",
      //     id: 'embedImage',
      //     command: 'embedImage',
      //     toolbar: 'insert'
      // });


      
      $('.btn-embedImage-insert',MODAL_IMG).addClass('disabled');
      $('.file-box',MODAL_IMG).bind("DOMSubtreeModified",function(){
        if( $(this).attr('href') ) {
          $('.btn-embedImage-insert',MODAL_IMG).removeClass('disabled');
        } else {
          $('.btn-embedImage-insert',MODAL_IMG).addClass('disabled');
        }
      });
      $(MODAL_IMG).on('hidden.bs.modal', function (e) {
        $('.fileinput-button-delete',MODAL_IMG).trigger('click');
      })
      

      EDITOR.on("instanceReady", function(event)
      {
        EDITOR.on("key", Update);
        EDITOR.on("keyup", Update);
        EDITOR.on("paste", Update);
        EDITOR.on("keypress", Update);
        EDITOR.on("blur", Update);
        EDITOR.on("change", Update);


        $('.btn-embedCode-insert', MODAL_EMBED).click(function() {
          var html = $('textarea', MODAL_EMBED).val();
              html = $('<div class="html_embed"></div>').html(html);
              html = html[0].outerHTML;
              html = html.replace(/([\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2694-\u2697]|\uD83E[\uDD10-\uDD5D])/g, '');

          var _EDITOR = CKEDITOR.instances[ '<?= $field ?>Form<?= $item['form'] ?>' ];
          var INSERTED = CKEDITOR.dom.element.createFromHtml(html);

          _EDITOR.insertElement(INSERTED);

          $('textarea', MODAL_EMBED).val('');

          MODAL_EMBED.modal('hide');
        });

        $('.btn-embedYoutube-insert', MODAL_YT).click(function() {
          var code = $('input', MODAL_YT).val();
          var html = $('<div class="html_embed"><iframe class="youtube-frame" width="100%" height="565px" src="https://www.youtube-nocookie.com/embed/'+code+'?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div>');
              html = html[0].outerHTML;

          var _EDITOR = CKEDITOR.instances[ '<?= $field ?>Form<?= $item['form'] ?>' ];
          var INSERTED = CKEDITOR.dom.element.createFromHtml(html);

          _EDITOR.insertElement(INSERTED);

          $('input', MODAL_YT).val('');

          MODAL_YT.modal('hide');
        });

        

        $('.btn-embedImage-insert', MODAL_IMG).click(function() {
          var id_file = $('.input-file-id', MODAL_IMG).val();
          if( !id_file ) {
            // MODAL_IMG.modal('hide');
            return;
          }
          var src = $('a.file-box',MODAL_IMG).attr('href');

          // if($(this).hasClass('download'))
          //   var html = $('<div><span class="false-view"><img src="'+src+'" style="display:block;width:100%;"></span><span class="real-view">[imgdw='+id_file+'][/imgdw]</span></div>');
          // else
          //   var html = $('<div><span class="false-view"><img src="'+src+'" style="display:block;width:100%;"></span><span class="real-view">[img='+id_file+'][/img]</span></div>');
          //     html = html[0].outerHTML;

          var html = $('<div>[img='+id_file+'][/img]</div>');
              html = html[0].outerHTML;

          var _EDITOR = CKEDITOR.instances[ '<?= $field ?>Form<?= $item['form'] ?>' ];
          var INSERTED = CKEDITOR.dom.element.createFromHtml(html);

          _EDITOR.insertElement(INSERTED);

          $('.glyphicon-trash', MODAL_IMG).trigger('click');

          MODAL_IMG.modal('hide');
        });
      });

      $('.btn-embedGallery-insert', MODAL_GALLERY).click(function() {
          var input_files = $('.input-gallery-items', MODAL_GALLERY);
          var id_files = '';

          input_files.each(function(i, el) {
            id_files += $(el).val();
          });

          // id_files = id_files.slice(0, -1);

          
          if( !id_files ) {
            MODAL_GALLERY.modal('hide');
            return;
          }
          
          // var html = $('<div class="html_embed"><span class="false-view">GALLERÍA</span><span class="real-view">[gallery='+id_files+'][/gallery]</span></div>');
          var html = $('<div>[gallery='+id_files+'][/gallery]</div>');
          // var src = $('a.file-box',MODAL_IMG).attr('href');

          // if($(this).hasClass('download'))
          // else
          //   var html = $('<div><span class="false-view"><img src="'+src+'" style="display:block;width:100%;"></span><span class="real-view">[img='+id_file+'][/img]</span></div>');
              html = html[0].outerHTML;

              console.dir(html);

          var _EDITOR = CKEDITOR.instances[ '<?= $field ?>Form<?= $item['form'] ?>' ];
          var INSERTED = CKEDITOR.dom.element.createFromHtml(html);

          _EDITOR.insertElement(INSERTED);

          $('.button-delete', MODAL_GALLERY).trigger('click');

          MODAL_GALLERY.modal('hide');
        });


      function Update() {
        setTimeout(function() {
          $('html, body').animate({
            scrollTop: ITEM.offset().top
          },0);
        },1);

        EDITOR.updateElement();
      }
    });


  }());

</script>
<style>
span.cke_button_icon.cke_button__embedyoutube_icon:before {
    content: '📺';
}
span.cke_button_icon.cke_button__embedimage_icon:before {
    content: '📷';
}
span.cke_button_icon.cke_button__embedcode_icon:before {
    content: '🔳';
}
span.cke_button_icon.cke_button__embedgallery_icon:before {
    content: '🖼️';
}
.cke_button__embedyoutube { background: #ffc10745 !important; }
.cke_button__embedcode { background: #ffc10745 !important; }
.cke_button__embedimage { background: #00bcd46b !important; }
.cke_button__embedgallery { background: #00bcd46b !important; }
.cke_button__blockquote { background: #e91e6357 !important; }

.cke_contents_ltr span.real-view {
  display: none !important;
}

</style>
</div>
