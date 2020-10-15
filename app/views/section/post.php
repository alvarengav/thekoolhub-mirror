<div class="page-post">

    <? $this->load->view('components/blog/post') ?>
    <div class="requiere-header-color">

        <? $this->load->view('components/bloc-text/index', [
            'text'=> $this->Data->Content('home-bloc-text-text'),
            ]); ?>
            
    </div>
    <? $this->load->view('components/line-subcribe/index'); ?>
    <div class="requiere-header-color">

        <? $this->load->view('components/blog/related') ?>

        
  <? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        
    ]); ?>
    </div>

    <style>
        .call-to-action {
            
    padding-top: 5rem;
    padding-bottom: 5rem;
        }
    </style>
</div>