<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed"); 

class Manager extends AppController 
{

  public function __construct()
  {
    $this->safeFunctionsU = array('chat');
    $this->safeFunctions = array('chat', 'preferences', 'password', 'notifications', 'users_data');
    parent::__construct();      
    $this->cfg['title'] = $this->lang->line('Gestión');
  }
    
  public function projects()
  {
    $this->cfg['subtitle'] = $this->lang->line('Proyectos');
    $this->cfg['order-column'] = "id";
    $this->cfg['order-type'] = "desc";
    $this->cfg['folder'] = 4;
    $this->cfg['folder-global'] = true;
    $this->load->library("abm", $this->cfg);
  }
  
  public function clients()
  {
    $this->cfg['subtitle'] = $this->lang->line('Clientes');
    $this->cfg['order-column'] = "id";
    $this->cfg['order-type'] = "desc";
    $this->cfg['duplicate'] = false; 
    $this->cfg['folder'] = 3;
    $this->cfg['folder-global'] = true;
    $this->load->library("abm", $this->cfg);
  }

  public function menu()
  {
    $this->cfg['subtitle'] = $this->lang->line('Menú');
    $this->cfg['order-column'] = "num";
    $this->cfg['order-type'] = "desc";
    $this->load->library("abm", $this->cfg);
  }
  
  public function submenu()
  {
    $this->cfg['subtitle'] = $this->lang->line('Submenú');
    $this->cfg['order-column'] = "menu";
    $this->cfg['order-type'] = "asc";
    $this->load->library("abm", $this->cfg);
  }
  
  public function icons()
  {
    $this->cfg['subtitle'] = $this->lang->line('Íconos');
    $this->cfg['order-column'] = "ico";
    $this->cfg['order-type'] = "desc";
    $this->load->library("abm", $this->cfg);
  }
  
  public function companies()
  {
    $this->cfg['subtitle'] = $this->lang->line('Empresas');
    $this->cfg['duplicate'] = false;    
    $this->cfg['folder'] = 1;
    $this->cfg['folder-global'] = true;
    $this->load->library("abm", $this->cfg);
  }
  
  public function users()
  {
    $this->cfg['subtitle'] = $this->lang->line('Usuarios');
    $this->cfg['duplicate'] = false;
    $this->cfg['routes'] = array('data' => 'users_data', 'validate' => 'users_validate');
    $this->cfg['folder'] = 2;
    $this->cfg['folder-global'] = true;
    $this->load->library("abm", $this->cfg);
  }
  
  public function users_data()
  {
    $this->load->model('manager/usersmodel', 'modelU');
    header('Content-Type: application/json');
    if($this->input->post('action') == 'mail')
    {
      if(!$this->input->post('mail'))
        die("false");
      $valid = $this->modelU->ValidMailUser($this->input->post('mail'), round($this->input->post('id')));
      die($valid ? "true" : "false");
    }
  }
  
  public function users_validate()
  {
    $id = $this->abm->idItem;
    $this->model->Validate($id);
    $info = $this->model->DataElement($id);
    $html = $this->load->view("app/mail/activation", array('data' => $info), true);
    $this->load->library('PHPMailer');
    $mail = new PHPMailer();
    $mail->From = $this->config->item('client-mail', 'app');
    $mail->FromName = $this->config->item('client', 'app');
    $mail->AddAddress($info['mail']);
    $mail->IsHTML(true);
    $mail->Subject = $this->lang->line("Activación de cuenta");
    $mail->Body = $html;
    mailSave('user-validate', $html);
   /* if(ENVIRONMENT == 'development')
    else*/
      $mail->Send();
    return redirect("manager/users/element/{$id}");
  }
  
  public function preferences()
  {
    if(!$this->MApp->user)
      redirect('app/user');
    $this->data['appNoChangeMenu'] = true;
    $this->data['errorForm'] = false;
    $this->load->library('form_validation', array(), 'validation');
    $this->validation->set_rules('name', $this->lang->line('Nombre'), 'trim|required');
    $this->validation->set_rules('lastname', $this->lang->line('Apellido'), 'trim|required');
    $this->validation->set_rules('mail', $this->lang->line('E-mail'), 'trim|required');
    $this->load->model('UserMainModel', 'UserM');
    $this->UserM->user = $this->MApp->user;
    if( $this->validation->run() !== FALSE && $this->UserM->SaveUserPreferences() )
    {
      $this->MApp->user = $this->MApp->DataUser();
      $this->data['actionResult'] = $this->lang->line('Cambios guardados correctamente.');
    }
    $this->model = (object) array();
    $this->model->mconfig = array();
    $this->model->mconfig['folder'] = 2;
    $this->model->mconfig['folder-global'] = true;
    $this->data['dataItem'] = $this->UserM->DataUserPreferences($this->MApp->user->id);
    $this->data['appTitle'] = $this->lang->line('Mi configuración');
    $this->load->view('manager/preferences', $this->data);
  }
  
  public function _password_check( $str = '' )
  {
    if ($str != $this->data['dataItem']['password'])
    {
      $this->validation->set_message('_password_check', $this->lang->line('Contraseña inválida'));
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
  
  public function actions( $id = 0 )
  {
    $this->load->helper('manager');
    switch($id)
    {
      case 1:
        $this->model->DeleteFiles();
        $this->data['actionResult'] = $this->lang->line('Archivos borrados.');
        break;
      case 2:
        $this->model->DeleteFolders();
        $this->data['actionResult'] = $this->lang->line('Carpetas borradas.');
        break;
      case 3:
        $this->model->DeleteThumbs();
        $this->data['actionResult'] = $this->lang->line('Miniaturas borradas.');
        break;
      case 4:
        $this->model->DeleteOldThumbs();
        $this->data['actionResult'] = $this->lang->line('Miniaturas antiguas borradas.');
        break;
      case 5:
        $this->model->ResetMenu();
        $this->data['actionResult'] = $this->lang->line('Menú restablecido.');
        break;
      case 6:
        $this->model->ResetPermissions();
        $this->data['actionResult'] = $this->lang->line('Permisos reiniciados.');
        break;
      case 7:
        $this->model->TruncateSystem();
        $this->data['actionResult'] = $this->lang->line('Sistema truncado.');
        break;
      case 8:
        $this->model->EmptyUserData();
        $this->data['actionResult'] = $this->lang->line('Datos de usuarios vaciados.');
        break;
    }
    $this->data['appTitle'] = $this->lang->line('Acciones generales');
    $this->load->view('manager/actions', $this->data);
  }
  
  public function password()
  {
    if(!$this->MApp->user)
      redirect('app/user');
    $this->data['appNoChangeMenu'] = true;
    $this->data['errorForm'] = false;
    $this->load->library('form_validation', array(), 'validation');
    $this->validation->set_rules('oldpassword', $this->lang->line('Contraseña actual'), 'trim|required|callback__password_check');
    $this->validation->set_rules('password', $this->lang->line('Contraseña nueva'), 'trim|required');
    $this->load->model('UserMainModel', 'UserM');
    $this->UserM->user = $this->MApp->user;
    $this->data['dataItem'] = $this->UserM->DataUserPreferences($this->MApp->user->id);    
    if( $this->validation->run() !== FALSE && $this->UserM->ChangePassword($this->MApp->user->id, $this->input->post('password')) )    {
      $this->data['actionResult'] = $this->lang->line('Contraseña modificada correctamente.');
    }
    $this->model = (object) array();
    $this->model->mconfig = array();
    $this->model->mconfig['folder'] = 2;
    $this->model->mconfig['folder-global'] = true;
    $this->data['appTitle'] = $this->lang->line('Contraseña');
    $this->load->view('manager/password', $this->data);
  }
  
  public function index()
  {
    $this->data['errorForm'] = false;
    $this->load->library('form_validation', array(), 'validation');
    $this->validation->set_rules('title', $this->lang->line('Título'), 'trim|required');
    $this->validation->set_rules('subtitle', $this->lang->line('Subtítulo'), 'trim|required');
    $this->validation->set_rules('table', $this->lang->line('Tabla'), 'trim|required|callback__checkTable');
    $this->validation->set_rules('controller', $this->lang->line('Controlador'), 'trim|required');
    $this->validation->set_rules('function', $this->lang->line('Función'), 'trim|required');
    $this->validation->set_rules('menu', $this->lang->line('Menú'), 'trim');    
    if( $this->validation->run() !== FALSE )
    { 
      $this->load->library('Automation');
      $result = $this->automation->process();
      if($result)
      {
        $this->data['actionResult'] = $this->lang->line('Modelo, función y vistas generadas correctamente.');
      }
    }
    $this->data['appTitle'] = $this->lang->line('Gestión del Sistema');
    $this->load->view('manager/auto', $this->data);
  }
  
  public function notifications( $action = '' )
  {
    if(!$this->MApp->user)
      redirect('app/user');
    switch($action)
    {
      case 'list':        
        $notifications = $this->MApp->GetNotifications($this->input->post('position'));
        return $this->load->view("manager/notifications/list", array('notifications' => $notifications));        
        break;
      case 'readall':
        $this->MApp->ReadAllNotifications();
        break;
      case 'read':
        header('Content-Type: application/json; charset=UTF-8');
        $this->MApp->ReadNotification($this->input->post('id'));
        $notifications = round($this->MApp->GetNotificationsCount());
        die('{"notifications":{ "count": '. $notifications . '}}');
        break;
      case 'unread':
        header('Content-Type: application/json; charset=UTF-8');
        $this->MApp->UnreadNotification($this->input->post('id'));
        $notifications = round($this->MApp->GetNotificationsCount());
        die('{"notifications":{ "count": '. $notifications . '}}');
        break;
      case 'delete':
        header('Content-Type: application/json; charset=UTF-8');
        $this->MApp->DeleteNotification($this->input->post('id'));
        $notifications = round($this->MApp->GetNotificationsCount());
        die('{"notifications":{ "count": '. $notifications . '}}');
        break;
    }
    $this->data['appTitle'] = array($this->lang->line('Mis notificaciones'));
    $this->data['dateC'] = $this->input->post('dateC');
    $this->data['appNoChangeMenu'] = true;
    $this->data['perpage'] = 20;
    $this->data['init'] = round($this->input->post('init'));
    $this->data['ntotal'] = $this->MApp->GetNotificationsListTotal();
    $this->data['notifications'] = $this->MApp->GetNotificationsList($this->data['init'], $this->data['perpage']);
    if($action == 'listf')
      $this->load->view("manager/notifications/listf", $this->data);
    else
      $this->load->view("manager/notifications/index", $this->data);   
  }
  
  public function chat( $action = '' )
  {
  
    if(!AJAX || !$this->MApp->user)
    { 
      show_404();
      return exit;   
    }
      
    header('Content-Type: application/json; charset=UTF-8');
    switch($action)
    {
      case 'contacts':        
        $contacts = json_encode($this->model->Contacts());
        $notifications = round($this->MApp->GetNotificationsCount());
        die('{"notifications":'. $notifications . ', "contacts":' . $contacts . '}');
        break;
      case 'contact':
        if(!round($this->session->userdata('udata-user-chat-' . $this->input->post('user'))))
          $this->session->set_userdata('udata-user-chat-' . $this->input->post('user'), 1);
        die(json_encode($this->model->Contact($this->input->post('user'))));
        break;
      case 'open':
        $this->model->View($this->input->post('user'));
        $this->session->set_userdata('udata-user-chat-' . $this->input->post('user'), 1);
        break;
      case 'pull':
        $notifications = round($this->MApp->GetNotificationsCount());
        $messages = json_encode($this->model->Pull());
        die('{"notifications":'. $notifications . ', "messages":' . $messages . '}');
        break;
      case 'messages':
        if(!round($this->session->userdata('udata-user-chat-' . $this->input->post('user'))))
          $this->session->set_userdata('udata-user-chat-' . $this->input->post('user'), 1);
        die(json_encode($this->model->Messages($this->input->post('user'), $this->input->post('time'))));
        break;
      case 'close':
        $this->session->set_userdata('udata-user-chat-' . $this->input->post('user'), 0);
        $this->session->unset_userdata('udata-user-chat-' . $this->input->post('user').'-size');
        break;
      case 'minimize':
        $this->session->set_userdata('udata-user-chat-' . $this->input->post('user'), 2);
      case 'size':
        $this->MApp->UpdateConnection();
        $this->session->set_userdata('udata-user-chat-' . $this->input->post('user').'-size', $this->input->post('size'));
        break;
      case 'send':
        $this->MApp->UpdateConnection();
        if( $this->input->post('type') == 2)
          $result = $this->model->MessageFile($this->MApp->user->id, $this->input->post('to'), $this->input->post('file'));
        else
          $result = $this->model->Message($this->MApp->user->id, $this->input->post('to'), $this->input->post('message'));
        die('{"result": ' . ($result ? "true" : "false") . '}');
        break;
    }
  }
  
  public function sql()
  {
    $this->load->library('form_validation', array(), 'validation');
    $this->validation->set_rules('sql', $this->lang->line('SQL'), 'trim|required');
    if( $this->validation->run() !== FALSE )
    {
      $db_debug = $this->db->db_debug;
      $this->db->db_debug = FALSE;       
      $this->db->query( $this->input->post('sql') );
      $this->db->db_debug = $db_debug;
      if( $this->db->_error_message() )
        $this->data['actionResultError'] = $this->db->_error_message();
      else
        $this->data['actionResult'] = $this->lang->line('Consulta ejecutada correctamente.');
    }
    $this->data['appTitle'] = array($this->lang->line('Gestión'), $this->lang->line("SQL"));
    $this->load->view('manager/sql',$this->data);
  }  
   
  public function _checkTable()
  {
    if( !$this->db->table_exists( $this->input->post('table') ) )
    {
      $this->validation->set_message('_checkTable', $this->lang->line('La tabla $1 no existe', array('<span>'. $this->input->post('table') .'</span>')));
      return false;
    }
    return true; 
  }  
  
}
