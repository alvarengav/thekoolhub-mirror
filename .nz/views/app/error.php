<? if(!AJAX) $this->load->view("common/header") ?>
<div id="main">
	<div class="row">
		<div class="text-center error-box">
			<h1 class="error-text-2"><?= $this->lang->line('Error 404') ?></h1>
			<h2 class="font-xl"><i class="fa fa-fw fa-warning fa-lg text-danger"></i> <?= $this->lang->line('Página no encontrada') ?></h2>
		</div>
	</div>
</div>
<?php $this->load->view("common/footer") ?>
