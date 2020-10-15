<div class="bg-gray1 grid-boxes-green requiere-header-white" style="background-color: #f2f2f2">
    <div class="incont wow fadeInUp" data-wow-delay=".3s">
        <div class="title"><?= $this->Data->Content($id . 'first-title') ?></div>
    </div>

    <div class="incont">
        <div class="row">
            <? foreach( $boxes as $i => $value):  ?>
            <div class="col-lg-3 col-md-6">

                <div class="box box--gray wow fadeInUp" data-wow-delay=".6s">
                    <div class="center">
                        <? if(isset($value['icon']) && $value['icon'] ): ?>
                        <div class="box-icon"><?= $value['icon'] ?></div>
                        <? endif ?>
                        <div class="box-title"><?= $value['title'] ?></div>
                        <div class="box-text"><?= $value['text'] ?></div>

                        <div class="more">
                            <? 
                            $arrow = $this->load->view('components/svgs/arrow-rigth.svg',[],true);
                            $this->load->view('components/liveadmin/admin-btn', [
                                'id'=>$id.'-btn-'.$i,
                                'class'=> 'link',
                                'html'=> $this->Data->Content($id.'btnMore-'.$i) . ' '. $arrow,
                                'default'=>'',
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <? endforeach ?>
        </div>

        <div class="end-btn">
            <? $this->load->view('components/liveadmin/admin-btn', [
                'id'=>$id.'-btn1',
                'class'=> 'btn btn-outline"',
                'html'=> $this->Data->Content($id.'-btn-text'),
                'default'=>$btnLink,
            ]) ?>
        </div>
    </div>
</div>