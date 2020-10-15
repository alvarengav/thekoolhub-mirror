<div class="news-grid">



    <div class="incont incont-min wow fadeInUp" data-wow-delay=".3s">

        <div class="title"><?= $title ?></div>

        <div class="subtitle"><?= $text ?></div>

    </div>



    <div class="container">

        <div class="row">

            <? foreach( $blog as $i => $value ):  ?>

            <div class="div<?= $i + 1 ?> <?= ($i == 0 || $i % 5 == 0)  ? 'col-md-12' : 'col-md-6' ?> col wow fadeInUp <? if(!$value): ?>mobile-hide<? endif ?>"
                data-wow-delay=".6s">



                <div class="box" js-go="<?= $value->link ?>"
                    style="background-image: url('<?= upload($value->file) ?>'); <? if(!$value): ?>visibility: hidden;<? endif ?>">

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
                            <? $this->load->view('components/svgs/arrow-rigth.svg') ?></a>

                    </div>

                </div>

            </div>

            <? endforeach ?>

        </div>



    </div>

</div>