<footer id="footer" class="requiere-header-color">
    <div class="incont incont1">

        <div class="row">
            <div class="col">
                <div class="title"><?= $this->Data->lang('The Kool Hub') ?></div>

                <a href="<?= $this->Data->lang_url('about') ?>" class="link"><?= $this->Data->lang('About Us') ?></a>
                <a href="<?= $this->Data->lang_url('community') ?>" class="link"><?= $this->Data->lang('Comunidad') ?></a>
                <a href="<?= $this->Data->lang_url('skool') ?>" class="link"><?= $this->Data->translate('Formación', $lang) ?></a>
                <a href="<?= $this->Data->lang_url('events') ?>" class="link"><?= $this->Data->lang('Eventos') ?></a>
                <a href="<?= $this->Data->lang_url('news') ?>" class="link"><?= $this->Data->lang('Blog') ?></a>
                <a href="<?= $this->Data->lang_url('contact') ?>" class="link"><?= $this->Data->lang('Contacto') ?></a>
            </div>
            <div class="col">
                <div class="title"><?= $this->Data->translate('Espacios', $lang) ?></div>

                <a href="<?= $this->Data->lang_url('spaces') ?>#showroom" class="link">Showroom</a>
                <a href="<?= $this->Data->lang_url('spaces') ?>#kool-lounge" class="link">Kool Lounge</a>
                <a href="<?= $this->Data->lang_url('spaces') ?>#skool" class="link"><?= $this->Data->translate('Formación', $lang) ?></a>
                <!-- <a href="<?= $this->Data->lang_url('spaces') ?>#meeting-room" class="link"><?= $this->Data->lang('Sala de reuniones') ?></a> -->
                <a href="<?= $this->Data->lang_url('spaces') ?>#common-spaces" class="link"><?= $this->Data->translate('Espacios comunes', $lang) ?></a>
                <a href="/<?= $lang ?>/london" class="link"><?= $this->Data->lang('London') ?></a>

            </div>
            <div class="col liveadmin-settings">

                <? 
            $id = 'footer_legal';
            $this->load->view('components/liveadmin/settings', ['url'=>'contents/info_links', 'id'=>$id, 'text'=>'Editar enlaces']); 
            //Agregar clase  al contenedor para flotar btn
            $data = $this->Data->GetInfo($id);

        ?>
                <div class="title"><?= $this->Data->lang('Legal') ?></div>
                <? foreach( $data->links as $i => $value): $link = $this->Data->GetInfoPage($value->link) ?>

                <a href="#<?= prep_word_url($link->title) ?>" class="link show_modal_info" data-info="<?= $link->id_post ?>"><?= $link->title ?></a>
                <? endforeach ?>

            </div>

            <div class="col">
                <div class="title"><?= $this->Data->lang('Newsletter') ?></div>

                <form action="<?= base_url('ajax_subscribe') ?>" class="ajaxForm form">
                    <input type="text" name="name" placeholder="<?= $this->Data->translate('Nombre', $lang) ?>">
                    <input type="text" name="lastname" placeholder="<?= $this->Data->translate('Apellido', $lang) ?>">
                    <input type="text" name="mail" placeholder="<?= $this->Data->lang('Email') ?>">
                    <button class="send" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36.729" height="10.079" viewBox="0 0 36.729 10.079">
                            <path id="Shape" d="M5.852,34.038V.788a.81.81,0,0,0-1.619,0V34.032L1.384,31.265a.823.823,0,0,0-1.146,0,.771.771,0,0,0,0,1.115L4.467,36.5a.826.826,0,0,0,.57.234.8.8,0,0,0,.57-.234l4.234-4.122a.771.771,0,0,0,0-1.115.821.821,0,0,0-1.14.006L5.852,34.038Z" transform="translate(0 10.079) rotate(-90)" fill="#ffa900" />
                        </svg>
                    </button>
                    <hr>
                    <div class="custom-control custom-checkbox liveadmin-settings">

                        <? 
            $id = 'footer_legal_2';
            $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_info_links', 'id'=>$id, 'text'=>'Edita enlace']); 
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
                        <input type="hidden" name="lang" value="<?= $language ?>">

                        <input type="checkbox" name="check" class="custom-control-input" id="customCheckFooter1">
                        <label class="custom-control-label" for="customCheckFooter1"><?= $this->Data->translate('Acepto los ', $lang) ?><a href="#<?= prep_word_url($link->title) ?>" data-info="<?= $link->id_post ?>" class="show_modal_info"><?= $this->Data->translate('términos y condiciones', $lang) ?></a>.</label>
                    </div>
                    <div class="thanks"></div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="incont incont2">
        <div class="social liveadmin-settings">

            <? 
            $id = 'footer_links_col_1';
            $this->load->view('components/liveadmin/settings', ['url'=>'contents/social_links', 'id'=>$id, 'text'=>'Editar redes']); 
            //Agregar clase  al contenedor para flotar btn
            $data = $this->Data->GetInfo($id);

        ?>

            <a target="_blank" href="<?= $data->linkedin ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18.548" height="18.51" viewBox="0 0 18.548 18.51">
                    <g id="Grupo_4" data-name="Grupo 4" transform="translate(0 0)">
                        <path id="Trazado_324" data-name="Trazado 324" d="M88.132,185.911h3.849V198.27H88.132Zm1.925-6.151a2.227,2.227,0,1,1-2.227,2.227,2.231,2.231,0,0,1,2.227-2.227" transform="translate(-87.83 -179.76)" fill="#fff" />
                        <path id="Trazado_325" data-name="Trazado 325" d="M94.79,186.261h3.689v1.689h.047a4.036,4.036,0,0,1,3.642-2c3.887,0,4.6,2.557,4.6,5.887v6.783h-3.84v-6.01c0-1.434-.028-3.283-2-3.283-2,0-2.3,1.566-2.3,3.17v6.114H94.79Z" transform="translate(-88.224 -180.11)" fill="#fff" />
                    </g>
                </svg>
            </a>
            <a target="_blank" href="<?= $data->instagram ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="19.873" height="19.86" viewBox="0 0 19.873 19.86">
                    <g id="Grupo_3" data-name="Grupo 3" transform="translate(0 0)">
                        <path id="Trazado_321" data-name="Trazado 321" d="M193.039,5.851a5.237,5.237,0,0,0-1.6-3.387A5.537,5.537,0,0,0,187.793.983a70.484,70.484,0,0,0-9.831.113,5.019,5.019,0,0,0-4.3,3.859c-.472,1.689-.377,9.482-.1,11.152a5.02,5.02,0,0,0,3.991,4.33c1.566.406,9.274.349,11,.075a5.042,5.042,0,0,0,4.349-3.972C193.359,14.8,193.2,7.418,193.039,5.851Zm-1.83,9.935a3.357,3.357,0,0,1-3.161,3c-1.6.179-8.765.274-10.246-.142a3.256,3.256,0,0,1-2.472-2.811,65.832,65.832,0,0,1,0-10.029,3.371,3.371,0,0,1,3.151-2.991,70.494,70.494,0,0,1,9.784.038,3.374,3.374,0,0,1,3,3.17A71.867,71.867,0,0,1,191.208,15.786ZM183.264,5.71a5.095,5.095,0,1,0,5.095,5.095A5.1,5.1,0,0,0,183.264,5.71Zm-.028,8.387a3.293,3.293,0,1,1,3.321-3.264A3.3,3.3,0,0,1,183.236,14.1Zm6.519-8.585a1.193,1.193,0,1,1-1.189-1.2A1.192,1.192,0,0,1,189.755,5.512Z" transform="translate(-173.329 -0.87)" fill="#fff" />
                        <path id="Trazado_322" data-name="Trazado 322" d="M193.039,5.851a5.237,5.237,0,0,0-1.6-3.387A5.537,5.537,0,0,0,187.793.983a70.484,70.484,0,0,0-9.831.113,5.019,5.019,0,0,0-4.3,3.859c-.472,1.689-.377,9.482-.1,11.152a5.02,5.02,0,0,0,3.991,4.33c1.566.406,9.274.349,11,.075a5.042,5.042,0,0,0,4.349-3.972C193.359,14.8,193.2,7.418,193.039,5.851Zm-1.83,9.935a3.357,3.357,0,0,1-3.161,3c-1.6.179-8.765.274-10.246-.142a3.256,3.256,0,0,1-2.472-2.811,65.832,65.832,0,0,1,0-10.029,3.371,3.371,0,0,1,3.151-2.991,70.494,70.494,0,0,1,9.784.038,3.374,3.374,0,0,1,3,3.17A71.867,71.867,0,0,1,191.208,15.786ZM183.264,5.71a5.095,5.095,0,1,0,5.095,5.095A5.1,5.1,0,0,0,183.264,5.71Zm-.028,8.387a3.293,3.293,0,1,1,3.321-3.264A3.3,3.3,0,0,1,183.236,14.1Zm6.519-8.585a1.193,1.193,0,1,1-1.189-1.2A1.192,1.192,0,0,1,189.755,5.512Z" transform="translate(-173.329 -0.87)" fill="#fff" />
                    </g>
                </svg>

            </a>
            <a target="_blank" href="<?= $data->facebook ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.17" height="21.399" viewBox="0 0 11.17 21.399">
                    <path id="Trazado_17" data-name="Trazado 17" d="M12.066,3.613c.66-.019,1.321-.009,1.991-.009h.274V.16c-.359-.038-.726-.085-1.094-.1C12.557.019,11.877-.01,11.2,0A4.985,4.985,0,0,0,8.321.887,4.33,4.33,0,0,0,6.585,3.774a9.605,9.605,0,0,0-.123,1.481c-.019.774,0,1.547,0,2.321v.292H3.16v3.849H6.443V21.4h4.01v-9.67h3.264c.17-1.283.33-2.547.5-3.868h-3.8s.009-1.906.028-2.736C10.481,3.991,11.16,3.642,12.066,3.613Z" transform="translate(-3.16 0.002)" fill="#fff" fill-rule="evenodd" />
                </svg>

            </a>
            <a target="_blank" href="<?= $data->twitter ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="23.388" height="19.043" viewBox="0 0 23.388 19.043">
                    <path id="Trazado_18" data-name="Trazado 18" d="M92.275,17.127a4.811,4.811,0,0,1-4.472-3.34,4.725,4.725,0,0,0,2.057-.066c.019,0,.038-.019.066-.028A4.8,4.8,0,0,1,86.8,11.485,4.726,4.726,0,0,1,86.1,8.928a4.76,4.76,0,0,0,2.142.585A4.849,4.849,0,0,1,86.256,6.6a4.774,4.774,0,0,1,.519-3.481A13.738,13.738,0,0,0,96.69,8.136c-.028-.189-.057-.359-.075-.528a4.654,4.654,0,0,1,.708-3.142,4.618,4.618,0,0,1,3.255-2.17,4.694,4.694,0,0,1,4.208,1.34.234.234,0,0,0,.255.075,9.577,9.577,0,0,0,2.793-1.076.141.141,0,0,1,.066-.028h.028A4.885,4.885,0,0,1,105.87,5.22a9.387,9.387,0,0,0,2.679-.717c.009.009.009.019.019.019-.189.245-.359.491-.557.717a9.389,9.389,0,0,1-1.745,1.66.146.146,0,0,0-.075.151,12.373,12.373,0,0,1-.094,2.132,14.485,14.485,0,0,1-1.236,4.283,14.1,14.1,0,0,1-2.594,3.793,12.817,12.817,0,0,1-6.6,3.679,14.957,14.957,0,0,1-2.679.321,13.491,13.491,0,0,1-7.689-2.066l-.113-.075a9.815,9.815,0,0,0,4.812-.66A9.617,9.617,0,0,0,92.275,17.127Z" transform="translate(-85.18 -2.223)" fill="#fff" fill-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="phone">
            <a href="tel:<?= $this->Data->GetContent('phone')->data ?>"><span><?= $this->Data->Content('phone') ?></span></a>
        </div>
        <div class="clearfix"></div>


        <div class="copy">
            © <?= date('Y') ?> The Kool Hub. All rights reserved. | work done with love by

            <a href="https://www.weareidentty.com/" target="_blank">
                <svg id="Grupo_149" data-name="Grupo 149" xmlns="http://www.w3.org/2000/svg" width="17.187" height="17.187" viewBox="0 0 17.187 17.187">
                    <g id="Grupo_8" data-name="Grupo 8" transform="translate(0)">
                        <g id="Grupo_1" data-name="Grupo 1" transform="translate(0 0)">
                            <path id="Trazado_1" data-name="Trazado 1" d="M394.307,352.041H377.12V334.854h17.187Zm-15.7-1.484h14.219V336.338H378.6Z" transform="translate(-377.12 -334.854)" fill="#d10015" />
                        </g>
                        <g id="Grupo_4" data-name="Grupo 4" transform="translate(4.353 5.668)">
                            <g id="Grupo_2" data-name="Grupo 2" transform="translate(0.329 0.074)">
                                <path id="Trazado_2" data-name="Trazado 2" d="M417.264,375.711l-1.106,3.747-.863-3.747h-1.841l-.847,3.747-.5-1.549h-1.67l1.137,3.512h1.947l.814-3.413.79,3.413h1.947l1.865-5.709Z" transform="translate(-410.435 -375.711)" fill="#d10015" />
                            </g>
                            <g id="Grupo_3" data-name="Grupo 3">
                                <circle id="Elipse_1" data-name="Elipse 1" cx="0.893" cy="0.893" r="0.893" fill="#fff" />
                            </g>
                        </g>
                    </g>
                </svg>
            </a>

        </div>

    </div>
</footer>

<? $this->load->view('components/modal-info/index') ?>

<? if(isset($admin) && $admin ): ?>
<? $this->load->view('components/liveadmin/index') ?>
<? endif ?>


<script>
    ajaxFormCallback['success-subscribe'] = function() {
        // $('#footer .send svg').after('<i class="fa fa-heart"></i>');
        // $('#footer .send svg').remove();
        // $('#footer .send').css('pointer-events', 'none');
        var _lang = "<?= $lang ?>";
        $('.line-subcribe .btn').width($('.line-subcribe .btn').width());
        $('.line-subcribe .btn').html('<?= $this->Data->lang("¡Gracias!") ?>');
        $('.line-subcribe .btn').css('pointer-events', 'none');
        $('.line-subcribe .btn').css('text-decoration', 'uppercase');

        $('.rmenu .appendRmenu .form-subscribe .form-bottom').remove();
        $('.rmenu .appendRmenu .form-subscribe input').remove();
        $('.rmenu .appendRmenu .form-subscribe .title').html('<?= $this->Data->lang("¡Gracias!") ?>');
        if (_lang == "es")
            $('.rmenu .appendRmenu .form-subscribe .subtitle').html('<?= $this->Data->lang("Gracias por acercarte un poquito más a nuestra comunidad.No te arrepentirás.A partir de ahora,prepárate para disfrutar de contenido interesante y de calidad. <br/> Prometemos no ser pesados(nosotros también tenemos siempre llena la bandeja de entrada) y comunicarnos solo si tenemos algo relevante que decir.¡Y por supuesto,también puedes venir a vernos siempre que te apetezca!") ?>');
        else 
            $('.rmenu .appendRmenu .form-subscribe .subtitle').html('<?= $this->Data->lang("Thank you for coming a little closer to our community. You won&#39;t regret it. From now on, get ready to enjoy interesting and quality content.<br/> We promise not to be pushy &#40;we too always have a full inbox&#41; and to communicate only if we have something relevant to say.") ?>');

        fbq('track', 'CompleteRegistration');
        gtag('event', 'conversion', {
            'event_category': 'Newsletter',
            'event_label': '<?= $lang ?>',
            'action': 'Enviar'
        });
        $('.thanks').fadeIn(1000).html('<?= $this->Data->lang("Thanks for subscribe ") ?> <i class="fa fa-heart"></i>').fadeOut(6000);
        $('#footer .form input').val("");
    }
</script>

<style>
    .thanks {
        display: none;
        background: #ffa90052;
        width: 100%;
        height: auto;
        color: #FFF;
        padding: 1rem;
        text-align: center;
        margin-top: 20px;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        transition: background-color 5000s ease-in-out 0s;
        color: #ffa900 !important;
        -webkit-text-fill-color: #ffa900;
    }

    #footer .form input {
        width: 100%;
    }
    button:focus {
        outline: 0;
    }
</style>