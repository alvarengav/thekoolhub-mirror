<div class="app-tabs" data-tab="<?= $tabSelect ?>" data-active="<?= isset($tabActive) ? $tabActive : ""  ?>">
	<?php foreach ($tabItems as $kk => $ii): ?>
		<span data-id="<?= $kk ?>" class="app-tab-span-<?= $kk ?>"><?= $ii ?></span>
	<?php endforeach ?>        		
</div>