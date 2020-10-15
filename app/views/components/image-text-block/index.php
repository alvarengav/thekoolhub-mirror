<div
    class="image-text-block wow2 <?= (strpos($imgSide, 'right') !== false) ? 'sweepToRight' : 'sweepToLeft' ?> image-text-block-<?= $imgSide ?> liveadmin-settings <?= $style ?>">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_file', 'id'=>$id, 'text'=>'Editar imagen']) ?>

    <? $data = $this->Data->GetInfo($id); ?>



    <div class="image-text-block-img wow2 w2FadeIn" data-wow2-delay="600">

        <img src="<?= upload($data->id_file->file) ?>">

    </div>

    <div class="image-text-block-content wow2 w2FadeIn" data-wow2-delay="900">

        <div class="center">

            <div class="image-text-block-title"><?= $title ?></div>

            <div class="image-text-block-description">

                <?= $description ?></div>



            <? if(isset($btn) && $btn): ?>

            <div class="wow2Child fadeInLeft">



                <div class="end-btn">

                    <? $this->load->view('components/liveadmin/admin-btn', [

                'id'=>$id.'-btn1',

                'class'=> 'btn btn-black-outline',

                'html'=> $btn,

                'default'=>$btnLink,

            ]) ?>

                </div>

            </div>

            <? endif ?>

            <? if(isset($linkedin) && $linkedin): ?>

            <div class="wow fadeInLeft linkedin">

                <? $this->load->view('components/liveadmin/admin-btn', [

                'id'=>$id.'-btn-linkedin',

                'class'=> 'btn-social',

                'html'=> '          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">

                <g id="Grupo_177" data-name="Grupo 177" transform="translate(-120 -6192)">

                  <g id="Grupo_176" data-name="Grupo 176" transform="translate(131 6201.947)">

                    <path id="Trazado_324" data-name="Trazado 324" d="M88.132,185.911h3.849V198.27H88.132Zm1.925-6.151a2.227,2.227,0,1,1-2.227,2.227,2.231,2.231,0,0,1,2.227-2.227" transform="translate(-87.83 -179.76)" fill="#000"/>

                    <path id="Trazado_325" data-name="Trazado 325" d="M94.79,186.261h3.689v1.689h.047a4.036,4.036,0,0,1,3.642-2c3.887,0,4.6,2.557,4.6,5.887v6.783h-3.84v-6.01c0-1.434-.028-3.283-2-3.283-2,0-2.3,1.566-2.3,3.17v6.114H94.79Z" transform="translate(-88.224 -180.11)" fill="#000"/>

                  </g>

                  <g id="Elipse_8" data-name="Elipse 8" transform="translate(120 6192)" fill="none" stroke="#000" stroke-width="1">

                    <circle cx="20" cy="20" r="20" stroke="none"/>

                    <circle cx="20" cy="20" r="19.5" fill="none"/>

                  </g>

                </g>

              </svg> '.$linkedin_btn . ' ' . $this->load->view('components/svgs/arrow-rigth.svg',[],true),

                'default'=> '#',

            ]) ?>



            </div>

            <? endif ?>

        </div>

    </div>

</div>

<style>
.without-linkedin .linkedin {
    display: none;
}
</style>