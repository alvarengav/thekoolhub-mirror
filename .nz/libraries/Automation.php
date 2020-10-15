<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed"); 

class Automation
{
  public
    $debug = false,
    $CI = false,
    $config = array();
  
  function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->helper('manager');
  }
  
  public function process()
  {    
    $tname = mb_strtolower($this->CI->input->post('table'), 'UTF-8');
    $cname = mb_strtolower($this->CI->input->post('controller'), 'UTF-8');
    $fname = mb_strtolower($this->CI->input->post('function'), 'UTF-8');
    $title = $this->CI->input->post('title');
    $subtitle = $this->CI->input->post('subtitle');
    $controller = APPPATH . "controllers/{$cname}.php";
    $model = APPPATH . "models/{$cname}/{$fname}model.php";
    $view = APPPATH . "views/{$cname}/{$fname}/list.php";
    $viewf = APPPATH . "views/{$cname}/{$fname}/list-filters.php";
    $views = APPPATH . "views/{$cname}/{$fname}/list-script.php";
    $viewe = APPPATH . "views/{$cname}/{$fname}/element.php";
    if($this->debug)
    {
      @unlink($controller);
      @unlink($model);
      @unlink($view);
      @unlink($viewf);
      @unlink($views);
      @unlink($viewe);
    }
    $fields = $this->CI->db->field_data( $tname );
    $fcomments = $this->CI->db->query("show full columns from `{$tname}`")->result();
    foreach($fields as $key => $value)
      $fields[$key]->label = ($fcomments[$key]->Comment) ? $fcomments[$key]->Comment : generateLabel($fields[$key]->name);
    $i = 0;
    $idtable = $fields[0]->name;
    if( $fields[0]->primary_key )
      unset($fields[0]);
    
    if($fname == $cname) 
    {
      $this->CI->validation->set_error('function', $this->CI->lang->line('La función no puede llamarse igual que el controlador'));
      return false;
    }
    
    foreach ($fields as $field)
    {
      if(substr($field->name,0,3) == 'id_' && substr($field->name,0,7) != 'id_file' && substr($field->name,0,10) != 'id_gallery')
      {
        $this->CI->validation->set_rules("lj{$i}", mb_strtoupper($field->name, 'UTF-8') . ' ' . $this->CI->lang->line('Tabla'), 'trim|required');
        $this->CI->validation->set_rules("lj{$i}-id", mb_strtoupper($field->name, 'UTF-8') . ' ' . $this->CI->lang->line('Índice'), 'trim|required');
        $this->CI->validation->set_rules("lj{$i}-text", mb_strtoupper($field->name, 'UTF-8') . ' ' . $this->CI->lang->line('Texto'), 'trim|required');
        $this->CI->validation->set_message("lj{$i}", $this->CI->lang->line('Debes indicar la tabla para relacionar el campo $1', array('<span>'.mb_strtoupper($field->name, 'UTF-8').'</span>')));
        $this->CI->validation->set_message("lj{$i}-id", $this->CI->lang->line('Debes indicar el índice para relacionar el campo $1', array('<span>'.mb_strtoupper($field->name, 'UTF-8').'</span>')));
        $this->CI->validation->set_message("lj{$i}-text", $this->CI->lang->line('Debes indicar el texto para mostrar el campo $1', array('<span>'.mb_strtoupper($field->name, 'UTF-8').'</span>')));
        $i++;
      }
    }
    
    $this->CI->data['totalIndex'] = $i; 
    $this->CI->data['classApp'] = 'two-columns';
    $this->CI->data['fields'] = $fields; 
    
    if( $this->CI->validation->run() === FALSE )
      return false;    
    
    $data = array(
      'title' => $title,
      'subtitle' => $subtitle,
      'table' => $tname,
      'controller' => $cname,
      'function' => $fname,
      'idtable' => $idtable,
      'fields' => $fields 
    );
    
    if( is_dir( APPPATH . "models/{$cname}" ) )
    {
      if( file_exists($model) )
      {
        $this->CI->validation->set_error('function', $this->CI->lang->line('El modelo $1 ya existe', array("<span>{$cname}/{$fname}Model</span>")));
        return false;
      }
    }else{
      mkdir(APPPATH . "models/{$cname}", 0777, true);
      chmod(APPPATH . "models/{$cname}", 0777);
    }
    
    $model_text = $this->CI->load->view('manager/auto/model', $data, TRUE);
    $model_text = "<?php\n\n" . $model_text;
    $handle = fopen($model, "x+");
    fwrite($handle, $model_text); 
    fclose($handle);
    if( is_dir( APPPATH . "views/{$cname}/{$fname}" ) )
    {
      if( file_exists($view) )
      {        
        $this->CI->validation->set_error('function', $this->CI->lang->line('La vista $1 ya existe', array("<span>views/{$cname}/{$fname}/list</span>")));
        return false;
      }
      if( file_exists($views) )
      {        
        $this->CI->validation->set_error('function', $this->CI->lang->line('La vista $1 ya existe', array("<span>views/{$cname}/{$fname}/list-script</span>")));
        return false;
      }
      if( file_exists($viewf) )
      {        
        $this->CI->validation->set_error('function', $this->CI->lang->line('La vista $1 ya existe', array("<span>views/{$cname}/{$fname}/list-filters</span>")));
        return false;
      }
      if( file_exists($viewe) )
      {        
        $this->CI->validation->set_error('function', $this->CI->lang->line('La vista $1 ya existe', array("<span>views/{$cname}/{$fname}/element</span>")));
        return false;
      }
    }else{
      mkdir(APPPATH . "views/{$cname}/{$fname}", 0777, true);
      chmod(APPPATH . "views/{$cname}/{$fname}", 0777);
    }
    
    $view_text = $this->CI->load->view('manager/auto/view-list', $data, TRUE);
    $view_text = str_replace( array('<a?','?a>'), array('<?','?>'), $view_text);
    $handle = fopen($view, "c+");
    fwrite($handle, $view_text); 
    fclose($handle); 
    
    $view_text = $this->CI->load->view('manager/auto/view-list-filters', $data, TRUE);
    $view_text = str_replace( array('<a?','?a>'), array('<?','?>'), $view_text);
    $handle = fopen($viewf, "c+");
    fwrite($handle, $view_text); 
    fclose($handle); 
    
    $view_text = $this->CI->load->view('manager/auto/view-list-script', $data, TRUE);
    $view_text = str_replace( array('<a?','?a>'), array('<?','?>'), $view_text);
    $handle = fopen($views, "c+");
    fwrite($handle, $view_text); 
    fclose($handle); 
    
    $viewe_text = $this->CI->load->view('manager/auto/view-element', $data, TRUE);
    $viewe_text = str_replace( array('<a?','?a>'), array('<?','?>'), $viewe_text);
    $handle = fopen($viewe, "c+");
    fwrite($handle, $viewe_text); 
    fclose($handle);    
    
    $data_model = APPPATH . "models/datamodel.php";
    $i = 0;
    foreach ($fields as $field)
      if(substr($field->name,0,3) == 'id_' && substr($field->name,0,7) != 'id_file' && substr($field->name,0,10) != 'id_gallery')
      {
        $mdata_text = file_get_contents($data_model);
        if( strpos($mdata_text, "function " . TableToModel(set_value('lj'.$i)) . "(") === FALSE )
        {
          $data['index'] = $i;
          $data['field'] = $field;
          $function_text = $this->CI->load->view('manager/auto/select', $data, TRUE);
          $mdata_final = substr($mdata_text,0,-2) . $function_text . "\n}";
          file_put_contents($data_model, $mdata_final);
        }
        $i++;
      }
    $data['folder'] = 0;
    
    if($cname != 'manager' )
    {
      $this->CI->load->model('FileManagerModel');
      if( ! ( $parent = $this->CI->FileManagerModel->FolderExists($title, 0) ) )
        $parent = $this->CI->FileManagerModel->NewFolder(array(
          'name' => $subtitle, 
          'id_type' => 1
        ));      
      if( ! ( $data['folder'] = $this->CI->FileManagerModel->FolderExists($subtitle, $parent) ) )
        $data['folder'] = $this->CI->FileManagerModel->NewFolder(array(
          'name' => $subtitle, 
          'id_parent' => $parent, 
          'id_type' => 1
        ));
    }
    else
    {
      $data['folder'] = 0;
    }
      
    if( !file_exists($controller) )
    {
      $controller_text = $this->CI->load->view('manager/auto/controller', $data, TRUE);
      $controller_text = str_replace( array('<a?','?a>'), array('<?','?>'), $controller_text);
      $handle = fopen($controller, "c+");
      fwrite($handle, $controller_text); 
      fclose($handle);
    }else{
      $controller_text = file_get_contents($controller);
    }  
    
    if( strpos($controller_text, "function {$fname}()") !== FALSE )
    {      
      $this->CI->validation->set_error('function', $this->CI->lang->line('La función $1 ya existe en el controlador', array("<span>". ucfirst($fname) ."</span>")));
      return false;
    }
    $function_text = $this->CI->load->view('manager/auto/function', $data, TRUE);
    $controller_final = substr($controller_text,0,-2) . $function_text . "\n}";
    file_put_contents($controller, $controller_final);
    
    if( $this->CI->input->post('menu') && $cname != 'manager' )
      $this->CI->model->GenerateAccessLink($title, $subtitle, $cname, $fname);
      
    return true;
  }
  
}