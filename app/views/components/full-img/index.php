<div class="full-img liveadmin-settings wow2 w2FadeIn">
<? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_file', 'id'=>$id, 'text'=>'Editar imagen']) ?>
<? $data = $this->Data->GetInfo($id); ?>

<img src="<?= upload( $data->id_file->file ) ?>">
</div>