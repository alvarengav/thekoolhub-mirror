<div class="page-blog margin-header">
    <article class="section-main">

        <div class="blog">

            <div class="container">
                <h1 class="blog-h1" style="padding-top: 80px"><?= $post->title ?></h1>
                <div class="blog-post">
                    <div class="center" style="margin: 0 auto">
                        <div class="text">
                            <?= parse_ckeditor($post->text) ?>
                        </div>
                    </div>
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