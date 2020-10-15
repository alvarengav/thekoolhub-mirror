<div class="page-blog">

    <? $this->load->view('components/intro/index', [
      'color'=>'darkblue',
      'title'=> $this->Data->Content('blog-intro-title'),
      'subtitle'=> $this->Data->Content('blog-intro-subtitle'),
      'contentTitle'=> $this->Data->Content('blog-intro-contentTitle'),
      'contentDescription'=> $this->Data->Content('blog-intro-contentDescription')
    ]); ?>
    <div class="requiere-header-color">

        <? $this->load->view('components/blog/index') ?>

        <div class="mt-4 pt-4"></div>
        <? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow mt-4 white-button',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        
    ]); ?>
    </div>
</div>


<style>
@media only screen and (max-width: 575px) {
    .preview-post-h1 {
        height: auto;
    }
}
</style>