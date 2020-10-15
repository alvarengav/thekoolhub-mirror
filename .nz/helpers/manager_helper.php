<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('TableToModel'))
{
  function TableToModel($table = '')
  {
    $table = rtrim(trim($table));
    $table = preg_replace ("/^nz_/", "", $table);
    $exp = explode('_', $table);
    foreach($exp as $key => $value)
      $exp[$key] = ucfirst($value);
    $table = implode($exp);
    return 'Select'.$table;
  }
}

if ( ! function_exists('FieldToTable'))
{
  function FieldToTable($index = '', $c = '', $f = '', $field = '')
  {
    if(substr($field,0,7) == 'id_file') return array('nz_file','id_file','file');
    
    $ret = array(' ',' ',' ');        
    $CI =& get_instance();
    $fnew = mb_strtolower($field,'UTF-8');  
      
    if(substr($fnew,0,3) == 'id_') $fnew = substr($fnew,3);
    
    if( $CI->input->post('lj'.$index) ) $ret[0] = $CI->input->post('lj'.$index);
    if( $CI->input->post('lj'.$index.'-id') ) $ret[1] = $CI->input->post('lj'.$index.'-id');
    if( $CI->input->post('lj'.$index.'-text') ) $ret[2] = $CI->input->post('lj'.$index.'-text');

    if( trim($ret[0]) )
    {
      if( trim($ret[1]) && trim($ret[2]) )
        return $ret;
      $table = $ret[0];
      $fields = $CI->db->list_fields($table);
      foreach($fields as $fi)
      {
        if( $field == $fi ) $ret[1] = $field;
        if( $fnew == $fi ) $ret[2] = $fnew;
      }
      if( !$ret[1] ) $ret[1] = $fields[0];
      return $ret;
    }      
    
    $tables = $CI->db->list_tables();
    foreach($tables as $table)
    {
      $table = mb_strtolower($table,'UTF-8');
      if( $f.'_'.$fnew == $table || rtrim($f,'s').'_'.$fnew == $table || rtrim($f,'es').'_'.$fnew == $table )
      {
        $ret[0] = $table;
        $fields = $CI->db->list_fields($table);
        foreach($fields as $fi)
        {
          if( $field == $fi ) $ret[1] = $field;
          if( $fnew == $fi ) $ret[2] = $fnew;
        }
        if( !$ret[1] ) $ret[1] = $fields[0];
        return $ret;
      }
    }
    foreach($tables as $table)
    {
      $table = mb_strtolower($table,'UTF-8');
      if( $c.'_'.$fnew == $table || rtrim($c,'s').'_'.$fnew == $table || rtrim($c,'es').'_'.$fnew == $table )
      {
        $ret[0] = $table;
        $fields = $CI->db->list_fields($table);
        foreach($fields as $fi)
        {
          if( $field == $fi ) $ret[1] = $field;
          if( $fnew == $fi ) $ret[2] = $fnew;
        }
        if( !$ret[1] ) $ret[1] = $fields[0];
        return $ret;
      }
    }
    foreach($tables as $table)
    {
      $table = mb_strtolower($table,'UTF-8');
      if( 'nz_' . $c.'_'.$fnew == $table || 'nz_' . rtrim($c,'s').'_'.$fnew == $table || 'nz_' . rtrim($c,'es').'_'.$fnew == $table )
      {
        $ret[0] = $table;
        $fields = $CI->db->list_fields($table);
        foreach($fields as $fi)
        {
          if( $field == $fi ) $ret[1] = $field;
          if( $fnew == $fi ) $ret[2] = $fnew;
        }
        if( !$ret[1] ) $ret[1] = $fields[0];
        return $ret;
      }
    }
    foreach($tables as $table)
    {
      $table = mb_strtolower($table,'UTF-8');
      if( $fnew == $table || 'nz_' . $fnew == $table ) 
      {
        $ret[0] = $table;
        $fields = $CI->db->list_fields($table);
        foreach($fields as $fi)
        {
          if( $field == $fi ) $ret[1] = $field;
          if( $fnew == $fi ) $ret[2] = $fnew;
        }
        if( !$ret[1] ) $ret[1] = $fields[0];
        return $ret;
      }
    }
  }
}

if ( ! function_exists('generateLabel'))
{
  function generateLabel( $name = '' )
  {
    if( substr($name,0,3) == 'id_') 
      $name = substr($name,3);
    return ucfirst($name);
  }
}

if ( ! function_exists('rrmdir'))
{
  function rrmdir($element)
  {
    if(is_dir($element)) 
    {
      $objects = scandir($element); 
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") 
        { 
          if (filetype($element."/".$object) == "dir") rrmdir($element."/".$object); else unlink($element."/".$object); 
        } 
      } 
      reset($objects); 
      rmdir($element); 
    }
    elseif(is_file($element))
    {
      unlink($element);
    }    
  } 
}