<? foreach($notifications as $n):
$n = notification_parse($n); if(!isset($n->delete)):
?>
<div data-id="<?= $n->id ?>" data-link="<?= $n->link ?>" class="widget-notification widget-item<?= $n->viewed ? "" : " not-viewed" ?><?= $n->image ? "" : " no-image" ?>">
  <div class="widget-item-inside">
    <a href="<?= $n->link ?>" <?= $n->blank ? 'class="widget-item-link widget-item-link-blank" target="_blank"' : 'class="widget-item-link widget-item-link-loader"' ?>></a>
    <? if($n->image): ?>
    <div class="widget-item-image">
      <img src="<?= $n->image ?>" />
    </div>
    <? endif ?>
    <div class="widget-item-details">
      <div class="widget-item-text"><?= $n->text ?></div>
      <div class="widget-item-time"><?= $n->ico ?><?= date('d/m/Y H:i', $n->time) ?><?= $n->project ? " - {$n->project}" : "" ?></div>
    </div>
    <div class="widget-item-actions">
      <div data-title="<?= $this->lang->line("Marcar como leída") ?>" class="item-action action-read"><i class="fa fa-square-o read-on"></i><i class="fa fa-check-square-o read-off"></i></div>
      <div data-title="<?= $this->lang->line("Marcar como no leída") ?>" class="item-action action-unread"><i class="fa fa-square-o read-on"></i><i class="fa fa-check-square-o read-off"></i></div>
      <div data-title="<?= $this->lang->line("Eliminar") ?>" class="item-action action-delete"><i class="fa fa-trash-o"></i></div>
    </div>
  </div>
</div>
<? endif ?>
<? endforeach ?>
<? if ( ! $this->input->post('position') && ! count($notifications)): ?>
<div class="widget-no-notifications" style="text-align: center;margin-top:  41px"><?= $this->lang->line("Aun no tienes notificaciones.") ?></div>
<? endif ?>