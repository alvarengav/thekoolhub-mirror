<div class="app-langs">
	<?php foreach ($this->model->langs as $l): ?>
		<span data-id="<?= $l ?>" class="lang-<?= $l ?>"><?= $l ?></span>
	<?php endforeach ?>        		
</div>