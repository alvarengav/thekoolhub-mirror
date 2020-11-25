<div class="requiere-header-color block-contact">
        <div
            class="image-text-block wow2 sweepToLeft image-text-block-left pt-0 liveadmin-settings yellow white-button in bg-white no-padding">
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
                        <form
                            action="https://thekoolhub.us4.list-manage.com/subscribe/post?u=06db20708c0634f21dd9424bc&amp;id=b7c3a7efbf"
                            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                            class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <? 
                                $id = 'community-chimp-form';
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
                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe"
                                        id="mc-embedded-subscribe" class="btn btn-black"></div>
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