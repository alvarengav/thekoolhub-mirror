<div class="news-grid liveadmin-settings ">

    <div class="incont incont-min wow fadeInUp" data-wow-delay=".3s">

        <div class="title"><?= $title ?></div>

        <div class="subtitle"><?= $text ?></div>

    </div>



    <div class="incont">

        <div class="row">

            <div class="col-md-6 mb-2 wow fadeInUp <? /*if(!$value): ?>mobile-hide<? endif*/ ?>" data-wow-delay=".6s">

                <div class="box" js-go="<?= $value->link ?>"
                    style="background-image: url('<?= upload(@$value->file) ?>'); <? /*if(!$value): ?>visibility: hidden;<? endif */ ?>">

                    <div class="bgc"></div>

                    <div class="center">

                        <div class="box-text">
                            <div class="box-title"><?= $value->title ?></div>

                            <div class="box-subtitle"><?= $value->subtitle ?></div>

                        </div>

                    </div>

                </div>


            </div>

            <div class="col-md-6 mb-2 wow fadeInUp <? /*if(!$value): ?>mobile-hide<? endif*/ ?>" data-wow-delay=".6s">

                <div class="box" js-go="<?= $value->link ?>"
                    style="background-image: url('<?= upload(@$value->file) ?>'); <? /*if(!$value): ?>visibility: hidden;<? endif */ ?>">

                    <div class="bgc"></div>

                    <div class="center">

                        <div class="box-text">
                            <div class="box-title"><?= $value->title ?></div>

                            <div class="box-subtitle"><?= $value->subtitle ?></div>

                        </div>

                    </div>

                </div>


            </div>


        </div>



    </div>

</div>

<style>
.news-grid .box {
    background-position: center center;
}
</style>