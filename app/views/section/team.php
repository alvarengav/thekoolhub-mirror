<div class="screen-team requiere-white-header">

    <div class="page-team incont ">
        

        <div class="screen  wow fadeIn">
            <div class="center">
                
                <h1 class="title wow fadeIn" data-wow-delay="900ms"><?= $team->title ?></h1>
                <blockquote class="wow fadeInUp" data-wow-delay="1200ms"><?= $team->subtitle ?></blockquote>
                
            </div>
            <div class="down wow fadeInUp" data-wow-delay="1400ms">
                <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
            </div>
        </div>
    </div>
</div>


<div class="page-team" style="text-align:center">



    <div class="container incont section-tb pb-0">

        <h1 class="title wow fadeIn" data-wow-delay="0ms"><?= $team->title2 ?></h1>
            <blockquote class="wow fadeInUp" data-wow-delay="300ms"><?= $team->subtitle2 ?></blockquote>
    </div>
    
    <? if($team->id_file_team ): ?>

        <div class="requiere-white-header wow fadeIn section-tb">

            <img class="img-team" preload-src="<?= upload($team->id_file_team->file) ?>" alt="<?= $team->title_team ?>" class="w-100">
        </div>
        <? endif ?>

        
    <div class="container incont section-tb pt-0">

    <blockquote class="wow fadeInUp" data-wow-delay="300ms"><?= $team->subtitle3 ?></blockquote>
</div>


    <? $gallery = $team->id_gallery_1; ?>
    <? $this->load->view('components/common/galleryScroll', ['gallery'=>$gallery]); ?>

    <?/*
    <div class="grid-team">
        <? foreach($gallery as $s): ?>
            <div class="row">
                <div class="col-md-5">
                    <img preload-src="<?= thumb($s->file, 666, 666) ?>">
                </div>
                <div class="col-md-7">
                    <div class="text">
                        <div class="center">
                            <div class="t1"><?= $s->title ?? $s->title ?></div>
                            <div class="t2"><?= $s->subtitle ?? nl2br($s->subtitle) ?></div>
                            <div class="t3"><?= $s->text ?? nl2br($s->text) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach ?>
    </div>
    <div class="container">
        <div class="text">
            <?= parse_ckeditor($team->last_text) ?>
        </div>
    </div>*/?>
        
</div>