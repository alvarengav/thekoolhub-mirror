<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppMainModel extends AppModel {

  public
    $lang = "es",
    $project = 0,
    $secure = false,
    $root = false,
    $user = false;

  public function __construct()
  {
    parent::__construct();
    $this->lang = $this->config->item('lang', 'app');
    $this->project = $this->config->item('project-id', 'app');
    $this->config->set_item('cookie_prefix', $this->ProjectEncodeName());
  }

  public function ProjectEncodeName( $id = 0 )
  {
    return 'p' . $this->project . substr(md5($this->project),0,5);
  }

  public function LoadDefaultModel()
  {
    $controller = strtolower($this->uri->segment(1, 'app'));
    $function = strtolower($this->uri->segment(2, 'index'));
    $model = "{$controller}/{$function}model";
    $model_path = APPPATH.'models/'.$model.'.php';
    if ( ! file_exists($model_path))
    {
      $model_path = NZAPATH.'models/'.$model.'.php';
    }
    if ( ! file_exists($model_path))
    {
      $model = "{$controller}/indexmodel";
      $model_path = APPPATH.'models/'.$model.'.php';
      if ( ! file_exists($model_path))
      {
        $model_path = NZAPATH.'models/'.$model.'.php';
      }
    }
    if (file_exists($model_path))
    {
      $this->load->model($model, "model");
    }
  }

  public function CheckSession()
  {
    if($this->session->userdata('uID'))
    {
      $this->user = $this->DataUser();
      $this->root = ($this->user && $this->user->company == 1);
    }
    $controller = strtolower($this->uri->segment(1, 'app'));
    $function = strtolower($this->uri->segment(2, 'index'));
    if($controller != 'app' && $function != 'user' && $this->user && $this->user->valid == 2)
      redirect('app/user/password');

    if($this->safeController || in_array($function, $this->safeFunctionsU))
    {
      $this->secure = (object)array('view' => 1, 'edit' => 1, 'delete' => 1, 'special' => 1);
      return;
    }
    if(!$this->user)
    {
      if(AJAX) exit;
      $this->session->set_userdata('nextUrl', current_url());
      redirect('app/user');
    }
    if(in_array($function, $this->safeFunctions))
    {
      $this->secure = (object)array('view' => 1, 'edit' => 1, 'delete' => 1, 'special' => 1);
      return;
    }
    $this->secure = $this->Secure($controller, $function);
    if(!$this->secure->view)
    {
      if(AJAX) exit;
      return redirect('app/error');
    }
  }
  
  public function DeleteFolder($dir = '')
  {
    $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) 
    { 
      $path = "{$dir}/{$file}";
      is_dir($path) ? $this->DeleteFolder($path) : unlink($path);
    } 
    return rmdir($dir); 
  }

  public function DeleteCache($cache_path = '')
  {
    $path = FCPATH.'app/cache/'.$cache_path;
    if (file_exists($path))
    {
      $this->DeleteFolder($path);      
    }
  }

  public function LangAddItem( $line = '' )
  {
    $total = $this->db->query("select count(*) as total from {$this->dbglobal}lang_item where `key` = '{$line}'")->row()->total;
    if($total) return;
    $sql = $this->db->insert_string("{$this->dbglobal}lang_item", array('key' => $line, 'item' => $line));
    $this->db->query($sql);
  }

  public function UpdateConnection( $id = 0 )
  {
    $id = $id ? $id : $this->user->id;
    $sql = "update {$this->dbglobal}user u
    set u.connection = '". time() ."'
    where u.id_user = '{$id}'";
    return $this->db->query($sql);
  }

  public function GetAppMenu()
  {
    $sql = "select m.id_menu as id, m.name, m.controller, mi.class as ico
    from nz_menu m
    left join {$this->dbglobal}ico mi on mi.id_ico = m.id_ico
    where 1 order by m.num";
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function GetAppSubmenu($id = 0)
  {
    $sql = "select i.name, i.function,
    COALESCE(s.view,0) as `view`, COALESCE(s.edit,0) as `edit`, COALESCE(s.delete,0) as `delete`, COALESCE(s.special,0) as `special`,
    COALESCE(sa.view,0) as `aview`, COALESCE(sa.edit,0) as `aedit`, COALESCE(sa.delete,0) as `adelete`, COALESCE(sa.special,0) as `aspecial`
    from nz_submenu i
    left join nz_user_secure s on s.id_submenu = i.id_submenu and s.id_user = '{$this->user->id}'
    left join nz_company_secure sa on sa.id_submenu = i.id_submenu and sa.id_company = '{$this->user->company}'
    where i.id_menu = '{$id}'
    order by i.num";
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function Secure($controller = '', $function = '')
  {
    $granted = $this->root && ! empty($this->user->company);
    $secure = (object) ['view' => $granted, 'edit' => $granted, 'delete' => $granted, 'special' => $granted];
    if (empty($this->user->company) || $this->root)
    {
      return $secure;
    }

    $sql = "SELECT
    LEAST(COALESCE(s.view, 0),    COALESCE(sa.view, 0))    AS `view`,
    LEAST(COALESCE(s.edit, 0),    COALESCE(sa.edit, 0))    AS `edit`,
    LEAST(COALESCE(s.delete, 0),  COALESCE(sa.delete, 0))  AS `delete`,
    LEAST(COALESCE(s.special, 0), COALESCE(sa.special, 0)) AS `special`
    FROM nz_submenu i
    LEFT JOIN nz_menu im on im.id_menu = i.id_menu
    LEFT JOIN nz_user_secure s on s.id_submenu = i.id_submenu and s.id_user = '{$this->user->id}'
    LEFT JOIN nz_company_secure sa on sa.id_submenu = i.id_submenu and sa.id_company = '{$this->user->company}'
    WHERE i.function = '{$function}' and im.controller = '{$controller}'
    ORDER by i.num
    LIMIT 1";
    return $this->db->query($sql)->row() ?: $secure;
  }

  public function GetDataUser($id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "select u.id_user as id, u.name, u.lastname, u.mail, u.password, u.id_type as type, u.id_company as company, u.valid, u.active, u.obs,
      a.company as companyname, a.mail as companymail
      from {$this->dbglobal}user u
      left join {$this->dbglobal}company a on a.id_company = u.id_company
      where u.id_user = '{$id}'";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }
    $ret['name'] = $this->input->post('name');
    $ret['lastname'] = $this->input->post('lastname');
    $ret['password'] = isset($_POST['password']) ? $this->input->post('password') : substr(md5(uniqid(mt_rand())),0,10);
    $ret['mail'] = $this->input->post('mail');
    $ret['type'] = $this->input->post('type');
    $ret['company'] = $this->input->post('company');
    $ret['valid'] = 0;
    $ret['obs'] = $this->input->post('obs');
    $ret['active'] = count($_POST) ? isset($_POST['active']) : 1;
    return $ret;
  }

  public function DataUser( $id = 0 )
  {
    $id = $id ? $id : $this->session->userdata('uID');
    $sql = "select u.id_user as id, u.name, u.lastname, u.mail, u.id_type as type, u.id_company as company, a.id_type as atype, u.valid,
    IF(f.file, f.id_file, f2.id_file) as idpicture, IF(f.file, f.file, f2.file) as picture
    from {$this->dbglobal}user u
    left join {$this->dbglobal}company a on a.id_company = u.id_company
    left join {$this->dbglobal}nz_file f on f.id_file = u.id_file
    left join {$this->dbglobal}nz_file f2 on f2.id_file = a.id_file
    where u.id_user = '{$id}'";
    return $this->db->query($sql)->row();
  }

  public function GetCompanyAdmins( $company = 0, $id = 0 )
  {
    $sql = "select u.id_user as id
    from {$this->dbglobal}user u

    left join {$this->dbglobal}company c on c.id_company = u.id_company
    where (u.id_company = '{$company}' and u.id_type < 3 and u.id_user != '{$id}') OR (u.id_type = 1 AND c.id_type = 1)";
    $result = $this->db->query($sql)->result();
    $ret = array();
    foreach($result as $r)
      $ret[] = $r->id;
    return $ret;
  }

  public function GetParseDataSession($item = '')
  {
    $sitem = $this->GetDataSession($item);
    if(!$sitem) return false;
    return json_decode($sitem->data);
  }

  public function GetDataSession( $item = '' )
  {
    $sql = "select d.data
    from nz_user_data d
    where d.id_user = '" . $this->session->userdata('uID') . "' and d.item = '{$item}'";
    return $this->db->query($sql)->row();
  }

  public function UpdateDataSession( $item = '', $data = array())
  {
    $sitem = $this->GetDataSession($item);
    if(!$sitem)
    {
      $sql = $this->db->insert_string('nz_user_data', array('id_user' => $this->session->userdata('uID'), 'item' => $item, 'data' => json_encode($data)));
      return $this->db->query($sql);
    }
    $ndata = json_decode($sitem->data);
    foreach($data as $key => $value)
      $ndata->$key = $value;
    $sql = $this->db->update_string('nz_user_data', array('data' => json_encode($ndata)), "id_user = '" . $this->session->userdata('uID') . "' and item = '{$item}'");
    return $this->db->query($sql);
  }

  public function GalleryItems( $id = 0 )
  {
    $sql = "select f.id_file as id, f.file, f.id_type as type, f.name
    from {$this->dbfiles}nz_gallery_file g
    left join {$this->dbfiles}nz_file f on f.id_file = g.id_file
    where g.id_gallery = '{$id}' and f.deleted = '0' order by g.num";
    return $this->db->query($sql)->result();
  }

  public function DuplicateGallery( $id = 0, $idn = 1 )
  {
    $sql = "insert into {$this->dbfiles}nz_gallery_file (id_gallery, id_file, num) select '{$idn}', id_file, num from {$this->dbfiles}nz_gallery_file where id_gallery = '{$id}' order by num";
    $this->db->query($sql);
  }

  public function AddGalleryItems( $id = 0, $items = array())
  {
    $num = 0;
    foreach($items as $i)
    {
      $i = round($i);
      if(!$i) continue;
      $sql = $this->db->insert_string("{$this->dbfiles}nz_gallery_file", array('id_gallery' => $id, 'id_file' => $i, 'num' => $num));
      $this->db->query($sql);
      $num++;
    }
  }

  public function AddGalleryItem( $id = 0, $file = 0 )
  {
    $sql = "select max(num) as num from {$this->dbfiles}nz_gallery_file where id_gallery = '{$id}'";
    $num = $this->db->query($sql)->row()->num + 1;
    $sql = $this->db->insert_string("{$this->dbfiles}nz_gallery_file", array('id_gallery' => $id, 'id_file' => $file, 'num' => $num));
    $this->db->query($sql);
  }

  public function DeleteGallery( $id = 0 )
  {
    $this->EmptyGallery($id);
    $sql = "delete from {$this->dbfiles}nz_gallery where id_gallery = '{$id}'";
    return $this->db->query($sql);
  }

  public function EmptyGallery( $id = 0 )
  {
    $sql = "delete from {$this->dbfiles}nz_gallery_file where id_gallery = '{$id}'";
    return $this->db->query($sql);
  }

  public function GetFile($id = 0)
  {
  	$sql = "SELECT f.file as fxfile, f.id_type as fxtype, 
  	f.id_file as fxid, f.name as fxname
  	FROM {$this->dbfiles}nz_file f
  	WHERE f.id_file = ?";
    return $this->db->query($sql, [$id])->row_array();
  }

  public function CreateGallery()
  {
    $sql = $this->db->insert_string("{$this->dbfiles}nz_gallery", array());
    $this->db->query($sql);
    return $this->db->insert_id();
  }

  public function GetNotificationsListTotal()
  {
    $sql = "select count(*) as total
    from {$this->dbglobal}notification n
    where n.id_user = '{$this->user->id}'";
    return $this->db->query($sql)->row()->total;
  }

  public function GetNotificationsList( $init = 0, $perpage = 5 )
  {
    $init = round($init);
    $sql = "select n.id_notification as id, n.*
    from {$this->dbglobal}notification n
    where n.id_user = '{$this->user->id}'
    order by n.id_notification desc
    LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }

  public function GetNotifications( $id = 0 )
  {
    $id = round($id);
    $sql = "select n.id_notification as id, n.*
    from {$this->dbglobal}notification n
    where " .  ( $id ? " n.id_notification > '{$id}' and " : "") .
    "n.id_user = '{$this->user->id}'
    order by n.id_notification desc";
    if(!$id)
      $sql .= " LIMIT 0, 50";
    return $this->db->query($sql)->result();
  }

  public function GetNotificationsCount()
  {
    $sql = "select count(*) as total
    from {$this->dbglobal}notification n
    where n.id_user = '{$this->user->id}' and viewed = '0'";
    return $this->db->query($sql)->row()->total;
  }

  public function ReadAllNotifications()
  {
    $sql = "update {$this->dbglobal}notification set viewed = '1' where id_user = '{$this->user->id}' and viewed = '0'";
    $this->db->query($sql);
  }

  public function ReadNotification( $id = 0 )
  {
    $id = round($id);
    $sql = "update {$this->dbglobal}notification set viewed = '1' where id_user = '{$this->user->id}' and id_notification = '{$id}'";
    $this->db->query($sql);
  }

  public function UnreadNotification( $id = 0 )
  {
    $id = round($id);
    $sql = "update {$this->dbglobal}notification set viewed = '0' where id_user = '{$this->user->id}' and id_notification = '{$id}'";
    $this->db->query($sql);
  }

  public function DeleteNotification( $id = 0 )
  {
    $id = round($id);
    $sql = "delete from {$this->dbglobal}notification where id_user = '{$this->user->id}' and id_notification = '{$id}'";
    $this->db->query($sql);
  }

  public function AddNotification( $users = array(), $data = array())
  {
    if(!is_array($users))
    {
      $users = array($users);
    }
    foreach($users as $user)
    {
      if(!$user) continue;
      $notification = array(
        'id_user' => $user,
        'id_type' => $data['id_type'],
        'id_project' => $data['id_project'],
        'data' => $data['data'],
        'text' => $data['text'],
        'link' => $data['link'],
        'time' => time()
      );
      $sql = $this->db->insert_string("{$this->dbglobal}notification", $notification);
      $this->db->query($sql);
    }
  }

  public function redirect($redirect = '', $ajax_redirect = TRUE, $content = '')
  {
    if ($redirect == 'default-home-url')
    {
    	return $this->redirect('app/home');
    }
    if ( ! $ajax_redirect)
    {
      return $this->SetOutput($content);
    }
    redirect($redirect);
  }

  public function SetOutputJSON($content = '', $encode = FALSE)
  {
    if ($encode)
    {
    	$content = json_encode($content);
    }
    $this->SetOutput($content, TRUE);
  }

  public function SetOutput($content = '', $json = FALSE, $nocache = FALSE)
  {
    if($nocache)
    {
      $this->output
        ->set_header('Cache-Control: no-cache, must-revalidate')
        ->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }
    $this->output
      ->set_content_type($json ? 'application/json' : 'text/html', 'utf-8')
      ->set_output($content ?: ($json ? '{}' : ''))
      ->_display();
    exit;
  }

}
