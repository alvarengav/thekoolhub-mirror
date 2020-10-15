<div class="wow2 <?= (strpos($imgSide, 'right') !== false) ? 'sweepToRight' : 'sweepToLeft' ?>">

    <div
        class="vertical-gallery-and-text  vertical-gallery-and-text-<?= $imgSide ?>  <?= isset($style) ? 'custom-' . $style : '' ?> liveadmin-settings">



        <? $data = $this->Data->GetInfo($id);

    $imgs = [];

    if( $data->id_gallery_1 ) {



      foreach( $data->id_gallery_1 as $s ) {

        $imgs[] = upload($s->file);

      }

    }



    ?>

        <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/vertical_gallery_and_text', 'id'=>$id, 'text'=>'Editar Galería y descarga']) ?>



        <div class="vertical-gallery-and-text-img wow2 w2FadeIn" data-wow2-delay="600">

            <? if($imgs): ?>

            <? $this->load->view('components/swipers/vertical-gallery', ['imgs'=>$imgs]) ?>



            <? endif ?>

        </div>

        <div class="vertical-gallery-and-text-content wow2 w2FadeIn" data-wow2-delay="900">

            <div class="center">

                <div class="vertical-gallery-and-text-title"><?= $title ?></div>

                <div class="vertical-gallery-and-text-description"><?= $description ?></div>





                <? $this->load->view('components/liveadmin/admin-btn', [

        'id'=>$id.'-btn1',

        'class'=> $id == 'cm-showroom-gallery' ? 'btn btn-black-outline' : 'btn btn-white-outline',

        'html'=> $btn,

        'default'=>$btnLink,

    ]) ?>

                <style>
                .btn-white-outline {
                    color: #FFF;
                    border: 2px solid #FFF;
                }

                .custom-darkblue.white-button .btn-white-outline:hover {
                    color: #16223A;
                    background: #FFF;
                }

                .custom-gray.dark-button .btn-white-outline {
                    color: #000;
                    border: solid 2px #000;
                }

                .custom-gray.dark-button .btn-white-outline:hover {
                    color: #FFF;
                    background: #000;
                }
                </style>



                <? if($data->id_file_down): ?>



                <a class="download" download="<?= upload($data->id_file_down->name) ?>"
                    href="<?= upload($data->id_file_down->file) ?>">

                    <? $this->load->view('components/svgs/download.svg') ?>



                    <?= $down ?>

                </a>

                <? endif ?>

            </div>

        </div>

    </div>

</div>