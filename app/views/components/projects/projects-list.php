<div class="projects-list container">
    <div class="row">
        <? foreach($projects as $p): ?>
            <div class="col-md-6">
            <? $this->load->view('components/projects/project-box', ['project'=>$p]) ?>
        </div>
        <? endforeach ?>
    </div>
</div>