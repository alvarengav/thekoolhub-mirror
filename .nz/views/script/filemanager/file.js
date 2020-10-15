(function(){
  var item = $('#<?= $item['name'] ?>Form<?= $item['form'] ?>', formGlobal);
  <? if(isset($item['sizeX']) && isset($item['sizeY'])): ?>
  var sizeX = <?= $item['sizeX'] ?>, sizeY = <?= $item['sizeY'] ?>;
  <? else: ?>
  var sizeX = 0, sizeY = 0;
  <? endif ?>
  $('.fileinput-button-edit', item).remove().click(function(){
    return;
    var w = 1000, h = 600, l = ($(window).width() - w) / 2, t = ($(window).height() - h) / 2;
    var form = '<?= $item['name'] ?>Form<?= $item['form'] ?>';
    var file = '<?= str_replace('/admin/','/', str_replace('\\','/', FCPATH)) ?>files/' + $('.input.input-file', item).attr('data-file');
    window.refreshFileInput = function(form, nfile)
    {
      $.ajax({
        url: '<?= base_url() ?>app/filemanager/update',
        cache: false,
        type: "POST",
        data: { id: $('.input-file-id', $('#' + form)).val(), nfile: nfile },
        dataType: "json"
      }).done(function(json){
        if(json.result)
        {
          $('.input.input-file', item).addClass('file-selected').attr('data-file', json.data.file);
          $('.file-info', item).removeClass('type-' + $('.file-info', item).attr('data-type'));
          $('.file-info', item).addClass('type-'+ json.data.id_type).attr('data-type', json.data.id_type);
          $('.file-info .file-ico img', item).remove();
          if(json.data.id_type == 1 && json.data.thumb)
          {
            $('.file-info .file-ico', item).html('<img src="'+ json.data.thumb +'" />');
            //$('.input.input-file', item).addClass('file-editable');
          }
          $('.file-box', item).attr('target', '_blank');
          $('.file-box', item).attr('href', json.data.url);
          $('.file-name', item).text(json.data.name);
          $('.input-file-id', item).val(json.data.id);
        }
        else
        {
          $('.fileinput-button-delete', item).click();
        }
      });
    }
    var myWindow = window.open("<?= layout() ?>js/phpimageeditor/?form=" + form + "&imagesrc=" + file+ "&sizeX=" + sizeX + "&sizeY=" + sizeY, "_blank ", "width="+w+", height="+h+", top="+t+", left = " + l);
  });
  <? if($this->MApp->secure->edit):?>
  $('.fileinput-button-delete', item).click(function(){
    $('.input.input-file', item).removeClass('file-selected').removeClass('file-editable');
    $('.file-info', item).removeClass('type-' + $('.file-info', item).attr('data-type'));
    $('.file-info .file-ico img', item).remove();
    $('.file-info', item).attr('data-type', 0).addClass('type-0');
    $('.file-box', item).removeAttr('target');
    $('.file-box', item).removeAttr('href');
    $('.file-name', item).text('');
    $('.input-file-id', item).val('');
  });
  item.fileupload({
    url: '<?= base_url() ?>app/filemanager/upload',
    paramName: 'filem',
    dataType: 'json',
    formData: { 
    	folder: '<?= empty($this->model->mconfig['folder']) ? '0' : $this->model->mconfig['folder']  ?>', 
    	global: <?= empty($this->model->mconfig['folder-global']) ? '0' : '1' ?>,
    },
    fileInput: $('.input-file-file', item),
    pasteZone: item,
    dropZone: item,
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('.widget-filemanager-progress', item).css(
          'width',
          progress + '%'
      );
    },
    add: function (e, data) {
      if($('.widget-filemanager-progress-bar', item).hasClass('active')) return;
      $('.widget-filemanager-progress-bar', item).addClass('active');
      data.submit();
    },
    fail: function (e, data) {
      $('.widget-filemanager-progress-bar', item).removeClass('active success');
    },
    done: function (e, data) {
      if(data.result.result)
      {
        $('.input.input-file', item).addClass('file-selected').attr('data-file', data.result.data.file);
        $('.file-info', item).removeClass('type-' + $('.file-info', item).attr('data-type'));
        $('.file-info', item).addClass('type-'+ data.result.data['id_type']).attr('data-type', data.result.data['id_type']);
        $('.file-info .file-ico img', item).remove();
        if(data.result.data['id_type'] == 1 && data.result.data['thumb'])
        {
          $('.file-info .file-ico', item).html('<img src="'+ data.result.data['thumb'] +'" />');
          //$('.input.input-file', item).addClass('file-editable');
        }
        $('.file-box', item).attr('target', '_blank');
        $('.file-box', item).attr('href', data.result.data.url);
        $('.file-name', item).text(data.result.data.name);
        $('.input-file-id', item).val(data.result.data.id);
      }
      else
      {
        $('.fileinput-button-delete', item).click();
      }
      $('.widget-filemanager-progress-bar', item).addClass('success');
      setTimeout(function () {
        $('.widget-filemanager-progress-bar', item).removeClass('active');
      }, 1000);
      setTimeout(function () {
        $('.widget-filemanager-progress-bar', item).removeClass('success');
        $('.widget-filemanager-progress', item).css('width', 0);
      }, 2000);
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
  <? endif ?> 
})();
