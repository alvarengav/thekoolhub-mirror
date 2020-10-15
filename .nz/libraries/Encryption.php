<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Encryption {

  public $key_alt  = '';
  private
    $CI       = false,
    $key      = '',
    $client   = '',
    $slug     = '';

  public function __construct()
  {
    $this->CI =& get_instance();

    if( ! isset($this->CI->config->config['app']))
    {
      $this->CI->load->config('app', TRUE);
    }

    $client         = $this->CI->config->item('client', 'app');
    $project        = $this->CI->config->item('project-code', 'app');
    $this->client   = $client;
    $this->key_alt  = md5($client.$client.$client);
    $this->key      = $project ? md5($project.$project) : $this->key_alt;

    $this->CI->config->set_item('cookie_prefix',    APP_MODULE.$this->client_encode());
    $this->CI->config->set_item('sess_cookie_name', $this->CI->config->item('cookie_prefix').'Sess');
    $this->CI->config->set_item('sess_data_cookie', $this->CI->config->item('sess_cookie_name').'Data');

  }

  public function client_encode()
  {
    return preg_replace('/[^A-Za-z0-9]/', '', ucfirstword($this->client, true));
  }

  public function safe_b64encode($string = '')
  {
    return str_replace(array('+','/','='),array('-','_',''), base64_encode($string));
  }

  public function safe_b64decode($string = '')
  {
    $data = str_replace(array('-', '_'), array('+', '/'), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4)
    {
      $data .= substr('====', $mod4);
    }
    return base64_decode($data);
  }

  public function convert($str = '', $ky = '')
  {
    if($ky == '')
    {
      return $str;
    }
    $ky = str_replace(chr(32), '', $ky);
    $kl = strlen($ky) < 32 ? strlen($ky) :32;
    $k  = array();

    for ($i = 0; $i < $kl; $i++)
    {
      $k[$i] = ord($ky{$i})&0x1F;
    }
    $j = 0;
    for ($i = 0; $i < strlen($str); $i++)
    {
      $e = ord($str{$i});
      $str{$i} = $e&0xE0 ? chr($e^$k[$j]) : chr($e);
      $j++;
      $j= $j == $kl ? 0 : $j;
    }
    return $str;
  }

  public  function encode($value = '', $key = '')
  {
    $key = $key ? $key : $this->key;
    return $this->safe_b64encode($this->convert($value, $key));
  }

  public function set($key)
  {
    $this->key = $key;
  }

  public function decode($value = '', $key = '')
  {
    $key = $key ? $key : $this->key;
    return $this->convert($this->safe_b64decode($value), $key);
  }

}
