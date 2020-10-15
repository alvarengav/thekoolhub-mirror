<div class="screen-services requiere-white-header">

    <div class="page-services incont ">
        

        <div class="screen  wow fadeIn">
            <div class="center">
                
                <h1 class="title wow fadeIn" data-wow-delay="900ms"><?= $info_page->title ?></h1>
                <blockquote class="wow fadeInUp" data-wow-delay="1200ms"><?= $info_page->subtitle ?></blockquote>
                
            </div>
            <div class="down wow fadeInUp" data-wow-delay="1400ms">
                <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
            </div>
        </div>
    </div>
</div>
<div class="requiere-white-header">
    <div class="section-main">
        <?
        if (count($services)) :
        ?>

            <? foreach ($services as $post) : ?>
                <section id="s<?= $post->id_post ?>">
                    <div class="full-box wow fadeIn" style="background-image: url('<?= thumb($post->file, 1920, 1080) ?>')">
                        <div class="bgc"></div>
                        <div class="center">
                            <div class="h1 wow fadeInUp" data-wow-delay="900ms"><?
                                            echo $post->title;
                                            if (isset($post->title2) && $post->title2) echo '<br>' . $post->title2
                                            ?></div>
                            <div class="h2 wow fadeInUp" data-wow-delay="1200ms"><?= $post->subtitle ?></div>
                        </div>
                        <div class="down">
                            <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
                        </div>
                    </div>
                </section>
            <? endforeach; ?>
        <? endif ?>
    </div>
</div>

</div>