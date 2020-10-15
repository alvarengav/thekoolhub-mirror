
<div class="project-box wow fadeInUp" data-wow-delay="300ms">
    <div class="img-box" js-go="<?= $project->link ?>">
        <div class="bg-cover"></div>
        <img preload-src="<?= thumb($project->file,1000,700) ?>" alt="<?= $project->title ?>">
        <div class="text">
            <div class="center">
                <? if($project->title): ?>
                    <div class="t1"><?= $project->title ?></div>
                <? endif ?>
                <div class="t2"><?= nl2br($project->subtitle) ?></div>
                <?/*<div class="tags">
                    <? foreach($project->tags as $t): ?>
                        <span><?= $t->text ?></span>
                    <? endforeach ?>
                </div>*/?>
            </div>
        </div>
    </div>
    <div class="bottom">
        <? if($project->title2): ?>
            <h1 class="t">
                <a href="<?= $project->link ?>">
                <?= $project->title2 ?>
                </a>
            </h1>
        <? else: ?>
            <div class="md-margin"></div>
            <div class="mdmargin">

        <? endif ?>
        <? $this->load->view('components/common/share-box3', ['link'=>$project->link, 'texto'=> $project->title, 'socialCounts' => $project->socialCounts, 'instagram'=>$project->instagram]) ?>
        <? if(!$project->title2): ?>
            </div>
        <? endif ?>
    </div>
</div>
