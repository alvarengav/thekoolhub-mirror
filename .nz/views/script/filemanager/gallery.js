<?
if(!isset($item['sortable'])) $item['sortable'] = true;
?>(function(){
  var item = $('#<?= $item['name'] ?>Form<?= $item['form'] ?>', formGlobal);
  <? if(isset($item['sizeX']) && isset($item['sizeY'])): ?>
  var sizeX = <?= $item['sizeX'] ?>, sizeY = <?= $item['sizeY'] ?>;
  <? else: ?>
  var sizeX = 0, sizeY = 0;
  <? endif ?>
  var refreshIds = function(){
    var ids = [];
    $.each($('.widget-gallery-items .gallery-item', item), function(index,el){
      el = $(el);
      if(el.hasClass('delete') || el.hasClass('uploading') || el.hasClass('placeholder') || el.hasClass('error')) return;
      ids.push(el.attr('data-id'));
    });
    $('.input-gallery-items',item).val(ids.join(','));
    $('.widget-gallery-items', item).sortable("refresh");
  };
  $('.fileinput-button-delete', item).click(function(){
    $('.widget-gallery-items .gallery-item', item).addClass('delete');
    refreshIds();
    setTimeout(function () {
      $('.widget-gallery-items .gallery-item', item).remove();
    }, 1000);
  });

  $('.widget-gallery-items .gallery-item .button-delete', item).click(function(){
    var parent = $(this).parents('.gallery-item');
    parent.addClass('delete');
    refreshIds();
    setTimeout(function () {
      parent.remove();
    }, 1000);
  });
  $('.widget-gallery-items').css('user-select','none');
  $('.widget-gallery-items .gallery-item .button-adjunt', item).click(function(){
    var parent = $(this).parents('.gallery-item');
    parent.addClass('delete');
    refreshIds();
    setTimeout(function () {
      parent.remove();
    }, 1000);
  });

  <? if ( ! empty($item['ckeditor_integrate'])): ?>
    $('.widget-gallery-items .gallery-item .button-edit', item).each(function(index, el) {
      var id_item = $(el).parent().parent().attr('data-id');
      var langs = <?= json_encode($this->model->langs); ?>;
      var nameItem = '<?= $item['ckeditor_integrate'] ?>';

      $(el).removeClass('btn-success').addClass('btn-warning');
      var btn_sync_ckeditor = $('<button type="button" class="btn btn-success button-insert button-adjunt"\
       data-toggle="tooltip" data-container="body" data-delay="300" data-placement="bottom" data-title="<?= $this->lang->line('Insertar en editor') ?>"><i class="fa fa-hand-o-up"></i></button>')
      .click(function(){
        <? if (isset($item['ckeditor_lang']) && $item['ckeditor_lang']): ?>
        var item = false;
        $.each(langs, function(index, val) {
          var nm = nameItem.replace('{lang}', val);
          if($('#' + nm).parents('.elem-lang').is(':visible'))
          {
            item = nm;
          }
        });
        if(!item) return;
        var EDITOR = CKEDITOR.instances[item];
        <? else: ?>
        var EDITOR = CKEDITOR.instances[nameItem];
        <? endif ?>        
        var itx = $('.link', $(this).parent().parent());
        if(itx.find('.file-info').hasClass('type-1'))
        {
        	EDITOR.insertHtml('<img src="'+itx.attr('href')+'" class="inserted-image left">');
        }
        else
        {
        	EDITOR.insertHtml('<a target="_blank" href="'+itx.attr('href')+'">'+itx.attr('href')+'</a>');
        }
      });
      $(el).before(btn_sync_ckeditor);
      btn_sync_ckeditor.tooltip();

      <? if (!empty($item['ckeditor_integrate2'])): ?>

      var nameItem2 = '<?= $item['ckeditor_integrate2'] ?>';
      var btn_sync_ckeditor2 = $('<button type="button" class="btn btn-warning button-insert button-adjunt-second"\
           data-toggle="tooltip" data-container="body" data-delay="300" data-placement="bottom" data-title="<?= $this->lang->line('Insertar en editor') ?>"><i class="fa fa-hand-o-right"></i></button>')
          .click(function(){
            <? if (isset($item['ckeditor_lang']) && $item['ckeditor_lang']): ?>
            var item = false;
            $.each(langs, function(index, val) {
              var nm = nameItem2.replace('{lang}', val);
              if($('#' + nm).parents('.elem-lang').is(':visible'))
              {
                item = nm;
              }
            });
            if(!item) return;
            var EDITOR = CKEDITOR.instances[item];
            <? else: ?>
            var EDITOR = CKEDITOR.instances[nameItem2];
            <? endif ?>
            var itx = $('.link',$(this).parent().parent());
            if(itx.find('.file-info').hasClass('type-1'))
            {
            	EDITOR.insertHtml('<img src="'+itx.attr('href')+'" class="inserted-image left">');
            }
            else
            {
            	EDITOR.insertHtml('<a target="_blank" href="'+itx.attr('href')+'">'+itx.attr('href')+'</a>');
            }
          })
        btn_sync_ckeditor2.css('margin-left', '5px');
        btn_sync_ckeditor.css('zoom', '.9');
        btn_sync_ckeditor2.css('zoom', '.9');
        $(el).before(btn_sync_ckeditor2);
        btn_sync_ckeditor2.tooltip();
       <? endif ?>

      $(el).hide();

    });
  <? endif ?>
  <? if($this->MApp->secure->edit):?>
  $('.widget-gallery-items .gallery-item .button-edit', item).remove().click(function(){
    return;
      window.refreshFileInputG = function(form, nfile, id)
      {
        var frm = $('#' + form), elem = false;
        $('.gallery-item', frm).each(function(index, el) {
          if($(el).attr('data-id') == id)
          {
            elem = $(el);
          }
        });
        if(!elem) return;
        $.ajax({
          url: '<?= base_url() ?>app/filemanager/update',
          cache: false,
          type: "POST",
          data: { id: id, nfile: nfile },
          dataType: "json"
        }).done(function(json){
          if(json.result)
          {
            $(elem).attr('data-id', json.data.id).attr('data-file', json.data.file);
            $('.file-info .file-ico img', elem).remove();
            if(json.data.id_type == 1 && json.data.thumb)
            {
              $('.file-info .file-ico', elem).html('<img src="'+ json.data.thumb +'" />');
            }
            $('.file-box', elem).attr('target', '_blank');
            if(max_size)
            {
              $('.file-box', elem).attr('href', json.data.url_max_size);
            }
            else
            {
              $('.file-box', elem).attr('href', json.data.url);
            }
            $('.file-name', elem).text(json.data.name);
          }
          else
          {
            $('.button-delete', elem).click();
          }
          refreshIds();
        });
      }
    var parent = $(this).parents('.gallery-item');
    var w = 1000, h = 600, l = ($(window).width() - w) / 2, t = ($(window).height() - h) / 2;
    var form = '<?= $item['name'] ?>Form<?= $item['form'] ?>';
    var file = '<?= str_replace('/admin/','/', str_replace('\\','/', FCPATH)) ?>files/' + parent.attr('data-file');
    var myWindow = window.open("<?= layout() ?>js/phpimageeditor/?form=" + form + "&idf="+ parent.attr('data-id') + "&imagesrc=" + file+ "&sizeX=" + sizeX + "&sizeY=" + sizeY, "_blank ", "width="+w+", height="+h+", top="+t+", left = " + l);
  });
  $('.widget-gallery-items', item).sortable({
    disabled: <?= $item['sortable'] ? "false" : "true" ?>,
    stop: function( event, ui ){
      refreshIds();
    },
    placeholder: "gallery-item placeholder"
  });
  var max_size = <?= empty($item['max_size']) ? '0' : $item['max_size'] ?>;
  item.fileupload({
    url: '<?= base_url() ?>app/gallery/upload',
    paramName: 'filem',
    dataType: 'json',
    formData: { 
    	max_size: max_size, 
    	folder: '<?= empty($this->model->mconfig['folder']) ? '0' : $this->model->mconfig['folder']  ?>', 
    	global: <?= empty($this->model->mconfig['folder-global']) ? '0' : '1' ?>,
    },
    pasteZone: $('.gallery-input-inside', item),
    dropZone: $('.gallery-input-inside', item),

    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('.widget-filemanager-progress', item).css(
          'width',
          progress + '%'
      );
    },
    processfail: function (e, data) {
      $(data.context).addClass('delete');
      refreshIds();
      setTimeout(function () {
        $(data.context).remove();
      }, 1000);
    },
    done: function (e, data) {
      if(data.result.result == 1)
      {
        <? if (!empty($item['ckeditor_integrate'])): ?>

        var langs = <?= json_encode($this->model->langs); ?>;
        var nameItem = '<?= $item['ckeditor_integrate'] ?>';

        $('<button type="button" class="btn btn-success button-insert button-delete"\
         data-toggle="tooltip" data-container="body" data-delay="300" data-placement="top" title="<?= $this->lang->line('Insertar en editor') ?>"><i class="fa fa-hand-o-up"></i></button>')
        .appendTo($('.gallery-item-actions', data.context)).click(function(){
            <? if (isset($item['ckeditor_lang']) && $item['ckeditor_lang']): ?>
            var item = false;
            $.each(langs, function(index, val) {
              var nm = nameItem.replace('{lang}', val);
              if($('#' + nm).parents('.elem-lang').is(':visible'))
              {
                item = nm;
              }
            });
            if(!item) return;
            var EDITOR = CKEDITOR.instances[item];
            <? else: ?>
            var EDITOR = CKEDITOR.instances[nameItem];
            <? endif ?>
            var itx = $('.link', $(this).parent().parent());
            if(itx.find('.file-info').hasClass('type-1'))
            {
            	EDITOR.insertHtml('<img src="'+itx.attr('href')+'" class="inserted-image left">');
            }
            else
            {
            	EDITOR.insertHtml('<a target="_blank" href="'+itx.attr('href')+'">'+itx.attr('href')+'</a>');
            }
          }).tooltip();

        <? if ( !empty($item['ckeditor_integrate2'])): ?>
        $('<button type="button" class="btn btn-success button-insert button-delete"\
         data-toggle="tooltip" data-container="body" data-delay="300" data-placement="top" title="<?= $this->lang->line('Insertar en editor') ?>"><i class="fa fa-hand-o-up"></i></button>')
          .appendTo($('.gallery-item-actions', data.context)).click(function(){
            <? if (isset($item['ckeditor_lang']) && $item['ckeditor_lang']): ?>
            var item = false;
            $.each(langs, function(index, val) {
              var nm = nameItem.replace('{lang}', val);
              if($('#' + nm).parents('.elem-lang').is(':visible'))
              {
                item = nm;
              }
            });
            if(!item) return;
            var EDITOR = CKEDITOR.instances[item];
            <? else: ?>
            var EDITOR = CKEDITOR.instances[nameItem];
            <? endif ?>
            var itx = $('.link', $(this).parent().parent());
            if(itx.find('.file-info').hasClass('type-1'))
            {
            	EDITOR.insertHtml('<img src="'+itx.attr('href')+'" class="inserted-image left">');
            }
            else
            {
            	EDITOR.insertHtml('<a target="_blank" href="'+itx.attr('href')+'">'+itx.attr('href')+'</a>');
            }
          }).tooltip();

        <? endif ?>

        <? endif ?>

        $(data.context).addClass('ctype-' + data.result.data['id_type']);
        $(data.context).removeClass('uploading').attr('data-id', data.result.data.id).attr('data-file', data.result.data.file);
        var url = (max_size) ? data.result.data.url_max_size : data.result.data.url;
        $('.file-box', data.context).attr('href', url).attr('target','_blank').addClass('link');
        $('.file-info', data.context).removeClass('type-0').addClass('type-' + data.result.data['id_type']);
        /*$('<button type="button" class="btn btn-warning button-edit"><i class="glyphicon glyphicon-edit"></i></button>').appendTo($('.gallery-item-actions', data.context)).click(function(){
            var parent = $(this).parents('.gallery-item');
            var w = 1000, h = 600, l = ($(window).width() - w) / 2, t = ($(window).height() - h) / 2;
            var form = '<?= $item['name'] ?>Form<?= $item['form'] ?>';
            var file = '<?= str_replace('/admin/','/', str_replace('\\','/', FCPATH)) ?>files/' + parent.attr('data-file');
            var myWindow = window.open("<?= layout() ?>js/phpimageeditor/?form=" + form + "&idf="+ parent.attr('data-id') +"&imagesrc=" + file, "_blank ", "width="+w+", height="+h+", top="+t+", left = " + l);
        });*/
        $('<button type="button" class="btn btn-danger button-delete"><i class="glyphicon glyphicon-trash"></i></button>').appendTo($('.gallery-item-actions', data.context)).click(function(){
          $(data.context).addClass('delete');
          refreshIds();
          setTimeout(function () {
            $(data.context).remove();
          }, 1000);
        });
        return refreshIds();
      }
      $(data.context).addClass('delete');
      refreshIds();
      setTimeout(function () {
        $(data.context).remove();
      }, 1000);
    }
  })
  .on('fileuploadstop', function (e, data) {
    $('.widget-filemanager-progress-bar', item).addClass('success');
    setTimeout(function () {
      $('.widget-filemanager-progress-bar', item).removeClass('active');
    }, 1000);
    setTimeout(function () {
      $('.widget-filemanager-progress-bar', item).removeClass('success');
      $('.widget-filemanager-progress', item).css('width', 0);
    }, 2000);
  })
  .on('fileuploadadd', function (e, data) {
    data.context = $('<div class="gallery-item uploading"/>').appendTo($('.widget-gallery-items', item));
    $('.widget-filemanager-progress-bar', item).addClass('active');
    $.each(data.files, function (index, file) {
      var node = $('<a class="file-box"/>')
      .append($('<div class="file-info"><div class="file-ico"></div></div>'))
      .append($('<span class="file-name"/>').text(file.name));
      node.appendTo(data.context);
      $('<div class="gallery-item-actions"/>').appendTo(data.context);
    });
  })
  .on('fileuploadprocessalways', function (e, data) {
      var index = data.index, file = data.files[index], node = $(data.context.children()[index]);
      if (file.preview)
      {
        $('.file-ico', node).prepend(file.preview);
      }
      else
      {
        $('.file-info', node).addClass('type-0');
      }
      if (file.error)
      {
        $(data.context).addClass('delete');
        refreshIds();
        setTimeout(function () {
          $(data.context).remove();
        }, 1000);
      }
  });

  item.bind('dragover', function (e) {
    if($('.widget-filemanager-progress-bar', item).hasClass('active')) return;
    timeout = item.dropZoneTimeout;
    if (!timeout) {
        item.addClass('dragover');
    } else {
        clearTimeout(timeout);
    }
    var found = false, node = e.target;
    do {
        if (node === item[0]) {
            found = true;
            break;
        }
        node = node.parentNode;
    } while (node != null);
    if (found) {
        item.addClass('dragover');
    } else {
        item.removeClass('dragover');
    }
    item.dropZoneTimeout = setTimeout(function () {
        item.dropZoneTimeout = null;
        item.removeClass('dragover');
    }, 100);
    item.addClass('dragover');
  });
  <?php endif ?>
})();
