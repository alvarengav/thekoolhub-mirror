<? $months = $this->DataG->GetMonthsArray();
$dateInit = FALSE;
foreach ($notifications as $n):
  if(isset($n->delete)) continue;
	$n = notification_parse($n);
  $date = date('d', $n->time). ' de ' . $months[round(date('m', $n->time))] . ((round(date('Y', $n->time)) != round(date('Y'))) ? ' de ' . date('Y', $n->time) : '');
  if($dateC != $date): 
	if( ! empty($dateInit))
	{
		echo '</div>';
	}
	$dateInit = TRUE;
	?>
<div class="date-separator page-title"><span class="date"><?= $date ?></span></div>
<div class="list-date">
<? endif ?>
<div data-id="<?= $n->id ?>" data-link="<?= $n->link ?>" class="widget-notification widget-item<?= $n->viewed ? "" : " not-viewed" ?>">
  <div class="widget-item-inside">
    <div class="widget-item-details">
      <div class="widget-item-text">
      <span class="widget-item-content<?= $n->ico ? ' with-ico' : '' ?>">      
	      <span class="widget-item-text"><?php if ($n->ico): ?><span class="widget-item-ico"><?= $n->ico ?></span> <?php endif ?><?= $n->text ?></span>
	      <span class="widget-item-time"><?= date("H:i", $n->time) ?><?= $n->project ? " - {$n->project}" : "" ?></span>
      </span>
      <span class="item-actions">
      	<a href="<?= $n->link ?>" <?= $n->blank ? 'class="item-action widget-item-link-blank" target="_blank"' : 'class="item-action widget-item-link-loader"' ?> title="<?= $this->lang->line("Revisar") ?>"><i class="fa fa-external-link"></i></a>
      	<span title="<?= $this->lang->line("Marcar como leída") ?>" class="item-action action-read"><i class="fa fa-square-o read-on"></i><i class="fa fa-check-square-o read-off"></i></span>
      	<span title="<?= $this->lang->line("Marcar como no leída") ?>" class="item-action action-unread"><i class="fa fa-square-o read-on"></i><i class="fa fa-check-square-o read-off"></i></span>
      	<span title="<?= $this->lang->line("Eliminar") ?>" class="item-action action-delete"><i class="fa fa-trash-o"></i></span>
      </span>
      </div>
    </div>
  </div>
</div>
<? $dateC = $date;
endforeach;
echo '</div>';
