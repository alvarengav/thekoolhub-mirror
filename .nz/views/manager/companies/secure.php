<fieldset class="inset">
  <div class="row">
    <div class="col-md-12">
      <legend><?= $this->lang->line("Permisos") ?></legend>
    </div>
  </div>
</fieldset>
<fieldset class="inset">
  <div class="row">
    <table id="TableSecure" class="table table-striped table-contoured table-hover widget-table-secure">
      <thead>
        <tr>
          <th><?= $this->lang->line("Módulos") ?></th>
          <th class="text-align-center"><?= $this->lang->line("Puede ver") ?></th>
          <th class="text-align-center"><?= $this->lang->line("Puede crear/editar") ?></th>
          <th class="text-align-center"><?= $this->lang->line("Puede borrar") ?></th>
          <th class="text-align-center"><?= $this->lang->line("Acciones especiales") ?></th>
        </tr>
      </thead>
      <tbody>
        <? 
        $menu = $this->MApp->GetAppMenu();
        $basic = array(9, 10, 11);
        foreach($menu as $m): 
          $globalFChk = false;
          $globalChk = true;
          $viewChk = true;
          $editChk = true;
          $deleteChk = true;
          $specialChk = true;
          $secureList = $this->model->Secure($idItem, $m->id);
          foreach($secureList as $i):
            if(!($i->view && $i->edit && $i->delete && $i->special)) $globalChk = false;
            if($i->view || $i->edit || $i->delete || $i->special) $globalFChk = true;
            if(!$i->view) $viewChk = false;
            if(!$i->edit) $editChk = false;
            if(!$i->delete) $deleteChk = false;
            if(!$i->special) $specialChk = false;
          endforeach;
          if($globalFChk || $this->MApp->secure->edit):
        ?><tr data-id="<?= $m->id ?>" class="row-menu row-menu-<?= $m->id ?>">
          <td class="smart-form col-global" style="height:36px">
            <? if($this->MApp->secure->edit) :?>
            <label class="checkbox">
              <input <?= $globalChk ? "checked='checked' " : "" ?>type="checkbox">
              <i></i> <span class="lbx"><?= $this->lang->line($m->name) ?></span>
            </label>
            <? else: ?>
            <span style="margin-left:5px"><?= $this->lang->line($m->name) ?></span>
            <? endif ?>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox<?= $this->MApp->secure->edit ? "" : " hide" ?>">
              <input <?= $viewChk ? "checked='checked' " : "" ?>data-type="view" type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox<?= $this->MApp->secure->edit ? "" : " hide" ?>">
              <input <?= $editChk ? "checked='checked' " : "" ?>data-type="edit" type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox<?= $this->MApp->secure->edit ? "" : " hide" ?>">
              <input <?= $deleteChk ? "checked='checked' " : "" ?>data-type="delete" type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox<?= $this->MApp->secure->edit ? "" : " hide" ?>">
              <input <?= $specialChk ? "checked='checked' " : "" ?>data-type="special" type="checkbox">
              <i></i>
            </label>
          </td>
        </tr>
        <? foreach($secureList as $i): 
        if(!$idItem && in_array($i->id, $basic))
        {
          $i->view = $i->edit = $i->delete = $i->special = true;
        }
        if($this->MApp->secure->edit || $i->view || $i->edit || $i->delete || $i->special):
        ?>
        <tr class="row-submenu row-menu-<?= $m->id ?>">
          <td class="smart-form col-global col-global-item">
            <? if($this->MApp->secure->edit) :?>
            <label class="checkbox">
              <input <?= ($i->view && $i->edit && $i->delete && $i->special) ? " checked='checked'" : "" ?>type="checkbox">
              <i></i> <span class="lbx"><?= $this->lang->line($i->submenu) ?></span>
            </label>            
            <? else: ?>
            <span style="margin-left:20px"><?= $this->lang->line($i->submenu) ?></span>
            <? endif ?>
          </td>
          <td class="smart-form col-type text-align-center col-type-view">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][view]"<?= $i->view ? " checked='checked'" : "" ?> type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-edit">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][edit]"<?= $i->edit ? " checked='checked'" : "" ?> type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-delete">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][delete]"<?= $i->delete ? " checked='checked'" : "" ?> type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-special">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][special]"<?= $i->special ? " checked='checked'" : "" ?> type="checkbox">
              <i></i>
            </label>
          </td>
        </tr>
        <? endif ?>
        <? endforeach ?>
        <? endif ?>
        <? endforeach ?>
      </tbody>
    </table>
  </div>
</fieldset>
