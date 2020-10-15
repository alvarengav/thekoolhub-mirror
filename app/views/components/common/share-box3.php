<? $instagram = $project->instagram ?>
<? $facebook = $project->facebook ?>
<? $twitter = $project->twitter ?>
    <div class="share-box">
    <!--googleoff: index-->
    <? if($twitter ): ?>
    <a target="_blank" href="https://twitter.com/<?= $twitter ?>">
        <i class="fa fa-twitter"></i> <?//= $socialCounts['twittershares'] ?>
    </a>
    <? endif ?>
    <? if($facebook ): ?>
        <a target="_blank" href="https://www.facebook.com/<?= $facebook ?>">
        <i class="fa fa-facebook"></i> <?//= $socialCounts['facebookshares'] ?>
    </a>
    <? endif ?>
    <? if($instagram ): ?>
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
    
    <? endif ?>
    <!--googleon: index-->
</div>