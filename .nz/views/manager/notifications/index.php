<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
  <div class="row page-title-row">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico fa fa-bell-o"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 ?> pull-right text-right button-right">          
      <div class="btn-group">
        <a href="<?= base_url() ?>" class="btn btn-default action-close app-loader">
          <?= $this->lang->line("Cerrar") ?>
        </a>
      </div>
    </div>
  </div>
  <section class="widget-form-content">
    <div class="clear-sm"></div>
    <div id="widget-list-<?= $wgetId ?>" class="widget-notifications-list well-white smart-form">
      <div class="widget-list-inside">
      <? if(!count($notifications)): ?>
      <div class="widget-no-notifications"><?= $this->lang->line("Aun no has recibido notificaciones") ?></div>     
      <? endif ?>
      <? $this->load->view("manager/notifications/listf") ?>
      </div>     
      <? if($init + $perpage < $ntotal):?>
      <div class="widget-list-button">
        <span class="btn btn-primary action-load-more"><?= $this->lang->line("Cargar más") ?></span>
      </div>     
      <? endif ?>
    </div>     
  </section>
</div>
<script>
$(document).ready(function() {
	App.changeMenu('', '');
  var widget = $('#widget-list-<?= $wgetId ?>'); 
  var addEventsItems = function(){
    $('.widget-item:not(.item-render)', widget).each(function(index, item){  
      item = $(item);    
      $('.widget-item-link-blank', item).click(function(){
        if(item.hasClass('not-viewed')) 
        {
          $('.action-read', item).click();
          App.Notifications.flush();
        }
      });
      $('.widget-item-link-loader', item).click(function(e){
        if(item.hasClass('not-viewed')) 
        {
          $('.action-read', item).click();
          App.Notifications.flush();
        }
        if(e && (e.which == 2 || e.ctrlKey)) 
        {
          e.stopPropagation();
          return;
        }
        App.loadURL($(this).attr('href'), true);
        e.preventDefault();
        return false;
      });
      $('.action-read', item).click(function(){
        item.removeClass('not-viewed');
        $.ajax({
          url: App.Notifications.URL + 'read',
          cache: false,
          type: "POST",
          data: { id: item.attr('data-id') },
          dataType: "json"
        }).done(function(json){
          App.Notifications.count = json.notifications.count;
          App.Notifications.update();
          App.Notifications.flush();
        });
      });
      $('.action-unread', item).click(function(){
        item.addClass('not-viewed');
        $.ajax({
          url: App.Notifications.URL + 'unread',
          cache: false,
          type: "POST",
          data: { id: item.attr('data-id') },
          dataType: "json"
        }).done(function(json){
          App.Notifications.count = json.notifications.count;
          App.Notifications.update();
          App.Notifications.flush();
        });
      });
      $('.action-delete', item).click(function(){          
        $.SmartMessageBox({
          title : "<?= $this->lang->line("¿Está seguro que desea eliminar definitivamente la notificación?") ?> <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span>",
          buttons : '[<?= $this->lang->line("No") ?>][<?= $this->lang->line("Si") ?>]'
        }, function(ButtonPressed) {
          if (ButtonPressed == "<?= $this->lang->line("Si") ?>") {
            $.ajax({
              url: App.Notifications.URL + 'delete',
              cache: false,
              type: "POST",
              data: { id: item.attr('data-id') },
              dataType: "json"
            }).done(function(json){
              App.Notifications.count = json.notifications.count;
              App.Notifications.update();
              App.Notifications.flush();
            });
            item.remove();
          }
        });           
        $("#MsgBoxBack").click(function(e){
          e.stopPropagation();
        });
        $("#MsgBoxBack .MessageBoxMiddle").addClass('MessageBoxMiddleLogout');
        $($("#MsgBoxBack .MessageBoxButtonSection button")[1]).addClass('btn-danger');
      });
    });    
    $('.widget-item', widget).addClass('item-render');
  };
  var init = <?= round($init) ?>, total = <?= round($ntotal) ?>, perpage = <?= $perpage ?>;
  $('.action-load-more', widget).click(function(){
    if($(this).hasClass('disabled')) return;
    $(this).addClass('disabled');
    var dateC = $('.date-separator .date', widget).last().text();
    $.ajax({
      url: App.Notifications.URL + 'listf',
      cache: false,
      type: "POST",
      data: { init: init, dateC: dateC },
      dataType: "html"
    }).done(function(html) {
      $('.action-load-more', widget).removeClass('disabled');
      init += perpage;
      if(init >= total) 
        $('.action-load-more', widget).css('display', 'none');
      $('.widget-list-inside', widget).append(html);      
      addEventsItems(); 
    })
  });
  $(widget).tooltip({
    selector: '.item-action',
    title: function(){ 
      return $(this).attr('data-title') ? $(this).attr('data-title') : $(this).attr('title');          
    },
    container: 'body',
    trigger: 'hover',
    template: '<div class="tooltip tooltip-nz tooltip-nz-notification-count" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
    placement: 'top'
  });
  init += perpage;
  addEventsItems(); 
});
</script>
<?php $this->load->view("common/footer") ?>
