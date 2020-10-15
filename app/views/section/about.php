<div class="page-home">

    <? $this->load->view('components/intro/index', [
      'color'=>'bluedark',
      'title'=> $this->Data->Content('about-intro-title'),
      'subtitle'=> $this->Data->Content('about-intro-subtitle'),
      'contentTitle'=> $this->Data->Content('about-intro-contentTitle'),
      'contentDescription'=> $this->Data->Content('about-intro-contentDescription')
    ]); ?>

    <div class="requiere-header-color">

        <? $this->load->view('components/image-text-block/index', [
    'imgSide' => 'left',
    'img' => layout('img/home.jpg'),
      'title'=> $this->Data->Content('about-textBlock2-title'),
      'description'=> $this->Data->Content('about-textBlock2-description'),
      'id'=>'about-imt-1',
      ]); ?>

        <? $this->load->view('components/image-text-block/index', [
  'imgSide' => 'right pt-0',
  'img' => layout('img/home.jpg'),
  'title'=> $this->Data->Content('about-textBlock3-title'),
  'description'=> $this->Data->Content('about-textBlock3-description'),
  'id'=>'about-imt-2'
  ]); ?>

        <? $this->load->view('components/call-to-action/index', [
  'style'=>'yellow white-button',
  'title'=> $this->Data->Content('about-call-to-action-title'),
  'btn'=> $this->Data->Content('about-call-to-action-btn'),
  'btnLink'=> $this->Data->lang_url('spaces'),

  ]); ?>
    </div>

    <? $this->load->view('components/text-and-items/index', [
        'title'=> $this->Data->Content('about-circle-images-and-texts-title'),
        'style'=> 'gray text-black',
        'id'=>'about-green-membes',
        'boxes' => [
          [
            'title' => $this->Data->Content('about-circle-images-and-texts-title-1'),
            'text' => $this->Data->Content('about-circle-images-and-texts-text-1'),
            'svg'=>'<svg xmlns="http://www.w3.org/2000/svg" width="83.14" height="83.14" viewBox="0 0 83.14 83.14">
            <g id="Grupo_188" data-name="Grupo 188" transform="translate(-613.281 -234.859)">
              <circle id="Elipse_20" data-name="Elipse 20" cx="40.57" cy="40.57" r="40.57" transform="translate(614.281 235.859)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
              <path id="Trazado_422" data-name="Trazado 422" d="M630.185,276.429s9.084,14.045,24.666,14.045,24.666-14.045,24.666-14.045-9.084-14.045-24.666-14.045S630.185,276.429,630.185,276.429Z" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
              <circle id="Elipse_21" data-name="Elipse 21" cx="10.481" cy="10.481" r="10.481" transform="translate(644.37 265.948)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
            </g>
          </svg>
          '
          ],
          [
            'title' => $this->Data->Content('about-circle-images-and-texts-title-2'),
            'text' => $this->Data->Content('about-circle-images-and-texts-text-2'),
            'svg'=>'<svg xmlns="http://www.w3.org/2000/svg" width="84.945" height="84.07" viewBox="0 0 84.945 84.07">
            <g id="Grupo_186" data-name="Grupo 186" transform="translate(-483.11 -230.712)">
              <g id="Grupo_185" data-name="Grupo 185">
                <path id="Trazado_417" data-name="Trazado 417" d="M522.333,313.789a40.055,40.055,0,0,1-33.221-26.975" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
                <path id="Trazado_418" data-name="Trazado 418" d="M563.763,258.135a40.053,40.053,0,0,1-6.909,42.606" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
                <path id="Trazado_419" data-name="Trazado 419" d="M493.867,251.683a40.076,40.076,0,0,1,41.111-16.854" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
                <circle id="Elipse_16" data-name="Elipse 16" cx="4.147" cy="4.147" r="4.147" transform="translate(534.978 231.712)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
                <circle id="Elipse_17" data-name="Elipse 17" cx="4.147" cy="4.147" r="4.147" transform="translate(550.071 299.559)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
                <circle id="Elipse_18" data-name="Elipse 18" cx="4.147" cy="4.147" r="4.147" transform="translate(484.11 278.52)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
              </g>
              <path id="Trazado_420" data-name="Trazado 420" d="M535.008,287.225l.644,5.071H515.7c0-19.7-5.819-18.7-5.819-27.913s5.819-16.813,17.042-16.813,15.962,9.893,17.376,15.629,3.575,14.382,3.575,14.382h-4.24v6.185a3.459,3.459,0,0,1-3.459,3.459h-8.513" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
            </g>
          </svg>
          
          '
          ],
          [
            'title' => $this->Data->Content('about-circle-images-and-texts-title-3'),
            'text' => $this->Data->Content('about-circle-images-and-texts-text-3'),
            'svg'=>'<svg xmlns="http://www.w3.org/2000/svg" width="83.14" height="83.14" viewBox="0 0 83.14 83.14">
            <g id="Grupo_187" data-name="Grupo 187" transform="translate(-340.487 -234.859)">
              <path id="Trazado_421" data-name="Trazado 421" d="M382.057,292.738l-14.628,5.2.427-15.519-9.467-12.3,14.892-4.39,8.777-12.806,8.777,12.806,14.892,4.39-9.467,12.3.427,15.519Z" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
              <circle id="Elipse_19" data-name="Elipse 19" cx="40.57" cy="40.57" r="40.57" transform="translate(341.487 235.859)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"/>
            </g>
          </svg>
          
          '
          ],
        ]
    ]); ?>



    <? $this->load->view('components/text-and-grid/index', [
        'title'=> $this->Data->Content('about-text-and-grid-title'),
        'text'=> $this->Data->Content('about-text-and-grid-text'),
        'btn'=> $this->Data->Content('about-text-and-grid-btn'),
        'btnLink'=> $this->Data->lang_url('community'),

        'id'=>'kool-about-members'
        ]); ?>


    <? 
        $id = 'about-kool-team-textb-';
        $this->load->view('components/basic-text-block/index', [
          'style'=> ' basic-text-block bg-gray1',
          'title'=> $this->Data->Content($id.'-title'),
          'description'=> $this->Data->Content($id.'-description'),
          'btn'=> false,
          'btnLink'=> false,
          ]); ?>
</div>


<? /*$this->load->view('components/text-and-grid2/index', [
        'style'=>'pink',
        'title'=> $this->Data->Content('cowork-members-title'),
        'text'=> $this->Data->Content('cowork-members-text'),
        'btn'=> $this->Data->Content('cowork-members-btn'),
        'id'=>'kool-team'

        ]);*/ ?>

<?
$id = 'about-member-4-';
  $this->load->view('components/image-text-block/index', [
  'imgSide' => 'left custom pt-0',
  'img' => layout('img/home.jpg'),
  'title'=> $this->Data->Content($id.'-title'),
  'description'=> $this->Data->Content($id.'-description'),
  'linkedin'=> $this->Data->Content($id.'-linkedin'),
  'linkedin_btn'=> $this->Data->Content($id.'-linkedin-btn'),
  'btn'=>false,
  'id'=>$id
  ]); ?>

<?
$id = 'about-member-1-';
  $this->load->view('components/image-text-block/index', [
  'imgSide' => 'right custom pt-0',
  'img' => layout('img/home.jpg'),
  'title'=> $this->Data->Content($id.'-title'),
  'description'=> $this->Data->Content($id.'-description'),
  'linkedin'=> $this->Data->Content($id.'-linkedin'),
  'linkedin_btn'=> $this->Data->Content($id.'-linkedin-btn'),
  'btn'=>false,
  'id'=>$id
  ]); ?>
<?
$id = 'about-member-2-';
  $this->load->view('components/image-text-block/index', [
  'imgSide' => 'left custom pt-0',
  'img' => layout('img/home.jpg'),
  'title'=> $this->Data->Content($id.'-title'),
  'description'=> $this->Data->Content($id.'-description'),
  'linkedin'=> $this->Data->Content($id.'-linkedin'),
  'linkedin_btn'=> $this->Data->Content($id.'-linkedin-btn'),
  'btn'=>false,
  'id'=>$id
  ]); ?>
<? 
$id = 'about-member-3-';
  $this->load->view('components/image-text-block/index', [
  'imgSide' => 'right custom pt-0',
  'img' => layout('img/home.jpg'),
  'title'=> $this->Data->Content($id.'-title'),
  'description'=> $this->Data->Content($id.'-description'),
  'linkedin'=> $this->Data->Content($id.'-linkedin'),
  'linkedin_btn'=> $this->Data->Content($id.'-linkedin-btn'),
  'btn'=>false,
  'id'=>$id,
  'style'=>'without-linkedin'
  ]); ?>
<div class="requiere-header-color">

    <? /*$this->load->view('components/full-img/index', [
        'id'=>'about-image',
        'img'=>layout('img/image1_1441_1x.png'),
        ]); */ ?>
</div>
<? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        
    ]); ?>
</div>