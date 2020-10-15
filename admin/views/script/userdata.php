<script>
<? if( $this->MApp->user ): ?>
App.userData = {
  recentChat: '<?= $this->session->userdata('udata-chat-recent') ?>',
  id: <?= $this->MApp->user->id ?>,
  type: <?= $this->MApp->user->type ?>,
  atype: <?= $this->MApp->user->atype ?>,
  root: <?= $this->MApp->root ? "true" : "false" ?>,
  name: "<?= $this->MApp->user->name ?>",
  lastname: "<?= $this->MApp->user->lastname ?>",
  image: <? if($this->MApp->user->picture): ?>'<?= thumb($this->MApp->user->picture, 32, 32, true, true) ?>'<? else: ?>false<? endif ?>
};
<? else: ?>
App.userData = false;
<? endif ?>
</script>