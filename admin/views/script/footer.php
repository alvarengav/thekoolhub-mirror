<? /*if( $this->MApp->user ): ?>
<? $this->load->view("script/filemanager/includes", array('force' => true)) ?>
<? endif*/ ?>
<? $this->load->view("script/userdata") ?>
<script>
$(document).ready(function() {
<? if(!isset($appNoChangeTitle)):
$title = prep_app_title($appTitle, false);
$client = $this->config->item('client', 'app');
$title = ($title && $title != $client) ? $title.' | '.$client : $client;
$title = addslashes($title);
?>
  App.Title.set('title', '<?= $title ?>');
<? endif ?>
<? if($this->MApp->user && empty($appNoChangeMenu)): ?>
App.changeMenu('<?= $this->uri->segment(1,'') ?>', '<?= $this->uri->segment(2,'') ?>');
<? endif ?>
setTimeout(function(){
	$('body').addClass('menu-animated');
}, 600);
});
<?php if (APP_MODE == 'dev' && ! empty($this->benchmark)): ?>
App.Log('Elapsed time', '<?= $this->benchmark->elapsed_time() ?>');
<?php endif ?>
</script>
