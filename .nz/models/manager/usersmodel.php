<?php

class UsersModel extends AppModel {

  public function __construct()
  {
    parent::__construct();
    $this->table = "{$this->dbglobal}user";  
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];  
    $sql = "SELECT t.id_user as id, t.*,
    lj0.type as type, lj1.company as company, lj2.file as fm1file, lj2.id_type as fm1type, lj2.name as fm1name
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}user_type lj0 on t.id_type = lj0.id_type
    LEFT JOIN {$this->dbglobal}company lj1 on t.id_company = lj1.id_company
    LEFT JOIN {$this->dbglobal}nz_file lj2 on t.id_file = lj2.id_file
    WHERE $where 
    ORDER BY {$orderby} {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}user_type lj0 on t.id_type = lj0.id_type     
    LEFT JOIN {$this->dbglobal}company lj1 on t.id_company = lj1.id_company 
    LEFT JOIN {$this->dbglobal}nz_file lj2 on t.id_file = lj2.id_file
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $sql = "1";
    
    if($this->MApp->user->atype != 1 || $this->MApp->user->type > 2)
      $sql .= " AND t.id_company = '". $this->MApp->user->company ."'";
    if($this->MApp->user->type != 1)
      $sql .= " AND t.id_type != '1'";
      
    if(!$filter) 
      return $sql;  
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($this->input->post('filter-id_type'))
      $sql .= " AND t.id_type = '". $this->input->post('filter-id_type') ."'";
    if($this->input->post('filter-id_company'))
      $sql .= " AND t.id_company = '". $this->input->post('filter-id_company') ."'";
    if($this->input->post('filter-id_client'))
      $sql .= " AND lj1.id_client = '". $this->input->post('filter-id_client') ."'";
    if($this->input->post('filter-active'))
      $sql .= " AND t.active = '1'";
    if($this->input->post('filter-valid'))
      $sql .= " AND t.valid = '1'";
    if($text)
      $sql .= " AND ( t.name like '%{$text}%'  OR  t.lastname like '%{$text}%'  OR  t.mail like '%{$text}%'  OR  t.password like '%{$text}%'  OR  t.obs like '%{$text}%'  OR t.id_user = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_user = '". $this->input->post('filter-id') ."'";  
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
      'SelectUserType' => $this->DataG->SelectUserType('', $this->lang->line('Selecciona una opción')),
      'SelectCompany' => $this->DataG->SelectCompany('', $this->lang->line('Selecciona una opción')),      
    );
  }
  
  public function Validate($id = 0)
  {  
    $sql = $this->db->update_string($this->table, array('valid' => 2), "id_user = '{$id}' and valid = '0'");
    return $this->db->query($sql);
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_type', 
       'label'   => $this->lang->line('Tipo de usuario'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_company', 
       'label'   => $this->lang->line('Empresa'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'name', 
       'label'   => $this->lang->line('Nombre'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'lastname', 
       'label'   => $this->lang->line('Apellido'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'mail', 
       'label'   => $this->lang->line('E-mail'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'password', 
       'label'   => $this->lang->line('Contraseña'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'obs', 
       'label'   => $this->lang->line('Observaciones'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'active', 
       'label'   => $this->lang->line('Activo'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'valid', 
       'label'   => $this->lang->line('Válido'), 
       'rules'   => 'trim'
      ),
    );
  }  
  
  public function ValidMailUser($mail = '', $id = 0)
  {
    $sql = "select count(*) as total from {$this->table} where mail = '{$mail}' and id_user != '{$id}'";
    return !($this->db->query($sql)->row()->total > 0);
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT name, lastname
    FROM {$this->table}
    WHERE id_user = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name . ' ' . $row->lastname);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_user = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_user']);    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $id =  $this->db->insert_id();
    return $id;
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $new = ($this->id == 0);
    if(!$this->ValidMailUser($this->input->post('mail'), $this->id)) return false;
    $data = array(
      'name' => $this->input->post('name'),
      'lastname' => $this->input->post('lastname'),
      'id_file' => $this->input->post('id_file'),
      'mail' => $this->input->post('mail'),
      'obs' => $this->input->post('obs'),
      'active' => $this->input->post('active') ? 1 : 0
    );
    if(isset($_POST['password']))
      $data['password'] = $this->input->post('password');
    if($this->input->post('id_type'))
      $data['id_type'] = ( $this->input->post('id_type') > $this->MApp->user->type ) ? $this->input->post('id_type') : $this->MApp->user->type ;
    elseif($new)
      $data['id_type'] = 3;
    if($this->input->post('id_company'))
      $data['id_company'] = $this->input->post('id_company');
    if( $this->id )
      $sql = $this->db->update_string($this->table, $data, "id_user = '{$this->id}'" );
    else
      $sql = $this->db->insert_string($this->table, $data );
    $this->db->query($sql);     
    $this->id = $this->id ? $this->id : $this->db->insert_id();
    if($new)
      $this->SaveUserSecureFromCompany($this->input->post('id_company'), $this->id);
    else
      $this->SaveUserSecure($this->input->post('secure'), $this->id);
    return $this->id;
  }
  
  public function SaveUserSecureFromCompany($company = 0, $id = 0)
  {
    $sql = "insert into nz_user_secure select '{$id}', s.id_submenu, s.view, s.edit, s.delete, s.special from nz_company_secure s where s.id_company = '{$company}'";
    $this->db->query($sql);
  }
  
  public function SaveUserSecure($data = array(), $id = 0)
  { 
    if(!$this->MApp->secure->edit) return;
    $sql = "delete from nz_user_secure where id_user = '{$id}'";
    $this->db->query($sql); 
    if(!$data) return;
    foreach($data as $key => $value)
    {
      $sql = $this->db->insert_string('nz_user_secure', array(
        'id_user' => $id,
        'id_submenu' => $key,
        'view' => isset($value['view']) ? 1 : 0,
        'edit' => isset($value['edit']) ? 1 : 0,
        'delete' => isset($value['delete']) ? 1 : 0,
        'special' => isset($value['special']) ? 1 : 0
      ));
      $this->db->query($sql);
    }
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete || $this->MApp->user->type > 2) return false;
    
    return FALSE;
    
    $sql = "DELETE FROM {$this->table} WHERE id_user = '{$id}'";
    
    if($this->MApp->user->atype != 1 || $this->MApp->user->type > 2)
      $sql .= " AND id_company = '". $this->MApp->user->company ."'";
    if($this->MApp->user->type != 1)
      $sql .= " AND id_type != '1'";
    
    $this->db->query($sql);
    return true;
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_user as id, t.*,
      lj0.type as type, lj1.company as company, lj2.file as fm1file, lj2.id_type as fm1type, lj2.name as fm1name
      FROM {$this->table} as t      
      LEFT JOIN {$this->dbglobal}user_type lj0 on t.id_type = lj0.id_type       
      LEFT JOIN {$this->dbglobal}company lj1 on t.id_company = lj1.id_company   
      LEFT JOIN {$this->dbglobal}nz_file lj2 on t.id_file = lj2.id_file      
      WHERE t.id_user = '{$id}'";
      if($this->MApp->user->atype != 1 || $this->MApp->user->type > 2)
        $sql .= " AND t.id_company = '". $this->MApp->user->company ."'";
      if($this->MApp->user->type != 1)
        $sql .= " AND t.id_type != '1'";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_type'] = $this->input->post() ? $this->input->post('id_type') : 3;
    $ret['id_company'] = $this->input->post() ? $this->input->post('id_company') : $this->MApp->user->company;
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['name'] = $this->input->post() ? $this->input->post('name') : '';
    $ret['lastname'] = $this->input->post() ? $this->input->post('lastname') : '';
    $ret['mail'] = $this->input->post() ? $this->input->post('mail') : '';
    $ret['password'] = $this->input->post() ? $this->input->post('password') : substr(md5(uniqid(mt_rand())),0,10);
    $ret['obs'] = $this->input->post() ? $this->input->post('obs') : '';
    $ret['active'] = $this->input->post('active') ? 1 : 0;
    return $ret;
  }
    
  public function Secure($id = 0, $ida = 0, $menu = 0)
  {
    $sql = "select i.name as submenu, i.id_submenu as id, i.function, im.name as menu, im.controller,
    COALESCE(s.view,0) as `view`, COALESCE(s.edit,0) as `edit`, COALESCE(s.delete,0) as `delete`, COALESCE(s.special,0) as `special`,
    COALESCE(sa.view,0) as `aview`, COALESCE(sa.edit,0) as `aedit`, COALESCE(sa.delete,0) as `adelete`, COALESCE(sa.special,0) as `aspecial`
    from nz_submenu as i
    left join nz_menu as im on im.id_menu = i.id_menu
    left join nz_user_secure s on s.id_submenu = i.id_submenu and s.id_user = '{$id}'
    left join nz_company_secure sa on sa.id_submenu = i.id_submenu and sa.id_company = '{$ida}'
    where i.id_menu = '{$menu}' " . (($this->MApp->user->type == 1) ? "" : " and i.root ='0' ") . "
    order by im.num, i.num";
    return $this->db->query($sql)->result();
  }

}
