<? $uniq = uniqid(); 
$currentUrl = base_url(uri_string()); 
$urlArray = explode('/',$currentUrl);
$url = end($urlArray);
?>

<? if($url != 'london'): ?>
<a href="/<?= $lang ?>/london" class="london">
    <? 
    $id = 'london';
    $this->load->view('components/basic-text-block/btn-link', [
    'title'=> $this->Data->Content($id),
    ]); ?>
</a>
<? else: ?>
<a href="/<?= $lang ?>" class="london">
    <? 
    $id = 'london-btn2';
    $this->load->view('components/basic-text-block/only-text', [
    'title'=> $this->Data->Content($id.'-title'),
    ]); ?>
</a>
<? endif; ?>
<style>
.london {
    -webkit-transition: -webkit-transform ease-in-out 0.3s;
    transition: -webkit-transform ease-in-out 0.3s;
    -o-transition: transform ease-in-out 0.3s;
    transition: transform ease-in-out 0.3s;
    transition: transform ease-in-out 0.3s, -webkit-transform ease-in-out 0.3s;
    -webkit-align-self: center;
    -ms-flex-item-align: center;
    align-self: center;
    background-color: #ffa900;
    display: block;
    font-weight: bold;
    z-index: 1010;
    cursor: pointer;
    position: fixed;
    height: 60px;
    line-height: 60px;
    text-align: center;
    text-decoration: none;
    width: 200px;
    right: 110px;
    top: 30px;
}

@media (max-width: 576px) {
    .london {
        height: 45px;
        line-height: 45px;
        width: 139px;
        right: 65px;
        top: 15px;
    }
}

.london:hover {
    text-decoration: none;
}

.header-scroll .london {
    height: 45px;
    line-height: 45px;
    top: 15px;
    right: 92px;
}

.appendRmenu .col2 .link .t {
    font-size: 1.6em;
}
</style>

<div class="rmenu-btn" id="rmenu<?= $uniq ?>">

    <div class="bars"></div>

</div>



<div class="appendRmenu" id="appendRmenu<?= $uniq ?>">

    <div class="col1">

        <div class="center">

            <form action="<?= base_url('ajax_subscribe') ?>" class="ajaxForm form-subscribe">

                <div class="title">

                    <?= $this->Data->lang('¡No te quedes sin saber qué pasa!') ?>



                </div>



                <div class="subtitle">

                    <?= $this->Data->lang('Nos encantan las cosas útiles. Suscríbete a nuestra newsletter mensual y sé el primero en enterarte de lo que sucede en el sector retail, los eventos y novedades de nuestro espacio… ¡y mucho más!') ?>

                </div>



                <input type="text" name="name" class="form-control"
                    placeholder="<?= $this->Data->translate('Introduce tu nombre...',$lang) ?>">
                <input type="text" name="lastname" class="form-control"
                    placeholder="<?= $this->Data->translate('Introduce tu apellido...',$lang) ?>"></input>

                <input type="text" name="mail" class="form-control"
                    placeholder="<?= $this->Data->lang('Introduce tu mail…') ?>">



                <div class="form-bottom">

                    <div class="div">

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



                            <input type="checkbox" name="check" class="custom-control-input" id="rMenucustomCheck1">

                            <label class="custom-control-label"
                                for="rMenucustomCheck1"><?= $this->Data->translate('Acepto los', $lang) ?> <a
                                    href="#<?= prep_word_url($link->title) ?>" data-info="<?= $link->id_post ?>"
                                    class="show_modal_info"><?= $this->Data->translate('términos y condiciones', $lang) ?></a>.</label>

                        </div>

                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" name="send_news" class="custom-control-input" id="rMenucustomCheck2">

                            <label class="custom-control-label"
                                for="rMenucustomCheck2"><?= $this->Data->lang('Quiero recibir notícias.') ?></a></label>

                        </div>

                    </div>

                    <div class="div">

                        <button class="btn btn-primary"><?= $this->Data->lang('Apúntate') ?></button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="col2">

        <div class="center">

            <a class="link" href="<?= $this->Data->lang_url('about') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('We are Kool') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('ABOUT') ?></div> -->

            </a>

            <a class="link" href="<?= $this->Data->lang_url('community') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('Be Kool') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('COMUNIDAD') ?></div> -->

            </a>

            <a class="link" href="<?= $this->Data->lang_url('spaces') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('Kool Spaces') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('ESPACIOS') ?></div> -->

            </a>

            <a class="link" href="<?= $this->Data->lang_url('skool') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('Skool') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('ESCUELA') ?></div> -->

            </a>

            <a class="link" href="<?= $this->Data->lang_url('events') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('Stay Kool') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('EVENTOS') ?></div> -->

            </a>

            <a class="link" href="<?= $this->Data->lang_url('news') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('Kool news') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('BLOG') ?></div> -->

            </a>

            <a class="link" href="<?= $this->Data->lang_url('contact') ?>">

                <div class="t" style="    margin-bottom: 1.5rem;"><?= $this->Data->lang('To be kool') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('CONTACTO') ?></div> -->

            </a>

            <a class="link" href="/<?= $lang ?>/london">

                <div class="t" style="margin-bottom: 1.5rem;">
                    <?= $this->Data->lang('KOOL London') ?></div>

                <!-- <div class="tt"><?= $this->Data->lang('KOOL London') ?></div> -->

            </a>

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

                            <path id="Trazado_324" data-name="Trazado 324"
                                d="M88.132,185.911h3.849V198.27H88.132Zm1.925-6.151a2.227,2.227,0,1,1-2.227,2.227,2.231,2.231,0,0,1,2.227-2.227"
                                transform="translate(-87.83 -179.76)" fill="#fff" />

                            <path id="Trazado_325" data-name="Trazado 325"
                                d="M94.79,186.261h3.689v1.689h.047a4.036,4.036,0,0,1,3.642-2c3.887,0,4.6,2.557,4.6,5.887v6.783h-3.84v-6.01c0-1.434-.028-3.283-2-3.283-2,0-2.3,1.566-2.3,3.17v6.114H94.79Z"
                                transform="translate(-88.224 -180.11)" fill="#fff" />

                        </g>

                    </svg>

                </a>

                <a target="_blank" href="<?= $data->instagram ?>">

                    <svg xmlns="http://www.w3.org/2000/svg" width="19.873" height="19.86" viewBox="0 0 19.873 19.86">

                        <g id="Grupo_3" data-name="Grupo 3" transform="translate(0 0)">

                            <path id="Trazado_321" data-name="Trazado 321"
                                d="M193.039,5.851a5.237,5.237,0,0,0-1.6-3.387A5.537,5.537,0,0,0,187.793.983a70.484,70.484,0,0,0-9.831.113,5.019,5.019,0,0,0-4.3,3.859c-.472,1.689-.377,9.482-.1,11.152a5.02,5.02,0,0,0,3.991,4.33c1.566.406,9.274.349,11,.075a5.042,5.042,0,0,0,4.349-3.972C193.359,14.8,193.2,7.418,193.039,5.851Zm-1.83,9.935a3.357,3.357,0,0,1-3.161,3c-1.6.179-8.765.274-10.246-.142a3.256,3.256,0,0,1-2.472-2.811,65.832,65.832,0,0,1,0-10.029,3.371,3.371,0,0,1,3.151-2.991,70.494,70.494,0,0,1,9.784.038,3.374,3.374,0,0,1,3,3.17A71.867,71.867,0,0,1,191.208,15.786ZM183.264,5.71a5.095,5.095,0,1,0,5.095,5.095A5.1,5.1,0,0,0,183.264,5.71Zm-.028,8.387a3.293,3.293,0,1,1,3.321-3.264A3.3,3.3,0,0,1,183.236,14.1Zm6.519-8.585a1.193,1.193,0,1,1-1.189-1.2A1.192,1.192,0,0,1,189.755,5.512Z"
                                transform="translate(-173.329 -0.87)" fill="#fff" />

                            <path id="Trazado_322" data-name="Trazado 322"
                                d="M193.039,5.851a5.237,5.237,0,0,0-1.6-3.387A5.537,5.537,0,0,0,187.793.983a70.484,70.484,0,0,0-9.831.113,5.019,5.019,0,0,0-4.3,3.859c-.472,1.689-.377,9.482-.1,11.152a5.02,5.02,0,0,0,3.991,4.33c1.566.406,9.274.349,11,.075a5.042,5.042,0,0,0,4.349-3.972C193.359,14.8,193.2,7.418,193.039,5.851Zm-1.83,9.935a3.357,3.357,0,0,1-3.161,3c-1.6.179-8.765.274-10.246-.142a3.256,3.256,0,0,1-2.472-2.811,65.832,65.832,0,0,1,0-10.029,3.371,3.371,0,0,1,3.151-2.991,70.494,70.494,0,0,1,9.784.038,3.374,3.374,0,0,1,3,3.17A71.867,71.867,0,0,1,191.208,15.786ZM183.264,5.71a5.095,5.095,0,1,0,5.095,5.095A5.1,5.1,0,0,0,183.264,5.71Zm-.028,8.387a3.293,3.293,0,1,1,3.321-3.264A3.3,3.3,0,0,1,183.236,14.1Zm6.519-8.585a1.193,1.193,0,1,1-1.189-1.2A1.192,1.192,0,0,1,189.755,5.512Z"
                                transform="translate(-173.329 -0.87)" fill="#fff" />

                        </g>

                    </svg>



                </a>

                <a target="_blank" href="<?= $data->facebook ?>">

                    <svg xmlns="http://www.w3.org/2000/svg" width="11.17" height="21.399" viewBox="0 0 11.17 21.399">

                        <path id="Trazado_17" data-name="Trazado 17"
                            d="M12.066,3.613c.66-.019,1.321-.009,1.991-.009h.274V.16c-.359-.038-.726-.085-1.094-.1C12.557.019,11.877-.01,11.2,0A4.985,4.985,0,0,0,8.321.887,4.33,4.33,0,0,0,6.585,3.774a9.605,9.605,0,0,0-.123,1.481c-.019.774,0,1.547,0,2.321v.292H3.16v3.849H6.443V21.4h4.01v-9.67h3.264c.17-1.283.33-2.547.5-3.868h-3.8s.009-1.906.028-2.736C10.481,3.991,11.16,3.642,12.066,3.613Z"
                            transform="translate(-3.16 0.002)" fill="#fff" fill-rule="evenodd" />

                    </svg>



                </a>

                <a target="_blank" href="<?= $data->twitter ?>">

                    <svg xmlns="http://www.w3.org/2000/svg" width="23.388" height="19.043" viewBox="0 0 23.388 19.043">

                        <path id="Trazado_18" data-name="Trazado 18"
                            d="M92.275,17.127a4.811,4.811,0,0,1-4.472-3.34,4.725,4.725,0,0,0,2.057-.066c.019,0,.038-.019.066-.028A4.8,4.8,0,0,1,86.8,11.485,4.726,4.726,0,0,1,86.1,8.928a4.76,4.76,0,0,0,2.142.585A4.849,4.849,0,0,1,86.256,6.6a4.774,4.774,0,0,1,.519-3.481A13.738,13.738,0,0,0,96.69,8.136c-.028-.189-.057-.359-.075-.528a4.654,4.654,0,0,1,.708-3.142,4.618,4.618,0,0,1,3.255-2.17,4.694,4.694,0,0,1,4.208,1.34.234.234,0,0,0,.255.075,9.577,9.577,0,0,0,2.793-1.076.141.141,0,0,1,.066-.028h.028A4.885,4.885,0,0,1,105.87,5.22a9.387,9.387,0,0,0,2.679-.717c.009.009.009.019.019.019-.189.245-.359.491-.557.717a9.389,9.389,0,0,1-1.745,1.66.146.146,0,0,0-.075.151,12.373,12.373,0,0,1-.094,2.132,14.485,14.485,0,0,1-1.236,4.283,14.1,14.1,0,0,1-2.594,3.793,12.817,12.817,0,0,1-6.6,3.679,14.957,14.957,0,0,1-2.679.321,13.491,13.491,0,0,1-7.689-2.066l-.113-.075a9.815,9.815,0,0,0,4.812-.66A9.617,9.617,0,0,0,92.275,17.127Z"
                            transform="translate(-85.18 -2.223)" fill="#fff" fill-rule="evenodd" />

                    </svg>

                </a>

            </div>

            <div class="langs">

                <a href="<?= base_url() ?>changelang/es" <? if($lang=='es' ): ?>class="active"
                    <? endif ?>>ES
                </a>

                <a href="<?= base_url() ?>changelang/en" <? if($lang=='en' ): ?>class="active"
                    <? endif ?>>ENG
                </a>

            </div>

        </div>

    </div>

</div>



<script>
var rmenuActive = false;

var rmenu = function(bk) {

    if (rmenuActive) return false;

    rmenuActive = true;

    var MENU = $('<div class="rmenu"></div>')

    // .height( $(window).height()).width($(window).width());

    var UL = $('<ul class="rmenu__ul"></ul>');





    var BTN = $('.rmenu-btn');

    var CLOSE = $('<i class="rmenu-close"></i>');



    var items = [];



    items[0] = $('<li><span></span></li>').append(CLOSE);





    $('[data-rmenu-add]').each(function(i, e) {

        var z = $(e).attr('data-rmenu-add');

        if ($.isNumeric(z)) {



            z = parseInt(z);



            if (!items[z]) {

                items[z] = $('<li></li>').append($(e).clone());

            } else {

                items[z].append($(e).clone())

            }

        }

    });



    $(items).each(function(i, e) {

        UL.append(e);



        $(e).click(function(event) {



            if ($('a', e).attr('href')) {

                window.location.href = $('a', e).attr('href');

            }

            // $(event).stopPropagation();

        });

    });









    MENU.append($('#appendRmenu<?= $uniq ?>'))

    // $('body').prepend( MENU.append(UL) );

    $('body').prepend(MENU);



    BTN.click(function() {

        toggle();

    });



    CLOSE.click(function() {

        toggle();

    });



    function toggle() {



        if ($('body').hasClass('open-rmenu')) {



            // Close



            $('.rmenu-btn').removeClass('rmenu-btn-x')



            $('body').removeClass('open-rmenu');





            if (window.history && window.history.pushState) {



                window.history = tempHistory;

            }



        } else {



            // Open



            $('.rmenu-btn').addClass('rmenu-btn-x')



            $('body').addClass('open-rmenu');







            if ($('.rmenu__ul li .social:visible').length == 0) {

                $('.rmenu__ul li .social:visible').parent().hide();



            }



            liReisize();



            if (window.history && window.history.pushState) {



                history.replaceState(null, document.title, location);

                history.pushState(null, document.title, location);



                $(window).bind("popstate", function(e) {

                    if ($('body').hasClass('open-rmenu')) {

                        $('.rmenu-btn').removeClass('rmenu-btn-x')

                        $('body').removeClass('open-rmenu')

                        e.stopPropagation();

                    }

                });



            }

        }

    }







    // window.addEventListener('resize', () => {

    // 	liReisize();



    // 	$('.rmenu__ul li a').eq(0).html( $(body).height() )

    // });



    if ("ontouchstart" in window) {

        var event = 'touchmove';

        $(document).bind(event, function(evt) {

            // alert()



            if ($('body').hasClass('open-rmenu')) {

                liReisize();

            }



        });

    }





    function liReisize() {

        var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

        var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);





        $('.rmenu').height(h);

        $('.rmenu').width(w);



    }

}



if (window.history && window.history.pushState)

    tempHistory = window.history;





$('document').ready(function() {

    rmenu('#rmenu<?= $uniq ?>');

});
</script>