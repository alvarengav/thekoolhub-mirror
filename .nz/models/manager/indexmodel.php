<?php

class IndexModel extends AppModel {
   
  public function GenerateAccessLink( $title = '', $subtitle = '', $controller  = '', $function = '' )
  {
    $sql = "select id_menu as id from nz_menu where controller = '{$controller}'";
    $row = $this->db->query($sql)->row();
    if($row)
    {
     $id = $row->id;
    }
    else
    {
      $row = $this->db->query("select max(`num`)+1 as max from `nz_menu` where controller not in ('manager', 'tickets')")->row();
      $num = ($row->max) ? $row->max : 1 ;
      $sql = $this->db->insert_string("nz_menu", array(
        'name' => $title,
        'controller' => $controller,
        'id_ico' => 1,
        'num' => $num
      ));
      $this->db->query($sql);
      $id = $this->db->insert_id();
    }
    $sql = "select id_submenu as id from nz_submenu where id_menu = '{$id}' AND function = '{$function}'";
    $row = $this->db->query($sql)->row();
    if($row)
      return;
    $row = $this->db->query("select max(`num`)+1 as max from `nz_submenu` where id_menu = '{$id}'")->row();
    $num = ($row->max) ? $row->max : 1 ;
    $sql = $this->db->insert_string("nz_submenu", array(
      'name' => $subtitle,
      'function' => $function,
      'id_menu' => $id,
      'num' => $num
    ));
    $this->db->query($sql);
  }  
    
  function AllTables( $sel = '' )
  {
    $table = $this->db->list_tables();
    $data = array();
    if($sel) $data[' '] = $sel;
    foreach($table as $t)
      $data[$t] = ucfirst($t);
    return $data;
  }
  
  function FieldsTable( $table = '', $sel = '' )
  {
    $fields = $this->db->list_fields($table);
    $data = array();
    if($sel)
    $data[' '] = $sel;
    foreach($fields as $f)
      $data[$f] = ucfirst($f);
    return $data;
  }    
  
}