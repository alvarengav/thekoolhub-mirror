<? if (!AJAX) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
  <form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . ($idItem ? "{$appController}/{$appFunction}/element/{$idItem}" . ($quickOpen ? "/quick" : "") : "{$appController}/{$appFunction}/element/new") ?>" role="form">
    <input type="hidden" value="0" name="goback" class="form-post-goback" />
    <div class="row page-title-row">
      <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
        <h1 class="page-title txt-color-blueDark"><?= (strpos($appTitleIco, "material-icons") === FALSE) ? "<i class='page-title-ico {$appTitleIco}'></i>" : $appTitleIco ?> <?= prep_app_title($appTitle) ?></h1>
      </div>
      <? $this->load->view("app/element/buttons-header", array('alt' => true)) ?>
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
      </div>
      <div class="clear-sm"></div>
      <div class="well-white smart-form">
        <fieldset>
          <div class="row">
            <? $field = 'title';
            $this->load->view('app/form', array('item' => array(
              'columns' => 9,
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('Titulo'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>
                    <? $field = 'date';
            $this->load->view('app/form/datetime', array('item' => array(
              'columns' => 3,
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('Fecha (Orden de lista)'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>
            <? /*$field = 'title2';
            $this->load->view('app/form', array('item' => array(
              'columns' => 12,
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('Subtitulo'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            )) */ ?>
            <? $field = 'subtitle';
            $this->load->view('app/form', array('item' => array(
              'type' => 'textarea',
              'height' => 120,
              'columns' => 12,
              'form' => $wgetId,
              'name' => $field,
              'label' => $this->lang->line('Descripción'),
              'value' => $dataItem[$field],
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'placeholder' => ''
            ))) ?>

            <? $field = 'id_file';
            $this->load->view('app/form', array('item' => array(
              'type' => 'filemanager',
              'columns' => 3,
              'form' => $wgetId,
              'name' => $field,
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
              'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : (isset($gallery['folder']) ? $gallery['folder'] : 0),
              'data' => $dataItem,
              'prefix' => 'fm1',
              'label' => $this->lang->line('Imagen Miniatura'),
              'value' => $dataItem[$field],
              'placeholder' => ''
            ))) ?>


            <? $field = 'id_interior_file';
            $this->load->view('app/form', array('item' => array(
              'type' => 'filemanager',
              'columns' => 3,
              'form' => $wgetId,
              'name' => $field,
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
              'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : (isset($gallery['folder']) ? $gallery['folder'] : 0),
              'data' => $dataItem,
              'prefix' => 'fm1',
              'label' => $this->lang->line('Imagen Portada'),
              'value' => $dataItem[$field],
              'placeholder' => ''
            ))) ?>

            <? 
            // $authors = [0=>'Sin Autor'];
            // $authors = array_merge($authors, $this->Data->SelectAuthor());
            $authors =  $this->Data->SelectAuthor();
            $authors[0] = 'Sin Autor';

            $author = ksort( $authors );

            // var_dump( );
            $field = 'id_author';
            $this->load->view('app/form/select2', array('item' => array(
              'columns' => 4,
              'type' => 'select',
              'form' => $wgetId,
              'name' => $field,
              'error' => $this->validation->error($field),
              'class' => $this->validation->error_class($field),
              'data' => $authors,
              'prefix' => 'fm1',
              'label' => $this->lang->line('Autor'),
              'value' => $dataItem[$field],
              'placeholder' => ''
            ))) ?>

            <div class="row">
              <div class=" col col-md-9">
                <? $field = 'texto';
                $this->load->view('app/form/ckeditor', array('item' => array(
                  'type' => 'textarea',
                  'height' => 500,
                  'full' => 1,
                  'columns' => 12,
                  'form' => $wgetId,
                  'name' => $field,
                  'label' => $this->lang->line('Texto'),
                  'value' => $dataItem[$field],
                  'error' => $this->validation->error($field),
                  'class' => $this->validation->error_class($field),
                  'placeholder' => ''
                ))) ?>
              </div>
              <div class="col col-md-3">
                <?
                $field = 'categories';
                $label = '';

                $this->load->view('app/form/multiCustomLine', array('item' => [
                  'label' => $label,
                  'elements' => [
                    [
                      'field' => 'category',
                      'label' => 'Categorías',
                      'type' => 'text',
                      'width' => 100,
                      'type' => 'select',
                      'data'=> $this->Data->SelectBlogCategory()
                    ],
                  ],
                  'columns' => 12,
                  'form' => $wgetId,
                  'name' => $field,
                  'placeholder' => ''
                ]));

                $field = 'related';
                $label = '';


                $this->load->view('app/form/multiCustomLine', array('item' => [
                  'label' => $label,
                  'elements' => [
                    [
                      'field' => 'related',
                      'label' => 'Relacionados',
                      'type' => 'text',
                      'width' => 100,
                      'type' => 'select',
                      'data'=> $this->Data->SelectBlog()
                    ],
                  ],
                  'columns' => 12,
                  'form' => $wgetId,
                  'name' => $field,
                  'placeholder' => ''
                ])) ?>
              </div>
            </div>

          </div>
        </fieldset>
        <div class="clear-sm"></div>
      </div>
      <? $this->load->view("app/element/buttons-footer") ?>
    </section>

    <? if($dataItem['id_blog']): ?>
    <iframe style="height: 0px; visiblity:hidden" src="<?= $this->config->config['base_sys'].'/'.$lang.'/blog/'.$dataItem['id_blog']; ?>" frameborder="0"></iframe>
    <? endif ?>
  </form>
</div>
<? $this->load->view("script/filemanager/includes") ?>
<? $this->load->view("script/ckeditor/includes") ?>
<script>
  $(document).ready(function() {
    var formGlobal = $('#widget-form-<?= $wgetId ?>');

    <? $this->load->view("common/ckeditor/config") ?>;


    <? if (!$this->MApp->secure->edit) : ?>
      formGlobal.addClass('form-disabled');
      formGlobal.submit(function(e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
      });
    <? else : ?>
      <? if ($idItem && !$quickOpen) : ?>
        App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>');
      <? endif ?>
      formGlobal.validate({
        submitHandler: function(form) {
          // for (instance in CKEDITOR.instances)
          // {
          //   if(CKEDITOR.instances[instance])
          //   {
          //     CKEDITOR.instances[instance].updateElement();
          //   }
          // }
          App.postForm(form);
        },
        rules: {
          /*'id_blog': 'required',
          'title': 'required',
          'texto': 'required',
          'share_twitter': 'required',
          'share_facebook': 'required',
          'share_instagram': 'required' */
        },
        messages: {}
      });

      $('.btn.save-action', formGlobal).click(function() {
        $('.form-post-goback', formGlobal).val('0');
        formGlobal.submit();
      });
      $('.btn.save-action-close', formGlobal).click(function() {
        $('.form-post-goback', formGlobal).val('1');
        formGlobal.submit();
      });
    <? endif ?>
    <? if ($quickOpen) : ?>
      $('.action-close', formGlobal).click(function(e) {
        e.preventDefault();
        window.close();
        return false;
      });
    <? endif ?>
    <? $field = 'id_file';
    $this->load->view('script/filemanager/file.js', array('item' => array(
      'form' => $wgetId,
      'name' => $field
    ))) ?>

<? $field = 'id_interior_file';
    $this->load->view('script/filemanager/file.js', array('item' => array(
      'form' => $wgetId,
      'name' => $field
    ))) ?>

  });
</script>



<? $this->load->view("common/footer") ?>