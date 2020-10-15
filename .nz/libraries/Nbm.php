<?php defined('BASEPATH') OR exit('No direct script access allowed');

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

class Nbm {

  var
    $CI = false,
    $data = array(),
    $config = array(),
    $idItem = 0,
    $currentView = false,
    $model = false;

  function __construct( $config = array() )
  {
    $this->CI =& get_instance();
    $this->data =& $this->CI->data;
    $this->CI->ABM = $this;
    $this->setConfig($config);
    $this->idItem = round($this->CI->uri->segment($this->config['uri-segment']+3,0));
    if($this->config['force-element'])
      $this->idItem = $this->config['force-element'];
    $this->process();
  }

  private function process()
  {
    $method = $this->getMethod(true);
    $this->currentView = $this->getView();
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
    $this->data['form_extra_buttons'] = $this->config['extra-buttons'];

    $this->data['forceElement'] = $this->config['force-element'];

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
      if($this->data['quickOpen'])
      {
        $content = $this->load->view("script/form/window-close", array(), true);
        return $this->MApp->SetOutput($content);
      }
      if($this->CI->input->post('goback'))
      {
      	$action = $this->CI->input->post('goback');
      	if($action && is_numeric($action))
      	{
        	return $this->ABM_Redirect();
      	}
      	if($action == 'save-close')
      	{
        	return $this->ABM_Redirect();
      	}
      	if($action == 'save-next')
      	{
        	$next = $this->model->get_next($this->idItem);
        	if ($next)
        	{
        		$url = "{$this->config['controller']}/{$this->config['function']}/element/{$next}";
        		return $this->CI->MApp->redirect($url);
        	}
      	}
      	if($action == 'save-new')
      	{
      		$url = "{$this->config['controller']}/{$this->config['function']}/new";
      		return $this->CI->MApp->redirect($url);
      	}
      }
      $this->model->id = $this->idItem;
    }
    $this->data['dataItem'] = $this->model->DataElement($this->idItem);
    if($this->idItem)
    {
      if( !isset($this->data['dataItem']['id']) || !$this->data['dataItem']['id'] )
        return $this->error404();
      $name = $this->model->Name();
      if($name)
      {
        if(is_array($name))
          $this->data['appTitle'] = array_merge($this->data['appTitle'], $name);
        else
          $this->data['appTitle'][] = $name;
      }
    }
    else
    {
      if ( ! $this->config['new-element'] || ! $this->CI->MApp->secure->edit)
      {
        return $this->error404();
      }
      $this->data['appTitle'][] = $this->CI->lang->line($this->config['new-element-label']);
    }
    $this->data['idItem'] = $this->idItem;
    $this->data['select'] = $this->model->DataSelects();

    $view = "{$this->config['fview']}element";
    if($this->currentView)
    {
    	if (!$this->CI->load->view_exists($view))
    	{
    		$view = $this->currentView;
    	}
    }
    $this->CI->load->view($view, $this->data);

  }

  public function actionJSON()
  {
  	$json = $this->model->JSON();
  	if (strpos($json, '"aaData":[]') !== FALSE)
  	{
  		$jsonP = json_decode($json);
  		if ($jsonP->iTotalRecords > 0)
  		{
  			$init = round($this->CI->input->post('iDisplayStart'));
  			$dLen = $this->CI->input->post('iDisplayLength');
  			$perpage = $dLen ? round($dLen) : 10;
  			$dStart = $init - $perpage;
  			if ($dStart < 0)
  			{
  				$dStart = 0;
  			}
  			$_POST['iDisplayStart'] = $dStart;
  			$json = $this->model->JSON();
  			$json = str_replace('{"sEcho"', '{"iDisplayStart":"'.$dStart.'","sEcho"', $json);
  		}
  	}
    $this->CI->MApp->SetOutputJSON($json);
  }

  public function actionActivate()
  {
  	$json = array('action' => 'activate', 'result' => 0, 'text' => '');
  	if ($this->idItem)
  	{
	  	$field = $this->CI->input->post('field');
	  	$value = round($this->CI->input->post('value')) ? 1 : 0 ;
	  	$result = $this->model->UpdateActiveField($this->idItem, $field, $value);
	  	$json['result'] = $result;
	  	if ( ! $json['text'] && $this->model->message_string)
	  	{
	  		$json['text'] = $this->model->message_string;
	  	}
  	}
  	return $this->CI->MApp->SetOutputJSON($json, true);
  }
  
  public function actionState()
  {
    $json = array('action' => 'state', 'success' => 0, 'text' => '');
    if ($this->idItem)
    {
      $result = $this->model->ChangeState($this->idItem);
      $json['success'] = $result ? 1 : 0;
      if ( ! $json['text'] && $this->model->message_string)
      {
        $json['text'] = $this->model->message_string;
      }
    }
    return $this->CI->MApp->SetOutputJSON($json, true);
  }

  public function actionDelete()
  {
    $json = array('action' => 'json', 'result' => 0);
    if(!$this->idItem)
      return $this->ABM_Redirect("{$this->config['controller']}/{$this->config['function']}", json_encode($json));
    $json['result'] = $this->model->Delete($this->idItem) ? 1 : 0;
    return $this->ABM_Redirect("{$this->config['controller']}/{$this->config['function']}", json_encode($json));
  }

  public function actionDeletem()
  {
    $ids = $this->CI->input->post('ids');
    if( $ids && count($idsarr = explode(',', $ids)))
    {
      $result = 1;
      foreach ($idsarr as $id)
      {
        $r = $this->model->Delete(round($id)) ? "1" : "0";
        if(!$r) $result = 0;
      }
      return $this->ABM_Redirect(false, '{"success": '. $result . '}');
    }
    $this->ABM_Redirect(false, '{"success": 0}');
  }

  public function actionSortitems()
  {
    $this->model->UpdateSort(explode(',', $this->CI->input->post('ids')));
    $this->ABM_Redirect(false, '{"success": 1}');
  }

  public function actionDeleteall()
  {
  	$json = array('action' => 'delete-all', 'result' => 0, 'text' => '');
  	$this->model->delete_all = TRUE;
    $json['result'] = $this->model->DeleteAll();
  	if ( ! $json['text'] && $this->model->message_string)
  	{
  		$json['text'] = $this->model->message_string;
  	}
  	return $this->CI->MApp->SetOutputJSON($json, true);
  }

  public function actionList()
  {
    if($this->model)
    {
    	$this->data['select'] = $this->model->DataSelects();
    }
    $this->data['appOrderColumn'] = $this->config['order-column'];
    $this->data['appOrderType'] 	= $this->config['order-type'];
    $this->data['showFilters'] 		= $this->config['show-filters'];

    $view = $this->currentView ?: "{$this->config['fview']}list";
    $this->CI->load->view($view, $this->data);
  }

  public function actionDuplicate()
  {
    if(!$this->config['duplicate'])
      return $this->error404();
    $idn = $this->model->Duplicate($this->idItem);
    if(!$idn)
      return $this->ABM_Redirect();
    $this->ABM_Redirect("{$this->config['controller']}/{$this->config['function']}/element/{$idn}");
  }

  public function actionExport($config = [])
  {
  	if(empty($config['uri_segment']) && $this->config['uri-segment'])
  	{
  		$config[] = $this->config['uri-segment'];
  	}

		$this->model->export_data($config);
  }

  public function getView($action = false)
  {
  	if ( ! $action)
  	{
    	$action = $baseaction = $this->CI->uri->segment($this->config['uri-segment'] + 2, '');
  	}
    if(!$action) $action = "list";
    if($action == 'new') $action = "element";
    $action = strtolower($action);
    if(!isset($this->config['views'][$action])) return false;
    return $this->config['views'][$action];
  }

  private function getMethod( $gmethod = false )
  {
    $action = $baseaction = $this->CI->uri->segment($this->config['uri-segment'] + 2, '');
    if(!$action) $action = "list";
    if($action == 'new') $action = "element";
    $action = preg_replace('/[^a-z0-9_]/', '', strtolower($action));
    if($gmethod)
      return isset($this->config['routes'][$action]) ? $this->config['routes'][$action] : false;
    if($this->config['force-element'])
    {
      if($baseaction != '' && $action != 'element')
      {
        return $this->ABM_Redirect();
      }
      $action = "element";
    }
    $action = mb_ucfirst($action, 'utf-8');
    return "action{$action}";
  }

  private function setInfoGlobal()
  {
    $this->data['appController'] = $this->config['controller'];
    $this->data['appFunction'] = $this->config['function'];
    $this->data['appFview'] = $this->config['fview'];
    $this->data['appTitle'] = array();

    if($this->config['title'])
    {
      if(is_array($this->config['title']))
        $this->data['appTitle'] = array_merge($this->data['appTitle'], $this->config['title']);
      else
        $this->data['appTitle'][] = $this->config['title'];
    }

    if($this->config['subtitle'])
    {
      if(is_array($this->config['subtitle']))
        $this->data['appTitle'] = array_merge($this->data['appTitle'], $this->config['subtitle']);
      else
        $this->data['appTitle'][] = $this->config['subtitle'];
    }

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
      'controller' 					=> $this->CI->uri->segment(1),
      'function' 						=> $this->CI->uri->segment(2, 'index'),
      'base-function'				=> false,
      'title' 							=> '',
      'subtitle' 						=> '',
      'custom-ico'					=> '',
      'uri-segment' 				=> 1,
      'order-column'				=> 'id',
      'order-type'					=> 'desc',
      'new-element' 				=> true,
    	'new-element-label' 	=> 'Agregar',
    	'search-label'				=> 'Buscar',
    	'delete-all'					=> true,
    	'delete-all-label'		=> 'Eliminar todo',
      'duplicate' 					=> true,
      'export' 							=> false,
      'export-month' 				=> false,
      'folder' 							=> 0,
      'folder-global'				=> false,
      'show-filters' 				=> false,
      'force-element' 			=> 0,
      'extra-buttons' 			=> true,
      'fview' 							=> FALSE,
      'routes'							=> array(),
      'views' 							=> array(
        'export-buttons' 	=> 'app/element/components/buttons-export',
        'list' 						=> 'app/element/actions/list',
        'element' 				=> 'app/element/actions/element',
      ),
    );
    foreach ( $config as $key => $value)
      $basic[$key] = $value;
    if( isset($this->CI->model) && $this->CI->model) $this->model = $this->CI->model;
    $this->config = $basic;
  	$this->config['view-function'] = $this->config['function'];
    if($this->config['base-function'])
    {
    	$this->config['function'] =	$this->config['base-function'];
    }
    if(empty($this->config['fview']))
    {
    	$this->config['fview'] = "{$this->config['controller']}/{$this->config['view-function']}/";
    }
    $this->setInfoGlobal();
    if ( ! $this->model)
    {
      $this->CI->MApp->errorOutput = $this->CI->lang->line('Modelo no encontrado');
      $this->CI->MApp->errorOutputCode = 403;
      return $this->error404();
    }
    $this->model->mconfig = $this->config;
  }

  public function error404()
  {
    $this->CI->load->view('app/error', $this->data);
  }

  public function ABM_Redirect( $url = '', $ajax = '' )
  {
    if(AJAX && $ajax)
    {
      return $this->CI->MApp->redirect('', false, $ajax);
    }
    if ( ! $url)
    {
      $url = "{$this->config['controller']}/{$this->config['function']}";
      if ($this->data['traceBack'] && $this->data['backUrl'])
      {
        $url = $this->data['backUrl'];
      }
    }
    return $this->CI->MApp->redirect($url);
  }

}
