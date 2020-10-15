<?php

class SubmenuModel extends AppModel 
{  

  public function __construct()
  {
    parent::__construct();
    $this->table = "nz_submenu";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];  
    if($orderby == 'menu')
      $orderby = 'lj0.num';
    $sql = "SELECT t.id_submenu as id, t.*,
    lj0.name as menu    
    FROM {$this->table} as t    
    LEFT JOIN nz_menu lj0 on t.id_menu = lj0.id_menu      
    WHERE $where 
    ORDER BY {$orderby} {$ascdesc}, t.num asc LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN nz_menu lj0 on t.id_menu = lj0.id_menu 
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
    if($this->input->post('filter-id_menu'))
      $sql .= " AND t.id_menu = '". $this->input->post('filter-id_menu') ."'";
    if($text)
      $sql .= " AND ( t.function like '%{$text}%'  OR  t.name like '%{$text}%'  OR t.id_submenu = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_submenu = '". $this->input->post('filter-id') ."'";  
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
      'SelectMenu' => $this->DataG->SelectMenu('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_menu', 
       'label'   => $this->lang->line('Menú'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'function', 
       'label'   => $this->lang->line('Función'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'name', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'num', 
       'label'   => $this->lang->line('Orden'), 
       'rules'   => 'trim|numeric'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {  
    $id = $id ? $id : $this->id;
    $sql = "SELECT function as name
    FROM {$this->table}
    WHERE id_submenu = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_submenu = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_submenu']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $id =  $this->db->insert_id();
    return $id;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'id_menu' => $this->input->post('id_menu'),
      'function' => $this->input->post('function'),
      'name' => $this->input->post('name'),
      'num' => $this->input->post('num'),
      'root' => $this->input->post('root') ? 1 : 0
    );
    if( $this->id )
      $sql = $this->db->update_string( $this->table, $data, "id_submenu = '{$this->id}'" );
    else
      $sql = $this->db->insert_string( $this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Save( $data = array() )
  {
    if(!$this->MApp->secure->edit) return;
    if( $this->id )
      $sql = $this->db->update_string( $this->table, $data, "id_submenu = '{$this->id}'" );
    else
      $sql = $this->db->insert_string( $this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}    WHERE id_submenu = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_submenu as id, t.*,
      lj0.name as menu      
      FROM {$this->table} as t      
      LEFT JOIN nz_menu lj0 on t.id_menu = lj0.id_menu       
      WHERE t.id_submenu = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_menu'] = $this->input->post() ? $this->input->post('id_menu') : '';
    $ret['function'] = $this->input->post() ? $this->input->post('function') : '';
    $ret['name'] = $this->input->post() ? $this->input->post('name') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    $ret['root'] = $this->input->post('root') ? 1 : 0;
    return $ret;
  }

}