<!-- <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/inline/ckeditor.js"></script> -->
<script src="<? base_url() ?>/admin/layout/js/ckeditor/ckeditor.js"></script>
<script src="<? base_url() ?>/app/layout/vendor/notify.min.js"></script>

<style>

.ck.ck-editor__editable_inline[dir=ltr] {
    text-align: inherit;
}
.editor:hover {
    outline: #00fff5 2px dotted;
}
.btn-settings {
    background: linear-gradient(45deg, #333, #666);
    color: white;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 5px;
    box-shadow: -1px 1px 3px rgba(0,0,0,.5);
    text-align: center;
    display: inline-block;
    width: 200px;
}
.liveadmin-settings {
  position: relative;
}
.liveadmin-settings .btn-settings {
  opacity: 0;
  position: absolute;
  top: 30px;
  right: 100px;
  cursor:pointer;
  z-index: 9999;
}
}
.liveadmin-settings:hover {
  outline: gray 2px dotted;
}
   
.liveadmin-settings:hover .btn-settings {
  opacity: 1;
}
   
#modalLiveAdmin .modal-lg {
    max-width: 1000px;
}
</style>

<!--Modal: Name-->
<div class="modal fade" id="modalLiveAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          <iframe class="embed-responsive-item" src="" allowfullscreen></iframe>
        </div>

      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: Name-->


<script>

$(document).ready(function() {

     var config = {};


    $('.editor').each(function() {

        $(this).click(function() {
            return false;
        });

        this.setAttribute('contenteditable', true);
        var _var = $(this).attr('data-var');
        var _lang = $(this).attr('data-lang');
        
        var config = {
            toolbar: [
                {name: "basicstyles", items: ["Bold", "Italic", "Underline", "Strike", "-", "RemoveFormat"]},
                {name: "links", items: ["Link", "Unlink"]},
                {name: 'colors', items: [ 'TextColor' ]}
            ],
            enterMode: CKEDITOR.ENTER_BR,
        };


        config.colorButton_colors = 'F2F2F2,707070,1A1A1A,FFA900,EF867D,7AC2B8';

        var EDITOR =  CKEDITOR.inline( this, config);


        EDITOR.on("instanceReady", function(event) {
            EDITOR.on("blur", Update);
            // EDITOR.on("key", Update);
            // EDITOR.on("keyup", Update);
            // EDITOR.on("paste", Update);
            // EDITOR.on("keypress", Update);
            // EDITOR.on("change", Update);
        });

        var interval = false;
        function Update() {
                // setTimeout(function() {
                //   $('html, body').animate({
                //     scrollTop: ITEM.offset().top
                //   },0);
                // },1);
        
                // EDITOR.updateElement();
            clearInterval(interval);
            interval = setTimeout(() => {
                $.notify("Texto actualizado","success");

                $.post( App.config.url+'liveadmin/update', { 
                    str: EDITOR.getData(),
                    lang: _lang,
                    var: _var
                })
                .done(function( data ) {
                });
            }, 600);
            
        }
    });

    $('[data-modal-liveadmin]').click(function() {
      var url = $(this).attr('data-modal-liveadmin');
      var id = $(this).attr('data-liveadmin-id');

      $('#modalLiveAdmin .embed-responsive-item').attr('src', App.config.url+'admin/'+url+'/<?=$this->data['lang'] ?>/'+id+'?is_iframe=true');
      $('#modalLiveAdmin').modal();
    });

    $('#modalLiveAdmin').on('hide.bs.modal', function() {
      setTimeout(() => {
        location.reload()
        
      }, 1000);
    })
});


    // var options = {
    //     toolbar: [ 'bold', 'italic', 'underline', '|', 'link', '|', 'undo', 'redo' ],
    //     heading: {
    //         options: [
    //             { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
    //         ]
    //     },
    //     autosave: {
    //         waitingTime: 5000, // in ms
    //         save( editor ) {
    //             console.dir(editor);
    //         }
    //     },
    // };

    // InlineEditor
    //     .create( document.querySelector( '.editor' ), options )
    //     .catch( error => {
    //         console.error( error );
    //     })
    //     .then( editor => {
    //         window.editor = editor;

            
    //         console.dir(editor);

    //         var interval = false;
    //         editor.model.document.on( 'change:data', ( evt, args ) => {
    //             clearInterval(interval);
    //             interval = setTimeout(() => {
    //                 console.dir( editor.getData() );
    //             }, 600);
    //         } );
    //     });


//         editor.on('change:data', () => {
//     console.log('The data has changed!');
// });


</script>