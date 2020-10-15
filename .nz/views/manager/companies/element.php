<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
  <input type="hidden" value="0" name="goback" class="form-post-goback" />
  <div class="row page-title-row">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico <?= $appTitleIco ?>"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
  </div>
  <section class="widget-form-content">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="onoffswitch-container">
          <span class="onoffswitch-title"><?= $this->lang->line("Estado") ?></span> 
          <span class="onoffswitch">
            <input name="active" value="1" type="checkbox" <? if($dataItem['active'] == 1 || (!$idItem && !$this->input->post())): ?>checked="checked"<? endif ?> class="onoffswitch-checkbox" id="activeForm<?= $wgetId ?>">
            <label class="onoffswitch-label" for="activeForm<?= $wgetId ?>"> 
              <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
              <span class="onoffswitch-switch"></span>
            </label> 
          </span>
        </div>
      </div>
      <? $this->load->view("app/element/buttons-header") ?>   
    </div>
    <div class="clear-sm"></div>
    <div class="well-white smart-form">
      <fieldset>
        <div style="margin:0 -8px" class="row">
<div class="col col-inset col-9 ">
<? $field = 'id_type'; unset($select['SelectCompanyType']['']); $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $select['SelectCompanyType'],
    'label' => $this->lang->line('Tipo de empresa'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  <? $field = 'id_client'; $this->load->view('app/form', array('item' => array(
    'type' => 'select',
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'data' => $this->DataG->SelectClient('', $this->lang->line('Sin cliente asignado')),
    'label' => $this->lang->line('Cliente'),
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
<? $field = 'company'; $this->load->view('app/form', array('item' => array(
    'columns' => 4,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Empresa'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
<? $field = 'obs'; $this->load->view('app/form', array('item' => array(
    'type' => 'textarea',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('Observaciones'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
</div>
<div class="col col-inset col-3">
  
<? $field = 'mail'; $this->load->view('app/form', array('item' => array(
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'label' => $this->lang->line('E-Mail'),
    'value' => $dataItem[$field],
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'placeholder' => ''
  ))) ?>
  
<? $field = 'id_file'; $this->load->view('app/form', array('item' => array(
    'type' => 'filemanager',
    'columns' => 12,
    'form' => $wgetId,
    'name' => $field,
    'global' => true,
    'error' => $this->validation->error($field),
    'class' => $this->validation->error_class($field),
    'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
    'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
    'data' => $dataItem,
    'prefix' => 'fm1',
    'label' => $this->lang->line('Logo'),
    'value' => $dataItem[$field],
    'placeholder' => ''
  ))) ?>
  
</div>
      </div>
      <div class="row">
        <section class="col col-12 widget-project-companies">
          <div class="widget-title"><?= $this->lang->line('Relaciones') ?></div>
          <div class="companies-list">
            <? $companies = $this->model->Relations($idItem);
            $items = "";
            foreach($companies as $c): 
            $checked = $c->relation;
            if(!$idItem && !$checked && $c->type == 1)
              $checked = true;
            ?>
            <div class="companies-item">
              <label class="checkbox">
                <input name="relations[<?= $c->idcompany ?>]" <?= $checked ? "checked='checked' " : "" ?>type="checkbox" />
                <i></i> <?= $c->company ?>
              </label>
            </div>
            <? endforeach ?>
          </div>
        </section>
      </div>
      </fieldset>
      <? $this->load->view("{$appController}/{$appFunction}/secure") ?>
      <div class="clear-sm"></div>
    </div>
    <? $this->load->view("app/element/buttons-footer") ?>   
  </section>     
</form>
</div>

<script>
$(document).ready(function() {
  var formGlobal = $('#widget-form-<?= $wgetId ?>');  
<? if(!$this->MApp->secure->edit):?>
  formGlobal.addClass('form-disabled');
  formGlobal.submit(function(e){
    e.preventDefault();
    e.stopPropagation();
    return false;
  });
<? else: ?>

  <? if($idItem): ?>
  App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
  <? endif ?>
  $('#id_typeForm<?= $wgetId ?>').change(function(){
    var $this = $(this);
    if($this.val() == 1)
      $('#id_clientForm<?= $wgetId ?>').val('').prop('disabled', true);
    else
      $('#id_clientForm<?= $wgetId ?>').prop('disabled', false);
  }).change();
  formGlobal.validate({ 
    rules : {
      'id_client': {
        required : function(){
          return ($('#id_typeForm<?= $wgetId ?>').val() > 1);
        }
      },
      'company': 'required',
      'mail': {
        email : true,
        required : true
      }
    },
    messages : {
    }
  });  
  $('#TableSecure tbody tr.row-menu').each(function(index, item){
    $('.col-global input', item).click(function(){
      $('#TableSecure tbody tr.row-menu-' + $(item).attr('data-id') + ' input').prop('checked', $(this).prop('checked'));      
    });
    $('.col-type input', item).click(function(){
      $('#TableSecure tbody tr.row-menu-' + $(item).attr('data-id') + ' .col-type-' + $(this).attr('data-type') + ' input').prop('checked', $(this).prop('checked'));      
    });
  });
  $('#TableSecure tbody tr.row-submenu').each(function(index, item){
    $('.col-global-item input', item).click(function(){
      $('.col-type input', item).prop('checked', $(this).prop('checked'));
    });
  });
  $('.btn.save-action',formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('0');
    formGlobal.submit();
  });
  $('.btn.save-action-close', formGlobal).click(function(){
    $('.form-post-goback', formGlobal).val('1');
    formGlobal.submit();
  });
  <? $field = 'id_file'; $this->load->view('script/filemanager/file.js', array('item' => array(
    'form' => $wgetId,
    'name' => $field
  ))) ?>
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
<? $this->load->view("common/footer") ?>