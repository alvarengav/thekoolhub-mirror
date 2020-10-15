<div class="info-table last-bold liveadmin-settings <?= isset($style) ? 'custom-' . $style : '' ?>"">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/component_info_table', 'id'=>$id, 'text'=>'Editar tabla']) ?>



    <? $data = $this->Data->GetInfo($id);

        $info = $data->info_table;

    ?>

    <div class=" incont incont-min wow2 w2FadeIn" data-wow2-delay="300">

    <table class="table">

        <? foreach( $info as $i => $value): ?>

        <? if($i==0) : ?>

        <thead>

            <tr>

                <th scope="col"><?= $value->col1 ?></th>

                <th class="text-center" scope="col"><?= $value->col2 ?></th>

                <th class="text-center" scope="col"><?= $value->col3 ?></th>

            </tr>

        </thead>

        <tbody>



            <? else: ?>



            <tr>

                <td><?= $value->col1 ?></td>

                <td class="text-center"><?= str_replace(':tick:', '<div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="10.887" height="7.619" viewBox="0 0 10.887 7.619">

                    <path id="Trazado_355" data-name="Trazado 355" d="M-16202.555-20342.889l1.775,2.795,6.324-5.209" transform="translate(16203.935 20346.711)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>

                    </svg></div>

                    ', $value->col2) ?></td>

                <td class="text-center"><?= str_replace(':tick:', '<div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="10.887" height="7.619" viewBox="0 0 10.887 7.619">

                    <path id="Trazado_355" data-name="Trazado 355" d="M-16202.555-20342.889l1.775,2.795,6.324-5.209" transform="translate(16203.935 20346.711)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>

                    </svg></div>

                    ', $value->col3) ?></td>

            </tr>

            <? endif ?>

            <? endforeach ?>



        </tbody>

        <tfoot>

            <tr>

                <td></td>

                <td>
                    <? 

                                $arrow = $this->load->view('components/svgs/arrow-rigth.svg',[],true);

                                $this->load->view('components/liveadmin/admin-btn', [

                                    'id'=>$id.'-last-1-',

                                    'class'=> 'btn btn-outline',

                                    'html'=> $this->Data->Content($id.'last-1-txt-'),

                                    'default'=>'',

                                ]) ?>
                </td>

                <td>
                    <? 

                                $arrow = $this->load->view('components/svgs/arrow-rigth.svg',[],true);

                                $this->load->view('components/liveadmin/admin-btn', [

                                    'id'=>$id.'-last-2-',

                                    'class'=> 'btn btn-outline',

                                    'html'=> $this->Data->Content($id.'last-2-txt-'),

                                    'default'=>'',

                                ]) ?>
                </td>

            </tr>

        </tfoot>

    </table>

</div>

<? if($btn): ?>



<div class="more wow2 w2FadeIn" data-wow2-delay="900">



    <a class="btn btn-black-outline" href="<?= $this->Data->lang_url('contact') ?>"><?= $btn ?></a>

</div>

<? endif ?>

</div>

<style>
.custom-darkblue .btn-outline:hover {
    background: #FFF;
    color: #16223A;
}
</style>