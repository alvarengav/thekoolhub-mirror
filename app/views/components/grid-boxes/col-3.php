<div class="grid-boxes grid-col-3 requiere-header-white <?= isset($style) ? 'grid-boxes-'.$style : '' ?>">
    <div class="incont">
        <div class="title"><?= $title ?></div>
    </div>

    <div class="incont">
        <div class="row">
            <? foreach( $boxes as $i => $value):  ?>
                <div class="col-lg-3 col-md-6">

                    <div class="box box--gray wow fadeInUp" data-wow-delay=".3s">
                        <div class="center">
                            <div class="box-icon"><?= $value['icon'] ?></div>
                            <div class="box-title"><?= $value['title'] ?></div>
                            <div class="box-text"><?= $value['text'] ?></div>
                        </div>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>