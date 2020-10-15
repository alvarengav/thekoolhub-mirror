<div class="page-home">

    <? $this->load->view('components/intro/index', [
      'color'=>'darkblue',
      'title'=> $this->Data->Content('skool-intro-title'),
      'subtitle'=> $this->Data->Content('skool-intro-subtitle'),
      'contentTitle'=> $this->Data->Content('skool-intro-contentTitle'),
      'contentDescription'=> $this->Data->Content('skool-intro-contentDescription')
    ]); ?>

    <div class="requiere-header-color">
        <? $this->load->view('components/basic-text-block/index', [
      'title'=> $this->Data->Content('skool-textBlock1-title'),
      'description'=> $this->Data->Content('skool-textBlock1-description')
    ]); ?>

        <? $this->load->view('components/image-text-block/index', [
      'imgSide' => 'left',
      'img' => layout('img/home.jpg'),
      'title'=> $this->Data->Content('skool-textBlock2-title'),
      'description'=> $this->Data->Content('skool-textBlock2-description'),
      'id'=> 'sool-textBlock2'
    ]); ?>

        <? $this->load->view('components/image-text-block/index', [
      'imgSide' => 'right pt-0',
      'img' => layout('img/home.jpg'),
      'title'=> $this->Data->Content('skool-textBlock3-title'),
      'description'=> $this->Data->Content('skool-textBlock3-description'),
      'id'=> 'sool-textBlock3'
    ]); ?>

        <? $this->load->view('components/grid-boxes/index', [
        'title'=> $this->Data->Content('skool-grid-boxes-title'),
        'style'=> 'white-gray',
        'boxes' => [
            [
                'title' => $this->Data->Content('skool-grid-box-title-1'),
                'text' => $this->Data->Content('skool-grid-box-text-1')
            ],
            [
                'title' => $this->Data->Content('skool-grid-box-title-2'),
                'text' => $this->Data->Content('skool-grid-box-text-2')
            ],
            [
                'title' => $this->Data->Content('skool-grid-box-title-3'),
                'text' => $this->Data->Content('skool-grid-box-text-3')
            ],
           
        ]
    ]); ?>

    </div>

    <? $this->load->view('components/basic-text-block/index', [
      'style'=>'yellow',
      'title'=> $this->Data->Content('skool-textBlock4-title'),
      'description'=> $this->Data->Content('skool-textBlock4-description')
    ]); ?>
    <div class="requiere-header-color">

        <? $this->load->view('components/events/grid', [
    'id'=> 'skool-events'
    ]); ?>
    </div>

</div>


<? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        
    ]); ?>

<style>
  .grid-boxes-img-text .box .textContent .text {
    color: #FFF !important;
  }
</style>