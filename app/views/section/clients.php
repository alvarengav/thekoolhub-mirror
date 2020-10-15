<div class="screen-clients requiere-white-header">

    <div class="page-clients incont ">
        

        <div class="screen  wow fadeIn">
            <div class="center">
                
                <h1 class="title wow fadeIn" data-wow-delay="900ms"><?= $clients->title ?></h1>
                <blockquote class="wow fadeInUp" data-wow-delay="1200ms"><?= $clients->subtitle ?></blockquote>
                
            </div>
            <div class="down wow fadeInUp" data-wow-delay="1400ms">
                <img src="<?= layout('img/angle-down.png') ?>" class="no-select">
            </div>
        </div>
    </div>
</div>
<div class="page-clients">
<? $projects = $this->Data->GetProjects(60,1); ?>

<? $this->load->view('components/projects/projects-list', ['projects'=>$projects]); ?>
</div>
