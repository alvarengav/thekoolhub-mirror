<?php

class InfoModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = 'info';
    $this->var = false;
    $this->mconfig = array(
      'title' => '',
      'subtitle' => '',
      'custom-ico' => '',
      'uri-segment' => 1,
      'order-column' => 'id',
      'order-type' => 'desc',
      'new-element' => true,
      'duplicate' => true,
      'folder-global' => false,
      'folder' => 7,
      'routes' => array()
    );
  }
 
  public function Get( $var = false )
  {
    $var = !$var ? $this->var : $var;
    $r = $this->db->query("SELECT data FROM info WHERE var = '$var'")->row();

    return $r ? ( $this->is_json($r->data) ? json_decode($r->data) : $r->data ) : false;
  }

  public function Set( $data )
  {
    $var = $this->var;
    $info = $this->Get();
    $data = (object)$data;

    for($i=0;$i<10;$i++) {
      $field = $i==0 ? 'id_gallery' : 'id_gallery_'.$i;
      
      if($this->input->post($field.'-items')) {       
        
        $gitems = explode(',', $this->input->post($field.'-items'));
        
        if($this->input->post($field))
          $this->MApp->EmptyGallery($this->input->post($field));

          if(count($gitems))
          {
            if(!$this->input->post($field))
              $data->$field = $this->MApp->CreateGallery();
            else
              $data->$field = $this->input->post($field);

            $this->MApp->AddGalleryItems($data->$field, $gitems);
          }
      } else {
        $this->MApp->EmptyGallery($this->input->post($field));
      }
    }


    $data = json_encode($data);


	  if($info!==false)
	  {
      return $this->db->update('info', ['data' => $data], ['var' => $var]);
	  }
	  else
	  {
	  	return $this->db->insert('info', ['data' => $data, 'var' => $var]);
	  }
  }

  private function is_json($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
  }

}