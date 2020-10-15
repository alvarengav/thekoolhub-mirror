<? $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<?= $this->Form->CreateForm(array('no-change-uri' => true, 'no-lang' => true, 'no-hidden-back' => true)) ?>
<?= $this->Form->AddElement('page-title') ?>
	<section class="widget-form-content">
		<?= $this->Form->AddElement('row-state') ?>
		<div class="well-white smart-form">
			<fieldset class="app-form-items">
				<?= $this->Form->AddElement('lang') ?>
				<div class="row">

				</div>
			</fieldset>
		<div class="app-cb"></div></fieldset></div>
		<?= $this->Form->AddElement('buttons-footer') ?>
	</section>
</form>
</div>
<script>
$(document).ready(function() {
	var formGlobal = $('#widget-form-<?= $wgetId ?>').appFormOld();
<? if(!$this->MApp->secure->edit):?>
	formGlobal.addClass('form-disabled');
	formGlobal.submit(function(e){
		e.preventDefault();
		e.stopPropagation();
		return false;
	});
<? else: ?>
	<? if($idItem && !$quickOpen): ?>
	App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
	<? endif ?>
	formGlobal.validate({
		rules : {
			'id_category': 'required',
			'sub': 'required',
			'num': 'required'
		},
		messages : {
		}
	});

	$('.btn.save-action',formGlobal).click(function(){
		$('.form-post-goback', formGlobal).val('0');
		formGlobal.submit();
	});
	$('.btn.save-action-close', formGlobal).click(function(){
		$('.form-post-goback', formGlobal).val('1');
		formGlobal.submit();
	});
	<? endif ?>
	<? if($quickOpen): ?>
	$('.action-close', formGlobal).click(function(e){
		e.preventDefault();
		window.close();
		return false;
	});
	<? endif ?>
});
</script>
<? $this->load->view("common/footer");
