<div class="basic-text-block <?= isset($style) ? 'basic-text-block-'.$style : '' ?> wow2 sweepToUp">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="basic-text-block-container">
          <div class="basic-text-block-title wow2 w2FadeIn" data-wow2-delay="600"><?= $title ?></div>
          <div class="basic-text-block-description wow2 w2FadeIn" data-wow2-delay="900"><?= $description ?></div>
          <? if(isset($btn) && $btn ): ?>
            <div class="basic-text-block-btn wow2 w2FadeIn" data-wow2-delay="600">
              <? $this->load->view('components/liveadmin/admin-btn', [
                  'id'=>$id.'-btn1',
                  'class'=> 'btn-outline btn',
                  'html'=> $btn,
                  'default'=>$btnLink,
              ]) ?>
            </div>
          <? endif ?>
        </div>
      </div>
    </div>
  </div>
</div>