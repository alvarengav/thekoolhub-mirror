<div class="line-subcribe wow2 w2FadeIn">
    <form  action="<?= base_url('ajax_subscribe') ?>" class="ajaxForm form-subscribe">
        <div class="container">

            <div class="title">
                <?= $this->Data->lang('¡No te pierdas nada! Suscríbete a nuestra newsletter') ?>
            </div>
            
            <div class="div" style="display:flex; width:70%; justify-content: flex-end;">
                <input type="text" name="name" class="form-control" placeholder="<?= $this->Data->lang('Introduce tu  nombre completo…') ?>">
                <input type="text" name="mail" class="form-control" placeholder="<?= $this->Data->lang('Introduce tu mail…') ?>">
                <input type="hidden" name="check" value="1">
                <input type="hidden" name="lang" value="<?= $language ?>">
                <button class="btn btn-primary"><?= $this->Data->lang('SUSCRÍBETE') ?></button>
            </div>
        </div>
    </form>
</div>

<style>
    .line-subcribe .container .btn {
        margin-left: 1rem;
    }
</style>