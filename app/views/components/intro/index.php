<div class="intro intro-<?= $color ?? $style ?> wow2 sweepToUp" >
  <div class="incont wow2 w2FadeIn" data-wow2-delay="600">
    <div class="row">
      <div class="col-md-12">
        <div class="intro-title-main"><?= $title ?></div>
        <div class="intro-title-secondary"><?= $subtitle ?></div>
        <div class="intro-content">
          <div class="intro-content-title"><?= $contentTitle ?></div>
          <div class="intro-content-description"><?= $contentDescription ?></div>
        </div>
        <? $this->load->view('components/svgs/arrow-down.svg') ?>
      </div>
    </div>
  </div>
</div>