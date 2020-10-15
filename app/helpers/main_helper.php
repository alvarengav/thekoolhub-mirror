<?php defined('BASEPATH') || exit('No direct script access allowed');

if ( ! function_exists('layout'))
{
  function layout( $url = '' )
  {
    $CI =& get_instance();
    return $CI->config->item('base_url').'app/layout/' . trim($url,'/');
  }
}

if ( ! function_exists('tview'))
{
	function tview( $file, $html = false )
	{
		$CI =& get_instance();
		$CI->load->view( $file, $html );
	}
}

if ( ! function_exists('is_json'))
{
  function is_json($str){
      return json_decode($str) != null;
  }
}

if ( ! function_exists('href'))
{
	function href($a = '')
	{
		$CI =& get_instance();
		$base_url = $CI->config->item('base_sys');
		return $CI->routes[$a]['pager'] ?? $base_url.$CI->routes[$a]['pager'] ?: $a;
	}
}

if ( ! function_exists('adjust_brightness'))
{
	function adjust_brightness($hex, $steps) 
	{
		$steps = max(-255, min(255, $steps));
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) 
		{
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}
		$color_parts = str_split($hex, 2);
		$return = '#';

		foreach ($color_parts as $color)
		{
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT);
    }

      return $return;
  }
}

if ( ! function_exists('parse_ckeditor'))
{
  function parse_ckeditor( $str )
  {
    $str = preg_replace('#<span class="false-view">(.*?)</span>#', '', $str);

    $find = array(
      // '~\[b\](.*?)\[/b\]~s',
      // '~\[i\](.*?)\[/i\]~s',
      // '~\[u\](.*?)\[/u\]~s',
      // '~\[quote\](.*?)\[/quote\]~s',
      // '~\[size=(.*?)\](.*?)\[/size\]~s',
      // '~\[color=(.*?)\](.*?)\[/color\]~s',
      // '~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
      // '~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
      // '~\[img=(.*?)\](.*?)\[/img\]~s',
      '~\[download=(.*?)\](.*?)\[/download\]~s'
    );

    $replace = false;

    $str = preg_replace($find,$replace,$str);

    $str = preg_replace_callback('~\[img=(.*?)\](.*?)\[/img\]~s', 'embed_img', $str);
    // $str = preg_replace_callback('~\[gallery=(.*?)\](.*?)\[/gallery\]~s', 'embed_gallery', $str);


    return $str;
  }
  function embed_img( $matches=[] ) {
    if(!count( $matches )) return '';
    
    
    $CI =& get_instance();
    $thumb = upload( $CI->Data->GetFile( $matches[1] )->file );
    // $thumb = thumb( $CI->Data->GetFile( $matches[1] )->file , 880,2000,false);
    
    return '<img src="'.$thumb.'" style="display: block;width: inherit;max-width: 100%; margin: 0 auto;" />';
  }
  function embed_gallery( $matches=[] ) {
    if(!count( $matches )) return '';
    if(!isset( $matches[1] )) return '';
    
    $CI =& get_instance();

    $arr = explode(',', $matches[1]);
    $g = [];
    foreach($arr as $f) {
      $g[] = $CI->Data->GetFile($f);
    }

    $str = $CI->load->view('components/common/galleryScroll', ['gallery'=>$g], true);
    // $thumb = thumb( $CI->Data->GetFile( $matches[1] )->file , 800,2000,false);
    
    return $str;
  }
}




if ( ! function_exists('date_to_human'))
{
	function date_to_human($date) 
	{
    $CI =& get_instance();
    $str = '';
    $dt = new DateTime($date);

    
    if( $CI->data['lang'] == 'es' )
      $months = array("ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC");
    else
      $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");


    $str .= $dt->format('d');
    $str .= ' ';
    $str .= $months[ $dt->format('m') - 1 ];
    $str .= ' ';
    $str .= $dt->format('Y');

    return $str;
  }
}
if ( ! function_exists('date_to_time'))
{
	function date_to_time($date) 
	{
    $str = '';
    $dt = new DateTime($date);


    $str .= $dt->format('h:i');

    return $str;
  }
}



require NZAPATH.'helpers/main_helper.php';
