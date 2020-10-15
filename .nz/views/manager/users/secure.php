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
        foreach($menu as $m): 
          $globalItemChk = false;
          $globalChk = true;
          $viewChk = true;
          $editChk = true;
          $deleteChk = true;
          $specialChk = true;
          $secureList = $this->model->Secure($idItem, $dataItem['id_company'], $m->id);
          foreach($secureList as $i):
            if($i->aview || $i->aedit || $i->adelete || $i->aspecial)
              $globalItemChk = true;
            else
              continue;            
            if(!($i->view && $i->edit && $i->delete && $i->special)) $globalChk = false;
            if(!$i->view) $viewChk = false;
            if(!$i->edit) $editChk = false;
            if(!$i->delete) $deleteChk = false;
            if(!$i->special) $specialChk = false;
          endforeach;
          if($globalItemChk):
        ?><tr data-id="<?= $m->id ?>" class="row-menu row-menu-<?= $m->id ?>">
          <td class="smart-form col-global">
            <label class="checkbox">
              <input <?= $globalChk ? "checked='checked' " : "" ?>type="checkbox">
              <i></i> <span class="lbx"><?= $this->lang->line($m->name) ?></span>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox">
              <input <?= $viewChk ? "checked='checked' " : "" ?>data-type="view" type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox">
              <input <?= $editChk ? "checked='checked' " : "" ?>data-type="edit" type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox">
              <input <?= $deleteChk ? "checked='checked' " : "" ?>data-type="delete" type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center">
            <label class="checkbox">
              <input <?= $specialChk ? "checked='checked' " : "" ?>data-type="special" type="checkbox">
              <i></i>
            </label>
          </td>
        </tr>
        <? foreach($secureList as $i): if($i->aview || $i->aedit || $i->adelete || $i->aspecial) :?>
        <tr class="row-submenu row-menu-<?= $m->id ?>">
          <td class="smart-form col-global col-global-item">
            <label class="checkbox">
              <input <?= ($i->view && $i->edit && $i->delete) ? " checked='checked'" : "" ?>type="checkbox">
              <i></i> <span class="lbx"><?= $this->lang->line($i->submenu) ?></span>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-view">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][view]"<?= ($i->aview && $i->view) ? " checked='checked'" : "" ?><?= $i->aview ? "" : " disabled='disabled'" ?> type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-edit">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][edit]"<?= ($i->aedit && $i->edit) ? " checked='checked'" : "" ?><?= $i->aedit ? "" : " disabled='disabled'" ?>  type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-delete">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][delete]"<?= ($i->adelete && $i->delete) ? " checked='checked'" : "" ?><?= $i->adelete ? "" : " disabled='disabled'" ?>  type="checkbox">
              <i></i>
            </label>
          </td>
          <td class="smart-form col-type text-align-center col-type-special">
            <label class="checkbox">
              <input name="secure[<?= $i->id ?>][special]"<?= ($i->aspecial && $i->special) ? " checked='checked'" : "" ?><?= $i->aspecial ? "" : " disabled='disabled'" ?>  type="checkbox">
              <i></i>
            </label>
          </td>
        </tr>
        <? endif; endforeach ?>
        <? endif ?>
        <? endforeach ?>
      </tbody>
    </table>
  </div>
</fieldset>
