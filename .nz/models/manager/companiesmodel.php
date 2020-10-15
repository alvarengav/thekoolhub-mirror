<?php

class CompaniesModel extends AppModel {

  public function __construct()
  {
    parent::__construct();
    $this->table = "{$this->dbglobal}company";    
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];     
    
    $sql = "SELECT t.id_company as id, t.*, lj0.type as type, lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name,
    lj2.client as client,
    (select count(*) from {$this->dbglobal}company_relation where id_company = t.id_company) as relations,
    (select count(*) from {$this->dbglobal}project_company where id_company = t.id_company) as projects,
    (select count(*) from {$this->dbglobal}user where id_company = t.id_company and active = '1') as users
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}company_type lj0 on t.id_type = lj0.id_type  
    LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file     
    LEFT JOIN {$this->dbglobal}client lj2 on t.id_client = lj2.id_client
    WHERE $where 
    ORDER BY {$orderby} {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t
    LEFT JOIN {$this->dbglobal}company_type lj0 on t.id_type = lj0.id_type  
    LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file    
    LEFT JOIN {$this->dbglobal}client lj2 on t.id_client = lj2.id_client 
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $sql = "1";    
    if($this->MApp->user->type != 1)
      $sql .= " AND t.id_type != '1'";  
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($this->input->post('filter-active'))
      $sql .= " AND t.active = '1'";
    if($text)
      $sql .= " AND ( t.company like '%{$text}%'  OR  t.mail like '%{$text}%'  OR  t.obs like '%{$text}%'  OR t.id_company = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_company = '". $this->input->post('filter-id') ."'";  
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
      'SelectCompanyType' => $this->DataG->SelectCompanyType('', $this->lang->line('Selecciona una opción'))
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'company', 
       'label'   => $this->lang->line('Empresa'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'mail', 
       'label'   => $this->lang->line('E-Mail'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Activa'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'obs', 
       'label'   => $this->lang->line('Observaciones'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT company as name
    FROM {$this->table}
    WHERE id_company = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_company = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_company']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $idn =  $this->db->insert_id();
    return $idn;
  }
  
  public function Relations( $id = 0 )
  {    
    $sql = "select i.id_company as idcompany, i.company as company, i.id_type as type, s.id_relation as relation
    from {$this->dbglobal}company as i
    left join {$this->dbglobal}company_relation s on s.id_company = '{$id}' AND s.id_relation = i.id_company
    where i.id_company != '{$id}'
    order by relation desc, type, i.company";
    return $this->db->query($sql)->result();
  }
  
  public function SaveCompanyRelations($companies = array(), $id = 0)
  {   
    if(!$this->MApp->secure->edit) return false;
    $sql = "delete from {$this->dbglobal}company_relation where id_company = '{$id}' OR id_relation = '{$id}'";
    $this->db->query($sql);
    $num = 0;
    if(!$companies) return;
    foreach($companies as $key => $value)
    {
      $sql = $this->db->insert_string("{$this->dbglobal}company_relation", array(
        'id_company' => $id,
        'id_relation' => $key
      ));
      $this->db->query($sql);
      $sql = $this->db->insert_string("{$this->dbglobal}company_relation", array(
        'id_company' => $key,
        'id_relation' => $id
      ));
      $this->db->query($sql);
    }
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $new = ($this->id == 0);
    $data = array(
      'id_type' => $this->input->post('id_type'),
      'id_file' => $this->input->post('id_file'),
      'id_client' => $this->input->post('id_client'),
      'company' => $this->input->post('company'),
      'mail' => $this->input->post('mail'),
      'active' => $this->input->post('active') ? 1 : 0,
      'obs' => $this->input->post('obs'),
    );
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_company = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql); 
    $this->id = $this->id ? $this->id : $this->db->insert_id();
    if($new)
      $this->CreateCompanyAdmin($this->id);
    $this->SaveCompanySecure($this->input->post('secure'), $this->id);
    $this->SaveCompanyRelations($this->input->post('relations'), $this->id);
    return $this->id;
  }
  
  public function SaveCompanySecure($data = array(), $id = 0)
  { 
    if(!$this->MApp->secure->edit) return;
    $sql = "delete from nz_company_secure where id_company = '{$id}'";
    $this->db->query($sql); 
    if(!$data) return;
    foreach($data as $key => $value)
    {
      $sql = $this->db->insert_string('nz_company_secure', array(
        'id_company' => $id,
        'id_submenu' => $key,
        'view' => isset($value['view']) ? 1 : 0,
        'edit' => isset($value['edit']) ? 1 : 0,
        'delete' => isset($value['delete']) ? 1 : 0,
        'special' => isset($value['special']) ? 1 : 0
      ));
      $this->db->query($sql);
    }
  }
  
  public function CreateCompanyAdmin($id = 0)
  {
    $company = $this->DataElement($id, true);
    $data = array();
    $data['mail'] = $company['mail'];
    $data['id_file'] = $company['id_file'];
    $data['id_company'] = $id;
    $data['lastname'] = $company['company'];
    $data['name'] = $this->lang->line("Administrador");
    $data['password'] = substr(md5($data['mail'].$data['id_company'].$data['name'].time()),0,12);
    $data['id_type'] = 2;
    $data['active'] = 1;
    $data['valid'] = 1;
    $sql = $this->db->insert_string("{$this->dbglobal}user", $data);
    $this->db->query($sql);
    $idu = $this->db->insert_id();
    $sql = "insert into nz_user_secure select '{$idu}', s.id_submenu, s.view, s.edit, s.delete, s.special from nz_company_secure s where s.id_company = '{$id}'";
    $this->db->query($sql);
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return FALSE;
    return FALSE;
    if( $id == 1 ) return FALSE;
    if($this->MApp->user->type > 2) return FALSE;
    $sql = "DELETE FROM {$this->table} WHERE id_company = '{$id}'";
    if($this->MApp->user->type != 1)
      $sql .= " AND id_type != '1'";      
    $this->db->query($sql);
    return TRUE;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_company as id, t.*, lj0.type as type, lj1.file as fm1file, lj1.id_type as fm1type, lj1.name as fm1name    
      FROM {$this->table} as t    
      LEFT JOIN {$this->dbglobal}company_type lj0 on t.id_type = lj0.id_type  
      LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file    
      WHERE t.id_company = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_type'] = $this->input->post() ? $this->input->post('id_type') : 2;
    $ret['id_client'] = $this->input->post() ? $this->input->post('id_client') : 0;
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['company'] = $this->input->post() ? $this->input->post('company') : '';
    $ret['mail'] = $this->input->post() ? $this->input->post('mail') : '';
    $ret['active'] = $this->input->post('active') ? 1 : 0;
    $ret['obs'] = $this->input->post() ? $this->input->post('obs') : '';
    return $ret;
  }
  
  public function Secure($id = 0, $menu = 0)
  {
    $sql = "select i.name as submenu, i.id_submenu as id, i.function, im.name as menu, im.controller,
    COALESCE(s.view,0) as `view`, COALESCE(s.edit,0) as `edit`, COALESCE(s.delete,0) as `delete`, COALESCE(s.special,0) as `special`
    from nz_submenu as i
    left join nz_menu as im on im.id_menu = i.id_menu
    left join nz_company_secure s on s.id_submenu = i.id_submenu and s.id_company = '{$id}'
    where i.id_menu = '{$menu}' " . (($this->MApp->user->type == 1) ? "" : " and i.root ='0' ") . "
    order by im.num, i.num";
    return $this->db->query($sql)->result();
  }

}
