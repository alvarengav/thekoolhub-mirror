<div class="text-and-items  <?= isset($style) ? 'custom-'.$style : '' ?> wow2 sweepToUp">

<? /* liveadmin-settings $this->load->view('components/liveadmin/settings', ['url'=>'contents/three_files', 'id'=>$id, 'text'=>'Editar imagen']) ?>
<? $data = $this->Data->GetInfo($id);*/ ?>


    <div class="incont wow2 w2FadeIn"  data-wow2-delay="600">

        <div class="row text-and-items-grid">
            <div class="col-xl-5 col-md-5 col-lg-5 col-md-12 text-and-items-text">
                <div class="title"><?= $title ?></div>

            </div>
            <div class="col-xl-7 col-md-7 col-lg-7 col-md-12 text-and-items-items">
                <? foreach( $boxes as $i => $value): $z = $i+1; $f = 'id_file_'.$z;?>
                        <div class="box  <?= isset($value['style']) ? 'box-'.$value['style'] : '' ?>">
                            <div class="box-svg pb-4"><?= $value['svg'] ?></div>

                            <div class="box-text">
                                <div class="box-title"><?= $value['title'] ?></div>
                                <div class="box-subtitle"><?= $value['text'] ?></div>
                            </div>
                        </div>
                <? endforeach ?>
            </div>
        </div>

    </div>
</div>