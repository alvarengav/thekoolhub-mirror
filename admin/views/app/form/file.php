<?php $uniqid = isset($prefix) && $prefix ? $prefix : uniqid(); ?>
<div class="col-md-<?= isset($columns) ? $columns : '12' ?>" id="file_<?= $uniqid ?>">
<? 
$file = $this->Data->GetFile($id_file); $image = $file ? upload($file->file) : '';
    $dt = [];
 ?>
  <? $st = $uniqid.'name'; $dt[$st] = $file ? $file->name : false; ?>
  <? $st = $uniqid.'file'; $dt[$st] = $file ? $file->file : false; ?>
  <? $st = $uniqid.'type'; $dt[$st] = $file ? $file->type : false;
  
    $item = array(
        'type' => 'filemanager',
        'columns' => 12,
        'form' => $wgetId,
        'name' => $field,
        'error' => $this->validation->error($field),
        'class' => $this->validation->error_class($field),
        'allow-navigation' => isset($gallery['default'][$field]['allow-navigation']) ? $gallery['default'][$field]['allow-navigation'] : false,
        'default-location' => isset($gallery['default'][$field]['folder']) ? $gallery['default'][$field]['folder'] : ( isset($gallery['folder']) ? $gallery['folder'] : 0 ),
        'data' => $dt,
        'prefix' => $uniqid,
        'label' => isset($label) ? $label : $this->lang->line('Imagen'),
        'value' => $id_file,
        'placeholder' => ''
    );
  ?>

  <? $this->load->view('app/form', array('item' => $item)) ?>

    <? /*if(isset($image_position) && is_array($image_position)) : ?>
        <div class="col" style="margin-top: -20px" id="btn_ip_<?= $uniqid ?>">
            <?= btn_image_position([
                'file'=>$image,
                'w'=>$image_position['w'],
                'h'=>$image_position['h'],
                'field'=>$image_position['field'],
                'coords'=>$dataItem[$image_position['field']],
            ]) ?>
        </div>
    <? endif; */?>
  
    <script>
  (function() {
    $(document).ready(function() {
        var item = $('#file_<?= $uniqid ?>');


        <? if(isset( $id_file ) && $id_file): ?>
            $('.file-info .file-ico', item).html('<img src="<?= $image ?>" />');
        <? endif; ?>


        <? if(isset($item['sizeX']) && isset($item['sizeY'])): ?>
        var sizeX = <?= $item['sizeX'] ?>, sizeY = <?= $item['sizeY'] ?>;
        <? else: ?>
        var sizeX = 0, sizeY = 0;
        <? endif ?>
        $('.fileinput-button-edit', item).click(function(){
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
            formData: { folder: '<?= $this->model->mconfig['folder']  ?>', global: <?= $this->model->mconfig['folder-global'] ? "1" : "0" ?>},
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
                    <? if(isset($image_position) && is_array($image_position)) : ?>
                        var BTN = $('#btn_ip_<?= $uniqid ?> .btn-image_position');
                        BTN.attr('data-ip-file',data.result.data['url']);
                    <? endif; ?>
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
    });
  }());
    </script>
</div>