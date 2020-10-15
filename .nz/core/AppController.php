<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AppController extends CI_Controller
{

  public
    $safeController = false,
    $safeFunctionsU = array(),
    $safeFunctions = array(),
    $data = array(
      'bodyClass' => '',
      'appTitle' => '',
      'wgetId' => ''
    );

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Encryption');
    $this->lang->load('system');
    $this->load->library('Session');
    $this->safeFunctions = array_map('strtolower', $this->safeFunctions);
    $this->safeFunctionsU = array_map('strtolower', $this->safeFunctionsU);
    $this->load->model('AppMainModel', 'MApp');
    $this->MApp->CheckSession();
    $this->load->model('DataModel', 'Data');
    $this->load->model('DataGModel', 'DataG');
    $this->MApp->LoadDefaultModel();
    $this->data['wgetId'] = md5(uniqid(mt_rand()));
    $this->load->driver('cache', array('adapter' => 'file'));
    $this->load->helper('date');
    $this->load->helper('text');
    $this->load->helper('form');
    if($this->MApp->user && $this->MApp->user->valid != 2)
    {
    	$this->MApp->UpdateConnection();
    }
  }

}
