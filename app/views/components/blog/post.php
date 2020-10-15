<div class="post">
    <?
    $file = $post->interior_file;
    if ($file == "")
        $file = $post->file;
    ?>
    <div class="post-header" style="background-image: url('<?= thumb($file, 1920, 420) ?>')">
        <div class="bgc"></div>

        <div class="center">
            <h1 class="h1 wow2 w2FadeIn"><?= $post->title ?></h1>
        </div>
    </div>


    <div class="requiere-header-color">
        <div class="post wow2 w2FadeIn" data-wow2-delay="600">

            <div class="navigation">
                <div class="container relative">
                    <a href="<?= $this->Data->lang_url('home') ?>"><?= $this->Data->lang('Home') ?></a> >
                    <a href="<?= $this->Data->lang_url('news') ?>"><?= $this->Data->lang('Blog') ?></a> >
                    <span><?= $post->title ?></span>

                    <? if($post->id_author):  ?>

                    <a <? if($post->author_link): ?>href="<?= $post->author_link ?>" target="_blank"
                        <? else: ?>href="#author"
                        <? endif ?> class="preview-author">
                        <div class="name"><?= $post->author_name ?></div>
                        <div class="pic"><img src="<?= upload($post->author_file) ?>" alt="<?= $post->author_name ?>">
                        </div>
                    </a>
                    <? endif ?>
                </div>
            </div>
            <article class="section-main">
                <div class="container">
                    <div class="post-post">

                        <div class="center">
                            <div class="post-info">
                                <div class="post-categories">
                                    <? if(is_array($post->categories)) { foreach( $post->categories as $i => $value): ?>
                                    <a href="<?= $this->Data->lang_url('news') ?>/?c=<?= $value->id ?>&<?= $value->slug ?>"
                                        class="category"><?= $value->title ?></a>
                                    <? endforeach; } ?>
                                </div>
                                <small class="post-date">
                                    <? $this->load->view('components/svgs/calendar.svg') ?> <?= $post->date ?></small>

                            </div>
                            <div class="text">
                                <?= parse_ckeditor($post->texto) ?>
                            </div>
                        </div>

                        <!-- <div class="post-footer">
                        <a href="<?= $this->Data->lang_url('news') ?>" style="color:white" class="btn btn-black"><?= $this->Data->lang('Volver al blog') ?></a>
                    </div> -->
                    </div>

                    <div class="text-center">
                        <div class="share-box">
                            <a style="text-decoration: none;
    padding: 30px 10px;
    font-size: 1.5rem;
    display: inline-block;
" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($post->link) ?>&title=&summary=<?= urlencode($post->title) ?>&source=">
                                <i class="fa fa-linkedin"></i>
                            </a>
                            <a style="text-decoration: none;
    padding: 30px 10px;
    font-size: 1.5rem;
    display: inline-block;
" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($post->link) ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a style="text-decoration: none;
    padding: 30px 10px;
    font-size: 1.5rem;
    display: inline-block;
" target="_blank" href="https://twitter.com/intent/tweet?text=<?= urlencode($post->link) ?> <?= urlencode($post->title) ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </div>




                        <div id="fb-root"></div>
                        <!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v6.0&appId=2054763121414015&autoLogAppEvents=1"></script>
                 <div class="fb-comments" data-href="<?= $post->link ?>" data-numposts="5" data-width=""></div> -->


                        <div id="disqus_thread"></div>
                        <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://thekoolhub-com.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a
                                href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                    </div>


                </div>
            </article>
        </div>
    </div>
</div>

<style>
@media (max-width: 544px) {
    .youtube-frame {
        max-height: 300px;
    }
}
</style>