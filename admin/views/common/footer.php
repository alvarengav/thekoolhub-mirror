<? $this->load->view("script/footer") ?>
<? if($this->input->get('is_iframe')) : ?>
  
  <style>
    html {
      overflow-y: hidden;
    }
      #left-panel,
      #header {
        display:none;
      }
      #main {
    padding: 0;
    margin: 0;
      }
      .well-white {
        
        padding: 0;
      }
      .smart-form section {
        margin-bottom: 0;
      }
  </style>

  <script>
    var m = parent.$('body').find('#modalLiveAdmin')

    $(document).ready(function() {
      $('.modal-content, iframe, .embed-responsive', m).height($('#main').outerHeight() - 10);
      $($('#main')).sizeChanged(function(){

        $('.modal-content, iframe, .embed-responsive', m).height($('#main').outerHeight() - 10);
      })
    });

    $('.pull-right .btn').click(function() {

      m.modal('hide');
    });

    
(function ($) {

  $.fn.sizeChanged = function (handleFunction) {
      var element = this;
      var lastWidth = element.width();
      var lastHeight = element.height();

      setInterval(function () {
          if (lastWidth === element.width()&&lastHeight === element.height())
              return;
          if (typeof (handleFunction) == 'function') {
              handleFunction({ width: lastWidth, height: lastHeight },
                            { width: element.width(), height: element.height() });
              lastWidth = element.width();
              lastHeight = element.height();
          }
      }, 100);


      return element;
  };

  }(jQuery));
  </script>
<? endif ?>
<? if(!AJAX): 
if($this->MApp->user && $this->MApp->user->valid != 2)
  $this->MApp->UpdateConnection();
?>
<style>.button-show-columns{display:none}.btn-group .active {
    pointer-events: none;
}</style>
</body>
</html>
<? endif ?>
