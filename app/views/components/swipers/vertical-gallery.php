<? $uniqid = uniqid() ?>
<div class="swiper-container vertical-gallery" id="s<?= $uniqid ?>">
    <div class="swiper-wrapper">
        <? foreach( $imgs as $i => $value): ?>
        <div class="swiper-slide"><img src="<?= $value ?>"></div>
        <? endforeach ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

<script>
    $(document).ready(function() {
        var swiper = new Swiper('#s<?= $uniqid ?>', {
            direction: 'vertical',
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>