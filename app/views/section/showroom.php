<style>
.bg-gray {
    background: #f2f2f2;
    padding-top: 4rem;
    padding-bottom: 4rem;
}
</style>

<div class="page-home">

    <? $this->load->view('components/image-presentation/index', [
        'title'=> $this->Data->Content('high-title'),
        'subtitle'=> $this->Data->Content('high-subtitle'),
        'btnLink'=>$this->Data->lang_url('contact'),
        'id'=>'high-1'
    ]); ?>

    <style>
    @media only screen and (min-width: 600px) {
        .form-flex {
            flex-direction: row-reverse;
        }
    }
    </style>

    <div class="requiere-header-color block-contact">
        <div
            class="form-flex image-text-block wow2 sweepToLeft image-text-block-left pt-0 liveadmin-settings yellow white-button in bg-white no-padding">
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

                    .custom-control-label::before {
                        border: solid 1px #888 !important;
                    }

                    .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
                        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23888' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E")
                    }

                    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                        <form
                            action="https://thekoolhub.us4.list-manage.com/subscribe/post?u=06db20708c0634f21dd9424bc&amp;id=b7c3a7efbf"
                            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                            class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <? 
                                $id = 'high-chimp-form';
                                $this->load->view('components/basic-text-block/only-title', [
                                'title'=> $this->Data->Content($id.'-title'),
                                ]); ?>
                                <div class="indicates-required"><span class="asterisk">*</span> Required fields</div>
                                <input type="email" placeholder="<?= $this->Data->lang('Email') ?>" value=""
                                    name="EMAIL" class="form-control required email" id="mce-EMAIL">
                                <input type="text" placeholder="<?= $this->Data->translate('Nombre',$lang) ?>" value=""
                                    name="FNAME" class="form-control" id="mce-FNAME">
                                <input type="text" placeholder="<?= $this->Data->translate('Apellido',$lang) ?>"
                                    value="" name="LNAME" class="form-control" id="mce-LNAME">
                                <input type="text" placeholder="<?= $this->Data->translate('Empresa',$lang) ?>" value=""
                                    name="MMERGE3" class="form-control" id="mce-MMERGE3">
                                <input type="text" placeholder="<?= $this->Data->translate('Teléfono',$lang) ?>"
                                    name="MMERGE4" class="form-control" value="" id="mce-MMERGE4">

                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                                        name="b_06db20708c0634f21dd9424bc_b7c3a7efbf" tabindex="-1" value=""></div>
                                <div class="clear">
                                    <input type="submit" style="float:left" value="Subscribe" name="subscribe"
                                        id="mc-embedded-subscribe" class="btn btn-black">
                                    <div style="float: left; margin-left: 1rem; margin-top: 1rem;">

                                        <div class="custom-control custom-checkbox" style="color: #888">

                                            <input type="checkbox" class="custom-control-input" value=""
                                                name="interested[]" id="interested1">

                                            <label class="custom-control-label" for="interested1">Acepto los
                                                <a style="color:#888" href="/contact#terms-and-conditions">términos y
                                                    condiciones</a></label>


                                        </div>
                                        <div class="custom-control custom-checkbox" style="color: #888">

                                            <input type="checkbox" class="custom-control-input" value=""
                                                name="interested[]" id="interested2">

                                            <label class="custom-control-label" for="interested2">Quiero recibir
                                                noticias</label>


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


    <? $this->load->view('components/mosaic/two', [
        
        'title'=> $this->Data->Content('high-mosaic-title'),
        'text'=> $this->Data->Content('high-mosaic-text'),
        'btn'=> $this->Data->Content('high-mosaic-btn'),
        'btnLink'=> $this->Data->lang_url('news'),
        'id' => 'high-mosaic-1'
        ]); ?>


    <? $this->load->view('components/mosaic/two', [
        
    'title'=> $this->Data->Content('high-mosaic2-title'),
    'text'=> $this->Data->Content('high-mosaic2-text'),
    'btn'=> $this->Data->Content('high-mosaic2-btn'),
    'btnLink'=> $this->Data->lang_url('news'),
    'id' => 'high-mosaic2-1'
    ]); ?>


    <div class="requiere-header-color block-contact">
        <div
            class="image-text-block wow2 sweepToLeft image-text-block-left pt-0 liveadmin-settings yellow white-button in bg-white no-padding pb-0">
            <div class="image-text-block-content wow2 w2FadeIn bg-gray padding-3" data-wow2-delay="900">
                <div style="width:100%">
                    <div class="image-text-block-form">
                        <!-- Begin Mailchimp Signup Form -->
                        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet"
                            type="text/css">
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
                        <div id="mc_embed_signup">
                            <form data-action="<?= base_url('ajax_subscribe') ?>"
                                action="https://thekoolhub.us4.list-manage.com/subscribe/post?u=06db20708c0634f21dd9424bc&amp;id=c6534103a5"
                                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <? 
                                $id = 'space-chimp-form';
                                $this->load->view('components/basic-text-block/only-title', [
                                'title'=> $this->Data->Content($id.'-title'),
                                ]); ?>
                                    <input type="hidden" name="form" value="spaces">
                                    <div class="indicates-required"><span class="asterisk">*</span> indicates required
                                    </div>
                                    <input type="email" placeholder="<?= $this->Data->lang('Email') ?>" value=""
                                        name="EMAIL" class="form-control required email" id="mce-EMAIL">
                                    <input type="text" placeholder="<?= $this->Data->translate('Nombre',$lang) ?>"
                                        value="" name="FNAME" class="form-control" id="mce-FNAME">
                                    <input type="text" placeholder="<?= $this->Data->translate('Apellido',$lang) ?>"
                                        value="" name="LNAME" class="form-control" id="mce-LNAME">
                                    <input type="text" placeholder="<?= $this->Data->translate('Empresa',$lang) ?>"
                                        value="" name="MMERGE5" class="form-control" id="mce-MMERGE5">
                                    <input type="text" placeholder="<?= $this->Data->translate('Teléfono',$lang) ?>"
                                        name="MMERGE3" class="form-control" value="" id="mce-MMERGE3">
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input
                                            type="text" name="b_06db20708c0634f21dd9424bc_c6534103a5" tabindex="-1"
                                            value=""></div>
                                    <div class="clear">
                                        <input type="submit" style="float:left" value="Subscribe" name="subscribe"
                                            id="mc-embedded-subscribe" class="btn btn-black">
                                        <div style="float: left; margin-left: 1rem; margin-top: 1rem;">

                                            <div class="custom-control custom-checkbox" style="color: #888">

                                                <input type="checkbox" class="custom-control-input" value=""
                                                    name="interested[]" id="interested3">

                                                <label class="custom-control-label" for="interested3">Acepto los
                                                    <a style="color:#888" href="/contact#terms-and-conditions">términos
                                                        y
                                                        condiciones</a></label>


                                            </div>
                                            <div class="custom-control custom-checkbox" style="color: #888">

                                                <input type="checkbox" class="custom-control-input" value=""
                                                    name="interested[]" id="interested4">

                                                <label class="custom-control-label" for="interested4">Quiero recibir
                                                    noticias</label>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script type='text/javascript'
                            src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'>
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
        'title'=> $this->Data->Content('high-call-to-action-title'),
        'btn'=> $this->Data->Content('high-call-to-action-btn'),
        'subtitle' => $this->Data->Content('high-call-to-action-subtitle'),
        ]); ?>
    </div>


</div>