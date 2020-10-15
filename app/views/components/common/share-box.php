<? $instagram = isset($instagram)&&$instagram ? $instagram : $config->instagram ?>
    <div class="share-box">
    <!--googleoff: index-->
    <a target="_blank" href="https://twitter.com/home?status=<?= urlencode($link) ?> <?= urlencode($texto) ?>">
        <i class="fa fa-twitter"></i> <?//= $socialCounts['twittershares'] ?>
    </a>
    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($link) ?>">
        <i class="fa fa-facebook"></i> <?//= $socialCounts['facebookshares'] ?>
    </a>
    <div class="more" data-instagram="<?= $instagram ?>">
        <i class="fa fa-instagram"></i> <?= $instagram ?>
        <div class="more-hide">
            <div class="triangle"></div>
            <div class="imgs">
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
                <a target="_blank" href="https://www.instagram.com/<?= $instagram ?>"><img src="<?= layout('img/gray.png') ?>"></a>
            </div>
            <div class="follow">
                
                <a href="https://www.instagram.com/<?= $instagram ?>" target="_blank">
                    <i class="fa fa-instagram"></i> <?= $instagram ?>
                </a>
            </div>
        </div>
    </div>
    <!--googleon: index-->
</div>