<div class="page-contact">

    <?  
    $id = 'contact-intro';
    $this->load->view('components/intro/index', [
      'color'=>'yellow',
      'title'=> $this->Data->Content($id.'-title'),
      'subtitle'=> $this->Data->Content($id.'-subtitle'),
      'contentTitle'=> $this->Data->Content($id.'-contentTitle'),
      'contentDescription'=> $this->Data->Content($id.'-contentDescription')
    ]); ?>


    <? 
     $id = 'block-contact';
        $this->load->view('components/block-contact/index', [
      'id' => $id,
    ]); ?>


    <style>
    .bg-white {
        background: #FFF;
        padding-top: 0;
        padding-bottom: 0;
    }

    .bg-gray {
        background: #f2f2f2;
    }

    .padding-3 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    </style>




    <? 
     $id = 'map-contact';
        $this->load->view('components/block-location/index', [
      'id' => $id,
    ]); ?>

</div>