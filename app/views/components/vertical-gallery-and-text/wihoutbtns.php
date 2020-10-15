<div class="wow2 <?= (strpos($imgSide, 'right') !== false) ? 'sweepToRight' : 'sweepToLeft' ?>">

<div class="vertical-gallery-and-text vertical-gallery-and-text-<?= $imgSide ?>  <?= isset($style) ? 'custom-'.$style : '' ?> liveadmin-settings">

<? $data = $this->Data->GetInfo($id);
    $imgs = [];
    if( $data->id_gallery_1 ) {

      foreach( $data->id_gallery_1 as $s ) {
        $imgs[] = upload($s->file);
      }
    }

    ?>
    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_gallery', 'id'=>$id, 'text'=>'Editar Galería']) ?>  

<div class="vertical-gallery-and-text-img wow2 w2FadeIn" data-wow2-delay="600">
    <? if($imgs): ?>
      <? $this->load->view('components/swipers/vertical-gallery', ['imgs'=>$imgs]) ?>
      
    <? endif ?>
  </div>
  <div class="vertical-gallery-and-text-content wow2 w2FadeIn" data-wow2-delay="900">
  <div class="center">

    <div class="vertical-gallery-and-text-title"><?= $title ?></div>
    <div class="vertical-gallery-and-text-description"><?= $description ?></div>

    </div>
  </div>
</div>
</div>