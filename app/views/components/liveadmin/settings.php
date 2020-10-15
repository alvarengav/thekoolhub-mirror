<? if($this->data['admin']) : ?>
    <div class="btn-settings" data-modal-liveadmin="<?= $url ?>" data-liveadmin-id="<?= $id ?>"><i class="fa fa-cogs"></i> <?= isset($text) ? $text : 'Editar configuración'  ?></div>
<? endif ?>