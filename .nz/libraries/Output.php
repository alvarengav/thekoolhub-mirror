<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends CI_Output {

  public
    $debug          = TRUE,
    $cache_path     = FALSE,
    $nocache        = array(),
    $interal_routes = array();

  public function get_cache_path($CFG)
  {
    if ( ! empty($this->cache_path))
    {
      return $this->cache_path;
    }
    $cache_path = $CFG->item('cache_path');
    if ($cache_path === '') 
    {
      $cache_path = APPPATH.'cache'.DIRECTORY_SEPARATOR.ENVIRONMENT.DIRECTORY_SEPARATOR;
      if ( ! file_exists($cache_path) && ! is_dir($cache_path))
      {
        $oldumask = umask(0);
        mkdir($cache_path, 0755, TRUE);
        umask($oldumask);
      }
    }
    return $this->cache_path = $cache_path;
  }
  
  public function get_file_cache($CFG, $URI)
  {
    $cache_path = $this->get_cache_path($CFG);
    if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
    {
      log_message('error', 'Unable to write cache file: '.$cache_path);
      return;
    }

    $file = FALSE;
    $route = $URI->segment(1, 'home');
    
    if(in_array($route, $this->nocache))
    {
      return FALSE;
    }
    
    if ($route == 'home')
    {
      $file = 'home';
    }
    elseif (isset($this->interal_routes[$route]))
    {
      $file = implode(DIRECTORY_SEPARATOR, $this->interal_routes[$route]);
      $page = round($URI->segment(2, 0));
      if ($page)
      {
        $file .= '__'.$page;
      }
    }
    else
    {
      if (preg_match('/^d?f(s|x|d|v)?/', $route))
      {
       $route = '@files' ;
      }
      $file = $route.DIRECTORY_SEPARATOR.implode('_', $URI->segments);
    }

    $path = $cache_path.$file;
    $dir  = pathinfo($path, PATHINFO_DIRNAME);
    if ( ! file_exists($dir) && ! is_dir($dir))
    {
      $oldumask = umask(0);
      mkdir($dir, 0755, TRUE);
      umask($oldumask);
    }

    return $path;

  }

  public function _write_cache($output)
  {

    $CI =& get_instance(); 
    
    if ( ! $this->is_active())
    {
      return FALSE;
    }
    
    $filepath = $this->get_file_cache($CI->config, $CI->uri);
    $cache_path = $this->cache_path;   
    
    if (isset($_GET['refresh-cache']) && is_really_writable($cache_path))
    {
      @unlink($filepath);
      log_message('debug', 'Cache file refreshing. File deleted.');
    }
    
    if ( !$filepath)
    {
      return FALSE;
    }
    
    if ( ! $fp = @fopen($filepath, 'w+b'))
    {
      log_message('error', 'Unable to write cache file: '.$cache_path);
      return;
    }
    
    if (flock($fp, LOCK_EX))
    {
      // If output compression is enabled, compress the cache
      // itself, so that we don't have to do that each time
      // we're serving it
      if ($this->_compress_output === TRUE)
      {
        $output = gzencode($output);

        if ($this->get_header('content-type') === NULL)
        {
          $this->set_content_type($this->mime_type);
        }
      }

      $expire = time() + ($this->cache_expiration * 60);

      // Put together our serialized info.
      $cache_info = serialize(array(
        'expire'  => $expire,
        'headers' => $this->headers
      ));

      $output = $cache_info.'ENDCI--->'.$output;

      for ($written = 0, $length = strlen($output); $written < $length; $written += $result)
      {
        if (($result = fwrite($fp, substr($output, $written))) === FALSE)
        {
          break;
        }
      }

      flock($fp, LOCK_UN);
    }
    else
    {
      log_message('error', 'Unable to secure a file lock for file at: '.$cache_path);
      return;
    }

    fclose($fp);

    if (is_int($result))
    {
      //chmod($cache_path, 0640);
      log_message('debug', 'Cache file written: '.$cache_path);

      // Send HTTP cache-control headers to browser to match file cache settings.
      $this->set_cache_header($_SERVER['REQUEST_TIME'], $expire);
    }
    else
    {
      @unlink($cache_path);
      log_message('error', 'Unable to write the complete cache content at: '.$cache_path);
    }
  }

  public function is_refreshing()
  {
    return isset($_GET['nocache']) || isset($_GET['refresh-cache']);
  }
  
  public function is_production()
  {
    return ENVIRONMENT == 'online';
  }

  public function is_active()
  {
    if (count($_POST) || $this->is_refreshing())
    {
      return FALSE;
    }
    return $this->is_production() ? TRUE : ! $this->debug;
  }
  
  public function _display_cache(&$CFG, &$URI)
  {
    if ( ! $this->is_active())
    {
      return FALSE;
    }

    $filepath = $this->get_file_cache($CFG, $URI);
    $cache_path = $this->cache_path;
    if ( !$filepath || ! file_exists($filepath) || ! $fp = @fopen($filepath, 'rb'))
    {
      return FALSE;
    }
    
    flock($fp, LOCK_SH);

    $cache = (filesize($filepath) > 0) ? fread($fp, filesize($filepath)) : '';

    flock($fp, LOCK_UN);
    fclose($fp);

    // Look for embedded serialized file info.
    if ( ! preg_match('/^(.*)ENDCI--->/', $cache, $match))
    {
      return FALSE;
    }

    $cache_info = unserialize($match[1]);
    $expire = $cache_info['expire'];

    $last_modified = filemtime($filepath);

    // Has the file expired?
    if ($_SERVER['REQUEST_TIME'] >= $expire && is_really_writable($cache_path))
    {
      // If so we'll delete it.
      @unlink($filepath);
      log_message('debug', 'Cache file has expired. File deleted.');
      return FALSE;
    }
    else
    {
      // Or else send the HTTP cache control headers.
      $this->set_cache_header($last_modified, $expire);
    }

    // Add headers from cache file.
    foreach ($cache_info['headers'] as $header)
    {
      $this->set_header($header[0], $header[1]);
    }

    // Display the cache
    $this->_display(substr($cache, strlen($match[0])));
    log_message('debug', 'Cache file is current. Sending it to browser.');
    return TRUE;
  }

  // --------------------------------------------------------------------

  /**
   * Delete cache
   *
   * @param string  $uri  URI string
   * @return  bool
   */
  public function delete_cache($uri = '')
  {
    $CI =& get_instance();
    $filepath = $this->get_file_cache($CI->config, $CI->uri);
    if ( ! is_really_writable($filepath) || ! @unlink($filepath))
    {
      log_message('error', 'Unable to delete cache file for '.$uri);
      return FALSE;
    }

    return TRUE;
  }

}
