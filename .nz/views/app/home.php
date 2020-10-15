<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
  <div class="widget-app-home">
    <a target="_blank" href="<?= base_sys() ?>" class="home-logo">
      <img src="<?= layout('background.png') ?>">
    </a>
  </div>
</div>
<script>
$(document).ready(function() {
  $('#main .widget-app-home').css('min-height', $('#left-panel').height() - 40);
});
</script>
<?php $this->load->view("common/footer") ?>
