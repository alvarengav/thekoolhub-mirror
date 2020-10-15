
<? $uniq = uniqid() ?>
<div class="swiper-container" id="sw<?= $uniq ?>">
    <div class="swiper-wrapper">
        <? foreach($gallery as $i => $slide) : ?>
        <div class="noveltyItem swiper-slide  p-a-0">
            <img src="<?= thumb($slide->file, $w, $h) ?>" alt="">
        </div>
        <? endforeach; ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        var mySwiper = new Swiper('#sw<?= $uniq ?>', {
            autoplay: {
                delay: 3000,
            },
            speed: 400,
            // simulateTouch: false,
            effect: 'fade'
        });
    })
</script>