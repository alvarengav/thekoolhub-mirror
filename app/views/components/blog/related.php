<div class="post-related">

    <div class="container ">
        
            
        <div class="title wow2 w2FadeIn" data-wow2-delay="300">
            <?= $this->Data->lang('Artículos relacionados') ?>
        </div>

        <section class="row">
            <? if(is_array($post->related)) { foreach($post->related as $zpost) : ?>
                <div class="col-lg-4 col-md-6"><? $this->load->view('components/blog/preview-post', ['post'=>$zpost]); ?></div>
                <? endforeach; } ?>
            </section>
            
        </div>
    </div>