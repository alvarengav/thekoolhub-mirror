<div class="screen-services requiere-white-header">

    <div class="page-services incont ">
        

        <div class="screen  wow fadeIn">
            <div class="center">
                
                <h1 class="title wow fadeIn" data-wow-delay="900ms"><?= $info_page->title ?></h1>
                <blockquote class="wow fadeInUp" data-wow-delay="1200ms"><?= $info_page->subtitle ?></blockquote>
                
            </div>
            <div class="down wow fadeInUp" data-wow-delay="1400ms">
                <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
            </div>
        </div>
    </div>
</div>

<div class="page-clients">
<? $blog = $this->Data->GetBlog(100,1,$categoria);  ?>
                <? $this->load->view('components/blog/widget-grid', ['blog'=>$blog]); ?>
</div>


</div>