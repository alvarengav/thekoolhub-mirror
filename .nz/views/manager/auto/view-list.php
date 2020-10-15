<?php
$title_ico = '<a?= (strpos($appTitleIco, "material-icons") === FALSE) ? "<i class=\'page-title-ico {$appTitleIco}\'></i>" : $appTitleIco ?a>';
?><a? if( !AJAX ) $this->load->view("common/header") ?a>
<div id="main">
  <div class="widget-app-table-list">
    <div class="row page-title-row">
      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
        <h1 class="page-title txt-color-blueDark"><?= $title_ico ?> <a?= prep_app_title($appTitle) ?a></h1>
      </div>
      <a? if($this->MApp->secure->edit && $this->model->mconfig['new-element']):?a>
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-right button-right">
        <a class="btn btn-primary pull-right app-loader" href="<a?= base_url() . "{$appController}/{$appFunction}" ?a>/new"><a?= $this->lang->line("Agregar nuevo") ?a></a>
      </div>
      <a? endif ?a>
    </div>
    <div class="clear-sm"></div>
    <section>
      <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-no-head" data-widget-editbutton="false">
        <div class="widget-datatable">
          <a? $this->load->view("app/datatable/columns") ?a>
          <a? $this->load->view("{$appController}/{$appFunction}/list-filters") ?a>
          <div class="widget-body no-padding">
            <table width="100%" id="datatable<a?= $wgetId ?a>" class="table table-striped table-hover">
              <thead></thead>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<a? $this->load->view("script/datatable/includes") ?a>
<a? $this->load->view("{$appController}/{$appFunction}/list-script") ?a>
<a? $this->load->view("common/footer") ?a>