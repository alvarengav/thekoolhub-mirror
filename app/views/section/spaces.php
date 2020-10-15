<div class="page-spaces">
    <? $this->load->view('components/intro/index', [
      'color'=>'yellow',
      'title'=> $this->Data->Content('spaces-intro-title'),
      'subtitle'=> $this->Data->Content('spaces-intro-subtitle'),
      'contentTitle'=> $this->Data->Content('spaces-intro-contentTitle'),
      'contentDescription'=> $this->Data->Content('spaces-intro-contentDescription')
    ]); ?>



    <? 
      $id = 'spaces-subintro-';
      
      $this->load->view('components/basic-text-block/index', [
        'title'=> $this->Data->Content($id.'-title'),
        'description'=> $this->Data->Content($id.'-description'),
        'style'=>'white'
        ]);?>

    <div id="showroom"></div>

    <? $this->load->view('components/vertical-gallery-and-text/index', [
        'title'=> $this->Data->Content('community-vertical-gallery-and-text-title'),
        'description'=> $this->Data->Content('community-vertical-gallery-and-text-description'),
        'btn'=> $this->Data->Content('community-vertical-gallery-and-text-btn'),
        'down'=> $this->Data->Content('community-vertical-gallery-and-text-down'),
        'style'=>'white no-padding-top',
        'id'=>'showroom-gallery',
        'btnLink'=> $this->Data->lang_url('contact'),

        ]); ?>

</div>

<div id="kool-lounge"></div>

<? 
    $id = 'kool-lounge-vgat';
        $this->load->view('components/vertical-gallery-and-text/index', [
        'title'=> $this->Data->Content($id.'-title2'),
        'description'=> $this->Data->Content($id.'-description2'),
        'btn'=> $this->Data->Content($id.'-btn2'),
        'down'=> $this->Data->Content($id.'-down2'),
        'id'=>$id,
        'style'=>'darkblue white-button',
        'imgSide' => 'right',
        'btnLink'=> $this->Data->lang_url('contact'),

        ]); ?>


<div id="skool"></div>
<? 
    $id = 'skool-vgat';
$this->load->view('components/vertical-gallery-and-text/index', [
    'title'=> $this->Data->Content($id.'-title2'),
    'description'=> $this->Data->Content($id.'-description2'),
    'id'=>$id,
    'style'=>'gray dark-button',
    'imgSide' => 'left',
    'btn'=> $this->Data->Content($id.'-btn'),
    ]); ?>

</div>

<? /*
<div id="meeting-room"></div>

    <?
    $id = 'meeting-room-spaces-vgat';
    $this->load->view('components/vertical-gallery-and-text/index', [
        'title'=> $this->Data->Content($id.'-title2'),
        'description'=> $this->Data->Content($id.'-description2'),
        'btn'=> $this->Data->Content($id.'-btn'),
        'btn2'=> $this->Data->Content($id.'-btn2'),
        'id'=>$id,
        'style'=>'green',
        'imgSide' => 'right',

        'btn'=> $this->Data->Content($id.'-btn'),
        ]); ?>

*/ ?>

<div id="common-spaces"></div>
<div class="requiere-header-color">

    <?
    $id = 'comunal-spaces-vgat';
$this->load->view('components/vertical-gallery-and-text/wihoutbtns', [
    'title'=> $this->Data->Content($id.'-title2'),
    'description'=> $this->Data->Content($id.'-description2'),
    'id'=>$id,
    'style'=>'gray',
    'imgSide' => 'right',
    ]); ?>

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
    <div class="image-text-block wow2 sweepToLeft image-text-block-left pt-0 liveadmin-settings yellow white-button in bg-white no-padding">
        <div class="image-text-block-content wow2 w2FadeIn bg-gray padding-3" data-wow2-delay="900">
            <div style="width:100%">
                <div class="image-text-block-form">
                    <!-- Begin Mailchimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                        #mc_embed_signup {
                            background: #fff;
                            clear: left;
                            font: 14px Helvetica, Arial, sans-serif;
                        }

                        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                            We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
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
                    </style>
                    <?php echo $this->config->item('lang', 'app'); ?>
                    <div id="mc_embed_signup">
                        <form data-action="<?= base_url('ajax_subscribe') ?>" noaction="https://xdthekoolhub.us4.list-manage.com/subscribe/post?u=06db20708c0634f21dd9424bc&amp;id=c6534103a5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                            <div id="mc_embed_signup_scroll">
                                <? 
                                $id = 'space-chimp-form';
                                $this->load->view('components/basic-text-block/only-title', [
                                'title'=> $this->Data->Content($id.'-title'),
                                ]); ?>
                                <input type="hidden" name="form" value="spaces">
                                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                                <input type="email" placeholder="<?= $this->Data->lang('Email') ?>" value="" name="EMAIL" class="form-control required email" id="mce-EMAIL">
                                <input type="text" placeholder="<?= $this->Data->translate('Nombre', $lang) ?>" value="" name="FNAME" class="form-control" id="mce-FNAME">
                                <input type="text" placeholder="<?= $this->Data->translate('Apellido', $lang) ?>" value="" name="LNAME" class="form-control" id="mce-LNAME">
                                <input type="text" placeholder="<?= $this->Data->translate('Empresa', $lang) ?>" value="" name="MMERGE5" class="form-control" id="mce-MMERGE5">
                                <input type="text" placeholder="<?= $this->Data->translate('Teléfono', $lang) ?>" name="MMERGE3" class="form-control" value="" id="mce-MMERGE3">
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_06db20708c0634f21dd9424bc_c6534103a5" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-black"></div>
                                <!-- Sección que contiene los checkbox de terminos y condiciones -->
                                <div class="form-bottom">



                                    <div class="div">

                                        <input type="hidden" name="lang" value="<?= $language ?>">



                                        <button class="btn btn-outline"><?= $this->Data->translate('Enviar', $lang) ?></button>

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
                                            <!-- fin seccion terminos y condiciones -->

                                            
                                            <input type="checkbox" name="check" class="custom-control-input" id="<?= $id ?>-check1">

                                            <label class="custom-control-label" for="<?= $id ?>-check1"><?= $this->Data->translate('Acepto los', $lang) ?> <a href="#<?= prep_word_url($link->title) ?>" data-info="<?= $link->id_post ?>" class="show_modal_info"><?= $this->Data->translate('términos y condiciones', $lang) ?></a>.</label>

                                        </div>

                                        <div class="custom-control custom-checkbox">

                                            <input type="checkbox" name="send_news" class="custom-control-input" id="<?= $id ?>-check2">

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
                            fnames[5] = 'MMERGE5';
                            ftypes[5] = 'text';
                            fnames[3] = 'MMERGE3';
                            ftypes[3] = 'phone';
                        }(jQuery));
                        var $mcj = jQuery.noConflict(true);
                    </script>
                    <!--End mc_embed_signup-->
                </div>
            </div>
        </div>
        <div class="image-text-block-content wow2 w2FadeIn in" data-wow2-delay="900">
            <div class="requiere-header-color">
                <? 
                $id = 'space-chimp';
                $this->load->view('components/basic-text-block/align-left', [
                'title'=> $this->Data->Content($id.'-title'),
                'description'=> $this->Data->Content($id.'-description')
                ]); ?>
            </div>
        </div>
    </div>


    <? $this->load->view('components/call-to-action/index', [
        'style'=>'yellow white-button',
        'title'=> $this->Data->Content('home-call-to-action-title'),
        'btn'=> $this->Data->Content('home-call-to-action-btn'),
        
    ]); ?>
</div>

<script>
    $(document).on('click', '#mc-embedded-subscribe', function(e) {
        $this = $('#mc-embedded-subscribe-form');

        var inputs = $this.find(':input.form-control:not(#mce-LNAME, #mce-MMERGE5, #mce-MMERGE3)');

        //validando que los inputs no esten vacíos
        var invalid = false;
        inputs.each(function(index, input) {
            if (!input.value) {
                invalid = true;
                return false;
            }
        });

        // if (invalid) return;

        inputEmail = $this.find("#mce-EMAIL");

        // if (!isValidEmail(inputEmail.val())) return;

        function isValidEmail(email) {
            return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email);
        }

        $.ajax({
            type: "POST",
            url: $this.attr('data-action'),
            data: $this.serialize(),
            dataType: 'JSON',
        }).done(function(response) {
            console.log('subscriptor registered in database');
        }).fail(function(error) {
            console.error(error);
        });
    });
</script>