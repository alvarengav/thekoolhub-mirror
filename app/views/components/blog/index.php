<a href="#app-body" class="go-top"><i></i></a>



<? 

$page = $this->input->get('page') ? $this->input->get('page') : 1;

$limit = $page>1 ? 6 : 7;

$GetBlog = $this->Data->GetBlog($limit, $page, $this->input->get('c') );



$posts = $GetBlog&&$GetBlog->data ? $GetBlog->data : false;

// $count = ;



?>

<? $categories = $this->Data->GetBlogCategories();  ?>



<div class="page-blog">



    <div class="categories wow2 w2FadeIn" data-wow2-delay="300">

        <? foreach( $categories as $i => $value): ?>

        <a class="category btn btn-black-outline" href="<?= $value->link ?>"><?= $value->title ?></a>

        <? endforeach ?>

    </div>



    <div class="section-main">

        <? if ($posts && count($posts)) : ?>

        <div class="blog" id="blog_container">



            <div class="container">



                <section class="row posts" id="post_container">

                    <? foreach ($posts as $post) : ?>

                    <div class="col-lg-4 col-md-6">
                        <? $this->load->view('components/blog/preview-post', ['post' => $post]); ?>
                    </div>

                    <? endforeach; ?>

                </section>



            </div>

            <? if($GetBlog&&$GetBlog->next_page): ?>



            <div class="text-center blog-btn-more">

                <a href="#next" class="btn btn-outline" data-next-page="<?= $GetBlog->next_page ?>"><?= $lang == "es" ? 'Cargar más' : 'Load More' ?></a>

            </div>

            <? endif ?>

        </div>

        <? endif ?>

    </div>



</div>



<script>
    $(document).ready(

        function() {

            var CTN = $('#post_container');

            var BTN = $('#blog_container .blog-btn-more a.btn');



            BTN.click(

                function() {

                    var next = $(BTN).attr('data-next-page');



                    $.get('<?= $lang == "es" ? 'noticias?c=' : 'news?c=' . $this->input->get('c') ?><?= '&page='; ?>' + next, function(data) {

                        var posts = $(data).find('#post_container').html();

                        var next = $(data).find('#blog_container .blog-btn-more a.btn').attr('data-next-page');



                        if (!next)

                            $(BTN).remove();

                        else

                            $(BTN).attr('data-next-page', next);





                        $(CTN).append(posts);



                        $('.wow2', CTN).each(function() {

                            var _this = $(this);

                            $(_this).waypoint(function(dir) {

                                var delay = _this.attr('data-wow2-delay');



                                setTimeout(function() {

                                    $(_this).addClass("in");

                                }, delay ? delay : 0);

                            }, {

                                offset: '50%'

                            });

                        });



                    });



                    return false;

                }

            );



        }

    );
</script>