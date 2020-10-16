<div class="grid-boxes-img-text liveadmin-settings">

    <? $this->load->view('components/liveadmin/settings', ['url'=>'contents/events_list', 'id'=>$id, 'text'=>'Editar Eventos']); 

    $data = $this->Data->GetInfo($id);
    ?>

    <div class="container">

        <? foreach( $data->data as $i => $value): ?>

        <div class="wow2 w2FadeIn" data-wow2-delay="300">
            <?
                $events = $this->Data->GetEvent(); $events;

                //is events is false, set empty array
                $events = $events ? $events : [];
            ?>
            <? foreach($events as $event): ?>
            <? $this->load->view('components/events/event', ['event'=>$event, 'style'=> $value->style]) ?>
            <? endforeach; ?>
        </div>

        <? endforeach ?>

    </div>

</div>
<style>
    .box-darkblue .text {
        color: #16223A !important;
    }
</style>


<style>
    @media only screen and (max-width: 575px) {

        .grid-boxes-img-text .box .picture {
            width: 100% !important;
            height: 300px;
        }

        .grid-boxes-img-text .box .textContent {
            width: 100% !important;
        }

        .grid-boxes-img-text .box .textContent .title {
            width: auto;
            color: #ef867d;
        }
    }
</style>