<? if( !AJAX ) $this->load->view("common/header") ?>
<div id="main">
	<div class="widget-app-table-list">
		<div class="row page-title-row">
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<h1 class="page-title txt-color-blueDark"><?= (strpos($appTitleIco, "material-icons") === FALSE) ? "<i class='page-title-ico {$appTitleIco}'></i>" : $appTitleIco ?> <?= prep_app_title($appTitle) ?></h1>
			</div>
			<? if($this->MApp->secure->edit && $this->model->mconfig['new-element']):?>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-right button-right">
					<a class="btn btn-primary pull-right app-loader" href="<?= base_url() . "{$appController}/{$appFunction}" ?>/new"><?= $this->lang->line("Agregar nuevo") ?></a>
				</div>
			<? endif ?>
		</div>
		<div class="clear-sm"></div>
		<section>
			<div id="appTable-<?= $wgetId ?>" class="widget-app-table jarviswidget">
				<div class="widget-datatable">
				<? 
					$this->load->view("app/datatable/columns");
					$custom_view = "{$appFview}list-filters";
					if ($this->load->view_exists($custom_view))
					{
						$this->load->view($custom_view);
					}
					$this->load->view("app/datatable/table");
				?>
				</div>
			</div>
		</section>
	</div>
</div>
<?
$script_view = "{$appFview}list-script";
$custom_view = $this->ABM->getView("list-script");
if ($custom_view && $this->load->view_exists($custom_view))
{
	$this->load->view($custom_view);
}
elseif($this->load->view_exists($script_view))
{
	$this->load->view($script_view);
}

$this->load->view("common/footer");