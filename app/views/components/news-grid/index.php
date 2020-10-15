<div class="news-grid liveadmin-settings ">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/news', 'id'=>$id, 'text'=>'Editar noticias']) ?>

    <? 



// $data = $this->Data->GetInfo($id);





    // $news = [];

    // foreach($data->related as $n ) {

    //     $news[] = $n->related;

    // }



    $news = $this->Data->GetBlog(3,1);





?>

    <div class="incont incont-min wow fadeInUp" data-wow-delay=".3s">

        <div class="title"><?= $title ?></div>

        <div class="subtitle"><?= $text ?></div>

    </div>



    <div class="incont">

        <div class="grid">

            <? foreach( $news->data as $i => $value ): ?>

            <div class="div<?= $i + 1 ?> wow fadeInUp <? /*if(!$value): ?>mobile-hide<? endif*/ ?>"
                data-wow-delay=".6s">



                <div class="box" js-go="<?= $value->link ?>"
                    style="background-image: url('<?= upload($value->file) ?>'); <? /*if(!$value): ?>visibility: hidden;<? endif */ ?>">

                    <div class="bgc"></div>

                    <div class="center">



                        <div class="box-text">



                            <div class="box-title"><?= $value->title ?></div>

                            <div class="box-subtitle"><?= $value->subtitle ?></div>

                        </div>

                        <div class="box-date">

                            <? $this->load->view('components/svgs/calendar.svg') ?>

                            <?= $value->date ?>

                        </div>

                    </div>



                    <div class="more">

                        <a href="<?= $value->link ?>" class="link"><?= $this->Data->lang('Leer') ?>
                            <? $this->load->view('components/svgs/arrow-rigth.svg') ?>
                        </a>

                    </div>

                </div>

            </div>

            <? endforeach ?>

        </div>



        <div class="end-btn">

            <? $this->load->view('components/liveadmin/admin-btn', [

                'id'=>$id.'-btn1',

                'class'=> 'btn btn-outline',

                'html'=> $btn,

                'default'=> $this->Data->lang_url('news'),

            ]) ?>

        </div>

    </div>

</div>

<style>
.news-grid .box {
    background-position: center center;
}
</style>