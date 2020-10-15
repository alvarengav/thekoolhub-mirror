<?

$field = array(
  'class' => '',
  'class-element' => '',
  'form' => '',
  'lang' => false,
  'disabled' => false,
  'readonly' => false,
  'global' => false,
  'checked' => false,
  'data' => array(),
  'name' => '',
  'error' => '',
  'label' => '',
  'type' => 'text',
  'value' => '',
  'placeholder' => '',
  'style-input' => '',
  'columns' => 0,
  'maxlength' => 0
);

if(isset($item))
foreach($item as $key => $value)
  $field[$key] = $value;
$labelC = "";
$disabled = "";
$nameR = $field['name'];
$lang = $field['lang'];
if($field['lang'])
{
  $field['name'] = $field['name'] . '_' . $lang;
  if($field['data'] && isset($field['data'][$nameR . '_lang']))
  {
    $dataField = json_decode($field['data'][$nameR . '_lang']);
    if( isset($dataField->$lang) )
    {
      if($dataField->$lang !== false)
        $field['value'] = $dataField->$lang;
    }
  }
  if(isset($field['data'][$nameR]) && !$field['value'] && $this->model->flang == $lang)
  {
    if($field['data'][$nameR] !== false && $field['data'][$nameR] != '0')
      $field['value'] = $field['data'][$nameR];
  }
}
if($field['disabled'])
{
  $disabled = " disabled='disabled'";
  $labelC = " disabled";
}
$readonly = "";
if($field['readonly'])
{
  $readonly = " readonly='readonly'";
  $labelC = " disabled";
}
$styleInput = "";
if($field['style-input'])
  $styleInput = " style='{$field['style-input']}'";
?><div <? if($field['type'] == 'filemanager' || $field['type'] == 'gallery'): ?>id="<?= $field['name'] ?>Form<?= $field['form'] ?>" <? else: ?>id="element-<?= $field['name'] ?>Form<?= $field['form'] ?>" <? endif ?>class="element <?= round($field['columns']) ? "col col-{$field['columns']}" : $field['columns'] ?> <?= $field['class-element'] ?><?= ($field['type'] == 'filemanager') ? " widget-filemanager widget-filemanager-input" : "" ?><?= ($field['type'] == 'gallery') ? " widget-filemanager widget-gallery-input" : "" ?><?= $field['lang'] ? " elem-lang elem-lang-" . $field['lang']  : "" ?>">
  <?

  if( $field['type'] == 'select' ):?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <span class="input select <?= $field['class'] ?>">
    <?= form_dropdown(
      $field['name'],
      $field['data'],
      $field['value'],
      "id='{$field['name']}Form{$field['form']}'{$disabled}{$readonly}{$styleInput} class='form-control form-post-{$field['name']}'"
    );?>
    <i></i>
  </span>
  <?

  elseif($field['type'] == 'checkbox'): ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class='checkbox'>
  	<?php if ( ! empty($field['checkbox-hidden'])): ?>
		<input type="hidden" name="<?= $field['name'] ?>" class="form-control form-post-<?= $field['name'] ?>">
  	<?php endif ?>
    <input id="<?= $field['name'] ?>Form<?= $field['form'] ?>" value="<?= htmlentities($field['value']) ?>" name="<?= $field['name'] ?>" class="form-control form-post-<?= $field['name'] ?>" type="<?= $field['type'] ?>"<?= $field['checked'] ? " checked='checked'" : '' ?><?= $disabled ?><?= $styleInput ?> />
    <i></i>
    <?= $field['label'] ?>
  </label>
  <?

  elseif($field['type'] == 'textarea'): $height = 160;
  if(isset($field['height'])) $height = $field['height'];
  ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <span class="textarea <?= $field['class'] ?>">
    <textarea id="<?= $field['name'] ?>Form<?= $field['form'] ?>" style="height:<?= $height ?>px" name="<?= $field['name'] ?>" class="form-control form-post-<?= $field['name'] ?>" <?= $field['placeholder'] ? " placeholder='{$field['placeholder']}'" : '' ?><?= round($field['maxlength']) ? " maxlength=\"{$field['maxlength']}\"" : "" ?><?= $disabled ?><?= $styleInput ?>><?= $field['value'] ?></textarea>
  </span>
  <?

  elseif($field['type'] == 'filemanager'):
  $type = 0;
  $name = '';
  $file = '';
  if($field['value'])
  {
    $file = $field['data'][$field['prefix'] . 'file'];
    $name = $field['data'][$field['prefix'] . 'name'];
    $type = $field['data'][$field['prefix'] . 'type'];
  }
  ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <a class="file-box<?= $field['value']? " link" : "" ?>"<?= $field['value'] ? ' href="'.upload($file, $field['global']).'"' : '' ?>target="_blank"><div data-type="<?= $type ?>" class="file-info type-<?= $type ?>"><div class="file-ico"><? if($field['value'] && $type == 1): ?><img src="<?= thumb_url($field['value'], $field['global']) ?>" /><? endif ?></div></div><span class="file-name"><?= $name ?></span></a>
  <div data-file="<?= $file ?>" class="input input-file<?= $field['value'] ? " file-selected" . (($type == 1) ? " file-editable" : "") : "" ?>">
    <input type="hidden" class="input-file-id" name="<?= $field['name'] ?>" value="<?= htmlentities($field['value']) ?>" />
    <? if($this->MApp->secure->edit && !$field['disabled'] && !$field['readonly']): ?>
    <span class="btn btn-primary fileinput-button-upload"><input type="file" class="input-file-file" /><i class="glyphicon glyphicon-upload"></i> <?= $this->lang->line("Examinar") ?></span>
    <button type="button" class="btn btn-danger fileinput-button-delete"><i class="glyphicon glyphicon-trash"></i><span><?= $this->lang->line("Quitar") ?></span></button>
    <button type="button" class="btn btn-success fileinput-button-edit"><i class="glyphicon glyphicon-edit"></i><span><?= $this->lang->line("Editar") ?></span></button>
    <div class="widget-filemanager-progress-bar"><div class="widget-filemanager-progress"></div></div>
    <? endif ?>
  </div>
  <?

  elseif($field['type'] == 'gallery'):
  $items = array();
  if($field['value'])
    $items = $this->MApp->GalleryItems($field['value']);
  $ids = array();
  foreach($items as $i) $ids[] = $i->id;
  ?>
  <div class="gallery-input-inside">
    <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
    <div class="input input-gallery<?= $field['value'] ? "" : " gallery-empty" ?>">
      <input type="hidden" class="input-gallery-id" name="<?= $field['name'] ?>" value="<?= htmlentities($field['value']) ?>" />
      <input type="hidden" class="input-gallery-items" name="<?= $field['name'] ?>-items" value="<?= implode(',',$ids) ?>" />
      <? if($this->MApp->secure->edit && !$field['disabled'] && !$field['readonly']): ?>
      <span class="btn btn-primary fileinput-button-upload"><input multiple type="file" class="input-file-file" /><i class="glyphicon glyphicon-plus"></i> <?= $this->lang->line("Agregar") ?></span>
      <button type="button" class="btn btn-danger fileinput-button-delete"><i class="glyphicon glyphicon-remove"></i><span><?= $this->lang->line("Vaciar") ?></span></button>
      <div class="widget-filemanager-progress-bar"><div class="widget-filemanager-progress"></div></div>
      <? endif ?>
    </div>
    <div class="widget-gallery-items">
    <? foreach($items as $i): ?><div data-file="<?= $i->file ?>" data-id="<?= $i->id ?>" class="gallery-item ctype-<?= $i->type ?>"><a class="file-box link" href="<?= upload($i->file, $field['global']); ?>" target="_blank"><div class="file-info type-<?= $i->type ?>"><div class="file-ico"><? if($i->type == 1): ?><img src="<?= thumb_url($i->id, $field['global']) ?>" /><? endif ?></div></div><span class="file-name"><?= $i->name ?></span></a><div class="gallery-item-actions">
    <? if($this->MApp->secure->edit && !$field['disabled'] && !$field['readonly']): ?>
    <button type="button" class="btn btn-success button-edit"><i class="glyphicon glyphicon-edit"></i></button>
    <button type="button" class="btn btn-danger button-delete"><i class="glyphicon glyphicon-trash"></i></button>
    <? endif ?>
    </div></div>
    <? endforeach ?>
    </div>
  </div>
  <?

  elseif($field['type'] == 'date'): ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <span class="input input-calendar <?= $field['class'] ?>">
    <span class="input-group">
      <input id="<?= $field['name'] ?>Form<?= $field['form'] ?>" value="<?= htmlentities($field['value']) ?>" name="<?= $field['name'] ?>" class="form-control form-calendar form-post-<?= $field['name'] ?>" readonly="true" type="text"<?= $field['placeholder'] ? " placeholder='{$field['placeholder']}'" : '' ?><?= round($field['maxlength']) ? " maxlength=\"{$field['maxlength']}\"" : "" ?><?= $disabled ?><?= $styleInput ?> />
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </span>
  </span>
  <?

  elseif($field['type'] == 'timepicker'): ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <span class="input input-timepicker <?= $field['class'] ?>">
    <span class="input-group">
      <input id="<?= $field['name'] ?>Form<?= $field['form'] ?>" value="<?= htmlentities($field['value']) ?>" name="<?= $field['name'] ?>" class="form-control form-timepicker form-post-<?= $field['name'] ?>" readonly="true" type="text"<?= $field['placeholder'] ? " placeholder='{$field['placeholder']}'" : '' ?><?= round($field['maxlength']) ? " maxlength=\"{$field['maxlength']}\"" : "" ?><?= $disabled ?><?= $styleInput ?> />
      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
    </span>
  </span>
  <?

  elseif($field['type'] == 'color'): ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <span class="input <?= $field['class'] ?>">
    <input id="<?= $field['name'] ?>Form<?= $field['form'] ?>" value="<?= htmlentities($field['value']) ?>"<?= $disabled ?><?= $readonly ?> name="<?= $field['name'] ?>" class="form-control form-post-<?= $field['name'] ?>" type="<?= $field['type'] ?>"<?= $field['placeholder'] ? " placeholder='{$field['placeholder']}'" : '' ?><?= round($field['maxlength']) ? " maxlength=\"{$field['maxlength']}\"" : "" ?><?= $disabled ?><?= $styleInput ?> />
    <input class="form-post-color-value" maxlength="10" value="<?= mb_strtoupper(htmlentities($field['value']), 'UTF-8') ?>" />
  </span>
  <? else: ?>
  <label for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="label<?= $labelC ?>"><?= $field['label'] ?></label>
  <span class="input <?= $field['class'] ?>">
    <input id="<?= $field['name'] ?>Form<?= $field['form'] ?>" value="<?= htmlentities($field['value']) ?>"<?= $disabled ?><?= $readonly ?> name="<?= $field['name'] ?>" class="form-control form-post-<?= $field['name'] ?>" type="<?= $field['type'] ?>"<?= $field['placeholder'] ? " placeholder='{$field['placeholder']}'" : '' ?><?= round($field['maxlength']) ? " maxlength=\"{$field['maxlength']}\"" : "" ?><?= $disabled ?><?= $styleInput ?> />
  </span>
  <? endif ?>
  <? if($field['error']): ?>
  <em for="<?= $field['name'] ?>Form<?= $field['form'] ?>" class="invalid"><?= $field['error'] ?></em>
  <? endif ?>
</div>
