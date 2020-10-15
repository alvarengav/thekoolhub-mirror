<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class App extends AppController {

  public
    $safeController = true;

  public function index( $section = '' )
  {
    if(!$this->MApp->user)
      return redirect('app/user');
    if($this->MApp->user->valid == 2)
      return redirect('app/user/password');
    $this->load->view('app/home', $this->data);
  }

  public function logout()
  {
    $this->MApp->UpdateConnection();
    $this->session->unset_userdata('uID');
    return redirect(base_url());
  }

  public function error()
  {
    $this->load->view('app/error', $this->data);
  }

  public function user( $section = 'login' )
  {
    $method = 'user_' . $section;
    if($this->MApp->user  && $this->MApp->user->valid == 2 && $section != 'password' )
      return redirect('app/user/password');
    elseif($this->MApp->user && $section != 'password')
      return redirect('app');
    if(!method_exists($this, $method))
      return show_404();
    $this->load->model('UserMainModel', 'UserM');
    $this->$method();
  }

  private function user_login()
  {
    $this->data['appTitle'] = $this->lang->line("Login");
    $this->data['bodyClass'] = "login-page";
    $this->data['errorForm'] = false;
    if($this->input->post())
    {
      $data = $this->UserM->Login($this->input->post('mail'), $this->input->post('password'));
      if($this->input->post('mail')) $this->session->set_userdata('prelogmail', $this->input->post('mail'));
      if(!$data['error'])
      {
        $this->session->set_userdata('uID', $data['id']);
        $this->MApp->UpdateConnection($data['id']);
        if($data['changepassword'])
          return redirect(base_url().'app/user/password');
        $url = $this->session->userdata('nextUrl');
        if($url)
        {
          $this->session->unset_userdata('nextUrl');
        }
        else
        {
          $url = base_url();
        }
        return redirect($url);
      }
      $this->data['errorForm'] = $data['error'];
    }
    $this->load->view("app/user/login", $this->data);
  }

  public function password()
  {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-Type: application/json; charset=UTF-8');
    if(!AJAX || !$this->MApp->user->id || strlen($this->input->post('password')) < 4) die('{"result":"0"}');
      $result = $this->UserM->ChangePassword($this->MApp->user->id, $this->input->post('password'));
    die('{"result":"' . $result . '"}');
  }

  private function user_password()
  {
    if(empty($this->MApp->user->id))
    {
      return redirect('app');
    }
    $this->data['appTitle'] = $this->lang->line("Cambiar contraseña");
    $this->data['bodyClass'] = "login-page";
    $this->data['errorForm'] = false;
    if($this->input->post())
    {
      $data = $this->UserM->ChangePassword($this->MApp->user->id, $this->input->post('password'));
      if(!$data['error'])
        return redirect(base_url());
      $this->data['errorForm'] = $data['error'];
    }
    $this->load->view("app/user/changepassword", $this->data);
  }

  private function user_register()
  {
    exit;
    $this->data['bodyClass'] = "login-page";
    $this->data['appTitle'] = $this->lang->line("Nuevo Usuario");
    $this->data['errorForm'] = false;
    if($this->input->post())
    {
      $data = $this->UserM->Register(array(
        'id_company' => $this->input->post('company'),
        'mail' => $this->input->post('mail'),
        'name' => $this->input->post('name'),
        'lastname' => $this->input->post('lastname')
      ));
      if($this->input->post('mail')) $this->session->set_userdata('prelogmail', $this->input->post('mail'));
      if(!$data['error'])
      {
        $info = $this->MApp->GetDataUser($data['id']);
       /* $html = $this->load->view("app/mail/register", array('data' => $info), true);
        $this->load->library('PHPMailer');
        $mail = new PHPMailer();
        $mail->From = $this->config->item('client-mail', 'app');
        $mail->FromName = $this->config->item('client', 'app');
        $mail->AddAddress($info['companymail']);
        $mail->Subject = $this->lang->line("Registro de cuenta");
        $mail->IsHTML(true);
        $mail->Body = $html;
        if(ENVIRONMENT == 'development')
          mailSave('user-register', $html);
        else
          $mail->Send();*/
        $this->MApp->AddNotification($this->MApp->GetCompanyAdmins($info['company'], $data['id']), array(
          'id_type' => 3,
          'id_project' => $this->MApp->project,
          'data' => json_encode(array(
            'id_user' => $data['id']
          )),
          'text' => '{userFullname} se registró al sistema en el proyecto {projectName}',
          'link' => base_url() . 'manager/users/element/' . $data['id']
        ));
        $this->data['formOK'] = true;
      }
      $this->data['errorForm'] = $data['error'];
    }
    $this->load->helper("form");
    $this->data['companiesList'] = $this->DataG->SelectCompanyProyect();
    $this->load->view("app/user/register", $this->data);
  }

  private function user_forgotpassword()
  {
    exit;
    $this->data['appTitle'] = $this->lang->line("Recuperar contraseña");
    $this->data['bodyClass'] = "login-page";
    $this->data['errorForm'] = false;
    if( $this->input->post() )
    {
      $data = $this->UserM->ForgotPassword($this->input->post('mail'));
      if($this->input->post('mail')) $this->session->set_userdata('prelogmail', $this->input->post('mail'));
      if(!$data['error'])
      {
        $this->session->set_userdata('forgotpassword', time());
        $info = $this->MApp->GetDataUser($data['id']);
        $html = $this->load->view("app/mail/forgotpassword", array('data' => $info), true);
        $this->load->library('PHPMailer');
        $mail = new PHPMailer();
        $mail->From = $this->config->item('client-mail', 'app');
        $mail->FromName = $this->config->item('client', 'app');
        $mail->AddAddress($info['mail']);
        $mail->Subject = $this->lang->line("Recuperar contaseña");
        $mail->IsHTML(true);
        $mail->Body = $html;
        mailSave('user-forgotpassword', $html);
        /*if(ENVIRONMENT == 'development')
        else
          $mail->Send();
        */
        $this->MApp->AddNotification($this->MApp->GetCompanyAdmins($info['company'], $data['id']), array(
          'id_type' => 3,
          'id_project' => $this->MApp->project,
          'data' => json_encode(array(
            'id_user' => $data['id']
          )),
          'text' => '{userFullname} solicitó el reinicio de su contraseña',
          'link' => base_url() . 'manager/users/element/' . $data['id']
        ));
        $this->data['formOK'] = true;
      }
      $this->data['errorForm'] = $data['error'];
    }
    $this->load->view("app/user/forgotpassword", $this->data);
  }


  public function lang( $section = '' )
  {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-Type: application/json; charset=UTF-8');
    $this->load->view("app/lang/{$section}/{$this->MApp->lang}");
  }

  public function sessiong()
  {
    if(!$this->MApp->user || !AJAX || !$this->input->post('item')) exit;
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-Type: application/json; charset=UTF-8');
    $this->session->set_userdata('udata-' . $this->input->post('item'), $this->input->post('value'));
    die('{"result":"1", "item": "'.$this->input->post('item').'"}');
  }

  public function session()
  {
    if(!$this->MApp->user || !AJAX || !$this->input->post('item')) exit;
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-Type: application/json; charset=UTF-8');
    $this->MApp->UpdateDataSession($this->input->post('item'), $this->input->post('values'));
    die('{"result":"1"}');
  }

  public function ckeditorcss()
  {
    $seconds_to_cache = 60 * 60 * 24 * 10;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: {$ts}");
    header("Pragma: cache");
    header("Cache-Control: max-age={$seconds_to_cache}");
    header('Content-Type: text/css');
    $this->load->view('common/ckeditor/css');
  }

  public function filemanager( $action = 'upload' )
  {
    #error_reporting(E_ALL);
    #ini_set('display_errors', 1);
    if(!$this->MApp->user) exit;

    header('Content-Type: application/json; charset=UTF-8');

    if($action == 'update')
    {
      $this->load->model('FileManagerModel', 'filemodel');
      $data = $this->filemodel->NewFileFromFile($this->input->post('id'), $this->input->post('nfile') );
      if(!$data)
        die('{"result":"0"}');
      die('{"result":"1","data":' . json_encode($data) . '}');
    }

    if(!count($_FILES) || !isset($_FILES['filem']))
      die('{"result":"0"}');
    $this->load->model('FileManagerModel', 'filemodel');
    if(round($this->input->post('global')))
    {
      $this->filemodel->fglobal = true;
      $this->filemodel->dbfiles = $this->config->item('db-global', 'app');
    }
    $data = $this->filemodel->uploadFile($_FILES['filem']);
    if(!$data)
      die('{"result":"0"}');
    die('{"result":"1","data":' . json_encode($data) . '}');
  }

  public function gallery( $action = 'upload' )
  {
    #error_reporting(E_ALL);
    #ini_set('display_errors', 1);
    if(!$this->MApp->user) exit;
    
    header('Content-Type: application/json; charset=UTF-8');
    if($action == 'upload')
    {
      if(!count($_FILES) || !isset($_FILES['filem']))
        die('{"result":"0"}');
      $this->load->model('FileManagerModel', 'filemodel');
      if(round($this->input->post('global')))
      {
        $this->filemodel->fglobal = true;
        $this->filemodel->dbfiles = $this->config->item('db-global', 'app');
      }
      $data = $this->filemodel->uploadFile($_FILES['filem']);
      if(!$data)
        die('{"result":"0"}');
      die('{"result":"1","data":' . json_encode($data) . '}');
    }
    if($action == 'add')
    {
      $this->filemodel->addToGallery();
    }
  }

  public function appscript()
  {
    $seconds_to_cache = 60 * 60 * 24;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: {$ts}");
    header("Pragma: cache");
    header("Cache-Control: max-age={$seconds_to_cache}");
    header('Content-Type: application/javascript; charset=utf-8');
    $this->load->view("script/app.js");
  }

 	public function thumb($id = 0)
  {
    /*$seconds_to_cache = 60 * 60 * 24;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: {$ts}");
    header("Pragma: cache");
    header("Cache-Control: max-age={$seconds_to_cache}");*/
    $row = $this->db->query("select * from nz_file where id_file = '{$id}'")->row();
    if(!$row) return show_404();
    redirect(thumb_internal($row->file, 150, 150, false));
  }

  public function profile($section = '', $id = 0 )
  {
    if($section != 'image') return show_404();
    /*$seconds_to_cache = 60 * 60 * 24;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: {$ts}");
    header("Pragma: cache");
    header("Cache-Control: max-age={$seconds_to_cache}");*/
    $dbglobal = $this->config->item('db-global', 'app');
    $row = $this->db->query("select * from {$dbglobal}nz_file where id_file = '{$id}'")->row();
    if(!$row) return show_404();
    redirect(thumb_internal($row->file, 32, 32, true, true));
  }

  public function thumbc( $id = 0 )
  {
    /*$seconds_to_cache = 60 * 60 * 24;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: {$ts}");
    header("Pragma: cache");
    header("Cache-Control: max-age={$seconds_to_cache}");*/
    $dbglobal = $this->config->item('db-global', 'app');
    $row = $this->db->query("select * from {$dbglobal}nz_file where id_file = '{$id}'")->row();
    if(!$row) return show_404();
    redirect(thumb_internal($row->file, 180, 180, false, true));
  }

  public function thumbg( $id = 0 )
  {
    /*$seconds_to_cache = 60 * 60 * 24;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: {$ts}");
    header("Pragma: cache");
    header("Cache-Control: max-age={$seconds_to_cache}");*/
    $dbglobal = $this->config->item('db-global', 'app');
    $row = $this->db->query("select * from {$dbglobal}nz_file where id_file = '{$id}'")->row();
    if(!$row) return show_404();
    redirect(thumb_internal($row->file, 150, 150, false, true));
  }

}
