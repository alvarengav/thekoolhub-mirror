<div id="widget-notifications" class="<?= empty($notificationsCount) ? '' : 'with-notifications' ?>">
  <div class="widget-box">
    <div class="widget-header">
      <div class="widget-header-inside"><div class="widget-header-loading"><div class="widget-header-loading-ico"></div></div><?= $this->lang->line("Notificaciones") ?><span data-title="<?= $this->lang->line("Marcar como leídas") ?>" class="widget-count-box"><span class="widget-count"><?= empty($notificationsCount) ? '-' : $notificationsCount ?></span></span></div>
      <div class="widget-header-arrow"></div>
    </div>
    <div class="widget-content">
      <div class="widget-content-inside"> 
        <? 
        if ( ! empty($notifications)) 
        {
        	$this->load->view("manager/notifications/list", array('notifications' => $notifications));        	
        }
        ?>
      </div>
    </div>
    <div class="widget-footer">
      <div class="widget-footer-inside">
      	<a class="app-loader" href="<?= base_url() ?>manager/notifications"><?= $this->lang->line("Ver todas") ?></a>
      </div>
    </div>
  </div>
</div>
