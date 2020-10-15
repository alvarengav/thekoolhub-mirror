<?php

class TeamModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "team";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_post as id, t.*,
    lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name    
    FROM {$this->table} as t    
    LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file      
    WHERE $where ";
    $sql .= " AND t.lang = '". $this->custom_lang ."'";  

    $sql .= " ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file 
    WHERE $where";
        $sql .= " AND t.lang = '". $this->custom_lang ."'";  

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
    if($this->input->post('filter-active'))
      $sql .= " AND t.active = '1'";
    if($text)
      $sql .= " AND ( t.title like '%{$text}%'  OR  t.subtitle like '%{$text}%'  OR  t.lang like '%{$text}%'  OR t.id_post = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_post = '". $this->input->post('filter-id') ."'";  
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
       'field'   => 'title', 
       'label'   => $this->lang->line('Titulo'), 
       'rules'   => 'trim'      
      ),
      array(
       'field'   => 'subtitle', 
       'label'   => $this->lang->line('Subtitulo'), 
       'rules'   => 'trim'      
      ),
      array(
       'field'   => 'lang', 
       'label'   => $this->lang->line('Idioma'), 
       'rules'   => 'trim'      
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Active'), 
       'rules'   => 'trim'
      ),			
      array(
       'field'   => 'id_file', 
       'label'   => $this->lang->line('File'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT title as `name`
    FROM {$this->table}
    WHERE id_post = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_post = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_post']);    
    
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'title' => $this->input->post('title'),
      'subtitle' => $this->input->post('subtitle'),
      'text' => $this->input->post('text'),
      'num' => $this->input->post('num'),
      'active' => $this->input->post('active') ? 1 : 0,
      'id_file' => $this->input->post('id_file'),
      'lang' => $this->custom_lang,

    );
        if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_post = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_post = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_post as id, t.*,
      lj0.file as fm1file, lj0.id_type as fm1type, lj0.name as fm1name      
      FROM {$this->table} as t      
      LEFT JOIN nz_file lj0 on t.id_file = lj0.id_file      
      WHERE t.id_post = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['title'] = $this->input->post() ? $this->input->post('title') : '';
    $ret['subtitle'] = $this->input->post() ? $this->input->post('subtitle') : '';
    $ret['text'] = $this->input->post() ? $this->input->post('text') : '';
    $ret['num'] = $this->input->post() ? $this->input->post('num') : '';
    $ret['active'] = $this->input->post('active') ? 1 : 0;
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    return $ret;
  }

}