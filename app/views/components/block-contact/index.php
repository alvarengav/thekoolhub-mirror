<div class="image-text-block block-contact image-text-block-<?= $imgSide ?> liveadmin-settings sweepToRight wow2">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_file', 'id'=>$id]);

      $data = $this->Data->GetInfo($id); ?>

    <? if(isset($data->id_file) && $data->id_file ): ?>

    <div class="image-text-block-img wow2 w2FadeIn" data-wow2-delay="600">

        <img src="<?= upload($data->id_file->file) ?>">

    </div>

    <? endif ?>

    <div class="image-text-block-content wow2 w2FadeIn" data-wow2-delay="900">

        <div class="center">

            <div class="image-text-block-title"><?= $this->Data->Content($id . '-title') ?></div>

            <div class="image-text-block-form">

                <form action="<?= base_url('contact') ?>" class="ajaxForm">

                    <input type="text" name="name" class="form-control"
                        placeholder="<?= $this->Data->translate('Nombre', $lang) ?>">

                    <input type="text" name="lastname" class="form-control"
                        placeholder="<?= $this->Data->translate('Apellido', $lang) ?>">

                    <input type="text" name="mail" class="select-control"
                        placeholder="<?= $this->Data->lang('Email') ?>">

                    <select name="country" class="select-control" id="">
                        <option value="0" selected><?= $this->Data->translate("Estoy interesado en", $lang); ?></option>
                        <option value="espana">Madrid</option>
                        <option value="london">Londres</option>
                    </select>

                    <textarea name="message" class="form-control"
                        placeholder="<?= $this->Data->translate('Comentarios', $lang) ?>"></textarea>



                    <div class="row checks">

                        <div class="col">

                            <b><?= $this->Data->translate('Interesado en', $lang) ?></b>

                            <? 

                $interested = [

                  $this->Data->lang('Showroom'),

                  $this->Data->lang('Cowork'),

                  $this->Data->lang('Skool'),

                  $this->Data->translate('Alquiler de espacio',$lang),


                ]

              ?>

                            <? foreach( $interested as $i => $value): ?>



                            <div class="custom-control custom-checkbox">

                                <input type="checkbox" class="custom-control-input" value="<?= $value ?>"
                                    name="interested[]" id="interested<?= $i ?>">

                                <label class="custom-control-label" for="interested<?= $i ?>"><?= $value ?></label>

                            </div>

                            <? endforeach ?>

                        </div>

                        <div class="col">

                            <b><?= $this->Data->translate('Número de personas', $lang) ?></b>



                            <? 

                  $np = [

                    $this->Data->lang('1'),

                    $this->Data->lang('2-4'),

                    $this->Data->lang('5-9'),

                    $this->Data->lang('10-20'),

                    $this->Data->lang('+20'),

                  ]

                ?>

                            <? foreach( $np as $i => $value): ?>



                            <div class="custom-control custom-radio">

                                <input type="radio" value="<?= $value ?>" class="custom-control-input"
                                    name="number_persons" id="number_persons<?= $i ?>">

                                <label class="custom-control-label" for="number_persons<?= $i ?>"><?= $value ?></label>

                            </div>

                            <? endforeach ?>

                        </div>

                    </div>



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

                                <input type="checkbox" name="check" class="custom-control-input" id="<?= $id ?>-check1">

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

                </form>

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
    border: 1px solid transparent;
    border-radius: 0;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>

<script>
ajaxFormCallback['submit-contact-form'] = function() {

    $('.block-contact .form-bottom').html(
        '<b><?= $this->Data->lang(" Gracias por enviarnos tu solicitud, en breve nos pondremos en contacto contigo.") ?></b>'
        );


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