<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('layout'))
{
  function layout($url = '')
  {
    $CI =& get_instance();
    $layout = 'layout/'.trim($url, '/');
    $base_url = $CI->config->item('base_sys') ?: $CI->config->item('base_url');
    if (APP_MODULE == 'admin')
    {
      if($CI->config->item('hide-nz-layout', 'app'))
      {
        return $CI->config->item('base_url').$layout;
      }
      return $base_url.'nz/'.$layout;
    }
    return $base_url.'app/'.$layout;
  }
}

if ( ! function_exists('mailSave'))
{
  function mailSave( $section = '', $string = '' )
  {
    $folder = APPPATH . "logs/{$section}/";
    if(!is_dir($folder))
    {
      mkdir($folder, 0777, true);
      chmod($folder, 0777);
    }
    $time = mktime();
    file_put_contents("{$folder}{$time}.html", $string);
  }
}


if ( ! function_exists('human_to_unix'))
{
  function human_to_unix( $time = '' )
  {
  	$time = preg_replace('/([^\d])/', '', $time);
  	$time = str_pad($time, 14, '0', STR_PAD_RIGHT);
  	// DDMMYYYYHHMMSS
  	return mktime(
  					(int) substr($time, 8, 2),
  					(int) substr($time, 10, 2),
  					(int) substr($time, 12, 2),
  					(int) substr($time, 2, 2),
  					(int) substr($time, 0, 2),
  					(int) substr($time, 4, 4)
  				);
  }
}


if ( ! function_exists('human_to_mysql'))
{
  function human_to_mysql( $string = '' )
  {
    $date = '0000-00-00';
    $arr = explode('/', $string);
    if(count($arr) != 3) return $date;
    $date = "{$arr[2]}-{$arr[1]}-{$arr[0]}";
    return $date;
  }
}

if ( ! function_exists('date_to_unix'))
{
	function date_to_unix($time = '')
	{
		// YYYY-MM-DD HH:MM:SS
		$time = preg_replace('/([^\d])/', '', $time);
		$time = str_pad($time, 14, '0', STR_PAD_RIGHT);
		// DDMMYYYYHHMMSS
		return mktime(
						(int) substr($time, 8, 2),
						(int) substr($time, 10, 2),
						(int) substr($time, 12, 2),
						(int) substr($time, 2, 2),
						(int) substr($time, 0, 2),
						(int) substr($time, 4, 4)
					);
	}
}

if ( ! function_exists('mysql_to_unix'))
{
  function mysql_to_unix($time = '')
  {
    $time = str_replace(array('-', ':', ' '), '', $time);
    return mktime(
      (int) substr($time, 8, 2),
      (int) substr($time, 10, 2),
      (int) substr($time, 12, 2),
      (int) substr($time, 4, 2),
      (int) substr($time, 6, 2),
      (int) substr($time, 0, 4)
    );
  }
}
if ( ! function_exists('mysql_to_calendar'))
{
  function mysql_to_calendar( $string = '' )
  {
    return date('d/m/Y', mysql_to_unix($string));
  }
}

if ( ! function_exists('mysql_to_calendartime'))
{
  function mysql_to_calendartime( $string = '' )
  {
    return date('d/m/Y H:i:s', mysql_to_unix($string));
  }
}

if ( ! function_exists('process_keywords'))
{
  function process_keywords( $string = '' )
  {
    return str_replace(array(' , ',' ,',', '),',',rtrim(str_replace(array('&#8230;','.','-','|','_'),',',$string),','));
  }
}

if ( ! function_exists('secure_item'))
{
  function secure_item( $secure = array(), $item = 0 )
  {
    if(!isset($secure[$item])) return (object)array('view' => 0, 'edit' => 0, 'delete' => 0);
    return $secure[$item];
  }
}

if ( ! function_exists('clean_title'))
{
  function clean_title( $str = '' )
  {
    return strip_tags($str);
    return str_replace(array('"',"'"),'', strip_tags($str));
  }
}

if ( ! function_exists('prep_app_title'))
{
  function prep_app_title( $title = array(), $html = true )
  {
    if(!is_array($title)) return clean_title($title);
    $implode = ' | ';
    if($html)
    {
      $implode = '<i class="fa fa-arrow-right"> </i>';
    }
    $title = trim(trim(implode($implode, $title)),'| ');
    if(!$html)
      $title = clean_title($title);
    return $title;
  }
}

if ( ! function_exists('nformat'))
{
  function nformat( $number = 0, $dec = 2 )
  {
    return number_format($number,$dec,'.','');
  }
}

if ( ! function_exists('create_select_options'))
{
  function create_select_options( $query = false, $label = '', $translate = false )
  {
    $data = array();
    if($translate) $CI =& get_instance();
    if($label) $data[''] = $label;
    if($query)
    {
      foreach ($query->result_array() as $row)
      {
        if($translate)
          $data[$row['id']] = $CI->lang->line($row['el']);
        else
          $data[$row['id']] = $row['el'];
      }
    }
    return $data;
  }
}

if ( ! function_exists('get_day_string'))
{
  function get_day_string( $number = 0 )
  {
    $number = round($number);
    $days = array();
    $days[0] = 'Domingo';
    $days[1] = 'Lunes';
    $days[2] = 'Martes';
    $days[3] = 'Miércoles';
    $days[4] = 'Jueves';
    $days[5] = 'Viernes';
    $days[6] = 'Sábado';
    return isset($days[$number]) ? $days[$number] : "";
  }
}

if ( ! function_exists('get_month_string'))
{
  function get_month_string( $number = 0 )
  {
    $number = round($number);
    $months = array();
    $months[1] = 'Enero';
    $months[2] = 'Febrero';
    $months[3] = 'Marzo';
    $months[4] = 'Abril';
    $months[5] = 'Mayo';
    $months[6] = 'Junio';
    $months[7] = 'Julio';
    $months[8] = 'Agosto';
    $months[9] = 'Septiembre';
    $months[10] = 'Octubre';
    $months[11] = 'Noviembre';
    $months[12] = 'Diciembre';
    return isset($months[$number]) ? $months[$number] : "";
  }
}

if ( ! function_exists('character_limiter'))
{

	function character_limiter($str, $n = 500, $end_char = '&#8230;')
	{
		if (mb_strlen($str) < $n)
		{
			return $str;
		}

		// a bit complicated, but faster than preg_replace with \s+
		$str = preg_replace('/ {2,}/', ' ', str_replace(array("\r", "\n", "\t", "\x0B", "\x0C"), ' ', $str));

		if (mb_strlen($str) <= $n)
		{
			return $str;
		}

		$out = '';
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';

			if (mb_strlen($out) >= $n)
			{
				$out = trim($out);
				return (mb_strlen($out) === mb_strlen($str)) ? $out : $out.$end_char;
			}
		}
	}
}


if ( ! function_exists('prep_word_url'))
{
  function prep_word_url($string = '', $spacer = "-" )
  {
    $string = rtrim(trim($string));
    $string = character_limiter($string,40,'');
    $string = mb_strtolower($string, 'UTF-8');
    $string = preg_replace("/[ÁáÄäÂâ]/iu","a",$string);
    $string = preg_replace("/[ÉéËëÊê]/iu","e",$string);
    $string = preg_replace("/[ÍíÏïÎî]/iu","i",$string);
    $string = preg_replace("/[ÓóÖöÔô]/iu","o",$string);
    $string = preg_replace("/[ÚúÜüÛû]/iu","u",$string);
    $string = preg_replace("/[Ññ]/iu","n",$string);
    $string = trim(preg_replace("/[^ A-Za-z0-9_]/", " ", $string));
    $string = preg_replace("/[ \t\n\r]+/", $spacer, $string);
    $string = str_replace(" ", $spacer, $string);
    $string = preg_replace("/[ -]+/", $spacer, $string);
    return $string;
  }
}

if ( ! function_exists('thumb_internal'))
{
  function thumb_internal($file = '', $width = 0, $height = 0, $crop = true, $global = false)
  {
    return thumb($file, $width, $height, $crop, $global);
  }
}

if ( ! function_exists('thumb_coords'))
{
  function thumb_coords( $file = '', $json = '', $width = 700, $height = 700)
  {
  	if ( ! $file)
  	{
  	  return '';
  	}
  	$file_segments = explode('/', $file);
  	if (count($file_segments) < 3)
  	{
  		return '';
  	}

    $CI =& get_instance();
    if ($CI->config->item('hide-pictures', 'app'))
    {
      return '';
    }

    $version  = str_replace('|', '', $CI->config->item('static-version', 'app'));
    $base_url = $CI->config->item('base_sys');
    if ($CI->config->item('static-url', 'app'))
    {
    	$base_url = $CI->config->item('static-url', 'app');
    }
    $uri  = 'fx';

    $file = str_replace('|', '', substr($file, 2));
    $chars = substr(md5($file), 7, 10);

    $encrypt = $CI->encryption->encode("{$width}|{$height}|{$json}|{$chars}|{$version}");

    return "{$base_url}{$uri}/{$encrypt}/{$file}";

  }
}

if ( ! function_exists('thumb'))
{
  function thumb($file = '', $width = 0, $height = 0, $crop = true, $global = false)
  {
    if ( ! $file)
    {
      return '';
    }
    $file_segments = explode('/', $file);
    if (count($file_segments) < 3)
    {
    	return '';
    }

    $CI =& get_instance();
    if ($CI->config->item('hide-pictures', 'app'))
    {
      return '';
    }
    if(is_string($crop))
    {
      $type = $crop;
    }
    else
    {
      $type   = $crop ? "c" : "t";
    }
    $module = $global ? "1" : "0";
    $width  = round($width);
    $height = round($height);

    $version  = str_replace('|', '', $CI->config->item('static-version', 'app'));
    $base_url = $CI->config->item('base_sys');
    if ($CI->config->item('static-url', 'app'))
    {
    	$base_url = $CI->config->item('static-url', 'app');
    }
    $uri  = $global ? 'fs' : 'f' ;

    $file = str_replace('|', '', substr($file, 2));
    $chars = substr(md5($file), 7, 10);

    $encrypt = $CI->encryption->encode("{$width}|{$height}|{$type}|{$module}|{$chars}|{$version}");

    return "{$base_url}{$uri}/{$encrypt}/{$file}";

  }
}

if ( ! function_exists('base_sys'))
{
  function base_sys($uri = '')
  {
    $CI =& get_instance();
    return rtrim($CI->config->item('base_sys'), '/').'/'.$uri;
  }
}

if ( ! function_exists('prep_no_url'))
{
	function prep_no_url($string = '')
	{
		$string = mb_strtolower($string, 'UTF-8');
		$string = str_replace(array('http://', 'https://', '://'), '', $string);
		$string = preg_replace('/[áäą́ȧăâàāąãå]/iu', 'a', $string);
		$string = preg_replace('/[ěɇéêèęẽëė]/iu', 'e', $string);
		$string = preg_replace('/[ɨíîïi̇ì]/iu', 'i', $string);
		$string = preg_replace('/[óôơo͘öòõ]/iu', 'o', $string);
		$string = preg_replace('/[ŭưʉúûü]/iu', 'u', $string);
		$string = preg_replace('/[ñ]/iu', 'n', $string);
		$string = preg_replace('/[^a-z0-9\-\.\/_:\+\#]/iu', '', $string);

		$url = $string;

		$chars = array('/', ':', '*', '+', '#');
		foreach ($chars as $char)
		{

			$segments = explode($char, $url);
			if (count($segments) == 1)
			{
				continue;
			}

			$new_segment = '';

			foreach ($segments as $segment)
			{
				if (strlen($segment) >= strlen($new_segment))
				{
					$new_segment = $segment;
				}
			}

			$url = $new_segment;

		}

		$url = trim(rtrim($url, '.'), '.');

		if (strpos($url, '.') === FALSE)
		{
			$url = $url . '.com';
		}

		return $url;

	}

}

if ( ! function_exists('thumb_version'))
{
  function thumb_version()
  {
    $CI =& get_instance();
    return $CI->config->item('upload-version', 'app');
  }
}

if ( ! function_exists('thumb_url'))
{
  function thumb_url( $id = '', $global = false )
  {
    $global = $global ? "g" : "";
    return base_url() . "app/thumb{$global}/{$id}";
  }
}

if ( ! function_exists('profile_url'))
{
  function profile_url( $id = '', $file = '' )
  {
    return base_url() . "app/profile/image/{$id}/{$file}";
  }
}

if ( ! function_exists('download_file'))
{
  function download_file($file = '', $global = false)
  {
    $CI =& get_instance();
    $base_url = $CI->config->item('base_sys');
    if ($CI->config->item('static-url', 'app'))
    {
    	$base_url = $CI->config->item('static-url', 'app');
    }
  	$uri  = 'fd';
    $encrypt = $CI->encryption->encode("{$file}|{$global}");
  	return "{$base_url}{$uri}/{$encrypt}/{$file}";
  }
}

if ( ! function_exists('view_file'))
{
  function view_file($file = '', $global = false)
  {
    $CI =& get_instance();
    $base_url = $CI->config->item('base_sys');
    if ($CI->config->item('static-url', 'app'))
    {
    	$base_url = $CI->config->item('static-url', 'app');
    }
  	$uri  = 'fv';
    $encrypt = $CI->encryption->encode("{$file}|{$global}");
  	return "{$base_url}{$uri}/{$encrypt}/{$file}";
  }
}

if ( ! function_exists('upload'))
{
  function upload( $file = '', $global = false )
  {
    if($file)
    {
      return view_file($file, $global);
    }

    $CI =& get_instance();
    $version = $CI->config->item('upload-version', 'app');
    $folder = $CI->config->item('uploads-global', 'app');
    if(!$global || !$folder)
    {
      $folder = $CI->config->item('uploads', 'app');
    }
    $folder = str_replace(FCPATH, '', $folder);
    $base_url = $CI->config->item('base_sys');
    if ($CI->config->item('static-url', 'app'))
    {
    	$base_url = $CI->config->item('static-url', 'app');
    }
    return $base_url . $folder;
  }
}


if ( ! function_exists('base64url_encode'))
{
  function base64url_encode($data = '')
  {
    return rtrim(strtr($data, '+/', '-_'), '=');
  }
}

if ( ! function_exists('base64url_decode'))
{
  function base64url_decode($data = '')
  {
    return str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT);
  }
}


if ( ! function_exists('mb_ucfirst'))
{
  function mb_ucfirst($string = '', $e = 'utf-8', $lower = true)
  {
    if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string))
    {
      if($lower)
      {
        $string = mb_strtolower($string, $e);
      }
      $upper = mb_strtoupper($string, $e);
      preg_match('#(.)#us', $upper, $matches);
      $string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $e), $e);
    }
    else
    {
      if($lower)
      {
        $string = strtolower($string);
      }
      $string = ucfirst($string);
    }
    return $string;
  }
}

if ( ! function_exists('ucfirstword'))
{
  function ucfirstword($string = '', $lower = false)
  {
    if($lower)
    {
      $string = mb_strtolower($lower, 'utf-8');
    }
    $segments = explode(' ', $string);
    $segments = array_map(function ($value) {
      return mb_ucfirst($value, 'utf-8');
    }, $segments);
    return implode(' ', $segments);
  }
}


if ( ! function_exists('mb_ucfirstword'))
{
	function mb_ucfirstword($string = '', $lower = false)
	{
		return ucfirstword($string, $lower);
	}
}


if ( ! function_exists('process_js_text'))
{
  function process_js_text( $str = '' )
  {
    return str_replace( array( "\n", "\r" ), array( "\\n", "\\r" ), $str );
  }
}

if ( ! function_exists('get_mime'))
{
  function get_mime( $filename = '' )
  {
    if(!file_exists($filename) || !filesize($filename)) return false;
    $image_info = getimagesize($filename);
    if(!isset($image_info["mime"])) 
    {
    	return mime_content_type($filename);
    }
    return $image_info["mime"];
  }
}

if ( ! function_exists('notification_replace'))
{
  function notification_replace( $text = '', $key = '', $value = '', $type = '')
  {
    if($type == 'color')
      $value = "<span class='app-color'>{$value}</span>";
    if($type == 'bold')
      $value = "<span class='app-bold'>{$value}</span>";
    if($type == 'italic')
      $value = "<span class='app-italic'>{$value}</span>";
    $key  = '{'.$key.'}';
    $text = str_replace($key, $value, $text);
    return $text;
  }
}

if ( ! function_exists('notification_clean'))
{
  function notification_clean( $text = '' )
  {
    //$text = str_replace($key, $value, $text);
    return rtrim(rtrim($text),'.') . '.';
  }
}

if ( ! function_exists('notification_parse'))
{
  function notification_parse( $n = false )
  {
    $CI =& get_instance();
    $data = $n;
    $text = $n->text;
    $data->project = false;
    $data->blank = true;
    $data->image = false;
    $data->ico = '<i class="fa fa-info-circle"></i>';
    if(in_array($n->id_type, array(4)))
      $data->blank = false;
    if(!$n->id_project || $n->id_project == $CI->MApp->project)
      $data->blank = false;
    $nData = json_decode($n->data);
    if(isset($nData->id_user))
    {
      $user = $CI->MApp->DataUser($nData->id_user);
      if($user)
      {
        if($user->picture)
        {
          $data->image = thumb($user->picture, 32, 32, true, true);
          #$data->image = profile_url($user->idpicture, $user->picture);
        }
        $text = notification_replace($text, 'userName', $user->name, 'color');
        $text = notification_replace($text, 'userLastname', $user->lastname, 'color');
        $text = notification_replace($text, 'userFullname', trim("{$user->name} {$user->lastname}"), 'color');
      }
      else
      {
        $CI->MApp->DeleteNotification($n->id);
        $data->delete = true;
        return $data;
      }
    }
    if($n->id_project)
    {
      $project = $CI->DataG->DataProject($n->id_project);
      if($project)
      {
        if(!$data->image && $project->picture)
          $data->image = thumb($project->picture, 32, 32, true, true);
        $data->project = $project->client . ' - ' . $project->project;
        #$text = notification_replace($text, 'projectName', $project->project . ' - ' . $project->client, 'color');
        $text = notification_replace($text, 'projectName', $project->project, 'color');
      }
    }
    if($n->id_type == 4)
    {
      $data->ico = '<i class="fa fa-info-circle"></i> ';
      $title = isset($nData->noteTitle) ? $nData->noteTitle : '';
      $text = notification_replace($text, 'notificationTitle', $title, 'italic');
    }
    if($n->id_type == 3)
    {
      $data->ico = '<i class="fa fa-user"></i> ';
    }
    $data->text = notification_clean($text);
    return $data;
  }
}

if ( ! function_exists('process_description'))
{
  function process_description($string = '')
  {
    $string = preg_replace('/&nbsp;/u', '.', $string);
    $string = preg_replace('/(^[,;:\#\. ])/ui', '.', $string);
    $string = preg_replace('/\s\s+/i', '.', $string);
    $string = preg_replace('/\W*\.\W*/ui', '. ', $string);
    $string = strip_tags($string);
    $string = explode('.', $string);
    $description = '';
    foreach ($string as $sentence)
    {
      $sentence = trim(rtrim($sentence));
      if($sentence)
      {
        $description .= $sentence.'. ';
      }
      if(strlen($description) >= 150)
      {
        break;
      }
    }
    return rtrim(trim($description));
  }
}

if ( ! function_exists('get_keywords'))
{
  function get_keywords($string = '', $implode = false, $quantity = 12)
  {
    mb_internal_encoding('UTF-8');
    $words = array(
      'about', 'from', 'then', 'this', 'that', 'these', 'those', 
      'what', 'when', 'where', 'will', 'with', 'such', 'have', 'could.*', 
      'general.*', 'https?', 'todos', 'eres|eran|eramos|somos|seremos', 'asociad.{1,3}',
      'como','desde', 'entre', 
      'algun.s?', 'tien.{1,4}', 'pued.{1,4}', 'teng.{1,4}', 'tambi.n', 
      'est.{1,4}', 's[oó]l[ao].*', '.{4,}ados?','ell[ao]s?', 'para.?', 'segun', 'sobre.?', 'tra.?'
    );
    $pattern = '/^('.implode('|', $words).')$/i';
    $string = mb_strtolower($string);
    $string = preg_replace('/[áäâ]/iu', 'a', $string);
    $string = preg_replace('/[éëê]/iu', 'e', $string);
    $string = preg_replace('/[íïî]/iu', 'i', $string);
    $string = preg_replace('/[óöô]/iu', 'o', $string);
    $string = preg_replace('/[úüû]/iu', 'u', $string);
    $string = trim(strip_tags(preg_replace('/(&nbsp;|\s{2,})/iu', ' ', $string)));
    $string = preg_replace('/([\pP]| {2,})/u', ' ', $string);
    $keywords = explode(' ', $string);
    $keywords = array_filter($keywords, function ($item) use ($pattern) {
      return !($item == '' || mb_strlen($item) <= 3 || is_numeric($item) || preg_match($pattern, $item));
    });
    $keywords = array_count_values($keywords);
    arsort($keywords);
    $max_index = $quantity * 2;
    $index = 0;
    if(count($keywords) > $quantity)
    {
      foreach ($keywords as $keyword => $value) 
      {
        if ( ! preg_match('/e?s$/', $keyword))
        {
          if (isset($keywords[$keyword.'s']) || isset($keywords[$keyword.'es']))
          {
            $keywords[$keyword] += $value;
            unset($keywords[$keyword]);
          }
        }
        $index++;
        if($index >= $max_index)
        {
          break;
        }
      }
    }
    $keywords = array_keys(array_slice($keywords, 0, $quantity));
    if($implode)
    {
      return implode(',', $keywords);
    }
    return $keywords;
  }
}


if ( ! function_exists('remove_at'))
{
  function remove_at($string = '')
  {
    $string = trim(trim(trim($string),'@'));
    return $string;
  }
}


if ( ! function_exists('rmodify'))
{
  function rmodify($params = array())
  {
    if( !is_array( $params[0] ) )
      $params = array($params);
    $json = str_replace('"', "'", json_encode($params));

    echo 'data-rmodify="'.$json.'"';
  }
}

if ( ! function_exists('quest_sanitize'))
{
	function quest_sanitize( $str = '' )
	{
		$str = str_replace( array('_','-'), ' ', $str);
		$str = str_replace( array('"',"'"), '', $str);
		return $str;
	}
}

if ( ! function_exists('round_value'))
{
	function round_value($value = 0, $fixed = FALSE)
	{
		if ($value == '')
		{
			return $value;
		}
		$len = strlen($value);
		$pow = pow(10, $len + 1);
		$number = number_format(round($value * $pow) / $pow, $len, '.', '');
		if ( ! $fixed && strpos($number, '.') !== FALSE)
		{
			$number = rtrim($number, 0);
			return substr($number, -1) == '.' ? $number.'0' : $number;
		}
		return $number;
	}
}

if ( ! function_exists('sanitize_field_human'))
{
	function sanitize_field_human($value = '', $special = TRUE)
	{
		if (empty($value))
		{
			return $value;
		}
		
		$quote_open = '‘';
		$quote_close = '’';
		
		$value = preg_replace('/(\'(.*)\'|"(.*)")/u', $quote_open.'$2'.$quote_close, $value);
		$value = preg_replace('/[“«‘]+/u', $quote_open, $value);
		$value = preg_replace('/[»”’"\']+/u', $quote_close, $value);
		
		if($special)
		{
			$value = preg_replace('/[\t\<\>\\ ]+/', ' ', $value);			
		}
		$value = trim(rtrim($value));
		return $value;
	}
}
