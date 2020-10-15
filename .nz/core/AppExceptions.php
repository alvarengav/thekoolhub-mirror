<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppExceptions extends CI_Exceptions {

  function show_error($heading, $message, $template = 'error_general', $status_code = 500)
  {
    set_status_header($status_code);

    $message = '<p>'.implode('</p><p>', ( ! is_array($message)) ? array($message) : $message).'</p>';

    if (ob_get_level() > $this->ob_level + 1)
    {
      ob_end_flush();
    }
    ob_start();
    $templates_path = config_item('error_views_path');
    include($templates_path.'errors/'.$template.'.php');
    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
  }

  function show_php_error($severity, $message, $filepath, $line)
  {
    $severity = ( ! isset($this->levels[$severity])) ? $severity : $this->levels[$severity];

    $filepath = str_replace("\\", "/", $filepath);

    if (FALSE !== strpos($filepath, '/'))
    {
      $x = explode('/', $filepath);
      $filepath = $x[count($x)-2].'/'.end($x);
    }

    if (ob_get_level() > $this->ob_level + 1)
    {
      ob_end_flush();
    }
    ob_start();
    $templates_path = config_item('error_views_path');
    include($templates_path.'errors/error_php.php');
    $buffer = ob_get_contents();
    ob_end_clean();
    echo $buffer;
  }

}