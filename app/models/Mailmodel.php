<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mailmodel extends CI_Model
{

  private
    $mailjet = false;

  public
    $message       = '',
    $recipients    = '',
    $from_mail    = '',
    $from_name    = '',
    $subject      = '',
    $client        = '';

  public function __construct()
  {
    parent::__construct();

    $lang = $this->session->userdata('slang');
    $this->config->load('app', TRUE);
  }

  public function PrepareMail($action = false, $recipients = false, $data = [])
  {
    if (!$action || !$recipients) {
      return;
    }

    $data             = $this->PrepareData($action, $data);
    $this->message     = $this->PrepareHTML($data);
    $this->recipients = $recipients;
    $this->reply = isset($data['reply']) ? $data['reply'] : false;
    $this->from = isset($data['from']) ? $data['from'] : $this->reply;
    $this->subject     = $data['subject'];


    return $this->SendMail();
  }

  public function PrepareData($action = false, $data = [])
  {
    //   $data['action'] 			= $action;
    //   $data['client'] 			= $this->client;
    //   $data['client-mail'] 	= $this->client_mail;
    $data['url']           = site_url();
    $data['view']         = $action;
    //   $data['url-mail'] 		= base_url('mail').'/?d='.urlencode(json_encode($data));
    return $data;
  }

  public function PrepareHTML($data = [])
  {
    if (!$data) {
      return;
    }
    $html = $this->load->view('mail/' . $data['view'], ['data' => $data], true);

    return $html;
  }

  // public function SendNewsletter($data)
  // {
  //   $data['url'] = site_url();
  //   $this->message =  $this->PrepareHTML($data);
  //   $this->reply = isset($data['reply']) ? $data['reply'] : false;
  //   $this->from = isset($data['from']) ? $data['from'] : $this->reply;
  //   $this->subject     = $data['subject'];
  //   return $this->SendMail();
  // }

  public function SendMail()
  {

    if (!$this->message || !$this->recipients) {
      return;
    }

    foreach ($this->recipients as $key => $value) {
      $name = '';
      if (is_string($value)) {
        $mail = $value;
      } elseif (is_array($value) || is_object($value)) {
        if (is_object($value))
          $value = (array)$value;
        if (isset($value['name']))
          $name = $value['name'];

        $mail = $value['mail'];
      } else {
        return;
      }

      $cabeceras = 'From: ' . $this->from . ' <' . $this->from . ">\r\n" .
        'Reply-To: ' . $this->reply . " \r\n" .
        'X-Mailer: PHP/' . phpversion();
      $cabeceras .= 'MIME-Version: 1.0' . "\r\n";
      $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      // print($this->message); die;
      //$mail = 'grlopez90@gmail.com';
      $r = mail($mail, $this->subject, $this->message, $cabeceras);
    }

    return $r;
  }
}