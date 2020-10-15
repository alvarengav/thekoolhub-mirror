<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class ABMDSess {

  private $data = false;

  function __construct( $data = false )
  {
    $this->data = $data;
  }

  public function __get($property)
  {
    if(!$this->data || !isset($this->data->$property))
      return false;
    return $this->data->$property;
  }

}

class ABM {

  var
    $CI = false,
    $data = array(),
    $config = array(),
    $idItem = 0,
    $model = false;

  function __construct( $config = array() )
  {
    $this->CI =& get_instance();
    $this->data =& $this->CI->data;
    $this->setConfig($config);
    $this->idItem = round($this->CI->uri->segment($this->config['uri-segment']+3,0));
    $this->process();
  }

  private function process()
  {
    $method = $this->getMethod(true);
    if(method_exists($this->CI, $method))
    {
      $this->CI->abm = $this;
      return $this->CI->$method();
    }
    $method = $this->getMethod();
    if(method_exists($this, $method))
      return $this->$method();
    $this->error404();
  }

  public function globalActions()
  {
    $this->data['quickOpen'] = false;
    $this->data['traceBack'] = false;
    $this->data['backUrl'] = base_url() . "{$this->config['controller']}/{$this->config['function']}";
    if($this->CI->uri->segment($this->config['uri-segment']+4,'') == 'quick')
    {
      $this->data['quickOpen'] = true;
      $this->data['bodyClass'] .= ' hidden-header hidden-menu forced-quick-open';
    }

    if($this->CI->uri->segment($this->config['uri-segment']+4,'') == 'back')
    {
      $this->data['backUrl'] = $this->CI->input->get('uri');
      $this->data['traceBack'] = true;
    }
    if($this->CI->input->post('gobackuri'))
    {
      $this->data['backUrl'] = $this->CI->input->post('gobackuri');
      $this->data['traceBack'] = true;
    }
  }

  public function actionElement()
  {
    $this->model->id = $this->idItem;
    $this->CI->load->library('form_validation', array(), 'validation');
    $this->CI->validation->set_rules($this->model->ValidationRules());
    $this->globalActions();
    if($this->CI->validation->run() !== FALSE)
    {
      $this->idItem = $this->model->SavePost();
      if($this->idItem)
      {
				$this->CI->session->set_flashdata('post-save-ok-'.$this->idItem, true);      	
      }
      if($this->data['quickOpen'])
      {
        die($this->CI->load->view("script/window-close", array(), true));
      }
      if($this->CI->input->post('goback'))
        return $this->redirect();
      $this->model->id = $this->idItem;
    }
    $this->data['dataItem'] = $this->model->DataElement($this->idItem);
    if($this->idItem)
    {
      if( !isset($this->data['dataItem']['id']) || !$this->data['dataItem']['id'] )
        return $this->error404();
      $this->data['appTitle'][] = $this->model->Name();
    }
    else
    {
      if(!$this->config['new-element'] || !$this->CI->MApp->secure->edit)
        return $this->error404();
      $this->data['appTitle'][] = $this->CI->lang->line("Nuevo elemento");
    }
    $this->data['idItem'] = $this->idItem;
    $this->data['select'] = $this->model->DataSelects();
    $this->CI->load->view("{$this->config['fview']}element", $this->data);
  }

  public function actionJSON()
  {
    header('Content-Type: application/json; charset=UTF-8');
    die($this->model->JSON());
  }

  public function actionDelete()
  {
    if(!$this->idItem)
    {
      if(AJAX) exit;
      return redirect("{$this->config['controller']}/{$this->config['function']}");
    }
    $result = $this->model->Delete($this->idItem) ? "1" : "0";
    if(AJAX) die('{"success":'. $result . '}');
    return redirect("{$this->config['controller']}/{$this->config['function']}");
  }

  public function actionDeletem()
  {
    $ids = $this->CI->input->post('ids');
    if( $ids && count($idsarr = explode(',', $ids)))
    {
      $result = 1;
      foreach($idsarr as $id)
      {
        $r = $this->model->Delete(round($id)) ? "1" : "0";
        if(!$r) $result = 0;
      }
      return $this->redirect(false, '{"success": '. $result . '}');
    }
    $this->redirect(false, '{"success": 0}');
  }

  public function actionList()
  {
    if($this->model) $this->data['select'] = $this->model->DataSelects();
    $this->data['appOrderColumn'] = $this->config['order-column'];
    $this->data['appOrderType'] = $this->config['order-type'];
    $this->CI->load->view("{$this->config['fview']}list", $this->data);
  }

  public function actionDuplicate()
  {
    if(!$this->config['duplicate'])
      return $this->error404();
    $idn = $this->model->Duplicate($this->idItem);
    if(!$idn)
      return $this->redirect();
    $this->redirect("{$this->config['controller']}/{$this->config['function']}/element/{$idn}");
  }

  public function actionExport()
  {
    $_POST['iDisplayStart'] = 0;
    $_POST['iDisplayLength'] = 99999999;
    $items = $this->model->ListItems();
    print_r($items);
  }

  private function getMethod( $global = false )
  {
    $action = $this->CI->uri->segment($this->config['uri-segment']+2,'');
    if(!$action) $action = "list";
    if($action == 'new') $action = "element";
    $action = strtolower($action);
    if($global)
      return isset($this->config['routes'][$action]) ? $this->config['routes'][$action] : false;
    $action = ucfirst($action);
    return "action{$action}";
  }

  private function setInfoGlobal()
  {
    $this->data['appController'] = $this->config['controller'];
    $this->data['appFunction'] = $this->config['function'];
    if($this->config['title'] && $this->config['subtitle'])
      $this->data['appTitle'] = array($this->config['title'], $this->config['subtitle']);
    elseif($this->config['title'])
      $this->data['appTitle'] = array($this->config['title']);
    elseif($this->config['subtitle'])
      $this->data['appTitle'] = array($this->config['subtitle']);
    if($this->config['custom-ico'])
      $this->data['appTitleIco'] = $this->config['custom-ico'];
    else
      $this->data['appTitleIco'] = $this->CI->DataG->GetMenuIco($this->config['controller']);
    $this->data['appFolder'] = $this->config['folder'];
    $this->data['appDSess'] = new ABMDSess($this->CI->MApp->GetParseDataSession("{$this->config['controller']}-{$this->config['function']}"));
  }

  public function setConfig( $config = array() )
  {
    $basic = array(
      'controller' => $this->CI->uri->segment(1),
      'function' => $this->CI->uri->segment(2, 'index'),
      'title' => '',
      'subtitle' => '',
      'custom-ico' => '',
      'uri-segment' => 1,
      'order-column' => 'id',
      'order-type' => 'desc',
      'new-element' => true,
      'duplicate' => true,
      'folder-global' => false,
      'folder' => 0,
      'routes' => array()
    );
    foreach( $config as $key => $value)
      $basic[$key] = $value;
    if( isset($this->CI->model) && $this->CI->model)
      $this->model = $this->CI->model;
    $this->config = $basic;
    $this->config['fview'] = "{$this->config['controller']}/{$this->config['function']}/";
    $this->setInfoGlobal();
    if(!$this->model) die('ERROR');
    $this->model->mconfig = $this->config;
  }

  public function redirect( $url = '', $ajax = '' )
  {
    if(AJAX && $ajax) die($ajax);
    if(!$url)
    {
      $url = "{$this->config['controller']}/{$this->config['function']}";
      if($this->data['traceBack'] && $this->data['backUrl'])
        $url = $this->data['backUrl'];
    }
    redirect($url);
  }

  public function error404()
  {
    $this->CI->load->view('app/error', $this->data);
  }

}
