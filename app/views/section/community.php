<div class="page-home">
    <? $this->load->view('components/intro/index', [
      'color'=>'yellow',
      'title'=> $this->Data->Content('community-intro-title'),
      'subtitle'=> $this->Data->Content('community-intro-subtitle'),
      'contentTitle'=> $this->Data->Content('community-intro-contentTitle'),
      'contentDescription'=> $this->Data->Content('community-intro-contentDescription')
    ]); ?>

    <div class="requiere-header-color">
        <? /*
      $id = 'community-intro2-btb-';
      
      $this->load->view('components/basic-text-block/index', [
        'title'=> $this->Data->Content($id.'-title'),
        'description'=> $this->Data->Content($id.'-description'),
        'style'=>'gray1'
        ]);*/ ?>

        <? $this->load->view('components/vertical-gallery-and-text/index', [
        'title'=> $this->Data->Content('cm-community-vertical-gallery-and-text-title'),
        'description'=> $this->Data->Content('cm-community-vertical-gallery-and-text-description'),
        'btn'=> $this->Data->Content('cm-community-vertical-gallery-and-text-btn'),
        'btnLink'=> $this->Data->lang_url('contact'),
        'down'=> $this->Data->Content('cm-community-vertical-gallery-and-text-down'),
        'id'=>'cm-showroom-gallery',
        ]); ?>

        <? $this->load->view('components/info-table/index', [
        'style'=>'gray1 pt-0',
        'id'=>'table_services',
        'btn'=> $this->Data->Content('community-info-table-btn'),
        'btnLink'=> $this->Data->lang_url('contact'),

    ]); ?>

        <? /*$this->load->view('components/carousel/index', [
    'title'=> $this->Data->Content('community-carousel-title'),
    'id'=>'community-carousel',
    'style'=>'white'
    ]);*/ ?>

        <? $this->load->view('components/text-and-grid/index', [
        'title'=> $this->Data->Content('home-text-and-grid-title'),
        'text'=> $this->Data->Content('home-text-and-grid-text'),
        'btn'=> $this->Data->Content('home-text-and-grid-btn'),
        'btnLink'=> $this->Data->lang_url('community'),
          'style' => 'darkblue-white-button',
        'id'=>'kool-members'
        ]); ?>
    </div>





    <? $this->load->view('components/vertical-gallery-and-text/index', [
        'title'=> $this->Data->Content('community-vertical-gallery-and-text-title2'),
        'description'=> $this->Data->Content('community-vertical-gallery-and-text-description2'),
        'btn'=> $this->Data->Content('community-vertical-gallery-and-text-btn2'),
        'down'=> $this->Data->Content('community-vertical-gallery-and-text-down2'),
        'id'=>'coworking_gallery',
        'style'=>'darkblue',
        'imgSide' => 'right',
        ]); ?>




    <? $this->load->view('components/info-table/index-add-btns', [
    'style'=>'darkblue  pt-0',
    'id'=>'table_services2',
    'btn'=> false,
    ]); ?>




    <div class="requiere-header-color">
        <? 
        $id = "community-gb-";
        $this->load->view('components/grid-boxes/col-3', [
        'title'=> $this->Data->Content('home-grid-boxes-title'),
        'style'=>'gray-gray boxes-transparent',
        'boxes' => [
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="50.418" height="40.088" viewBox="0 0 50.418 40.088">
                <g id="Grupo_189" data-name="Grupo 189" transform="translate(-260.768 -471.102)">
                  <circle id="Elipse_22" data-name="Elipse 22" cx="4.23" cy="4.23" r="4.23" transform="translate(272.905 472.102)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_423" data-name="Trazado 423" d="M271.479,488.715v-4.044a1.97,1.97,0,0,1,1.97-1.97h7.371a1.97,1.97,0,0,1,1.97,1.97v4.044" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_23" data-name="Elipse 23" cx="4.23" cy="4.23" r="4.23" transform="translate(290.28 472.102)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_424" data-name="Trazado 424" d="M288.854,488.715v-4.044a1.97,1.97,0,0,1,1.97-1.97H298.2a1.971,1.971,0,0,1,1.971,1.97v4.044" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_24" data-name="Elipse 24" cx="4.23" cy="4.23" r="4.23" transform="translate(282.064 494.577)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_425" data-name="Trazado 425" d="M280.638,511.19v-4.044a1.971,1.971,0,0,1,1.97-1.971h7.371a1.972,1.972,0,0,1,1.971,1.971v4.044" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_426" data-name="Trazado 426" d="M278.085,506.942h-15.98l4.573-15.505h37.356l5.717,15.505H294.51" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
              
              ',
                'title' => $this->Data->Content($id.'-title-1'),
                'text' => $this->Data->Content($id.'-text-1')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="52.644" height="36.248" viewBox="0 0 52.644 36.248">
                <g id="Grupo_190" data-name="Grupo 190" transform="translate(-388.812 -472.869)">
                  <circle id="Elipse_25" data-name="Elipse 25" cx="1.399" cy="1.399" r="1.399" transform="translate(413.735 505.318)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_427" data-name="Trazado 427" d="M403.624,498.382a19.789,19.789,0,0,1,22.57-.313" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_428" data-name="Trazado 428" d="M396.737,491.105a27.845,27.845,0,0,1,37.538.679" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_429" data-name="Trazado 429" d="M389.519,484.48a36.224,36.224,0,0,1,51.23,0" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
              ',
                'title' => $this->Data->Content($id.'-title-2'),
                'text' => $this->Data->Content($id.'-text-2')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="59.263" height="24.466" viewBox="0 0 59.263 24.466">
                <g id="Grupo_191" data-name="Grupo 191" transform="translate(-509.513 -479.551)">
                  <circle id="Elipse_26" data-name="Elipse 26" cx="11.233" cy="11.233" r="11.233" transform="translate(510.513 480.551)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_40" data-name="Línea 40" x1="35.797" transform="translate(532.979 491.784)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_41" data-name="Línea 41" y1="8.559" transform="translate(564.317 491.784)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_42" data-name="Línea 42" y1="5.268" transform="translate(554.55 491.784)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
                     
              ',
                'title' => $this->Data->Content($id.'-title-3'),
                'text' => $this->Data->Content($id.'-text-3')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="38.785" height="49.513" viewBox="0 0 38.785 49.513">
                <g id="Grupo_192" data-name="Grupo 192" transform="translate(-624.884 -460.951)">
                  <path id="Trazado_430" data-name="Trazado 430" d="M662.669,481.278a74,74,0,0,0-18.393-2.392,63.657,63.657,0,0,0-18.392,2.392v28.186h36.785Z" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_27" data-name="Elipse 27" cx="3.589" cy="3.589" r="3.589" transform="translate(640.688 486.512)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_43" data-name="Línea 43" y1="6.056" transform="translate(644.276 493.689)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_431" data-name="Trazado 431" d="M633.174,479.717v-6.663a11.1,11.1,0,1,1,22.205,0v6.663" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
                  
              ',
                'title' => $this->Data->Content($id.'-title-4'),
                'text' => $this->Data->Content($id.'-text-4')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="45.472" height="32.588" viewBox="0 0 45.472 32.588">
                <g id="Grupo_193" data-name="Grupo 193" transform="translate(-740.714 -477.395)">
                  <rect id="Rectángulo_112" data-name="Rectángulo 112" width="30.588" height="30.588" transform="translate(741.714 478.395)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_432" data-name="Trazado 432" d="M752.789,493.689l8.965,7.914,23.732-23.208" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
                      
              ',
                'title' => $this->Data->Content($id.'-title-5'),
                'text' => $this->Data->Content($id.'-text-5')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="50.892" height="35.408" viewBox="0 0 50.892 35.408">
                <g id="Grupo_194" data-name="Grupo 194" transform="translate(-846.803 -478.513)">
                  <path id="Trazado_433" data-name="Trazado 433" d="M872.249,479.513h-20.2v10.453" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_434" data-name="Trazado 434" d="M872.249,497.915h-16.5v-7.949H847.8V506.19h24.446" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_44" data-name="Línea 44" y1="7.731" transform="translate(852.05 506.19)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_435" data-name="Trazado 435" d="M872.249,479.513h20.2v10.453" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_436" data-name="Trazado 436" d="M872.249,497.915h16.5v-7.949H896.7V506.19H872.249" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_45" data-name="Línea 45" y1="7.731" transform="translate(892.449 506.19)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
                 
              ',
                'title' => $this->Data->Content($id.'-title-6'),
                'text' => $this->Data->Content($id.'-text-6')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="47.611" height="44.114" viewBox="0 0 47.611 44.114">
                <g id="Grupo_195" data-name="Grupo 195" transform="translate(-950.863 -466.948)">
                  <path id="Trazado_437" data-name="Trazado 437" d="M990.332,494.711c0,9.684-8.069,15.351-18.022,15.351s-18.023-5.588-18.023-15.351V482.988h36.045Z" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_438" data-name="Trazado 438" d="M990.155,486.589a7.319,7.319,0,1,1-1.207,14.539" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_46" data-name="Línea 46" x2="42.893" transform="translate(950.863 510.062)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_439" data-name="Trazado 439" d="M968.342,477.086c1.419-1.878,1.012-3.285.167-4.975s-1.057-3.222.3-4.411" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_440" data-name="Trazado 440" d="M976.654,477.086c1.418-1.878,1.011-3.285.167-4.975s-1.058-3.222.3-4.411" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
              
              
              ',
                'title' => $this->Data->Content($id.'-title-7'),
                'text' => $this->Data->Content($id.'-text-7')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="33.929" height="53.544" viewBox="0 0 33.929 53.544">
                <path id="Trazado_441" data-name="Trazado 441" d="M409.846,160.75H423.37v-6.429c0-9.2-3.991-10.641-3.991-14.078s2.217-5.32,2.771-7.537a14.084,14.084,0,0,0,0-5.1c3.769-2.439,3.658-4.212,3.658-4.212-.554-6.873-3.1-6.651-5.32-7.095s-6.319-2.327-6.319-4.1v-2.993h-8.646V112.2c0,1.774-4.1,3.658-6.318,4.1s-4.766.222-5.321,7.095c0,0-.111,1.773,3.658,4.212a14.109,14.109,0,0,0,0,5.1c.555,2.217,2.771,4.1,2.771,7.537s-3.99,4.878-3.99,14.078v6.429Z" transform="translate(-392.882 -108.206)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
              </svg>
              
              
              ',
                'title' => $this->Data->Content($id.'-title-8'),
                'text' => $this->Data->Content($id.'-text-8')
            ],
           
        ]
    ]); ?>


    </div>
    <? 
$id = 'community-members';
$this->load->view('components/text-and-grid2/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content($id.'-title'),
        'text'=> $this->Data->Content($id.'-text'),
        'btn'=> $this->Data->Content($id.'-btn'),
        'id'=>$id
        ]); ?>

    <div class="requiere-header-color">
        <? 
        $id = 'community-itb-1';
        $this->load->view('components/image-text-block/index', [
      'imgSide' => 'left',
      'id' => $id,
      'title'=> $this->Data->Content($id.'-title'),
      'description'=> $this->Data->Content($id.'-description')
    ]); ?>

        <? 
        $id = 'community-itb-2';
        $this->load->view('components/image-text-block/index', [
      'imgSide' => 'right pt-0',
      'id' => $id,
      'title'=> $this->Data->Content($id.'-title'),
      'description'=> $this->Data->Content($id.'-description')
    ]); ?>

        <? 
        $id = 'community-itb-3';
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

    <div class="requiere-header-color block-contact">
        <div class="image-text-block-form wow2 sweepToLeft image-text-block-left pt-0 liveadmin-settings yellow white-button in bg-white no-padding">
            <div class="image-text-block-content wow2 w2FadeIn bg-gray padding-3" data-wow2-delay="900">
                <div style="width:100%">
                    <!-- Begin Mailchimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                        #mc_embed_signup {
                            background: #fff;
                            clear: left;
                            font: 14px Helvetica, Arial, sans-serif;
                        }

                        #mc_embed_signup {
                            background: transparent !important;
                        }

                        #mc_embed_signup form {
                            padding: 0 !important;
                        }

                        #mc-embedded-subscribe {
                            margin-left: 0 !important;
                        }

                        #mc_embed_signup input {
                            border-radius: 0 !important;
                            margin-bottom: 5px;
                            padding: 1.7rem 1rem;
                            border: 0 !important;
                        }

                        #mc_embed_signup input[type="submit"] {
                            padding-top: 7px !important;
                            padding-bottom: 7px !important;
                        }

                        #mc_embed_signup h2 {
                            font-size: 2.5em;
                            margin-bottom: 1rem;
                            line-height: 1.2em;
                        }

                        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                        <form data-action="<?= base_url('ajax_subscribe') ?>" noaction="https://_thekoolhub.us4.list-manage.com/subscribe/post?u=06db20708c0634f21dd9424bc&amp;id=b7c3a7efbf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                            <div id="mc_embed_signup_scroll">
                                <? 
                                $id = 'community-chimp-form';
                                $this->load->view('components/basic-text-block/only-title', [
                                'title'=> $this->Data->Content($id.'-title'),
                                ]); ?>
                                <input type="hidden" name="form" value="community">
                                <div class="indicates-required"><span class="asterisk">*</span> Required fields</div>
                                <input type="email" placeholder="<?= $this->Data->lang('Email') ?>" value="" name="EMAIL" class="form-control required email" id="mce-EMAIL">
                                <input type="text" placeholder="<?= $this->Data->translate('Nombre', $lang) ?>" value="" name="FNAME" class="form-control" id="mce-FNAME">
                                <input type="text" placeholder="<?= $this->Data->translate('Apellido', $lang) ?>" value="" name="LNAME" class="form-control" id="mce-LNAME">
                                <input type="text" placeholder="<?= $this->Data->translate('Empresa', $lang) ?>" value="" name="MMERGE3" class="form-control" id="mce-MMERGE3">
                                <input type="text" placeholder="<?= $this->Data->translate('Teléfono', $lang) ?>" name="MMERGE4" class="form-control" value="" id="mce-MMERGE4">

                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <!-- <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_06db20708c0634f21dd9424bc_b7c3a7efbf" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-black"></div> -->
                                <!-- Sección que contiene los checkbox de terminos y condiciones -->
                                <div class="form-bottom">
                                    <div class="div">
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_06db20708c0634f21dd9424bc_b7c3a7efbf" tabindex="-1" value=""></div>
                                        <input type="hidden" name="lang" value="<?= $language ?>">


                                        <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-black" disabled>
                                        <!-- <button class="btn btn-outline"><?= $this->Data->translate('Enviar', $lang) ?></button> -->

                                    </div>

                                    <div class="div sign-form">

                                        <div class="custom-control custom-checkbox liveadmin-settings">
                                            <? 

                                  $id = 'footer_legal_2';

                                  $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_info_links', 'id'=>$id, 'text'=>'Edita enlace terminos']); 

                                //   //Agregar clase  al contenedor para flotar btn

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


                                            <input type="checkbox" name="check" class="custom-control-input input-check" id="<?= $id ?>-check1">

                                            <label class="custom-control-label" for="<?= $id ?>-check1"><?= $this->Data->translate('Acepto los', $lang) ?> <a href="#<?= prep_word_url($link->title) ?>" data-info="<?= $link->id_post ?>" class="show_modal_info"><?= $this->Data->translate('términos y condiciones', $lang) ?></a>.</label>

                                        </div>

                                        <div class="custom-control custom-checkbox">

                                            <input type="checkbox" name="send_news" class="custom-control-input input-check" id="<?= $id ?>-check2">

                                            <label class="custom-control-label" for="<?= $id ?>-check2"><?= $this->Data->lang('Quiero recibir notícias.') ?></a></label>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'>
                    </script>
                    <script type='text/javascript'>
                        (function($) {
                            window.fnames = new Array();
                            window.ftypes = new Array();
                            fnames[0] = 'EMAIL';
                            ftypes[0] = 'email';
                            fnames[1] = 'FNAME';
                            ftypes[1] = 'text';
                            fnames[2] = 'LNAME';
                            ftypes[2] = 'text';
                            fnames[3] = 'MMERGE3';
                            ftypes[3] = 'text';
                            fnames[4] = 'MMERGE4';
                            ftypes[4] = 'phone';
                        }(jQuery));
                        var $mcj = jQuery.noConflict(true);
                    </script>
                    <!--End mc_embed_signup-->
                    <!--End mc_embed_signup-->
                </div>
            </div>
            <div class="image-text-block-content wow2 w2FadeIn in" data-wow2-delay="900">
                <div class="requiere-header-color">
                    <? 
                    $id = 'community-chimp';
                    $this->load->view('components/basic-text-block/align-left', [
                    'title'=> $this->Data->Content($id.'-title'),
                    'description'=> $this->Data->Content($id.'-description')
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        
    ]); ?>
</div>

<?php $this->load->view('common/subscribe-form-js'); ?>