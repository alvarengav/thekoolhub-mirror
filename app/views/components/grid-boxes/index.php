<div class="grid-boxes requiere-header-white <?= isset($style) ? 'grid-boxes-' . $style : '' ?>">
    <div class="incont wow fadeInUp" data-wow-delay=".3s">
        <div class="title"><?= $title ?></div>
        <? if (isset($description)): ?>
        <div class="subtitle">
            <?= $description ?>
        </div>
        <? endif; ?>
    </div>

    <div class="incont-min">
        <div class="row">
            <? foreach( $boxes as $i => $value):  ?>
            <div class="col-lg-4 col-md-6">

                <div class="box box--gray wow fadeInUp" data-wow-delay=".6s">
                    <div class="center">
                        <? if(isset($value['icon']) && $value['icon'] ): ?>
                        <div class="box-icon"><?= $value['icon'] ?></div>
                        <? endif ?>
                        <div class="box-title"><?= $value['title'] ?></div>
                        <div class="box-text"><?= $value['text'] ?></div>
                    </div>
                </div>
            </div>
            <? endforeach ?>
        </div>
    </div>
</div>

<style>
.grid-boxes .subtitle {
    font-weight: 300;
    font-size: 1.5em;
    line-height: 1.5em;
    width: 100%;
    max-width: 710px;
    margin: 0 auto;
    margin-bottom: 4em;
    text-align: center;
}
</style>