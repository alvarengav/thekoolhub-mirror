<?/*
<div class="carrusel galleryScroll">
    <div class="pinContainer" id="pin_<?= uniqid() ?>">
        <div class="panel slides">
            
            <? foreach ($gallery as $s) : ?>
                <div class="slide carrusel_item">
                    <img preload-src="<?= thumb($s->file, 666, 1000) ?>">
                    <? if( isset($s->title) || isset($s->subtitle) || isset($s->text) ) : ?>
                    <div class="text">
                        <div class="center">
                            <div class="t1"><?= $s->title ?? $s->title ?></div>
                            <div class="t2"><?= $s->subtitle ?? nl2br($s->subtitle) ?></div>
                            <div class="t3"><?= $s->text ?? nl2br($s->text) ?></div>
                        </div>
                    </div>
                    <? endif ?>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>*/ ?>
<? $uid = uniqid(); ?>
<div class="gallerySwiper wow fadeIn" data-wow-delay="300ms" id="g<?= $uid ?>">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <? foreach ($gallery as $s) : ?>
                <div class="swiper-slide">
                    <img preload-src="<?= thumb($s->file, 666, 1000) ?>">
                    <? if( isset($s->title) && $s->title || isset($s->subtitle) && $s->subtitle || isset($s->text) && $s->text ) : ?>
                    <div class="text">
                        <div class="center">
                            <div class="t1"><?= $s->title ?? $s->title ?></div>
                            <div class="t2"><?= $s->subtitle ?? nl2br($s->subtitle) ?></div>
                            <div class="t3"><?= $s->text ?? nl2br($s->text) ?></div>
                        </div>
                    </div>
                    <? endif ?>
                </div>
            <? endforeach ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      </div>
</div>

<script>
    $(document).on('endLoad', function () {
        var g = $('#g<?= $uid ?>');
        
        $('#g<?= $uid ?> .swiper-container').css({
            'width': $(window).width(),
            'left': 0,
            'position': 'absolute',
        });

        $('#g<?= $uid ?>').css({
            'height': $('#g<?= $uid ?> .swiper-container').height(),
        });

        $('#g<?= $uid ?> .swiper-slide').each(function() {
            $(this).width($('img', $(this)).width());


        });


        var swiper = new Swiper('#g<?= $uid ?> .swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 0,
            centeredSlides: true,
            grabCursor: true,
            keyboard: {
                enabled: true,
                onlyInViewport: false,
            },
            on: {

                init: function() {
                    var _this = this;
                    
                    $('#g<?= $uid ?> .swiper-slide').click(function() {
                        if($(this).hasClass('swiper-slide-prev'))
                            swiper.slidePrev()
                        if($(this).hasClass('swiper-slide-next'))
                            swiper.slideNext()
                    });
           
                }
            }
            // pagination: {
            //     el: '.swiper-pagination',
            //     clickable: true,
            // },
        });

        if( breakpoint('>md') )
            swiper.slideTo(1);
    });
</script>