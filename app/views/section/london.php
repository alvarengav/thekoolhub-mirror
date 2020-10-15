<div class="page-home">

    <? $this->load->view('components/image-presentation/index', [
        'title'=> $this->Data->Content('london-presentation-title'),
        'subtitle'=> $this->Data->Content('london-presentation-subtitle'),
        'btn'=>$this->Data->Content('london-1-btn'),
        'btnLink'=>$this->Data->lang_url('contact'),
        'id'=>'london-1'
    ]); ?>

    <div class="requiere-header-color">
        <? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content('london-call-to-action-title'),
        'btn'=> $this->Data->Content('london-call-to-action-btn'),
        'btnLink'=> $this->Data->lang_url('spaces'),

        ]); ?>
    </div>

    <div class="requiere-header-color">
        <? 
        $id = 'london-itb-1';
        $this->load->view('components/image-text-block/index', [
      'imgSide' => 'left',
      'class' => 'white',
      'id' => $id,
      'title'=> $this->Data->Content($id.'-title'),
      'description'=> $this->Data->Content($id.'-description'),
      'btn'=> $this->Data->Content($id.'-btn'),
    ]); ?>

        <? 
        $id = 'london-itb-2';
        $this->load->view('components/image-text-block/index', [
      'imgSide' => 'right pt-0',
      'id' => $id,
      'title'=> $this->Data->Content($id.'-title'),
      'description'=> $this->Data->Content($id.'-description'),
      'btn'=> $this->Data->Content($id.'-btn'),
    ]); ?>

        <? 
        $id = 'london-itb-3';
        $this->load->view('components/image-text-block/index', [
      'imgSide' => 'left pt-0',
      'id' => $id,
      'title'=> $this->Data->Content($id.'-title'),
      'description'=> $this->Data->Content($id.'-description'),
      'btn'=> $this->Data->Content($id.'-btn'),
    ]); ?>



        <? /*$this->load->view('components/carousel/index', [
        'style'=> 'white',
        'id'=>'partners-carousel',

        'title'=> $this->Data->Content('home-carousel-title')
        ]);*/ ?>
    </div>


    <div class="requiere-header-color my-yellow">
        <? 
        $id = "london-gb-";
        $this->load->view('components/grid-boxes/index', [
        'title'=> $this->Data->Content('london-grid-boxes-title'),
        'description'=> $this->Data->Content('london-grid-boxes-description'),
        'style'=>'gray-gray boxes-transparent',
        'boxes' => [
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="43.847" height="44.7" viewBox="0 0 43.847 44.7">
                <g id="Group_216" data-name="Group 216" transform="translate(-626.472 -229.526)">
                  <path id="Path_406" data-name="Path 406" d="M649.148,269.786a18.067,18.067,0,0,1-14.984-12.166" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Path_407" data-name="Path 407" d="M667.835,244.684a18.069,18.069,0,0,1-3.117,19.217" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Path_408" data-name="Path 408" d="M636.309,241.774a18.083,18.083,0,0,1,18.542-7.6" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Ellipse_11" data-name="Ellipse 11" cx="5.755" cy="5.755" r="5.755" transform="translate(627.472 246.109)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Ellipse_12" data-name="Ellipse 12" cx="5.755" cy="5.755" r="5.755" transform="translate(654.45 230.526)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Ellipse_13" data-name="Ellipse 13" cx="5.755" cy="5.755" r="5.755" transform="translate(654.45 261.715)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
              
              ',
                'title' => $this->Data->Content($id.'-title-1'),
                'text' => $this->Data->Content($id.'-text-1')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40.273" height="46.727" viewBox="0 0 40.273 46.727">
                <path id="Path_474" data-name="Path 474" d="M444.467,303.693l.644,5.071H425.158c0-19.7-5.819-18.705-5.819-27.913s5.819-16.814,17.043-16.814,15.962,9.893,17.375,15.63,3.575,14.382,3.575,14.382h-4.24v6.185a3.459,3.459,0,0,1-3.459,3.459H441.12" transform="translate(-418.339 -263.037)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
              </svg>
              ',
                'title' => $this->Data->Content($id.'-title-2'),
                'text' => $this->Data->Content($id.'-text-2')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="64.829" height="64.83" viewBox="0 0 64.829 64.83">
                <g id="Group_218" data-name="Group 218" transform="translate(-709.3 -262.573)">
                  <g id="Group_217" data-name="Group 217">
                    <path id="Path_475" data-name="Path 475" d="M757.022,279.68a6.625,6.625,0,0,1,0-9.367l-6.326-6.326-39.982,39.982,6.326,6.326a6.623,6.623,0,1,1,9.367,9.367l6.326,6.326,39.982-39.982-6.326-6.326A6.625,6.625,0,0,1,757.022,279.68Z" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  </g>
                  <line id="Line_47" data-name="Line 47" y1="22.761" x2="22.761" transform="translate(730.334 283.607)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Line_48" data-name="Line 48" y1="22.761" x2="22.761" transform="translate(726.462 279.735)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Line_49" data-name="Line 49" y1="22.761" x2="22.761" transform="translate(734.205 287.478)" fill="none" stroke="#fbba06" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
                     
              ',
                'title' => $this->Data->Content($id.'-title-3'),
                'text' => $this->Data->Content($id.'-text-3')
            ],
        ]
    ]); ?>

        <style>
        .my-yellow .grid-boxes.grid-boxes-gray-gray svg * {
            stroke: #fbba06 !important;
        }
        </style>
    </div>

    <? 
     $id = 'map-contact-london';
        $this->load->view('components/block-location/london', [
      'id' => $id,
    ]); ?>

    <div class="intro intro-yellow block-contact" id="london-contact">
        <div class="center p-4">
            <div style="max-width: 800px; margin: 0 auto">
                <div class="image-text-block-title"><?= $this->Data->Content($id . '-title') ?></div>
                <div class="image-text-block-form">
                    <form action="<?= base_url('contact') ?>" class="ajaxForm">
                        <input type="text" name="name" class="form-control"
                            placeholder="<?= $this->Data->translate('Nombre', $lang) ?>">

                        <input type="text" name="mail" class="form-control"
                            placeholder="<?= $this->Data->lang('Email') ?>">

                        <select name="country" class="select-control" id="">
                            <option value="0" selected><?= $this->Data->translate("En que estas interesado", $lang); ?>
                            </option>
                            <option value="coworking">Coworking</option>
                            <option value="alquiler"><?= $this->Data->translate("Alquiler de espacios", $lang); ?>
                            </option>
                            <option value="servicios"><?= $this->Data->translate("Servicios B2B", $lang); ?></option>
                        </select>

                        <textarea name="message" class="form-control"
                            placeholder="<?= $this->Data->translate('Comentarios', $lang) ?>"></textarea>



                        <div class="form-bottom">

                            <div class="div">
                                <input type="hidden" name="lang" value="<?= $language ?>">

                                <button
                                    class="btn btn-outline btn-contact-yellow"><?= $this->Data->translate('Enviar', $lang) ?></button>
                                <style>
                                .btn-contact-yellow {
                                    color: #FFF;
                                    background: transparent;
                                    border: solid 2px #FFF;
                                }

                                .btn-contact-yellow:hover {
                                    color: #ffa900;
                                    background: #FFF;
                                    border: solid 2px #FFF;
                                }
                                </style>
                            </div>
                            <div class="div sign-form">
                                <div class="custom-control custom-checkbox liveadmin-settings">

                                    <? 
                                  $id = 'footer_legal_2';
                                  $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_info_links', 'id'=>$id, 'text'=>'Edita enlace terminos']); 
                                  //Agregar clase  al contenedor para flotar btn
                                  $data = $this->Data->GetInfo($id);
                            
                                  if( $data && $data->link ) {
                                    $link = $this->Data->GetInfoPage($data->link);
                            
                                  } else {
                                    $link = (object)[
                                      'id_post'=>'',
                                      'title'=>'',
                                    ];
                                  }
                            
                                ?>
                                    <input type="checkbox" name="check" class="custom-control-input"
                                        id="<?= $id ?>-check1">
                                    <label class="custom-control-label"
                                        for="<?= $id ?>-check1"><?= $this->Data->translate('Acepto los', $lang) ?> <a
                                            href="#<?= prep_word_url($link->title) ?>" data-info="<?= $link->id_post ?>"
                                            class="show_modal_info"><?= $this->Data->translate('términos y condiciones', $lang) ?></a>.</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="send_news" class="custom-control-input"
                                        id="<?= $id ?>-check2">
                                    <label class="custom-control-label"
                                        for="<?= $id ?>-check2"><?= $this->Data->lang('Quiero recibir notícias.') ?></a></label>
                                </div>
                            </div>
                        </div>
                        <div class="d-none alert alert-danger alert-contact">Thanxs</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.select-control {
    margin-bottom: 1rem;
    display: block;
    width: 100%;
    height: -webkit-calc(2.25rem + 2px);
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #313131;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}

.grid-boxes .box .box-title {
    font-size: 1.5em !important;
}
</style>
<script>
ajaxFormCallback['submit-contact-form'] = function() {

    $('.block-contact .form-bottom').after(
        '<b><?= $this->Data->lang(" Gracias por enviarnos tu solicitud, en breve nos pondremos en contacto contigo.") ?></b>'
    ).addClass('alert').addClass('alert-danger').addClass('mt-3');

    $('.form-control').each(function(index, value) {
        $(this).val("");
    });
    $('.select-control').val("");

    fbq('track', 'Lead');
    gtag('event', 'conversion', {
        'event_category': 'Formulario Contacto',
        'event_label': '<?= $lang ?>',
        'action': 'Enviar'
    });

}
</script>