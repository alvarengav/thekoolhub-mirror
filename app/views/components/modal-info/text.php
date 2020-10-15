

<div class="modal-header">
<h1 class="modal-title"><?= $info->title ?></h1>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <div class="text">
        <?= parse_ckeditor($info->text) ?>
    </div>
</div>