<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends APP_Controller
{

	public

		$routes = array(
			'404'           =>  array('section' => '404', 'theme' => 'default'),
			'home'          =>  array('section' => 'home', 'theme' => 'default', 'pager' => '/'),
			'example'       =>  array('section' => 'example', 'theme' => 'default', 'pager' => 'example'),
			'skool'       =>  array('section' => 'skool', 'theme' => 'default', 'pager' => 'skool'),
		);

	public function __construct()
	{
		$this->data['lang'] = 'es';
		$this->data['default_lang'] = 'es';
		$this->data['admin'] = false;
		// $this->data['admin'] = true;

		parent::__construct();
	}

	public function lang()
	{
		$this->data['lang'] = $this->uri->segments[1];
		$this->config->set_item('lang', $this->data['lang']);


		return $this->index(isset($this->uri->segments[2]) && $this->uri->segments[2] ? $this->uri->segments[2] : 'home');
	}

	public function changelang($lang)
	{
		$routes = [
			['es' => '', 'en' => ''],
			['es' => 'nosotros', 'en' => 'about'],
			['es' => 'espacios', 'en' => 'spaces'],
			['es' => 'informacion', 'en' => 'about'],
			['es' => 'comunidad', 'en' => 'community'],
		];
		$currentUrl = $_SESSION['CurrentUrl'];
		//$currentUrl = 'http://kool.test/en/spaces';
		$currentUrlParts = explode('/', $currentUrl);
		//$route = $route[2]['es'];
		if ($lang === 'es') {
			$route = array_search($currentUrlParts[4], array_column($routes, 'en'));
			$currentUrlParts[3] = 'es';
			$currentUrlParts[4] = $routes[$route]['es'];
			$newUrl = implode('/', $currentUrlParts);
		} else {
			$route = array_search($currentUrlParts[4], array_column($routes, 'es'));
			$currentUrlParts[3] = 'en';
			$currentUrlParts[4] = $routes[$route]['en'];
			$newUrl = implode('/', $currentUrlParts);
		}
		// if ($currentUrl )
		redirect($newUrl);
	}


	public function index($route = 'home')
	{
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$_SESSION["CurrentUrl"] = $actual_link;

		$route = 'home';
		error_reporting(E_ALL & ~E_NOTICE);

		// is admin
		$secretToken = md5('prev-kool');
		if ($this->uri->segment(2, false) == $secretToken) {

			$this->session->set_userdata('is_admin', 1);

			redirect(base_url($this->uri->segment(2, false)));
		}

		if ($this->session->userdata('is_admin')) {
			$this->data['admin'] = true;
		}
		// 


		if (!isset($this->routes[$route]))
			return $this->error404();

		$page = $route;
		$data_section = $this->routes[$route];

		$this->load->helper('date');

		$this->data['section'] 		= $data_section['section'];
		$this->data['main_view'] 	= "section/{$page}";


		$this->data['config'] = $this->Data->GetInfo('cogs', 'es');
		$ulang = $this->uri->segment(1, false);


		if (!(isset($this->data['config']->header_langs)) || !$this->data['config']->header_langs) {
			print('Activar un lenguaje');
			return;
		}

		$this->data['languages'] = [];
		foreach ($this->data['config']->header_langs as $ll) {
			$this->data['languages'][$ll->lang] = $ll->text;
		}

		$langs = array_keys($this->data['languages']);
		$default_lang = $langs[0];
		if (!in_array($ulang, $langs)) $ulang = false;

		if (!$ulang) {
			$clang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

			if (in_array($clang, $langs)) {
				redirect(base_url($clang));
			} else {
				redirect(base_url($default_lang));
			}
		}

		$slang = $this->session->userdata('slang');
		if (!$slang || $slang != $ulang) {
			$this->session->set_userdata('slang', $ulang);
		}
		$lang = $this->session->userdata('slang');

		$this->data['lang'] = $lang;


		$routes = ['', 'about', 'spaces', 'info', 'skool', 'community', 'news', 'contact', 'post', 'events', 'london', 'showroom'];
		$routes_es = ['', 'nosotros', 'espacios', 'informacion', 'skool', 'comunidad', 'noticias', 'contacto', 'articulo', 'eventos', 'london', 'showroom'];

		$this->data['routes'] = $routes;
		$this->data['routes_es'] = $routes_es;

		$ur = $this->uri->segment(2, false);

		if ($lang == 'es') {
			$key = array_search($ur, $routes_es);

			$ur = $routes[$key];
		}

		$this->data['page'] 			= $ur;

		if (in_array($ur, $routes)) {
			$this->data['main_view'] = "section/{$ur}";

			if ($ur == '') {
				$this->data['animation'] = true;
				$this->data['main_view'] = "section/home";
				$this->data['page'] 			= 'home';

				$section_seo = $this->Data->GetInfo('seo_home');

				$this->data['headers']['head-title'] = $section_seo->seo_title;
				$this->data['headers']['title'] = $section_seo->seo_title;
				$this->data['headers']['description'] = $section_seo->seo_description;

				$this->data['show_seo_settings'] = true;
			} else {
				$section_seo = $this->Data->GetInfo('seo_' . $ur);
				$home_seo = $this->Data->GetInfo('seo_home');

				$this->data['headers']['head-title'] = $section_seo->seo_title ? $section_seo->seo_title : $home_seo->seo_title;
				$this->data['headers']['title'] = $section_seo->seo_title ? $section_seo->seo_title : $home_seo->seo_title;
				$this->data['headers']['description'] = $section_seo->seo_description ? $section_seo->seo_description : $home_seo->seo_description;
				$this->data['show_seo_settings'] = true;
			}

			if ($ur == 'post') {
				$this->data['show_seo_settings'] = false;
				$this->data['post'] = $this->Data->GetBlogPost($this->uri->segment(3, false));

				if (!$this->data['post'])
					redirect(base_url($ulang));


				$this->data['headers']['head-title'] = $this->data['post']->title;
				$this->data['headers']['title'] = $this->data['post']->title;
				$this->data['headers']['share-image'] = upload($this->data['post']->file);

				$this->data['headers']['description'] = '';
			}

			if ($ur == 'london') {
				$this->data['show_seo_settings'] = true;
				$this->data['headers']['head-title'] = "Kool London";
				$this->data['headers']['title'] = "Kool London";
				$this->data['headers']['share-image'] = "https://thekoolhub.com/files/2020/07/copia-de-dsc05970-1.jpg";
			}

			if ($ur == 'showroom') {
				$this->data['show_seo_settings'] = true;
				$this->data['headers']['head-title'] = "Kool High";
				$this->data['headers']['title'] = "Kool High";
				$this->data['headers']['share-image'] = "https://thekoolhub.com/files/2020/07/copia-de-dsc05970-1.jpg";
			}
		}


		// if(  )
		// $this->data['headers']['head-title'] = $this->data['home']->seo_title;
		// $this->data['headers']['title'] = $this->data['home']->seo_title;
		// $this->data['headers']['description'] = $this->data['home']->seo_description;



		$this->data['lang'] 	= $lang;
		$this->data['language'] 	= $this->data['languages'][$this->data['lang']];
		$this->Data->translations 	= $this->Data->GetInfo('translations');


		$this->data['is_robot'] = false;

		$this->data['header'] = true;
		$this->data['html'] = true;
		$this->data['footer'] = true;



		$this->load->view('base', $this->data);

		// echo '<!--';
		// print_r($this->Data->notranslate);
		// echo '-->';
	}

	public function error404()
	{
		return $this->index('404');
	}


	public function ajax_subscribe()
	{

		$email = $this->input->post('EMAIL');
		$fname = $this->input->post('FNAME');

		//si el email no tiene el formato correcto, se devuelve un error 422
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($fname)){
			header('HTTP/1.1 422 Unprocessable Entity');
			// header('Content-Type: application/json');
			echo json_encode(array(
				'error_message' => 'empty or invalid email, or empty FNAME',
			));
			return;
		}

		if ($this->input->post()) {
			$user = array(
				'active' => 1,
				'created' => date('Y-m-d H:i:s'),
				'mail' => $this->input->post('EMAIL'),
				'name' => $this->input->post('FNAME'),
				'lastname' => $this->input->post('LNAME') ? $this->input->post('LNAME') : NULL, //is empty set null
				'bussines' => $this->input->post('MMERGE5') ? 'Si' : 'No',
				'lang' => $this->input->post('lang') ? $this->input->post('lang') : NULL,
				'phone' => $this->input->post('MMERGE3') ? $this->input->post('MMERGE3') : NULL,
				'form' => $this->input->post('form')
			);

			$r = $this->db->insert('newsletter', $user);

			echo json_encode(array('error' => 0, 'callback' => 'success-subscribe'));
		}
	}

	public function custom_newsletter()
	{
		$config = $this->Data->GetInfo('cogs');

		if (
			isset($config->mailchimp_list)
			&& $config->mailchimp_list
			&& isset($config->mailchimp_key)
			&& $config->mailchimp_key
		) {
			$email = $this->input->post('mail');
			$list_id = $config->mailchimp_list;
			$api_key = $config->mailchimp_key;


			$data_center = substr($api_key, strpos($api_key, '-') + 1);

			var_dump($data_center);
			die($list_id);

			$url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';

			$json = json_encode([
				'email_address' => $email,
				'name' => $this->input->post('name'),
				'bussines' => $this->input->post('bussines'),
				'status'        => 'subscribed', //pass 'subscribed' or 'pending'
			]);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			$result = curl_exec($ch);
			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);


			$this->MJ->SendNewsletter([
				'name' => $this->input->post('name') . " " . $this->input->post('lastname'),
				'view' => 'newsletter',
				'subject' => 'Newsletter',
				'title' => 'Newsletter',
				'reply' => $this->input->post('mail'),
				'number_persons' => "",
				'interested' => "",
			]);
		}
	}

	public function contact()
	{
		if ($post = $this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Nombre', 'trim|required');
			//$this->form_validation->set_rules('lastname', 'Nombre', 'trim|required');
			$this->form_validation->set_rules('mail', 'Mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('message', 'Mensaje', 'trim|required');
			$this->form_validation->set_rules('check', 'Aceptar términos', 'required');
			// $this->form_validation->set_rules('interested', 'Aceptar términos', 'required');
			// if(!$this->usection()) $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
			if ($this->form_validation->run() == FALSE) {
				$data['error'] = 1;
				$data['inputErrors'] = array_keys($this->form_validation->error_array());
				echo json_encode($data);
			} else {
				$config 	= $this->Data->GetInfo('cogs', 'es');
				$this->data['config'] = $config;

				$this->data['languages'] = [];
				foreach ($this->data['config']->header_langs as $ll) {
					$this->data['languages'][$ll->lang] = $ll->text;
				}

				$this->data['lang'] 	= $this->input->post('lang') == 'ENG' ? 'en' : 'es';
				$this->data['language'] 	= $this->data['languages'][$this->data['lang']];
				$this->Data->translations 	= $this->Data->GetInfo('translations');

				$this->load->model('Mailmodel', 'MJ');

				$recipients = [];
				foreach ($config->mails as $m) {
					$recipients[] = $m;
				}

				$interested = is_array($this->input->post('interested')) ? implode(', ', $this->input->post('interested')) : 'No específica';
				$number_persons = $this->input->post('number_persons') ? $this->input->post('number_persons') : 'No específica';

				$this->MJ->PrepareMail('toteam', $recipients, [
					'subject' => 'Contacto web',
					'title' => 'Contacto web',
					'reply' => $this->input->post('mail'),
					'number_persons' => $number_persons,
					'interested' => $interested,
					//   'message'=> '
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Enviado desde: </b> '.base_url().' </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Nombre:</b> '.$this->input->post('name').' </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Apellido:</b> '.$this->input->post('lastname').' </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Mail:</b> '.$this->input->post('mail').' </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Intereses:</b> '.$interested.' </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Numero de personas:</b> '.$number_persons.' </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"><b>Comentarios:</b> </p>
					// 	  <p style="font-family: Arial,Helvetica,sans-serif;"> '.$this->input->post('message').' </p>
					// 	  ',
				]);
				// ALTER TABLE `contact` ADD `interested` VARCHAR(255) NULL AFTER `text`, ADD `number_persons` VARCHAR(255) NULL AFTER `interested`;
				// ALTER TABLE `contact` ADD `created` DATETIME NULL AFTER `number_persons`;
				// ALTER TABLE `newsletter` ADD `lastname` VARCHAR(255) NULL AFTER `lang`;
				// ALTER TABLE `contact` ADD `lang` VARCHAR(255) NULL AFTER `created`;


				$this->MJ->PrepareMail('touser', [$this->input->post('mail')], [
					'subject' => $this->Data->lang('Contacto web'),
					'title' => $this->Data->lang('Contacto web'),
					'reply' => $recipients[0]->mail,
					'reply' => $recipients[0]->mail,
					'number_persons' => $number_persons,
					'interested' => $interested,
					//   'message'=> '
					// 	  <p><h2 style="font-family: Arial,Helvetica,sans-serif; font-size: 1.1rem; ">' .$this->Data->lang('Gracias por enviarnos tu solicitud, procedimiento en breve nos pondremos en contacto contigo.'). '</h2> <br> </p>
					// 	  <p  style="font-family: Arial,Helvetica,sans-serif;"><b>' .$this->Data->lang('Su consulta es'). ':</b> </p>
					// 	  <p  style="font-family: Arial,Helvetica,sans-serif;"> '.$this->input->post('message').' </p>
					//   ',
				]);

				$this->db->insert('contact', [
					'first_name' => $this->input->post('name'),
					'last_name' => $this->input->post('lastname'),
					'mail' => $this->input->post('mail'),
					'interested' => $interested,
					'number_persons' => $number_persons,
					'lang' => $this->input->post('lang'),
					'created' => date('Y-m-d H:i:s'),
					//   'phone'=>$this->input->post('phone'),
					'text' => $this->input->post('message'),
				]);

				if ($this->input->post('send_news') && !$this->Data->ExistNewsletter($this->input->post('mail'))) {
					$user = array(
						'active' => 1,
						'created' => date('Y-m-d H:i:s'),
						'mail' => $this->input->post('mail'),
						'name' => $this->input->post('name'),
						'lastname' => $this->input->post('lastname'),
						'lang' => $this->input->post('lang'),
						'bussines' => 'Si',
					);

					$r = $this->db->insert('newsletter', $user);
				}

				echo json_encode(array('error' => 0, 'callback' => 'submit-contact-form'));
			}
		}
	}

	public function instagramApi($page = false)
	{
		if (!$page) return;
		require APPPATH . '/third_party/vendor/autoload.php';

		$cache = new Instagram\Storage\CacheManager(__DIR__ . '/cache/');
		$guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));

		$api   = new Instagram\Api($cache);
		$api->setUserName($page);

		// $feed = $api->getFeed();

		try {
			$feed = $api->getFeed();

			header('Content-Type: application/json');
			echo json_encode($feed->getMedias());
		} catch (Exception $exception) {
			print_r($exception->getMessage());
		} catch (\GuzzleHttp\Exception\GuzzleException $e) {
			print_r($exception->getMessage());
		}
	}

	public function liveadmin($action = false)
	{
		$this->data['lang'] = $this->input->post('lang');

		if ($this->session->userdata('is_admin')) {
			if ($action == 'update') {
				$this->Data->SetContent($this->input->post('var'), $this->input->post('str'));

				var_dump($this->db->last_query());
			}
		}
	}
	public function info($id_post = false)
	{
		$info = $this->Data->GetInfoPage($id_post);

		$this->load->view('components/modal-info/text', ['info' => $info]);
	}
	public function logout()
	{
		$this->session->unset_userdata('is_admin');
		redirect(base_url());
	}
	public function nocookie()
	{
		$this->session->set_userdata('nocookie', 1);

		print_r('nocookie');

		return;
	}
}
