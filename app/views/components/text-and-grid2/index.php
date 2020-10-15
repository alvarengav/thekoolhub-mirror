<div class="text-and-grid2 liveadmin-settings <?= isset($style) ? 'custom-' . $style : '' ?> sweepToUp wow2">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/members_list', 'id'=>$id, 'text'=>'Editar Miembros']); 

    $data = $this->Data->GetInfo($id);



    ?>

    <div class="incont">



        <div class="center incont-min w2FadeIn wow2" data-wow2-delay="600">



            <div class="title"><?= $title ?></div>



            <div class="text">

                <?= $text ?>

            </div>



        </div>





        <div class="grid">

            <? foreach( $data->data as $i => $value): $member = $this->Data->GetMember($value->id) ?>

            <div class="item w2FadeIn wow2" data-wow2-delay="600">

                <img class="item-img" src="<?= upload($member->file) ?>" alt="">



                <div class="item-title"><?= $member->title ?></div>

                <div class="item-subtitle"><?= $member->sector ?></div>

            </div>

            <? endforeach ?>

        </div>





        <div class="more wow2" data-wow2-delay="900">

            <? $this->load->view('components/liveadmin/admin-btn', [

                    'id'=>$id.'-btn1',

                    'class'=> 'btn btn-white-outline',

                    'html'=> $btn,

                    'default'=>$btnLink,

                ]) ?>

        </div>

    </div>

</div>

<style>
.custom-yellow.white-button .btn-white-outline:hover {
    color: #FFA900;
    background: #FFF;
}
</style>