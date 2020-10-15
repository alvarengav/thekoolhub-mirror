<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Files_Controller extends CI_Controller
{
	public
	 $debug = false,
	 $jpeg_quality = 80;

	public function __construct()
	{
	  parent::__construct();
	  $this->set_cache();
	  if(substr($this->uri->segment(1, ''), 0, 1) == 'd')
	  {
	  	$this->debug = true;
	  }
	}

	public function error_404($ln = 0)
	{
		header('HTTP/1.1 404 Not Found', true, 404);
		echo 'HTTP/1.1 404 Not Found';
		if($ln)
		{
			echo "({$ln})";
		}
	}

	public function error_406($ln = 0)
	{
		header('HTTP/1.1 406 Not Acceptable', true, 406);
		echo 'HTTP/1.1 406 Not Acceptable';
		if($ln)
		{
			echo "({$ln})";
		}
	}

	public function download_file($hash = '')
	{
		$this->download = true;
		$this->view_file($hash);
	}

	public function view_file($hash = '')
	{
    $debug = $this->debug;

    $data = explode('|', $this->encryption->decode($hash));
    if ($debug)
    {
      echo '<pre>';
      print_r($data);
      echo '</pre>';
    }
    if(count($data) != 2)
    {
      return $this->error_404(81);
    }

    $folder = $this->config->item('uploads-global', 'app');
    if ( ! $data[1] || ! $folder)
    {
      $folder = $this->config->item('uploads', 'app');
    }
    $folder = rtrim($folder, '/');
    if ($debug)
    {
      echo '<pre>';
      print_r($folder);
      echo '</pre>';
    }

    $file = $data[0];
    $file_original = "{$folder}/{$file}";
    if ($debug)
    {
      echo '<pre>';
      print_r($file_original);
      echo '</pre>';
    }

    if ( ! file_exists($file_original))
    {
      return $this->error_404(118);
	}
	


    if (!empty($this->download))
    {
    	header("Content-Type: application/octet-stream");
    	header("Content-Transfer-Encoding: Binary");
    	header("Content-disposition: attachment; filename=\"" . basename($file_original) . "\"");
    }
    
    $mime = get_mime($file_original);
    if ($mime)
    {
    	header("Content-Type: {$mime}");
    }
    readfile($file_original);
    exit;

	}

	public function file()
	{

		$debug = $this->debug;

		$segments = $this->uri->segment_array();
		if ($debug)
		{
		  echo '<pre>';
		  print_r($segments);
		  echo '</pre>';
		}

		if ( ! isset($segments[2]))
		{
			return $this->error_404(42);
		}
		$hash = $segments[2];
		$file_segments = array();
		foreach ($segments as $index => $segment)
		{
			if($index < 3)
			{
				continue;
			}
			$file_segments[] = $segment;
		}

		if ($debug)
		{
		  echo '<pre>'; print_r($file_segments); echo '</pre>';
		}
		if (count($file_segments) < 3)
		{
			return $this->error_404(61);
		}
		$file = implode('/', $file_segments);

		if ($debug)
		{
		  echo '<pre>'; print_r($file); echo '</pre>';
		}

		$data = explode('|', $this->encryption->decode($hash));
		if ($debug)
		{
		  echo '<pre>';
		  print_r($data);
		  echo '</pre>';
		}
		if(count($data) != 5 && count($data) != 6)
		{
			return $this->error_404(81);
		}
		$width = $data[0];
		$height = $data[1];
		$folder = $this->config->item('uploads-global', 'app');
		if ( ! $data[3] || ! $folder)
		{
			$folder = $this->config->item('uploads', 'app');
		}
		$folder = rtrim($folder, '/');
		if ($debug)
		{
			echo '<pre>';
			print_r($folder);
			echo '</pre>';
		}

		if (substr(md5($file), 7, 10) != $data[4])
		{
			if ($debug)
			{
				echo '<pre>';
				echo substr(md5($file), 7, 10).'  =  '.$data[4];
				echo '</pre>';
				die();
			}
			return $this->error_404(107);
		}

		$file_original = "{$folder}/20{$file}";
		if ($debug)
		{
			echo 'ORIGINAL:<pre>';
			print_r($file_original);
			echo '</pre>';
		}
		if ( ! file_exists($file_original))
		{
			return $this->error_404(118);
		}


		if(strtolower(substr($file, -3)) == 'pdf')
		{
			if ($debug)
			{
				echo '<pre>THUMB PHP'; print_r($file_original); echo '</pre>'; die();
				$this->error_406(161);
			}
			header("Content-Type: application/pdf");
			readfile($file_original);
			exit;
		}
		

		$function = 'resize';
		if ($data[2] != 't')
		{
			$function .= '_crop';
		}
		$thumbs_root = 'thumb';
		$folder_thumbs = "{$folder}/{$thumbs_root}/";
		$name = array_pop($file_segments);
		$file_segments[] = $hash.$name;
		$file_thumb = $folder_thumbs.implode('/', $file_segments);

    $file_folder = pathinfo($file_thumb, PATHINFO_DIRNAME);
    if ( ! $file_folder)
    {
      return $this->error_404(174);
    }
    if ( ! is_dir($file_folder))
    {
      mkdir($file_folder, 0777, true);
    }


	
		if($data[2] == 'u')
		{
			if ($debug)
			{
				echo '<pre>';
				print_r($file_original);
				echo '</pre>';
				die();
			}
			if (file_exists($file_original))
			{
				if (file_exists($file_thumb))
				{
					die('Symlink: '.$file_thumb);
				}
				symlink($file_original, $file_thumb);
				$mime = get_mime($file_original);
				if ($mime)
				{
					header("Content-Type: {$mime}");
				}
				readfile($file_thumb);
				exit;
			}
			return $this->error_406(155);
		}

		
		
		$mime = get_mime($file_thumb);
		if ($mime)
		{
			if ($debug)
			{
				echo '<pre>THUMB PHP'; print_r($file_thumb); echo '</pre>'; die();
				$this->error_406(161);
			}
			header("Content-Type: {$mime}");
			readfile($file_thumb);

			exit;
		}


		
		$this->load->library('image');
		$this->image->load($file_original)->set_jpeg_quality($this->jpeg_quality);
		$this->image->$function($width, $height);
		$this->image->save($file_thumb)->clear();
		

		if ($debug)
		{
			echo '<pre>'; print_r($file_thumb); echo '</pre>'; die();
		}

		$mime = get_mime($file_thumb);
		if ($mime)
		{
			header("Content-Type: {$mime}");
			readfile($file_thumb);
			exit;
		}

		$this->error_406(199);

	}


	public function coords()
	{
		$debug = $this->debug;
		$segments = $this->uri->segment_array();

		if ($debug)
		{
		  echo '<pre>';
		  print_r($segments);
		  echo '</pre>';
		}
		if ( ! isset($segments[2]))
		{
			return $this->error_404(42);
		}
		$hash = $segments[2];
		$file_segments = array();
		foreach ($segments as $index => $segment)
		{
			if($index < 3)
			{
				continue;
			}
			$file_segments[] = $segment;
		}

		if ($debug)
		{
		  echo '<pre>'; print_r($file_segments); echo '</pre>';
		}
		if (count($file_segments) < 3)
		{
			return $this->error_404(61);
		}
		$file = implode('/', $file_segments);

		if ($debug)
		{
		  echo '<pre>'; print_r($file); echo '</pre>';
		}

		$data = explode('|', $this->encryption->decode($hash));
		if ($debug)
		{
		  echo '<pre>';
		  print_r($data);
		  echo '</pre>';
		}
		if(count($data) != 5)
		{
			return $this->error_404(81);
		}

		$points = explode(',', $data[2]);
    if(count($points) != 6)
  	{
  		return $this->error_404(88);
  	}

		$folder = $this->config->item('uploads', 'app');
		$folder = rtrim($folder, '/');
		if ($debug)
		{
			echo '<pre>';
			print_r($folder);
			echo '</pre>';
		}

		if (substr(md5($file), 7, 10) != $data[3])
		{
			if ($debug)
			{
				echo '<pre>';
				echo substr(md5($file), 7, 10).'  =  '.$data[3];
				echo '</pre>';
				die();
			}
			return $this->error_404(107);
		}

		$file_original = "{$folder}/20{$file}";
		if ($debug)
		{
			echo '<pre>';
			print_r($file_original);
			echo '</pre>';
		}
		if ( ! file_exists($file_original))
		{
			return $this->error_404(118);
		}

		$thumbs_root = 'thumb';
		$folder_thumbs = "{$folder}/{$thumbs_root}/";
		$name = array_pop($file_segments);
		$file_segments[] = $hash.$name;
		$file_thumb = $folder_thumbs.implode('/', $file_segments);

		$mime = get_mime($file_thumb);
		if ($mime)
		{
			if ($debug)
			{
				echo '<pre>THUMB PHP'; print_r($file_thumb); echo '</pre>'; die();
				return $this->error_406(161);
			}
			header("Content-Type: {$mime}");
			readfile($file_thumb);
			exit;
		}

		$file_folder = pathinfo($file_thumb, PATHINFO_DIRNAME);
		if ( ! $file_folder)
		{
			return $this->error_404(174);
		}
		if ( ! is_dir($file_folder))
		{
			mkdir($file_folder, 0777, true);
		}

		$imagesize    = getimagesize($file_original);
		$width        = $imagesize[0];

		$width_final  = $data[0];
		$height_final = $data[1];

		$size         = 858;
		$ratio        = 1;
		$points_base  = $points;

		if ($width > $size)
		{
			$ratio = $width / $size;
			foreach ($points as $k => $value)
			{
				$points[$k] = round(round($value) * $ratio);
			}
		}

		$this->load->library('image');

		$this->image
		->load($file_original)
		->set_jpeg_quality($this->jpeg_quality)
		->crop($points[0], $points[1], $points[2], $points[3])
		->save($file_thumb, true)
		->clear();

		$this->image
		->load($file_thumb)
		->set_jpeg_quality($this->jpeg_quality)
		->resize($width_final, $height_final)
		->save($file_thumb, true)
		->clear();

		if ($debug)
		{
			echo '<pre>'; print_r($file_thumb); echo '</pre>'; die();
		}

		$mime = get_mime($file_thumb);
		if ($mime)
		{
			header("Content-Type: {$mime}");
			readfile($file_thumb);
			exit;
		}

		$this->error_406(199);

	}

	public function set_cache($seconds_to_cache = 86400)
	{
		$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
		header("Expires: {$ts}");
		header("Pragma: cache");
		header("Cache-Control: max-age={$seconds_to_cache}");
	}

}
