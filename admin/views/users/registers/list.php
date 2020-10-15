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
        <a class="btn btn-success pull-right" download="Registros" target="_blank" style="margin-right:10px" href="<?= base_url() . "{$appController}/export_registers" ?>"><?= $this->lang->line("Descargar CSV") ?></a>
      </div>
      <? endif ?>
    </div>
    <div class="clear-sm"></div>
    <section>
      <div class="jarviswidget well-white">
      <fieldset>
        <!-- <legend>Estadísticas</legend> -->
        <div class="row">
          <div class="col-md-3 text-center" style="padding-top: 20px">
            <h4><i class="fa fa-uses"></i> <b><?= $this->model->RegistersStats() ?></b> peticiones totales.</h4>
          </div>
            <div class="col-md-3 text-center" style="padding-top: 20px">
              <h4><i class="fa fa-uses"></i> <b><?= $this->model->RegistersStats('avisar') ?></b> peticiones de Avisar.</h4>
            </div>
            <div class="col-md-3 text-center" style="padding-top: 20px">
                <h4><i class="fa fa-uses"></i> <b><?= $this->model->RegistersStats('informar') ?></b> peticiones de Informar.</h4>
            </div>
            <div class="col-md-3 text-center" style="padding-top: 20px">
              <h4><i class="fa fa-uses"></i> <b><?= $this->model->RegistersStats('countries') ?></b> países con peticiones de Geniux.</h4>
            </div>
            <div class="clearfix"></div>
          </div>
          </fieldset>
      </div>
      <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-no-head" data-widget-editbutton="false">
        <div class="widget-datatable">
          <? $this->load->view("app/datatable/columns") ?>
          <? $this->load->view("{$appController}/{$appFunction}/list-filters") ?>
          <div class="widget-body no-padding">
            <table width="100%" id="datatable<?= $wgetId ?>" class="table table-striped table-hover">
              <thead></thead>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<? $this->load->view("script/datatable/includes") ?>
<? $this->load->view("{$appController}/{$appFunction}/list-script") ?>
<? $this->load->view("common/footer") ?>