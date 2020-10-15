<div class="carousel liveadmin-settings <?= isset($style) ? 'custom-'.$style : '' ?>">
<? $data = $this->Data->GetInfo($id);
    $imgs = [];
    if( $data->id_gallery_1 ) {
        foreach( $data->id_gallery_1 as $i => $s ) {
            // if($i>1) continue;
            $imgs[] = upload($s->file);
        }
    }

    ?>
    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_gallery', 'id'=>$id, 'text'=>'Editar Galería']) ?>  

    <div class="incont incont-min wow fadeInUp" data-wow-delay=".3s">
        <div class="title"><?= $title ?></div>
    </div>
    <? if( $data->id_gallery_1 ) : ?>
    <div class="incont incont-mi wow fadeInUp" data-wow-delay=".6s">
        <div class="center">
            <div class="swiper-container">
                <div class="swiper-wrapper" <?= count($imgs)<3 ? 'style="justify-content:center"' : '' ?>>
                    <? foreach( $imgs as $i => $value): ?>                        
                        <div class="swiper-slide  wow fadeInUp">
                            <img class="slide-img" src="<?= $value ?>" alt="">
                        </div>
                        <? endforeach ?>
                    </div>
                    
                </div>
            </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <? endif ?>
</div>