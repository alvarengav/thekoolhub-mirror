<?php

class BlogModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "blog";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_blog as id, t.*,
    lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name    
    FROM {$this->table} as t    
    LEFT JOIN nz_file lj1 on t.id_file = lj1.id_file      
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
    LEFT JOIN nz_file lj1 on t.id_file = lj1.id_file 
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
    if($this->input->post('filter-id_blog'))
      $sql .= " AND t.id_blog = '". $this->input->post('filter-id_blog') ."'";
    if($this->input->post('filter-active'))
      $sql .= " AND t.active = '1'";
    if($text)
      $sql .= " AND ( t.title like '%{$text}%'  OR  t.subtitle like '%{$text}%'  OR  t.categories like '%{$text}%'  OR  t.related like '%{$text}%'  OR  t.share_twitter like '%{$text}%'  OR  t.share_facebook like '%{$text}%'  OR  t.share_instagram like '%{$text}%'  OR t.id_blog = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_blog = '". $this->input->post('filter-id') ."'";  
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
      'Selectblog' => $this->Data->Selectblog('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      // array(
      //  'field'   => 'id_blog', 
      //  'label'   => $this->lang->line('ID'), 
      //  'rules'   => 'trim|numeric'
      // ),
      array(
       'field'   => 'title', 
       'label'   => $this->lang->line('Titulo'), 
       'rules'   => 'trim'      
      ),			
      array(
       'field'   => 'subtitle', 
       'label'   => $this->lang->line('Descripción'), 
       'rules'   => 'trim'
      ),			
		
      array(
       'field'   => 'id_file', 
       'label'   => $this->lang->line('Imagen'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'texto', 
       'label'   => $this->lang->line('Texto'), 
       'rules'   => 'trim'
      ),

    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT title as `name`
    FROM {$this->table}
    WHERE id_blog = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_blog = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_blog']);    
    
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
      'title2' => $this->input->post('title2'),
      'date' => $this->input->post('date'),
      'subtitle' => $this->input->post('subtitle'),
      'categories' => json_encode($this->input->post('categories')),
      'related' => json_encode($this->input->post('related')),
      'id_file' => $this->input->post('id_file') ? $this->input->post('id_file') : false,
      'id_interior_file' => $this->input->post('id_file') ? $this->input->post('id_interior_file') : false,
      'id_author' => $this->input->post('id_author') ? $this->input->post('id_author') : false,
      'texto' => $this->input->post('texto'),
      'active' => $this->input->post('active') ? 1 : 0,
      'lang' => $this->custom_lang,

    );

    
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_blog = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    return $this->id ? $this->id : $this->db->insert_id();
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_blog = '{$id}'";
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_blog as id, t.*,
      lj0.title as blog,
      lj1.file as fm1file, lj2.file as fm2file, lj1.id_type as fm1type, lj1.name as fm1name      
      FROM {$this->table} as t      
      LEFT JOIN blog lj0 on t.id_blog = lj0.id_blog       
      LEFT JOIN nz_file lj1 on t.id_file = lj1.id_file  
      LEFT JOIN nz_file lj2 on t.id_interior_file = lj2.id_file      
      WHERE t.id_blog = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();

      $ret['categories'] = $ret['categories'] ? json_decode($ret['categories']) : false;
      $ret['related'] = $ret['related'] ? json_decode($ret['related']) : false;
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_blog'] = $this->input->post() ? $this->input->post('id_blog') : '';
    $ret['title'] = $this->input->post() ? $this->input->post('title') : '';
    $ret['title2'] = $this->input->post() ? $this->input->post('title2') : '';
    $ret['date'] = $this->input->post() ? $this->input->post('date') : '';
    $ret['subtitle'] = $this->input->post() ? $this->input->post('subtitle') : '';
    $ret['categories'] = $this->input->post() ? $this->input->post('categories') : '';
    $ret['related'] = $this->input->post() ? $this->input->post('related') : '';
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['id_interior_file'] = $this->input->post() ? $this->input->post('id_interior_file') : '';
    $ret['id_author'] = $this->input->post() ? $this->input->post('id_author') : '';
    $ret['active'] = $this->input->post('active') ? 1 : 0;

    $ret['texto'] = $this->input->post() ? $this->input->post('texto') : '';
     return $ret;
  }

}