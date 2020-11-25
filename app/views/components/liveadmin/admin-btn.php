<div class="<? if($admin): ?>admin-btn<? endif ?> relative">

<? $this->load->view('components/liveadmin/settings', ['url'=>'contents/one_link', 'id'=>'admin-btn-'.$id, 'text'=>'Editar link']); 

$data = $this->Data->GetInfo('admin-btn-'.$id);



?>

<a href="<?= ($data&&isset($data->link)&&$data->link) ? $data->link : $default ?>" <?= isset($class) && $class ? ' class="'.$class.'"' : '' ?>  <?= isset($data->blank) && $data->blank=='1' ? ' target="_blank"' : '' ?>>

    <?= $html ?> <? //$this->load->view('components/svgs/arrow-rigth.svg') ?>

</a>

</div>

<? if($admin): ?>

    

    <style>

        .admin-btn .btn-settings {

            opacity: 0 !important;

            position: absolute !important;

            top: -30px !important;

            margin-left: 10px !important;

            right: inherit !important;

            cursor: pointer !important;

            z-index: 9999 !important; 

        }

        

        .admin-btn:hover .btn-settings {

            opacity: 1 !important;

        }

    </style>

<? endif ?>