<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserMainModel extends AppModel {
  
  public function Login($mail = '', $password = '')
  {  
    $ret = array();
    $ret['changepassword'] = false;
    $ret['error'] = false;
    $sql = "select u.id_user as id, u.password as password, u.valid
    from {$this->dbglobal}user u 
    left join {$this->dbglobal}company a on a.id_company = u.id_company
    where u.mail = ? and u.active = '1' and a.active = '1'";
    $row = $this->db->query($sql, array($mail))->row();
    if(!$row)
    {
      $ret['error'] = 1;
      return $ret;
    } 
    if(!$row->valid)
    {
      $ret['error'] = 1;
      return $ret;
    }      
    if($row->password != $password)
    {
      $ret['error'] = 2;
      return $ret;
    }    
    if($row->valid == 2)
    {
      $ret['changepassword'] = true;
    }
    $ret['id'] = $row->id;
    return $ret;
  }
  
  public function ChangePassword($id = 0, $password = '')
  {  
    $sql = $this->db->update_string("{$this->dbglobal}user", array('password' => $password, 'valid' => 1), "id_user = '{$id}' and valid > 0");
    return $this->db->query($sql);
  }  
  
  public function Register($data = array())
  {
    $ret = array();
    $ret['error'] = false;
    if(!$this->ValidMail($data['mail']))
    {
      $ret['error'] = 1;
      return $ret;
    }
    if(!$this->ValidCompany($data['id_company']))
    {
      $ret['error'] = 1;
      return $ret;
    }
    $data['password'] = substr(md5(uniqid(mt_rand())),0,10);
    $data['id_type'] = 3;
    $data['active'] = 1;
    $data['valid'] = 0;
    $sql = $this->db->insert_string("{$this->dbglobal}user", $data);
    $this->db->query($sql);
    $id = $this->db->insert_id();
    $ret['id'] = $id;    
    $sql = "insert into nz_user_secure select '{$id}', s.id_submenu, s.view, s.edit, s.delete, s.special from nz_company_secure s where s.id_company = '{$data['id_company']}'";
    $this->db->query($sql);
    return $ret;
  }
  
  public function ForgotPassword($mail = '')
  {
    $time = $this->session->userdata('forgotpassword');
    $ret = array();
    $ret['error'] = false;
    /*if($time > time() - 3 * 60)
    {
      $ret['error'] = 2;
      return $ret;
    }*/
    $sql = "select id_user as id from {$this->dbglobal}user where mail = '{$mail}' and active = '1' and valid > 0";
    $row = $this->db->query($sql)->row();
    if(!$row)
    {
      $ret['error'] = 1;
      return $ret;
    }
    $password = substr(md5(uniqid(mt_rand())),0,10);
    $sql = "update {$this->dbglobal}user set password = '{$password}', valid = '2' where id_user = '{$row->id}'";
    $this->db->query($sql);
    $ret['id'] = $row->id;
    return $ret;
  }    
  
  public function ValidCompany($id = 0)
  {
    $sql = "select count(*) as total from {$this->dbglobal}company where id_company = '{$id}' and active = '1'";
    $total = $this->db->query($sql)->row()->total;
    return $total;
  }
  
  public function ValidMail($mail = '')
  {
    $sql = "select count(*) as total from {$this->dbglobal}user where mail = '{$mail}'";
    $total = $this->db->query($sql)->row()->total;
    return ($total == 0);
  }  

  public function ValidMailUser($mail = '', $id = 0)
  {
    $sql = "select count(*) as total from {$this->dbglobal}user where mail = '{$mail}' and id_user != '{$id}'";
    return !($this->db->query($sql)->row()->total > 0);
  }
  
  public function SaveUserPreferences()
  {
    if(!$this->ValidMailUser($this->input->post('mail'), $this->user->id)) return false;
    $data = array(
      'name' => $this->input->post('name'),
      'lastname' => $this->input->post('lastname'),
      'id_file' => $this->input->post('id_file'),
      'mail' => $this->input->post('mail'),
    );
    if (isset($_POST['obs']))
    {
      $data['obs'] = $this->input->post('obs');
    }
    $this->db->update("{$this->dbglobal}user", $data, "id_user = '{$this->user->id}'");
    return true;
  }
  
  public function DataUserPreferences( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_user as id, t.*,
      lj0.type as type, a.company as company, a.id_file as company_file, 
      lj2.file as fm1file, lj2.id_type as fm1type, lj2.name as fm1name,
      lj3.file as fm2file, lj3.id_type as fm2type, lj3.name as fm2name
      FROM {$this->dbglobal}user as t      
      LEFT JOIN {$this->dbglobal}user_type lj0 on t.id_type = lj0.id_type       
      LEFT JOIN {$this->dbglobal}company a on t.id_company = a.id_company   
      LEFT JOIN {$this->dbglobal}nz_file lj2 on t.id_file = lj2.id_file      
      LEFT JOIN {$this->dbglobal}nz_file lj3 on a.id_file = lj3.id_file      
      WHERE t.id_user = '{$id}'";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_file'] = $this->input->post() ? $this->input->post('id_file') : '';
    $ret['obs'] = $this->input->post() ? $this->input->post('obs') : '';
    $ret['name'] = $this->input->post() ? $this->input->post('name') : '';
    $ret['lastname'] = $this->input->post() ? $this->input->post('lastname') : '';
    $ret['mail'] = $this->input->post() ? $this->input->post('mail') : '';
    $ret['password'] = $this->input->post() ? $this->input->post('password') : substr(md5(uniqid(mt_rand())),0,10);
    return $ret;
  }
  
}
