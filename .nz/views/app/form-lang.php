<?php 

$item['data'] = $dataItem;
foreach ($this->model->langs as $l)
{
  $item['lang'] = $l;
  $this->load->view('app/form', array('item' => $item));
}
