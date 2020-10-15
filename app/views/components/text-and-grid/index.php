<div class="text-and-grid liveadmin-settings sweepToRight wow2">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/members_list', 'id'=>$id, 'text'=>'Editar Miembros']); 

    $data = $this->Data->GetInfo($id);



    ?>

    <div class="wow2 w2FadeIn" data-wow2-delay="600">

        <div class="incont ">

            <div class="row">

                <div class="col-lg-6 col-md-12">

                    <div class="center">



                        <div class="title"><?= $title ?></div>



                        <div class="text">

                            <?= $text ?>

                        </div>



                        <div class="more">

                            <? $this->load->view('components/liveadmin/admin-btn', [

                            'id'=>$id.'-btn1',

                            'class'=> 'link',

                            'html'=> $btn . ' ' . $this->load->view('components/svgs/arrow-rigth.svg', [], true),

                            'default'=>$btnLink,

                        ]) ?>

                        </div>

                    </div>



                </div>

                <div class="col-lg-6 col-md-12">

                    <div class="grid">

                        <? foreach( $data->data as $i => $value): $member = $this->Data->GetMember($value->id); if($member->active!=1) continue; ?>

                        <div class="item">

                            <? if($member->link): ?>

                            <a href="<?= $member->link ?>" target="_blank">

                                <? endif ?>

                                <img class="item-img" src="<?= upload($member->file) ?>" alt="">

                                <? if($member->link): ?>

                            </a>

                            <? endif ?>



                            <div class="item-title"><?= $member->title ?></div>

                            <div class="item-subtitle"><?= $member->sector ?></div>

                        </div>

                        <? endforeach ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>
.custom-darkblue .btn-white-outline:hover {
    background: #FFF;
    color: #16223A !important;
}

.custom-darkblue .btn-white-outline:hover span {
    color: #16223A !important;
}
</style>