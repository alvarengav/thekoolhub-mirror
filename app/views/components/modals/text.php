<div class="modal modal-picture-text" data-backdrop="static"  id="<?= $id ?>" tabindex="-1" <? //= rmodify(array(array('<lg', 'append', 'main'), array('<lg', 'removeClass', 'visible'))) ?>>
	<div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<p class="title"><?= $title ?></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" data-add-class=>
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body">

				<p class="text">
					<?= $text ?>
				</p>
				<div class="clearfix"></div>

			</div>
		</div>
	</div>
</div>
