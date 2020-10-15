<div
    class="call-to-action <?= isset($style) ? 'call-to-action-' . $style : '' ?> <?= (strpos($style, 'white') !== false) ? '0' : 'wow2 sweepToUp' ?>">

    <div class="incont incont-min wow2 w2FadeIn"
        data-wow2-delay="<?= (strpos($style, 'white') !== false) ? '0' : '600' ?>">

        <div class="title" style="color: #FFF"><?= $title ?></div>
        <? if (isset($subtitle)): ?>
        <div class="subtitle" style="color: #FFF; text-align: center"><?= $subtitle ?></div>
        <? endif; ?>

    </div>







    <div class="end-btn wow2 w2FadeIn" data-wow2-delay="<?= (strpos($style, 'white') !== false) ? '0' : '600' ?>">

        <? $this->load->view('components/liveadmin/admin-btn', [

            'id'=>$id.'-btn1',

            'class'=> 'btn btn-outline"',

            'html'=> $btn,

            'default'=>$btnLink,

        ]) ?>

    </div>



</div>

<style>
.white-button .btn-outline {
    color: #FFF;
    border: #FFF 2px solid;
}

.white-button .btn-outline:hover {
    background: #FFF;
    color: #ffa900;
}
</style>