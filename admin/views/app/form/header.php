<?php
$wgetId = uniqid();
$id_header = $id_header ?? 0;
$_dataItem = $this->HeaderM->DataElement($id_header);

?>
<div class="modal fade" id="header_<?= $wgetId ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content widget-app-element">
<!--       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
        <h4 class="modal-title">Configuración de header</h4>
      </div> -->
      <div class="modal-body widget-app-element-form" style="padding:0; margin:15px 40px">
				<div class="smart-form">
      	<form action="">

				<div class="row">
      	<h1 style="font-weight: bold">Personalizar información SEO</h1>
      	<h2 style="margin:0; margin-bottom:10px">Buscadores</h2>

      	<?php if ($id_header === 1): ?>
      		<div class="row">
     	<? $field = 'header[title]';
     	$logo_value = 'general';
     	$select_logo = [
     		'general' => 'General',
     		'luto' => 'Luto',
     	];
     	if(isset($_dataItem['title']))
     	{
     		$title_explode = explode('|||', $_dataItem['title']);
     		if(count($title_explode) == 2)
     		{
   				$_dataItem['title'] = $title_explode[0];
   				$logo_value = $title_explode[1];
     		}
     	}
   		$this->load->view('app/form', array('item' => array(
		    'form' => $wgetId,
		    'name' => $field,
		    'columns' => 6,
		    'label' => $this->lang->line('Título'),
		    'value' => $_dataItem['title'],
		  )));
   		$this->load->view('app/form', array('item' => array(
		    'form' => $wgetId,
		    'name' => 'logo_menu',
		    'type' => 'select',
		    'columns' => 6,
        'data' => $select_logo,
		    'label' => $this->lang->line('Selección de logo'),
		    'value' => $logo_value,
		  )));
		   ?>
		  </div>
      	<?php else: ?>
     	<? $field = 'header[title]'; $this->load->view('app/form', array('item' => array(
		    'form' => $wgetId,
		    'name' => $field,
		    'label' => $this->lang->line('Título'),
		    'value' => $_dataItem['title'],
		  ))) ?>
      	<?php endif ?>
		  <div class="app-hh"></div>
			<div class="row">
		  <div class="col col-6">
		<? $field = 'header[description]'; $this->load->view('app/form', array('item' => array(
		    'type' => 'textarea',
		    'height' => 90,
		    'form' => $wgetId,
		    'name' => $field,
		    'label' => $this->lang->line('Descripción'),
		    'value' => $_dataItem['description'],
		  ))) ?>
<div class="app-hh"></div>
		<? $field = 'header[keywords]'; $this->load->view('app/form', array('item' => array(
		    'form' => $wgetId,
		    'name' => $field,
		    'label' => $this->lang->line('Palabras clave'),
		    'value' =>  $_dataItem['keywords'],
		  ))) ?>
		  </div>

		  <? $field = 'header_id_file'; $this->load->view('app/form', array('item' => array(
		      'type' => 'filemanager',
		      'form' => $wgetId,
		      'columns' => 6,
		      'name' => $field,
		      'label' => 'Imagen principal (Tamaño mínimo recomendado 1200x628)',
		      // 'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
		      // 'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
		      'data' => $_dataItem,
		      'prefix' => 'fm1',
		      'value' =>  $_dataItem['id_file'],
		    ))) ?>

		 </div>
		 </div>

    	<div class="row">
    	<div class="row">
		 	<div class="col col-6">
      	<h2 style="margin:0; margin-bottom:10px">Facebook</h2>

      	<? $field = 'header[facebook_title]'; $this->load->view('app/form', array('item' => array(
      	    'form' => $wgetId,
      	    'name' => $field,
      	    'label' => $this->lang->line('Título'),
      	    'value' =>  $_dataItem['facebook_title'],
      	  ))) ?>
      	  <div class="app-hh"></div>
      	<? $field = 'header[facebook_text]'; $this->load->view('app/form', array('item' => array(
      	    'type' => 'number',
      	    'form' => $wgetId,
      	    'name' => $field,
      	    'type' => 'textarea',
      	    'height' => 90,
      	    'label' => $this->lang->line('Detalle'),
      	    'value' => $_dataItem['facebook_text'],
      	  ))) ?>
		 	</div>
		 	<div class="col col-6">
      	<h2 style="margin:0; margin-bottom:10px">Twitter</h2>

		 		      	<? $field = 'header[twitter_text]'; $this->load->view('app/form', array('item' => array(
		 				    'type' => 'number',
		 				    'form' => $wgetId,
		 				    'name' => $field,
		 				    'type' => 'textarea',
		 				    'height' => 90,
		 				    'label' => $this->lang->line('Tweet'),
		 				    'value' => $_dataItem['twitter_text'],
		 				  ))) ?>
		 	</div>
		</div>
		</div>

		<input type="hidden" name="id_header" value="<?= isset($id_header) ? $id_header : '' ?>">

        <div class="clearfix"></div>
        </form>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Cancelar
        </button>
        <button type="button" class="btn btn-primary btn-save" data-dismiss="modal">
          Guardar
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#header_<?= $wgetId ?>">
  Personalizar Encabezados
</button>


<script>
  (function() {
    $(document).ready(function() {
    	var ITEM = $('#header_<?= $wgetId ?>');
    	var form = $('form', ITEM);

    	$('.btn-save',ITEM).click(function() {
			$.ajax({
				url: '<?= base_url("config/header/save") ?>',
				type: "POST",
				dataType: "text",
				data: ITEM.serializeAny(),
				success:function(text){
				  $('[name="id_header"]',ITEM).val(text);
				}
			});
    	});

    	var formGlobal = ITEM;

		<? $field = 'header_id_file'; $this->load->view('script/filemanager/file.js', array('item' => array(
		'form' => $wgetId,
		'name' => $field
		))) ?>

		(function($){
		$.fn.serializeAny = function() {
		    var ret = [];
		    $.each( $(this).find(':input'), function() {
		        ret.push( encodeURIComponent(this.name) + "=" + encodeURIComponent( $(this).val() ) );
		    });

		    return ret.join("&").replace(/%20/g, "+");
		}
		})(jQuery);

    });
  }());
</script>

<style>
</style>
