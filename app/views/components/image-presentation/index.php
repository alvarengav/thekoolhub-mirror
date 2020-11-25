<? $data = $this->Data->GetInfo($id); ?>

<? $video = $this->Data->GetInfo($id.'-video'); ?>

<div class="image-presentation liveadmin-settings" style="background-image: url('<?= upload($data->id_file->file) ?>')">

    <div class="bgc"></div>

    <? if($video && $video->id_file->file ): ?>

    <video loop="" autoplay="" muted="" playsinline="">

        <source src="<?= upload($video->id_file->file) ?>" type="video/mp4">

    </video>

    <? endif ?>
    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_file', 'id'=>$id, 'text'=>'Editar imagen']) ?>





    <!-- <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_file', 'id'=>$id.'-video', 'text'=>'Editar Video']) ?> -->



    <div class="center">

        <div class="wow fadeIn" data-wow-delay=".3s">



            <h1 class="title"><?= $title ?></h1>

            <h3 class="subtitle"><?= $subtitle ?></h3>



            <?
            if (isset($btn)) {
                $this->load->view('components/liveadmin/admin-btn', [

                    'id'=>$id.'-btn1',

                    'class'=> 'btn btn-primary',

                    'html'=> $btn,

                    'default'=>$btnLink,

                ]);
            }
             ?>



        </div>



        <? $this->load->view('components/svgs/arrow-down.svg') ?>

    </div>

</div>