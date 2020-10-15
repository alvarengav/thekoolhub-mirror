<div class="instagram-grid requiere-header-color">

    <div class="incont incont-min ">

        <a class="title wow fadeInUp" data-wow-delay=".3">

            <svg xmlns="http://www.w3.org/2000/svg" width="33.379" height="33.358" viewBox="0 0 33.379 33.358">

                <path id="Trazado_322" data-name="Trazado 322"
                    d="M206.434,9.237a8.8,8.8,0,0,0-2.694-5.689,9.3,9.3,0,0,0-6.117-2.488c-3.93-.222-13.232-.349-16.512.19a8.431,8.431,0,0,0-7.226,6.481c-.792,2.837-.634,15.926-.174,18.731a8.431,8.431,0,0,0,6.7,7.274c2.631.681,15.577.586,18.477.127a8.468,8.468,0,0,0,7.305-6.671C206.973,24.276,206.7,11.868,206.434,9.237ZM203.36,25.924a5.638,5.638,0,0,1-5.309,5.039c-2.694.3-14.722.46-17.21-.238A5.469,5.469,0,0,1,176.69,26a110.571,110.571,0,0,1,0-16.845,5.663,5.663,0,0,1,5.293-5.023,118.406,118.406,0,0,1,16.433.063,5.668,5.668,0,0,1,5.039,5.324C203.741,12.264,203.82,22.976,203.36,25.924ZM190.017,9a8.557,8.557,0,1,0,8.557,8.557A8.562,8.562,0,0,0,190.017,9Zm-.048,14.088a5.531,5.531,0,1,1,5.578-5.483A5.536,5.536,0,0,1,189.97,23.087ZM200.92,8.667a2,2,0,1,1-2-2.013A2,2,0,0,1,200.92,8.667Z"
                    transform="translate(-173.329 -0.87)" fill="#1a1a1a" />

            </svg>

            /<?= $this->Data->Content('instagram') ?>

        </a>

    </div>



    <div class="instagram-grid pt-0" data-wow-delay=".6">



        <?$instagram = $this->Data->Instagram();?>
        <div class="grid" id="instagram-grid" data-instagram="<?= $this->Data->GetContent('instagram')->data ?>">
            <?if (!empty($instagram)) :?>
            <?$cont = 0;?>
            <? foreach ($instagram as $s) : $link = $s->link; ?>
            <?if ($cont < 10) :?>
            <a class="item wow fadeIn" href="<?= $link ?>" target="_blank">

                <img class="item-img" src="<?= $s->thumb ?>">
            </a>
            <? endif; ?>
            <?$cont++;?>
            <? endforeach ?>
            <? endif; ?>
        </div>



    </div>