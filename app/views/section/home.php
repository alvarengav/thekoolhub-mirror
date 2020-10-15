<div class="page-home">

    <? $this->load->view('components/image-presentation/index', [
        'title'=> $this->Data->Content('home-presentation-title'),
        'subtitle'=> $this->Data->Content('home-presentation-subtitle'),
        'btn'=>$this->Data->Content('home-presentation-btn'),
        'btnLink'=>$this->Data->lang_url('contact'),
        'id'=>'home-1'
    ]); ?>


    <? $this->load->view('components/bloc-text/index', [
        'text'=> $this->Data->Content('home-bloc-text-text'),
        'btn'=> $this->Data->Content('home-bloc-text-btn'),
        'btnLink'=> $this->Data->lang_url('kool'),
    ]); ?>

    <div class="requiere-header-color">
        <? $this->load->view('components/grid-boxes/index', [
        'title'=> $this->Data->Content('home-grid-boxes-title'),
        'style'=>'gray-bluedark boxes-transparent',
        'boxes' => [
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="48.112" height="42.47" viewBox="0 0 48.112 42.47">
                <path id="Trazado_405" data-name="Trazado 405" d="M382.669,238.231a11.528,11.528,0,1,1,23.056,0,11.528,11.528,0,1,1,23.056,0c0,7.681-4.669,14.286-10,19.414a61.678,61.678,0,0,1-13.056,9.406S382.669,255.3,382.669,238.231Z" transform="translate(-381.669 -225.703)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
              </svg>
              ',
                'title' => $this->Data->Content('home-grid-box-title-1'),
                'text' => $this->Data->Content('home-grid-box-text-1')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="33.929" height="53.544" viewBox="0 0 33.929 53.544">
                <path id="Trazado_404" data-name="Trazado 404" d="M528.876,277.36H542.4v-6.429c0-9.2-3.991-10.642-3.991-14.078s2.217-5.321,2.771-7.538a14.11,14.11,0,0,0,0-5.1c3.769-2.438,3.658-4.212,3.658-4.212-.554-6.872-3.1-6.651-5.321-7.094s-6.318-2.328-6.318-4.1v-2.993h-8.646v2.993c0,1.773-4.1,3.658-6.318,4.1s-4.767.222-5.321,7.094c0,0-.111,1.774,3.658,4.212a14.11,14.11,0,0,0,0,5.1c.554,2.217,2.771,4.1,2.771,7.538s-3.99,4.877-3.99,14.078v6.429Z" transform="translate(-511.912 -224.816)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
              </svg>
              
              ',
                'title' => $this->Data->Content('home-grid-box-title-2'),
                'text' => $this->Data->Content('home-grid-box-text-2')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="43.847" height="44.7" viewBox="0 0 43.847 44.7">
                <g id="Grupo_182" data-name="Grupo 182" transform="translate(-626.472 -229.526)">
                  <path id="Trazado_406" data-name="Trazado 406" d="M649.148,269.786a18.067,18.067,0,0,1-14.984-12.166" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_407" data-name="Trazado 407" d="M667.835,244.684a18.069,18.069,0,0,1-3.117,19.217" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_408" data-name="Trazado 408" d="M636.309,241.774a18.083,18.083,0,0,1,18.542-7.6" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_11" data-name="Elipse 11" cx="5.755" cy="5.755" r="5.755" transform="translate(627.472 246.109)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_12" data-name="Elipse 12" cx="5.755" cy="5.755" r="5.755" transform="translate(654.45 230.526)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_13" data-name="Elipse 13" cx="5.755" cy="5.755" r="5.755" transform="translate(654.45 261.715)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
              
              ',
                'title' => $this->Data->Content('home-grid-box-title-3'),
                'text' => $this->Data->Content('home-grid-box-text-3')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="65.141" height="38.773" viewBox="0 0 65.141 38.773">
                <g id="Grupo_183" data-name="Grupo 183" transform="translate(-742.092 -231.135)">
                  <path id="Trazado_409" data-name="Trazado 409" d="M806,257.643,766.65,268.81,753.443,258.9l6.034-15.367,39.348-11.168Z" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_410" data-name="Trazado 410" d="M762.852,256.233a10.955,10.955,0,0,1-8.023,7.555c-8.934,2.535-11.8-5.125-11.8-5.125" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_411" data-name="Trazado 411" d="M755.651,253.488a13.32,13.32,0,0,0-3.594.533c-8.934,2.536-7.348,10.56-7.348,10.56" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Elipse_14" data-name="Elipse 14" cx="1.092" cy="1.092" r="1.092" transform="translate(761.76 255.141)" stroke="#707070" stroke-width="2"/>
                </g>
              </svg>
              ',
                'title' => $this->Data->Content('home-grid-box-title-4'),
                'text' => $this->Data->Content('home-grid-box-text-4')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="53.043" height="39.116" viewBox="0 0 53.043 39.116">
                <g id="Grupo_184" data-name="Grupo 184" transform="translate(-863.755 -230.499)">
                  <path id="Trazado_412" data-name="Trazado 412" d="M913.911,240.292l-23.635,8.727-23.635-8.727,23.635-8.727Z" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_413" data-name="Trazado 413" d="M890.277,264.014c-7.419,0-16.014-1.642-17.269-3.863V248.466" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Trazado_414" data-name="Trazado 414" d="M890.277,264.014c7.418,0,16.013-1.642,17.269-3.863V248.466" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                  <line id="Línea_39" data-name="Línea 39" y2="25.592" transform="translate(912.603 244.023)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
              
              ',
                'title' => $this->Data->Content('home-grid-box-title-5'),
                'text' => $this->Data->Content('home-grid-box-text-5')
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="34.589" height="49.053" viewBox="0 0 34.589 49.053">
                <path id="Trazado_415" data-name="Trazado 415" d="M1016.508,247.059a3.885,3.885,0,0,1-3.71,2.426,4.167,4.167,0,0,1-4.166-4.167c0-2.962,2.487-4.453,2.222-8.054-.463-6.3-4.753-8.6-8.641-9.806a13.323,13.323,0,0,1,.216,6.936c-1.389,4.906-10.184,10.554-12.526,15.486a18.219,18.219,0,0,0-2.009,7.844,16.294,16.294,0,1,0,28.614-10.665Z" transform="translate(-986.894 -225.966)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2"/>
              </svg>
              
              ',
                'title' => $this->Data->Content('home-grid-box-title-6'),
                'text' => $this->Data->Content('home-grid-box-text-6')
            ],
           
        ]
    ]); ?>
    </div>


    <div id="skool"></div>
    <? $id = 'home-kool-gbg-'; 
    $this->load->view('components/grid-boxes-green/index', [
        'id'=>$id,
        'btnLink'=> $this->Data->lang_url('spaces'),

        'boxes' => [
            [
                'title' => $this->Data->Content($id.'-title-1'),
                'text' => $this->Data->Content($id.'-subtitle-1')
            ],
            [
                'title' => $this->Data->Content($id.'-title-2'),
                'text' => $this->Data->Content($id.'-subtitle-2')
            ],
            [
                'title' => $this->Data->Content($id.'-title-3'),
                'text' => $this->Data->Content($id.'-subtitle-3')
            ],
            [
                'title' => $this->Data->Content($id.'-title-4'),
                'text' => $this->Data->Content($id.'-subtitle-4')
            ],
        ]
    ]); ?>

    <? $this->load->view('components/text-and-grid/index', [
        'title'=> $this->Data->Content('home-text-and-grid-title'),
        'text'=> $this->Data->Content('home-text-and-grid-text'),
        'btn'=> $this->Data->Content('home-text-and-grid-btn'),
        'btnLink'=> $this->Data->lang_url('community'),

        'id'=>'kool-members'
        ]); ?>

    <div class="requiere-header-color">

        <? $this->load->view('components/news-grid/index', [
        
    'title'=> $this->Data->Content('home-news-grid-title'),
    'text'=> $this->Data->Content('home-news-grid-text'),
    'btn'=> $this->Data->Content('home-new-grid-btn'),
    'btnLink'=> $this->Data->lang_url('news'),
    'id' => 'home-news'
    ]); ?>

        <? $this->load->view('components/carousel/index', [
        'title'=> $this->Data->Content('home-carousel-title'),
        'id'=>'partners-carousel'
        ]); ?>
    </div>

    <? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        'btnLink'=> $this->Data->lang_url('contact'),
    ]); ?>

    <? $this->load->view('components/instagram-grid/index'); ?>

</div>