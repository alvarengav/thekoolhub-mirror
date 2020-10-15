<div class="jarviswidget-editbox widget-datatable-filters">
  <fieldset class="smart-form">
    <div class="row"><? $cols = 0; $i = 0; foreach ($fields as $field) : ?>
<? if($cols>=12) : $cols = 0 ?>
    </div>
    <div class="row">
<? endif ?>
<? if( substr($field->name,0,3) == 'id_' && ($field->type == 'tinyint' || $field->type == 'smallint' || $field->type == 'mediumint' || $field->type == 'int' || $field->type == 'bigint' ) ) : if( substr($field->name,0,7) != 'id_file' && substr($field->name,0,10) != 'id_gallery' ): $cols+= 2; ?>
<? if($cols>=12) : $cols = 2 ?>
    </div>
    <div class="row">
<? endif ?>
    
      <section class="col-filter col col-2">
        <label for="<?= $field->name ?>FormSelect<a?= $wgetId ?a>" class="label"><a?= $this->lang->line('<?= $field->label ?>') ?a></label>
        <label class="select">
          <a?= form_dropdown('', $select['<?= TableToModel(set_value('lj'.$i)) ?>'], '', "id='<?= $field->name ?>FormSelect{$wgetId}'") ?a>
          <i></i>
        </label>
      </section><? endif; $i++; elseif($field->type == 'boolean' || $field->type == 'bit' || ($field->type == 'tinyint' && $field->max_length == 1 && substr($field->name,0,3) != 'id_') ) : $cols+= 1.5;?>

<? if($cols>=12) : $cols = 1.5 ?>
    </div>
    <div class="row">
<? endif ?>
      <section class="col-filter col col-1-5">
        <label for="<?= $field->name ?>FormChk<a?= $wgetId ?a>" class="checkbox">
          <input id='<?= $field->name ?>FormChk<a?= $wgetId ?a>' value='1' type='checkbox' class='post' name='<?= $field->name ?>' />
          <i></i>
          <a?= $this->lang->line('Solo <?= rtrim(mb_strtolower($field->label, 'UTF-8'),'s') . 's'; ?>') ?a>
        </label>
      </section><? endif ?><? endforeach ?>
    <? $cols += 4; if($cols>=12) : $cols = 4 ?>
    </div>
    <div class="row">
<? endif ?>
      <section class="col col-4">
        <label class="label"><a?= $this->lang->line("Contenido") ?a></label>
        <label class="input">
          <input type="text" id="textFormInput<a?= $wgetId ?a>" placeholder="<a?= $this->lang->line("Escriba una palabra") ?a>">
        </label>
      </section>
<? $cols += 2; if($cols>=12) : $cols = 2 ?>
    </div>
    <div class="row">
<? endif ?>
      <section class="col col-2">
        <button type="button" id="button-datatable-search<a?= $wgetId ?a>" class="btn btn-primary pull-left element-no-label">
          <a?= $this->lang->line("Buscar") ?a>
        </button>
      </section>
    </div>
  </fieldset>
</div>