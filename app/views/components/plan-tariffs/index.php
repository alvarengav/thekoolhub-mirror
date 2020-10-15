<div class="plan-tariffs requiere-header-white <?= isset($style) ? 'grid-boxes-'.$style : '' ?>">
    <div class="incont incont-min">
        <div class="row">
            <? foreach( $boxes as $i => $value):  ?>
                <div class="col-md-5">

                    <!-- <div class="box box--gray wow fadeInUp">
                        <div class="center">
                            <div class="box-icon"><?= $value['icon'] ?></div>
                            <div class="box-title"><?= $value['title'] ?></div>
                            <div class="box-text"><?= $value['text'] ?></div>
                            <div class="box-text2"><?= $value['text2'] ?></div>
                            <div class="box-text3"><?= $value['text3'] ?></div>
                        </div>
                    </div> -->

                    <? if(isset($value['btn'])): ?>                        
                        <? $this->load->view('components/liveadmin/admin-btn', [
                            'id'=>$id.'-btn1',
                            'class'=> 'btn btn-outline',
                            'html'=> $value['btn'],
                            'default'=>$btnLink,
                        ]) ?>
                    <? endif ?>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>