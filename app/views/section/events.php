<div class="page-spaces">
    <? 
    $id = 'events-intro';
        $this->load->view('components/intro/index', [
      'color'=>'yellow',
      'title'=> $this->Data->Content($id.'-title'),
      'subtitle'=> $this->Data->Content($id.'-subtitle'),
      'contentTitle'=> $this->Data->Content($id.'-contentTitle'),
      'contentDescription'=> $this->Data->Content($id.'-contentDescription')
    ]); ?>

    <div class="requiere-header-color">

        <? 
        $id = 'spaces-intro2-btb-';
        
        $this->load->view('components/basic-text-block/index', [
          'title'=> $this->Data->Content($id.'-title'),
          'btn'=> $this->Data->Content('Contactanos'),
          'btnLink'=> $this->Data->lang_url('contact'),
          'style'=> ' child-btn-yellow',
          'description'=> $this->Data->Content($id.'-description')
          ]); ?>
    </div>

    <div class="bg-darkblue">

        <? $this->load->view('components/events/grid', [
        'id'=> 'list-main-events'
    ]); ?>

    </div>

    <div class="requiere-header-color">

        <? 
        $id = 'spaces-last-calltoa-btb-';
        
        $this->load->view('components/basic-text-block/index', [
          'style'=> ' child-btn-yellow',
          'title'=> $this->Data->Content($id.'-title'),
          'description'=> $this->Data->Content($id.'-description'),
          'btn'=> $this->Data->Content($id.'-btn'),
          'btnLink'=> $this->Data->lang_url('contact'),
          ]); ?>
    </div>


</div>