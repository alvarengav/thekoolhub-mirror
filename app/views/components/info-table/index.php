<div class="info-table liveadmin-settings <?= isset($style) ? 'custom-'.$style : '' ?>"">
    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/component_info_table_col4', 'id'=>$id, 'text'=>'Editar tabla']) ?>

    <? $data = $this->Data->GetInfo($id);
        $info = $data->info_table;
    ?>
    <div class="incont incont-min wow2 w2FadeIn" data-wow2-delay="300">
        <table class="table">
            <? foreach( $info as $i => $value): ?>
                <? if($i==0) : ?>
                    <thead>
                        <tr>
                            <? if($value->col1): ?>
                            <th scope="col"><?= $value->col1 ?></th>
                            <? endif ?>
                            <? if($value->col2): ?>
                            <th class="text-center" scope="col"><?= $value->col2 ?></th>
                            <? endif ?>
                            <? if($value->col3): ?>
                            <th class="text-center" scope="col"><?= $value->col3 ?></th>
                            <? endif ?>
                            <? if(isset($value->col4) && $value->col4): ?>
                            <th class="text-center" scope="col"><?= $value->col4 ?></th>
                            <? endif ?>
                        </tr>
                    </thead>
                <tbody>

                <? else: ?>
                
                    <tr>
                    <? if(isset($info[0]->col1) && $info[0]->col1): ?>
                            <td><?= $value->col1 ?></td>
                        <? endif ?>
                        <? if(isset($info[0]->col2) && $info[0]->col2): ?>
                            <td class="text-center"><?= str_replace(':tick:','<div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="10.887" height="7.619" viewBox="0 0 10.887 7.619">
                        <path id="Trazado_355" data-name="Trazado 355" d="M-16202.555-20342.889l1.775,2.795,6.324-5.209" transform="translate(16203.935 20346.711)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg></div>
                        ', $value->col2) ?></td>
                        <? endif ?>
                        <? if(isset($info[0]->col3) && $info[0]->col3): ?>
                        <td  class="text-center"><?= str_replace(':tick:','<div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="10.887" height="7.619" viewBox="0 0 10.887 7.619">
                    <path id="Trazado_355" data-name="Trazado 355" d="M-16202.555-20342.889l1.775,2.795,6.324-5.209" transform="translate(16203.935 20346.711)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg></div>
                    ', $value->col3) ?></td>
                    <? endif ?>
                    <? if(isset($info[0]->col4) && $info[0]->col4): ?>
                        <td  class="text-center"><?= str_replace(':tick:','<div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="10.887" height="7.619" viewBox="0 0 10.887 7.619">
                    <path id="Trazado_355" data-name="Trazado 355" d="M-16202.555-20342.889l1.775,2.795,6.324-5.209" transform="translate(16203.935 20346.711)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg></div>
                    ', $value->col4) ?></td>
                    <? endif ?>
                </tr>
                <? endif ?>
            <? endforeach ?>
                
        </tbody>
        </table>
    </div>
    <? if($btn): ?>
        
        <div class="more wow2 w2FadeIn" data-wow2-delay="900">
            
            <a class="btn btn-black-outline" href="<?= $this->Data->lang_url('contact') ?>"><?= $btn ?></a>
        </div>
        <? endif ?>
</div>