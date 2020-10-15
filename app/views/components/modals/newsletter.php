<div class="modal modal-picture-text" data-backdrop="static"  id="modal_newsletter" tabindex="-1" <? //= rmodify(array(array('<lg', 'append', 'main'), array('<lg', 'removeClass', 'visible'))) ?>>
	<div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
		<div class="modal-content">

			<div class="modal-body">
				<form action="<?= base_url('ajax_subscribe') ?>" method="post" class="ajaxForm">
					<div class="row">
						<div class="col-md-6 img-cover" style="background-image:url('<?= thumb($config->id_file_newslettr->file,380,420) ?>')">

						</div>
						<div class="col-xs-12 col-md-6 text-col">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close" data-add-class=>
								<span aria-hidden="true"></span>
							</button>

							<div class="remove_in_sub">
								<p class="title"><?= $this->lang->line('Newsletter') ?></p>
							<p class="text">
								<?= $this->lang->line('¡Suscribete a nuestro boletín de ofertas!') ?>
							</p>
								<div class="form-group">
									<input type="email" class="form-control" name="mail" placeholder="Email">
								</div>
								<div class="form-group">
									<button class="btn btn-black">Enviar</button>
								</div>

								<div class="checkboxcontent">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="customCheck1"  id="customCheck1">
										<label class="custom-control-label" for="customCheck1"><?= $this->lang->line('He leido, comprendo y acepto los') ?> <a href="#modal_terms" data-toggle="modal" data-target="#modal_terms"><?= $this->lang->line('términos y condiciones') ?></a>.</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="customCheck2" id="customCheck2">
										<label class="custom-control-label" for="customCheck2"><?= $this->lang->line('He leido, comprendo y acepto los') ?> <a href="#modal_legal" data-toggle="modal" data-target="#modal_legal"><?= $this->lang->line('política de privacidad') ?></a>.</label>
									</div>
								</div>

							</div>
							</div>

					</div>
					<div class="clearfix"></div>
					</form>
			</div>
		</div>
	</div>
</div>
<script>

	<? if( !$this->session->userdata('show_newsletter') ): $this->session->set_userdata('show_newsletter', '1'); ?>
		$(document).ready(function() {
			$('#modal_newsletter').modal();
		});
	<? endif; ?>

	ajaxFormCallback['success-subscribe'] = function() {
		$('.remove_in_sub').height( $('.remove_in_sub').height() ).css({
			'display': 'flex',
    		'align-items': 'center'
		});
		
		$('.remove_in_sub').html('<h2><?= $config->mail_newsletter ?></h2>');
	}
</script>