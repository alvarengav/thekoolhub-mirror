<?php defined('BASEPATH') OR exit('No direct script access allowed');

class APP_Controller extends CI_Controller {

  public
    $data = array();

  public function __construct()
  {
    parent::__construct();
    
//    $this->load->database();
    $this->load->library('session');
    $this->load->model('DataModel', 'Data');
  }

}
