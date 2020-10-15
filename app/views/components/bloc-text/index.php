<div class="bloc-text wow2 sweepToUp">
    <div class="center wow2 w2FadeIn" data-wow2-delay="600">
        <div class="container incont ">

            <div class="text">
                <?= $text ?>    
        </div>
            <? if(isset($btn) && $btn ): ?>
                
                <div class="more  ">
                    <? $this->load->view('components/liveadmin/admin-btn', [
                        'id'=>$id.'-btn1',
                        'class'=> 'link',
                        'html'=> $btn . ' ' . $this->load->view('components/svgs/arrow-rigth.svg', [], true),
                        'default'=>$btnLink,
                    ]) ?>
                </div>
            <? endif ?>
        </div>
    </div>
</div>