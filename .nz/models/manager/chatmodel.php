<?php

class ChatModel extends AppModel {
  
  public function Contact( $id = 0 )
  {
    $sql = "SELECT t.id_user as id, t.name as name, t.lastname as lastname, a.company as company, a.id_company as idcompany, t.connection,
    IF(t.id_file, t.id_file, a.id_file) as pictureid, IF(t.id_file, f.file, f2.file) as picture, IF(a.id_company = '{$this->MApp->user->company}', 0, 1) as companyu
    FROM {$this->dbglobal}user as t    
    LEFT JOIN {$this->dbglobal}company a on t.id_company = a.id_company
    left join {$this->dbglobal}nz_file f on f.id_file = t.id_file
    left join {$this->dbglobal}nz_file f2 on f2.id_file = a.id_file
    WHERE t.id_user != '{$this->MApp->user->id}' and t.active = '1' and t.valid = '1' and t.id_user = '{$id}'
    ORDER BY companyu, a.company, t.name, t.lastname";
    $user = $this->db->query($sql)->row();
    if(!$user) return false;
    $user->status = $this->ContactStatus($user->connection);
    unset($user->companyu);
    $user->opened = round($this->session->userdata('udata-user-chat-' . $user->id));
    $user->size = round($this->session->userdata('udata-user-chat-' . $user->id . '-size'));
    if($user->pictureid)
      $user->picture = profile_url($user->pictureid, $user->picture);
    else
      $user->picture = '';      
    unset($user->pictureid);
    return $user;
  }
  
  public function ContactStatus( $time = 0 )
  {
    $time = round($time);  
    if(!$time)
      return 0;
    if($time > time() - 120)
      return 1;
    elseif($time > time() - 300)
      return 2;
    return 0;
  }
    
  public function Contacts()
  {
    $time = time() - 60 * 2;
    $sql = "SELECT t.id_user as id, t.name as name, t.lastname as lastname, a.company as company, a.id_company as idcompany, t.connection,
    IF(t.id_file, t.id_file, a.id_file) as pictureid, IF(t.id_file, f.file, f2.file) as picture, IF(a.id_company = '{$this->MApp->user->company}', 0, 1) as companyu
    FROM {$this->dbglobal}user as t    
    LEFT JOIN {$this->dbglobal}company a on t.id_company = a.id_company
    LEFT JOIN {$this->dbglobal}company_relation cr on t.id_company = cr.id_relation
    left join {$this->dbglobal}nz_file f on f.id_file = t.id_file
    left join {$this->dbglobal}nz_file f2 on f2.id_file = a.id_file
    WHERE t.id_user != '{$this->MApp->user->id}' and t.active = '1' and t.valid = '1' and (cr.id_company = '{$this->MApp->user->company}' OR t.id_company = '{$this->MApp->user->company}' )
    ORDER BY companyu, a.company, t.name, t.lastname";
    $users = $this->db->query($sql)->result();
    foreach($users as $key => $user)
    {
      $user->status = $this->ContactStatus($user->connection);
      unset($users[$key]->companyu);
      $user->opened = round($this->session->userdata('udata-user-chat-' . $user->id));
      $user->size = round($this->session->userdata('udata-user-chat-' . $user->id . '-size'));
      if($user->pictureid)
        $users[$key]->picture = profile_url($user->pictureid, $user->picture);
      else
        $users[$key]->picture = '';      
      unset($users[$key]->pictureid);
    }
    return $users;
  }
  
  public function Messages($user = 0, $unix = 0)
  {
    $id = $this->MApp->user->id;
    $user = round($user);
    if(!$id || !$user) return array();
    $unix = round($unix);
    if(!$unix) $unix = time();
    $sql = "select m.time, m.message, m.id_from as id, m.viewed, m.id_type as type,
    IF(m.id_from = '{$id}', 1, 0) as user from {$this->dbglobal}message m 
    where m.id_from IN({$id},{$user}) AND m.id_to IN({$id},{$user}) and m.time < '{$unix}' 
    order by m.id_message desc LIMIT 0, 100";
    return $this->db->query($sql)->result();     
  }
  
  public function View( $user = 0 )
  {
    $id = $this->MApp->user->id;
    if(!$id) return false;
    $sql = "update {$this->dbglobal}message m
    set m.viewed = '1' 
    where m.id_to = '{$id}' and m.id_from = '{$user}' and m.viewed = '0'";
    return $this->db->query($sql);
  }
  
  public function Pull()
  {
    $id = $this->MApp->user->id;
    if(!$id) return array();
    $sql = "select m.time, m.message, m.id_from as id, m.viewed, m.id_type as type
    from {$this->dbglobal}message m 
    where m.id_to = '{$id}' and m.receive = '0' 
    order by m.id_message asc";
    $result = $this->db->query($sql)->result();    
    $sql = "update {$this->dbglobal}message m
    set m.receive = '1' 
    where m.id_to = '{$id}' and m.receive = '0'";
    $this->db->query($sql);
    return $result;
  }
  
  public function MessageFile($from = 0, $to = 0, $file = 0)
  {
    $file = round($file);
    $from = round($from);
    $to = round($to);
    if(!$from || !$to || !$file) return false;
    
    $dbglobal = $this->config->item('db-global', 'app');
    $row = $this->db->query("select * from {$dbglobal}nz_file where id_file = '{$file}'")->row();
    if(!$row) return false;    
    $ms = array(
      'id' => $row->id_file,
      'name' => $row->name,
      'url' => upload($row->file, 1),
      'type'=> $row->id_type,
      'thumb'=> ($row->id_type == 1) ? base_url() . "app/thumbc/{$row->id_file}" : ''
    );
    $message = json_encode($ms);
    $sql = $this->db->insert_string("{$this->dbglobal}message", array(
      'id_from' => $from,
      'id_to' => $to,
      'id_type' => 2,
      'message' => $message,
      'time' => time(),
      'receive' => 0,
      'viewed' => 0
    ));
    $this->db->query($sql);
    return true;
  }
  
  public function Message($from = 0, $to = 0, $message = '')
  {
    $from = round($from);
    $to = round($to);
    $message = $this->clearMessage($message);
    if(!$from || !$to || !$message) return false;
    $sql = $this->db->insert_string("{$this->dbglobal}message", array(
      'id_from' => $from,
      'id_to' => $to,
      'message' => $message,
      'time' => time(),
      'receive' => 0,
      'viewed' => 0
    ));
    $this->db->query($sql);
    return true;
  }
  
  
  public function clearMessage($text = '') 
  {
    $text = htmlspecialchars($text, ENT_QUOTES);
    $text = str_replace("\n\r", "\n", $text);
    $text = str_replace("\r\n", "\n", $text);
    $text = str_replace("  ", " ", $text);
    return $text;
  }
    
}