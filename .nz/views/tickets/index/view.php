<? if( !AJAX ) $this->load->view("common/header") ?>
<div class="widget-app-element" id="main">
<form class="widget-app-element-form" id="widget-form-<?= $wgetId ?>" method="post" action="<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>" role="form">
  <input type="hidden" value="add-note" name="action" />
  <div class="row page-title-row">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
      <h1 class="page-title txt-color-blueDark"><i class="page-title-ico <?= $appTitleIco ?>"></i> <?= prep_app_title($appTitle) ?></h1>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 ?> pull-right text-right button-right">          
      <div class="btn-group">      
        <? if($dataItem['id_state'] < 7 && ($this->MApp->user->type == 1 || $this->MApp->user->atype == 1 )): ?>
        <a class="btn btn-success action-resolve">
          <?= $this->lang->line("Marcar como resuelta") ?>
        </a>
        <? endif ?> 
        <? if($dataItem['id_state'] == 7 && ($dataItem['id_reporter'] == $this->MApp->user->id || $this->MApp->user->type < 3)): ?>
        <a class="btn btn-success action-confirm">
          <?= $this->lang->line("Confirmar resolución") ?>
        </a>
        <a class="btn btn-danger action-cancel">
          <?= $this->lang->line("No se resolvió") ?>
        </a>
        <? endif ?> 
        <? if($dataItem['id_state'] == 8 && ($dataItem['id_reporter'] == $this->MApp->user->id || $this->MApp->user->type < 3)): ?>
        <a class="btn btn-primary action-reopen">
          <?= $this->lang->line("Reabrir") ?>
        </a>
        <? endif ?>
        <? if($dataItem['id_state'] < 7 || ($this->MApp->user->type == 1 || $this->MApp->user->atype == 1 )): ?>
        <a href="<?= base_url() . "{$appController}/{$appFunction}/element/{$idItem}" ?>" class="btn btn-primary app-loader">
          <?= $this->lang->line("Modificar datos") ?>
        </a>
        <? endif ?>
        <a href="<?= $backUrl ?>" class="btn btn-default action-close app-loader">
          <?= $this->lang->line($traceBack ? "Volver" : "Cerrar") ?>
        </a>
      </div>
    </div>
  </div>
  <section class="widget-form-content">
    <div class="clear-sm"></div>
    <div class="widget-ticket-view widget-ticket-global well-white smart-form">
      <table cellspacing="0">
        <tbody>  
          <tr>
            <td class="td-label" style="width:160px"><?= $this->lang->line("ID") ?></td>
            <td class="td-label"><?= $this->lang->line("Categoría") ?></td>
            <? if($dataItem['id_project']): ?>
            <td class="td-label"><?= $this->lang->line("Proyecto") ?></td>
            <? endif ?>
            <td class="td-label td-center"><?= $this->lang->line("Reproducibilidad") ?></td>
            <td class="td-label td-center"><?= $this->lang->line("Severidad") ?></td>
            <td class="td-label td-center"><?= $this->lang->line("Prioridad") ?></td>  
          </tr>        
          <tr class="row-1">
            <td style="width:160px"><?= str_pad($this->abm->idItem, 5, "0", STR_PAD_LEFT) ?></td>
            <td><?= $this->lang->line($dataItem['category']) ?></td>
            <? if($dataItem['id_project']): ?>
            <td><?= "<a class='app-loader' href='" . base_url() ."manager/projects/element/{$dataItem['id_project']}/back?backuri=".current_url()."'>" . $dataItem['project'] . "</a>" ?></td>
            <? endif ?>
            <td class="td-center"><?= $this->lang->line($dataItem['reproducibility']) ?></td>
            <td class="td-center"><?= $this->lang->line($dataItem['severity']) ?></td>
            <td class="td-center"><?= $this->lang->line($dataItem['priority']) ?></td>
          </tr> 
        </tbody>
      </table>    
      <table style="margin:10px 0" cellspacing="0">
        <tbody>     
          <tr class="row-2">
            <td width="160px" class="td-label"><?= $this->lang->line("Estado") ?></td><td class="td-state-<?= $dataItem['id_state'] ?>"><?= $this->lang->line($dataItem['state']) ?></td>
            <td width="16%" class="td-label"><?= $this->lang->line("Fecha de envío") ?></td><td width="16%"><?= mysql_to_calendartime($dataItem['creation']) ?></td>
            <td width="16%" class="td-label"><?= $this->lang->line("Última actualización") ?></td><td width="16%"><?= mysql_to_calendartime($dataItem['modification']) ?></td>
          </tr>
          <tr class="row-2">
            <td width="160px" class="td-label"><?= $this->lang->line("Resolución") ?></td><td><?= $this->lang->line($dataItem['resolution']) ?></td>
            <td width="16%" class="td-label"><?= $this->lang->line("Informador") ?></td><td width="16%"><?= $dataItem['reporter'] ?></td>
            <td width="16%" class="td-label"><?= $this->lang->line("Asignada a") ?></td><td width="16%"><?= $dataItem['assigned'] ?></td>
          </tr>
        </tbody>
      </table>    
      <table cellspacing="0">
        <tbody>   
          <tr class="row-1"><td width="160px" class="td-label"><?= $this->lang->line("Resumen") ?></td><td><?= str_pad($this->abm->idItem, 5, "0", STR_PAD_LEFT) ?>: <?= mb_ucfirst($dataItem['title']) ?></td></tr>
          <? if($dataItem['details']): ?>
          <tr class="row-2"><td width="160px" class="td-label td-break-word"><?= $this->lang->line("Descripción") ?></td><td><?= nl2br($dataItem['details']) ?></td></tr>
          <? endif ?>
          <? if($dataItem['steps_to_reproduce']): ?>
          <tr class="row-2"><td width="160px" class="td-label td-break-word"><?= $this->lang->line("Pasos para reproducir") ?></td><td><?= nl2br($dataItem['steps_to_reproduce']) ?></td></tr>
          <? endif ?>
          <? if($dataItem['additional_info']): ?>
          <tr class="row-2"><td width="160px" class="td-label td-break-word"><?= $this->lang->line("Información Adicional") ?></td><td><?= nl2br($dataItem['additional_info']) ?></td></tr>
          <? endif ?>
          <tr class="row-1">
            <td width="160px" class="td-label"><?= $this->lang->line("Archivos Adjuntos") ?></td>
            <td colspan="5">
          <? $field = 'id_gallery'; $this->load->view('app/form', array('item' => array(
            'type' => 'gallery',
            'form' => $wgetId,
            'name' => $field,
            'disabled' => ($dataItem['id_state'] == 8),
            'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
            'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
            'data' => $dataItem,
            'prefix' => 'fmg1',    
            'global' => true,
            'label' => $this->lang->line('Archivos'),
            'value' => $dataItem[$field],
            'placeholder' => ''
          ))) ?>
            </td>
          </tr>
        </tbody>
      </table>
      <? if(count($notesList)): ?>
      <div class="widget-ticket-notes-container">      
        <div class="widget-title"><?= $this->lang->line("Notas") ?></div>
        <table cellspacing="0" class="widget-ticket-notes">
          <tbody>   
            <? foreach($notesList as $n): ?>
            <tr id="note-<?= $n->id ?>" class="row-1">
              <td width="160px" class="td-label td-visibility-<?= $n->id_visibility ?>">
                <p class="note-id"><a href="<?= base_url() ?>tickets/index/view/<?= $idItem ?>#note-<?= $n->id ?>"><?= str_pad($this->abm->idItem, 5, "0", STR_PAD_LEFT) ?>-<?= str_pad($n->id, 5, "0", STR_PAD_LEFT) ?></a><? if($dataItem['id_state'] < 8 ): ?><? if( $this->MApp->user->id  == $n->id_user || $this->MApp->user->type == 1 || $this->MApp->user->atype == 1 ):
                ?><a data-id="<?= $n->id ?>" data-visibility="<?= $n->id_visibility ?>" title="<?= $this->lang->line("Eliminar nota") ?>" class="tooltip-nz-app ttactive btn btn-xs btn-default delete-button<?= $this->MApp->secure->delete ? "" : " disabled" ?>" type="button"><i class="fa fa-actions fa-trash-o"></i></a><? endif ?><? endif ?></p>
                <p class="note-user"><?= $n->user ?></p>
                <p class="note-user-company"><?= $n->company ?></p>
                <p class="note-date"><?= mysql_to_calendartime($n->date) ?></p>
                <p class="note-visibility"><?= $this->lang->line("Visiblidad") ?>: <?= $this->lang->line($n->visibility) ?></p>
              </td>
              <td><?= nl2br($n->note) ?></td>
            </tr>
            <? endforeach ?>
         </tbody>
        </table>  
      </div>      
      <? endif ?>
      <? if($dataItem['id_state'] < 8 ): ?>
      <div class="widget-title"><?= $this->lang->line("Agregar nota") ?></div>
      <table cellspacing="0" class="widget-ticket-add-new-note">
        <tbody>   
          <tr>
            <td width="160px" class="td-label"><?= $this->lang->line("Nota") ?></td>
            <td>
            <? $this->load->view('app/form', array('item' => array(
                'type' => 'textarea',
                'columns' => '',
                'form' => $wgetId,
                'name' => 'note',
                'label' => '',
                'class' => 'post-form-npte',
                'placeholder' => ''
              ))) ?>            
            </td>
          </tr>
          <tr>
            <td style="vertical-align:middle" width="160px" class="td-label"><?= $this->lang->line("Visiblidad") ?></td>
            <td>
              <? $this->load->view('app/form', array('item' => array(
                  'type' => 'select',
                  'columns' => '',
                  'form' => $wgetId,
                  'disabled' => $this->MApp->user->atype != 1,
                  'name' => 'id_visibility',
                  'data' => $this->DataG->SelectTicketVisibility(''),
                  'label' => '',
                  'class' => 'post-form-visibility',
                  'value' => 1,
                  'placeholder' => ''
                ))) ?>         
            </td>
          </tr>
          <tr>
            <td style="vertical-align:middle" width="160px" class=""></td>
            <td style="text-right:center"><button type="button" class="button-add-note btn btn-primary"><?= $this->lang->line("Agregar") ?></button></td>
          </tr>
       </tbody>
      </table>
      <? endif ?>
      <? if(count($historic)): ?>    
      <div class="widget-title"><?= $this->lang->line("Historial de la incidencia") ?></div>
      <table cellspacing="0" class="widget-ticket-historic">
        <tbody>  
          <tr>
            <td style="width:150px" class="td-label"><?= $this->lang->line("Fecha") ?></td>
            <td class="td-label"><?= $this->lang->line("Nombre de usuario") ?></td>
            <td class="td-label"><?= $this->lang->line("Acción") ?></td>
            <td style="min-width:150px" class="td-label"><?= $this->lang->line("Detalle") ?></td>
          </tr>          
          <? foreach($historic as $h): ?>
          <tr class="td-row">
            <td><?= mysql_to_calendartime($h->date) ?></td>
            <td><?= $h->user ?> <span class="user-company"><?= $h->company ?></span></td>
            <td><?= $h->action ?></td>
            <td class="historic-details"><?= str_replace(' => ',' <i class="fa fa-arrow-right"></i> ',$h->details) ?></td>
          </tr>
          <? endforeach ?>
       </tbody>
      </table>   
      <? endif ?> 
    </div>  
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
  App.changeURI('<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>');
  $('.button-add-note', formGlobal).click(function(e){
    formGlobal.submit();
  });
  formGlobal.validate({ 
    rules : {
      'note': 'required'
    },
    messages : {
    }
  });
<? endif ?>  
<? if(isset($noteScroll) && $noteScroll != 'quick'): ?>
  if($("#note-<?= $noteScroll ?>"))
    $('html, body').scrollTop(parseInt($("#note-<?= $noteScroll ?>").offset().top));
<? endif ?>  
<? if($quickOpen): ?>
  $('.action-close', formGlobal).click(function(e){
    e.preventDefault();
    window.close();
    return false;
  });
<? endif ?>
  <? $field = 'id_gallery'; $this->load->view('script/filemanager/gallery.js', array('item' => array(
    'sortable' => false,
    'form' => $wgetId,
    'name' => $field
  ))) ?> 
  $('.action-resolve', formGlobal).click(function(){
    $.ajax({
      url: '<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>',
      type: "POST",
      data: {
        'action': 'resolve-ticket'
      },
      dataType: "json"
    }).always(function() {
      App.loadURL('<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>', true);
    });
  });
  $('.action-confirm', formGlobal).click(function(){
    $.ajax({
      url: '<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>',
      type: "POST",
      data: {
        'action': 'confirm-ticket'
      },
      dataType: "json"
    }).always(function() {
      App.loadURL('<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>', true);
    });
  });
  $('.action-reopen', formGlobal).click(function(){
    $.ajax({
      url: '<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>',
      type: "POST",
      data: {
        'action': 'reopen-ticket'
      },
      dataType: "json"
    }).always(function() {
      App.loadURL('<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>', true);
    });
  });
  $('.action-cancel', formGlobal).click(function(){
    $.ajax({
      url: '<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>',
      type: "POST",
      data: {
        'action': 'cancel-ticket'
      },
      dataType: "json"
    }).always(function() {
      App.loadURL('<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>', true);
    });
  });
  
  $('.delete-button', formGlobal).click(function(){
    var ths = $(this);
    $.SmartMessageBox({
      sound:false,
      title : "<?= $this->lang->line('Eliminar nota') ?>",
      content : "<?= $this->lang->line('¿Estás seguro qué deseas eliminar esta nota?') ?>",
      buttons : '[<?= $this->lang->line('No') ?>][<?= $this->lang->line('Si') ?>]'
    }, function(ButtonPressed) {
      if(ButtonPressed == "<?= $this->lang->line('Si') ?>") 
      {
        $.ajax({
          url: '<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>',
          type: "POST",
          data: {
            'action': 'remove-note',
            'note': ths.attr('data-id'),
            'visibility': ths.attr('data-visibility')
          },
          dataType: "json"
        });
        ths.parents('tr').remove();
        App.clearGarbage();
        var cc = $('.widget-ticket-notes-container', formGlobal);
        if(!$('table tr',cc).length) cc.remove();
      }
    });   
    $("#MsgBoxBack .MessageBoxMiddle").addClass('MessageBoxMiddleLogout');
    $($("#MsgBoxBack .MessageBoxButtonSection button")[1]).addClass('btn-danger');    
  });
  
  var itemG = $('#id_galleryForm<?= $wgetId ?>', formGlobal);  
  /*$('.fileinput-button-delete', itemG).click(function(){
    $('.widget-gallery-items .gallery-item', itemG).addClass('delete');
    refreshIds();
    setTimeout(function () {
      $('.widget-gallery-items .gallery-item', itemG).remove();
    }, 1000);
  });*/
  itemG.on('fileuploaddone', function (e, data) {
    if(data.result.result == 1)
    {
      $.ajax({
        url: '<?= base_url() . "{$appController}/{$appFunction}/view/{$idItem}" ?>',
        type: "POST",
        data: {
          'action': 'file-add',
          'filename': data.result.data.name,
          'file': data.result.data.id
        },
        dataType: "json"
      });      
      $(data.context).removeClass('uploading').attr('data-id', data.result.data.id);
      $('.file-box', data.context).attr('href', data.result.data.url).attr('target','_blank').addClass('link');
      $('.file-info', data.context).removeClass('type-0').addClass('type-' + data.result.data['id_type']);
      $('<button type="button" class="btn btn-danger button-delete"><i class="glyphicon glyphicon-trash"></i></button>').appendTo($('.gallery-item-actions', data.context)).click(function(){
        $(data.context).addClass('delete');
        refreshIds();
        setTimeout(function () {
          $(data.context).remove();
        }, 1000);
      });
      return;
    }
    $(data.context).addClass('delete');
    setTimeout(function () {
      $(data.context).remove();
    }, 1000);
  });
});
</script>
<?php $this->load->view("common/footer") ?>
