<?php

class ProjectsModel extends AppModel {

  function __construct()
  {
    parent::__construct();
    $this->table = "{$this->dbglobal}project";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_project as id, t.*, (select count(*) from {$this->dbglobal}project_company where id_project = t.id_project) as companies,
    lj0.client as client,
    lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name    
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}client lj0 on t.id_client = lj0.id_client      
    LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}client lj0 on t.id_client = lj0.id_client     
    LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file 
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $project = $this->MApp->project;
    $sql = "SELECT p.id_project as id
    FROM {$this->dbglobal}project p
    left join {$this->dbglobal}project_company s on s.id_project = p.id_project
    where s.id_company = '{$this->MApp->user->company}' OR p.id_project = '{$project}'";
    $result = $this->db->query($sql)->result();
    $ids = array(0);
    foreach($result as $r)
      $ids[] = $r->id;
    #$sql .= " AND ( t.id_category != '1' OR (t.id_category = '1' AND t.id_project IN (" . implode($ids) . ") )) ";    
    $sql = "1";
    $sql .= " AND t.id_project IN (" . implode(',', $ids) . ") ";  
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($this->input->post('filter-id_client'))
      $sql .= " AND t.id_client = '". $this->input->post('filter-id_client') ."'";
    if(!$this->input->post('filter-finish'))
      $sql .= " AND t.finish = '0'";
    if(!$this->input->post('filter-active'))
      $sql .= " AND t.active = '1'";
    if($text)
      $sql .= " AND ( t.project like '%{$text}%'  OR  t.url like '%{$text}%'  OR  t.obs like '%{$text}%'  OR t.id_project = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_project = '". $this->input->post('filter-id') ."'";  
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
      'SelectClient' => $this->DataG->SelectClient('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_client', 
       'label'   => $this->lang->line('Cliente'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'date', 
       'label'   => $this->lang->line('Inicio'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'project', 
       'label'   => $this->lang->line('Proyecto'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'url', 
       'label'   => $this->lang->line('URL'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'obs', 
       'label'   => $this->lang->line('Observaciones'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'finish', 
       'label'   => $this->lang->line('Terminado'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_file', 
       'label'   => $this->lang->line('Imagen'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Activo'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT project as `name`
    FROM {$this->table}
    WHERE id_project = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_project = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_project']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    
    $sql = "insert into {$this->dbglobal}project_company select '{$idn}', pc.id_company, num from {$this->dbglobal}project_company pc where pc.id_project = '{$id}' order by num";
    $this->db->query($sql); 
    
    return $idn;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $data = array(
      'id_client' => $this->input->post('id_client'),
      'date' => human_to_mysql($this->input->post('date')),
      'project' => $this->input->post('project'),
      'url' => prep_url($this->input->post('url')),
      'obs' => $this->input->post('obs'),
      'finish' => $this->input->post('finish') ? 1 : 0,
      'id_file' => $this->input->post('id_file'),
      'data' => json_encode($this->input->post('data')),
      'active' => $this->input->post('active') ? 1 : 0,
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_project = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    $this->id = $this->id ? $this->id : $this->db->insert_id();
    $this->SaveProjectCompanies($this->id, $this->input->post('companies'));
    return $this->id;
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $sql = "DELETE FROM {$this->table}
    WHERE id_project = '{$id}'";
    $this->db->query($sql);
    return true;
  }
  
  public function Companies( $id = 0 )
  {    
    $sql = "select i.id_company as idcompany, i.company as company, i.id_type as type, s.id_project as project
    from {$this->dbglobal}company as i
    left join {$this->dbglobal}project_company s on s.id_project = '{$id}' AND s.id_company = i.id_company
    order by project desc, s.num, i.company";
    return $this->db->query($sql)->result();
  }
  
  public function SaveProjectCompanies($id = 0, $companies = array())
  {   
    if(!$this->MApp->secure->edit) return false;
    $sql = "delete from {$this->dbglobal}project_company where id_project = '{$id}'";
    $this->db->query($sql);
    $num = 0;
    if(!$companies) return;
    foreach($companies as $key => $value)
    {
      $sql = $this->db->insert_string("{$this->dbglobal}project_company", array(
        'id_project' => $id,
        'id_company' => $key,
        'num' => $num++,
      ));
      $this->db->query($sql);
    }
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_project as id, t.*,
      lj0.client as client,
      lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name      
      FROM {$this->table} as t      
      LEFT JOIN {$this->dbglobal}client lj0 on t.id_client = lj0.id_client       
      LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file      
      WHERE t.id_project = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_client'] = $this->input->post() ? $this->input->post('id_client') : '';
    $ret['date'] = $this->input->post() ? human_to_mysql($this->input->post('date')) : date('Y-m-d');
    $ret['project'] = $this->input->post() ? $this->input->post('project') : '';
    $ret['url'] = $this->input->post() ? $this->input->post('url') : '';
    $ret['obs'] = $this->input->post() ? $this->input->post('obs') : '';
    $ret['finish'] = $this->input->post('finish') ? 1 : 0;
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['data'] = $this->input->post('data') ? json_encode($this->input->post('data')) : '';
    $ret['active'] = $this->input->post('active') ? 1 : 0;
    return $ret;
  }

}