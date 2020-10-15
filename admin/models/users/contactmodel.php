<?php

class ContactModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "contact";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_contact as id, t.*    
    FROM {$this->table} as t    
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $sql = "1";
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($text)
      $sql .= " AND ( t.first_name like '%{$text}%'  OR  t.last_name like '%{$text}%'  OR  t.mail like '%{$text}%'  OR  t.phone like '%{$text}%'  OR  t.text like '%{$text}%'  OR t.id_contact = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_contact = '". $this->input->post('filter-id') ."'";  
    return $sql;
  }  
  
  public function JSON()
  {
    $total = $this->ListTotal();
    $total2 = $this->ListTotal(true);
    $json = $this->ListItems();
    $sEcho = $this->input->post('sEcho');
    return '{"sEcho":' . $sEcho . ',"iTotalRecords": '. $total .',"iTotalDisplayRecords": '. $total2 .',"aaData":' . json_encode($json) . '}';
  }
  
  public function DataSelects()
  {
    return array(      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'first_name', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'      
      ),
      array(
       'field'   => 'last_name', 
       'label'   => $this->lang->line('Apellido'), 
       'rules'   => 'trim'      
      ),
      array(
       'field'   => 'mail', 
       'label'   => $this->lang->line('Mail'), 
       'rules'   => 'trim'      
      ),
      array(
       'field'   => 'phone', 
       'label'   => $this->lang->line('Teléfono'), 
       'rules'   => 'trim'      
      ),			
      array(
       'field'   => 'text', 
       'label'   => $this->lang->line('Comentarios'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT first_name as `name`
    FROM {$this->table}
    WHERE id_contact = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_contact = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_contact']);    
    
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'mail' => $this->input->post('mail'),
      'phone' => $this->input->post('phone'),
      'text' => $this->input->post('text'),
    );
        if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_contact = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_contact = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_contact as id, t.*      
      FROM {$this->table} as t      
      WHERE t.id_contact = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['first_name'] = $this->input->post() ? $this->input->post('first_name') : '';
    $ret['last_name'] = $this->input->post() ? $this->input->post('last_name') : '';
    $ret['mail'] = $this->input->post() ? $this->input->post('mail') : '';
    $ret['phone'] = $this->input->post() ? $this->input->post('phone') : '';
    $ret['text'] = $this->input->post() ? $this->input->post('text') : '';
    return $ret;
  }

}