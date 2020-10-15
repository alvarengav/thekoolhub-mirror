<? $notificationsCount = $this->MApp->GetNotificationsCount(); ?>
<header id="header">
  <? $this->load->view("common/header/logo") ?>
  <div class="pull-right">
    <a data-title="<?= $this->lang->line("Preferencias") ?>" href="<?= base_url() ?>manager/preferences" class="app-loader user-info tooltip-nz-app ttactive">
      <img style="width:20px" <? if($this->MApp->user->picture): ?>src="<?= thumb_internal($this->MApp->user->picture, 20, 20, true, true) ?>" class="user-picture"<? else: ?>class="user-picture no-picture"<? endif ?> />
      <span class="user-name"><?= $this->MApp->user->name ?></span>
    </a>
    <div class="action-hide-menu btn-header">
      <span><a class="tooltip-nz-app ttactive" data-title="<?= $this->lang->line("Cerrar menú") ?>"><i class="fa fa-reorder"></i></a></span>
    </div>
    <div class="action-notifications<?= $notificationsCount ? " with-notifications" : ""?> btn-header transparent">
      <span><a class="notifications-link  tooltip-nz-app ttactive" data-title="<?= $this->lang->line("Notificaciones") ?>"><i class="fa fa-exclamation-triangle"></i><span class="notifications-count"><?= $notificationsCount ?></span></a></span>
    </div>
    <? if( ! $this->config->item('chat-inactive', 'app')): ?>
    <div class="action-chat btn-header transparent">
      <span><a class="tooltip-nz-app ttactive" data-title="<?= $this->lang->line("Chat") ?>"><i class="fa fa-wechat"></i></a></span>
    </div>
    <?php endif ?>
    <div class="action-logout btn-header transparent">
      <span><a class="tooltip-nz-app ttactive" href="<?= base_url() ?>app/logout" data-title="<?= $this->lang->line("Salir") ?>"><i class="fa fa-sign-out"></i></a></span>
    </div>
  </div>
</header>
<? if($notificationsCount) :?><script>App.Notifications.count = <?= $notificationsCount ?>;</script><? endif ?>
<? $this->load->view("manager/notifications/box", array( 'notificationsCount' => $notificationsCount )) ?>
<?
$this->load->view('common/header/menu');
/*
if ( ENVIRONMENT == 'development' OR !($menu = $this->cache->get('menu-user-' . $this->MApp->user->id)) )
{
   $menu = $this->load->view('common/header/menu', null, true);
   $this->cache->save('menu-user-' . $this->MApp->user->id, $menu, 300);
}
echo $menu;
*/
