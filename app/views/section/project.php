<div class="full-box requiere-white-header  wow fadeIn" style="background-image: url('<?= thumb($project->file, 1920, 1080) ?>')">
<div class="bgc"></div>

<div class="center">
        <h1 class="h1 wow fadeIn" data-wow-delay="600ms"><?= $project->title ?></h1>
        <div class="h2 wow fadeInUp" data-wow-delay="900ms"><?= $project->subtitle ?></div>
    </div>
    <div class="down wow fadeInUp" data-wow-delay="1200ms">
        <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
    </div>
</div>
<div class="page-blog">
    <article class="section-main">

        <div class="blog">

            <div class="container">
            
                <!-- <h1 class="blog-h1 incont">
                    <? if($project->title2) :?>
                    <?= $project->title2 ?>
                    <? endif ?>
                </h1> -->

                
                <div class="blog-post">

                <div class="work_types wow fadeInUp" data-wow-delay="300ms">

<span class="work_types-title"><?= $this->Data->lang('Serveis') ?></span>

<? if($project->work_types): 
    foreach ($project->work_types as $t) : ?>
    <span><?= $t->text ?></span>
<? endforeach; 
endif; ?>
</div>
                    <div class="blog-header">
                        <div class="flex">

                            <div class="tags  wow fadeInUp" data-wow-delay="300ms">
                                <? if($project->tags): foreach ($project->tags as $t) : ?>
                                    <span><?= $t->text ?></span>
                                <? endforeach; endif; ?>
                            </div>

                            <? $this->load->view('components/common/share-box3', ['project' => $project]) ?>

                            
                        </div>

                    </div>
                    <div class="center incont">

                        <div class="text " data-wow-delay="300ms">
                            
                            <?= parse_ckeditor($project->texto) ?>
                        </div>
                    </div>

                    <div class="project-bottom"></div>

                </div>




                <?/*
                <a href="<?= base_url($lang.'/blog') ?>" class="btn-back"><i class="fa fa-arrow-left"></i> <?= $this->Data->lang('Volver a artículos') ?></a>
                $projects = $this->Data->GetBlog($project->related);
                    if( count($projects) ) :
                        
                    ?>
                        <section class="row in-container">
                            <? foreach($projects as $project) : ?>
                                <div class="col-md-4"><? $this->load->view('components/common/blog_project', ['project'=>$project]); ?></div>
                            <? endforeach; ?>
                        </section>
                <? endif */ ?>

            </div>
        </div>
    </article>

</div>


<script>
    $(document).on('endLoad', function () {

        var mh = $('.blog-post .right').outerHeight() + 30;
        $('.blog-post .left').css('min-height', mh);

        if( breakpoint('>md') ) {
            setTimeout(function() {
                $('.work_types').css('top' ,$('.blog-post .center').position().top );
                $('.work_types').css('left' , $('.blog-post .center .text').position().left - 225 );
            },200);
        } else {
            $('.project-bottom').append($('.blog-header .tags'))
            $('.project-bottom').append($('.work_types'))
        }

    });
</script>