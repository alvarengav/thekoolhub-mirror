<div class="circle-images-and-texts  <?= isset($style) ? 'custom-'.$style : '' ?> wow2 sweepToUp">

<? /* liveadmin-settings $this->load->view('components/liveadmin/settings', ['url'=>'contents/three_files', 'id'=>$id, 'text'=>'Editar imagen']) ?>
<? $data = $this->Data->GetInfo($id);*/ ?>


    <div class="incont wow2 w2FadeIn"  data-wow2-delay="600">
        <div class="title"><?= $title ?></div>
    </div>

    <div class="incont wow2 w2FadeIn"  data-wow2-delay="900">
        <div class="row">

            <? foreach( $boxes as $i => $value): $z = $i+1; $f = 'id_file_'.$z;?>
                <div class="col-md-4">
                    <div class="box  <?= isset($value['style']) ? 'box-'.$value['style'] : '' ?>">
                        <?/*<img src="<?= upload( $data->$f->file ) ?>" alt="" class="img">*/ ?>
                        <div class="box-svg pb-4"><?= $value['svg'] ?></div>
                        <div class="box-title"><?= $value['title'] ?></div>
                        <div class="box-text"><?= $value['text'] ?></div>
                    </div>
                </div>
                <? endforeach ?>
            </div>
    </div>
</div>