<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppLang extends CI_Lang {

  function _line($line = '')
  {
    $value = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];
    if ($value === FALSE && $line)
    {
      $CI =& get_instance();
      //$CI->MApp->LangAddItem($line);
      return $line;
    }
    return $value;
  }

  function line($line = '', $params = null)
  {
    $return = $this->_line($line);
    if($return === FALSE) $return = $line;
    if(!is_null($params)) $return = $this->_ni_line($return, $params);
    return str_replace('\'', '’', $return);
  }

  private function _ni_line($return = '', $params = null)
  {
    $params = is_array($params) ? $params : array($params);
    $search = array();
    $cnt = 1;
    foreach($params as $param)
    {
      $search[$cnt] = "/\\\${$cnt}/";
      $cnt++;
    }
    unset($search[0]);
    $return = preg_replace($search, $params, $return);
    return $return;
  }

}
