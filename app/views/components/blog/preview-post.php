<article class="preview-post  wow2 w2FadeIn" data-wow2-delay="300"
    onclick="javascript:location.href='<?= $post->link ?>'">

    <img class="preview-post-img" src="<?= upload($post->file) ?>">



    <div class="preview-post-content">

        <div class="center">

            <h1 class="preview-post-h1"><a href="<?= $post->link ?>"><?= $post->title ?></a></h1>


            <?php
            if ($lang == "es")
                setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
            ?>
            <small class="preview-post-date">
                <? $this->load->view('components/svgs/calendar.svg') ?>
                <? echo strftime("%A %d %B %Y", strtotime($post->date)); ?></small>

            <h1 class="preview-post-subtitle"><?= $post->subtitle ?> </h1>

            <div class="preview-post-more more">
                <div class="link"><?= $this->Data->lang('Leer') ?>
                    <? $this->load->view('components/svgs/arrow-rigth.svg') ?>
                </div>
            </div>

        </div>

    </div>

</article>