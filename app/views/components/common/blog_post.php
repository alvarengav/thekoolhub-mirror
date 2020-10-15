<article class="blog-post" onclick="javascript:location.href='<?= $post->link ?>'">
    <img class="blog-post-img" src="<?= upload($post->file) ?>">

    <div class="blog-post-content">
        <small class="blog-post-date"><?= $post->date ?></small>
        <h1 class="blog-post-h1"><?= $post->title ?></h1>
        <a class="blog-post-more" href="<?= $post->link ?>"><?= $this->Data->lang('Leer más') ?></a>
    </div>
</article>