<?php $uniqid = uniqid(); ?>
<div class="modal fade" id="modal-<?= $uniqid ?>" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
        <h4 class="modal-title">Encuadrar imagen</h4>
      </div>
      <div class="modal-body  smart-form">

          <div id="PIC_C_<?= $uniqid ?>" style="user-select:none; overflow: hidden; text-align:center; width: 100%; background: gray; display: block ">
            <img>
          </div>

          <p style="color:red; margin-top: 10px; display:none" id="alert-<?= $uniqid ?>">Las proporciones de la imagen son más pequeñas que la presentación, recomendamos cargar una imagen de mayor resolución.</p>

          <p>Utilizar tamaños mayores a la presentación (<span class="ideal-w"></span>x<span class="ideal-h"></span>px)</p>

          <div class="clearfix"></div>

          <input type="hidden" name="coords" class="coords" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="<?= layout('') ?>js/plugin/jcrop/css/jquery.Jcrop.css" type="text/css" />
<script src="<?= layout('') ?>js/plugin/jcrop/js/jquery.Jcrop.js"></script>
<script>
  (function() {

    $(document).ready(function() {
      var MODAL = $('#modal-<?= $uniqid ?>');
      var JCropper;

      $('.btn-image_position').click( btn_open );

      function btn_open() {
        var _this = $(this);
            _this.attr('data-loading-text','<i class="fa fa-cog fa-spin"></i> cargando');
            _this.button('loading');

        MODAL.modal({ backdrop: 'static', keyboard: false }).modal('show');
        _this.button('reset');

        var PIC_C = $('#PIC_C_<?= $uniqid ?>');
            PIC_C.attr('style',"user-select:none; overflow: hidden; text-align:center; width: 100%; background: gray; display: block ");
            PIC_C.html('');
            PIC_C.append('<img>');

        if (_this.attr('data-ip-w')) {
          PIC_C.show();
          $('.multimedia',MODAL).show();

          var PIC = $('img',PIC_C);
              PIC.attr('src', _this.attr('data-ip-file'));
              $('.coords',MODAL).attr('name', _this.attr('data-ip-field'));

          PIC.load(function() {

            var int = setInterval(function() {
              var pw = PIC.width();
              var ph = PIC.height();

              if(pw>0) {
                clearInterval(int);

                var cw = PIC_C.width();
                var ch = PIC_C.height();
                var zw = zwb = _this.attr('data-ip-w');
                var zh = zhb = _this.attr('data-ip-h');


                  $('.ideal-w', MODAL).html(zw);
                  $('.ideal-h', MODAL).html(zh);


                if( pw>cw )
                {
                  var dif = pw/cw;
                  pw = pw/dif;
                  PIC.width( pw );
                  var zw = zw / dif;
                  var zh = zh / dif;
                }

                if(pw<zw || ph<zh)
                {
                  $('#alert-<?= $uniqid ?>').show();
                }


                var jcrop_api;

                var coords = _this.attr('data-ip-coords') ? _this.attr('data-ip-coords').split(',') : false;
                var setSelect = [  pw/2 - zw/2 , ph/2 - zh/2,zw,zh ];
                if (!isNaN(coords[0]) && !isNaN(coords[1]) && !isNaN(coords[2]) && !isNaN(coords[3])) {
                  setSelect = [ coords[0], coords[1], coords[2], coords[3] ];
                }

                JCropper = PIC.Jcrop({
                  allowSelect:     false,
                  bgFade:     true,
                  bgColor:     'rgb(0, 255, 208)',
                  bgOpacity:   .3,
                  aspectRatio: zwb/zhb,
                  // minSize: [zw, zh],
                  onChange: showCoords,
                  onSelect: showCoords,
                  setSelect: setSelect,
                },function(){
                  jcrop_api = this;
                });
              }


            }, 100);


        });


        }
      }

      function showCoords(c)
      {
        $('.coords',MODAL).val( c.x +',' + c.y +','+ c.x2 +','+ c.y2 +','+ c.w +',' +c.h );
      };


    });
  })();
</script>
<style>
  .jcrop-holder {
    margin: auto;
  }
  .jcrop-keymgr {
    display: none !important;
  }
  .modal-dialog .label {
    color: black;
    display: inline-block;
    text-align: left;
  }
</style>
