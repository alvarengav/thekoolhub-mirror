<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DataModel extends CI_Model
{
	public
		$notranslate = [],
		$pconfig = false,
		$translations = false,
		$words = [
			'Nombre' => ['es' => 'Nombre', 'en' => 'Name'],
			'Apellido' => ['es' => 'Apellido', 'en' => 'Last Name'],
			'Correo Electronico' => ['es' => 'Correo Electronico', 'en' => 'Email'],
			'Teléfono' => ['es' => 'Teléfono', 'en' => 'Telephone'],
			'Empresa' => ['es' => 'Empresa', 'en' => 'Company'],
			'Comentarios' => ['es' => 'Comentarios', 'en' => 'Comments'],
			'Interesado en' => ['es' => 'Interesado en', 'en' => 'Interested in'],
			'Número de personas' => ['es' => 'Número de personas', 'en' => 'Number of people'],
			'términos y condiciones' => ['es' => 'Términos y condiciones', 'en' => 'Terms and Conditions'],
			'Acepto los' => ['es' => 'Acepto los', 'en' => 'I accept the'],
			'Enviar' => ['es' => 'Enviar', 'en' => 'Send'],
			'Espacios' => ['es' => 'Espacios', 'en' => 'Spaces'],
			'Formación' => ['es' => 'Formación', 'en' => 'School'],
			'En que estas interesado' => ['es' => '¿En qué estás interesado?', 'en' => 'What are you interested in?'],
			'Alquiler de espacios' => ['es' => 'Alquiler de espacios', 'en' => 'Space Leasing'],
			'Servicios B2B' => ['es' => 'Servicios B2B', 'en' => 'B2B Services'],
			'Espacios comunes' => ['es' => 'Espacios comunes', 'en' => 'Common spaces'],
			'Política de privacidad' => ['es' => 'Política de privacidad', 'en' => 'Privacy policy'],
			'Política de cookies' => ['es' => 'Política de cookies', 'en' => 'Cookies policy'],
			'Aviso legal' => ['es' => 'Aviso legal', 'en' => 'Legal notice'],
			'Estoy interesado en' => ['es' => 'Estoy interesado en', 'en' => 'What are you interested in?'],
			'Alquiler de espacio' => ['es' => 'Alquiler de espacio', 'en' => 'Space Leasing'],
			'Nombre' => ['es' => 'Nombre', 'en' => 'First name'],
			'Apellido' => ['es' => 'Apellido', 'en' => 'Lastname'],
			'Introduce tu nombre...' => ['es' => 'Introduce tu nombre...', 'en' => 'Enter your first name'],
			'Introduce tu apellido...' => ['es' => 'Introduce tu apellido...', 'en' => 'Enter your last name'],
			'Gracias por acercarte un poquito más a nuestra comunidad.No te arrepentirás.A partir de ahora,prepárate para disfrutar de contenido interesante y de calidad. Prometemos no ser pesados(nosotros también tenemos siempre llena la bandeja de entrada) y comunicarnos solo si tenemos algo relevante que decir.¡Y por supuesto,también puedes venir a vernos siempre que te apetezca!' =>
			['es' => "Gracias por acercarte un poquito más a nuestra comunidad.No te arrepentirás.A partir de ahora,prepárate para disfrutar de contenido interesante y de calidad. <br/> Prometemos no ser pesados(nosotros también tenemos siempre llena la bandeja de entrada) y comunicarnos solo si tenemos algo relevante que decir.¡Y por supuesto,también puedes venir a vernos siempre que te apetezca!', 
			'en' => 'Thank you for coming a little closer to our community. You won't regret it. From now on, get ready to enjoy interesting and quality content.
			<br/> We promise not to be pushy &#40;we too always have a full inbox&#41; and to communicate only if we have something relevant to say."],
		];

	public function __construct()
	{
		parent::__construct();
		$this->posts_limit = 5;
	}

	public function GetGallery($id = 0)
	{
		$sql = "SELECT f.file
		FROM nz_gallery_file s
		LEFT JOIN nz_file f on f.id_file = s.id_file
		WHERE s.id_gallery = '{$id}'
		ORDER BY s.num";
		return $this->db->query($sql)->result();
	}


	public function ExistNewsletter($mail)
	{
		$this->db->select('t.*');
		$this->db->from('newsletter  t');
		$this->db->where("t.mail", $mail);

		$r = $this->db->get()->row();
		// var_dump($this->db->last_query());die;
		return $r ? 1 : 0;
	}


	public function GetFile($file = '')
	{
		if (!$file) return false;
		$this->dbfiles = '';

		$this->config->load('app');

		$this->dbglobal = $this->config->config["db-global"];

		$r = $this->db->query("select f.*
	  from {$this->dbfiles}nz_file f
	  left join {$this->dbfiles}nz_folder ff on ff.id_folder = f.id_folder
	  WHERE f.id_file = '{$file}'")->row();

		//   left join {$this->dbglobal}file_type t on t.id_type = f.id_type
		return $r;
	}



	public function GetBlog($limit = 3, $page = 1, $category = false)
	{
		if (!$limit) return;

		$this->db->select('t.*');
		$this->db->select('nz.file as file');
		$this->db->join('nz_file nz', 'nz.id_file = t.id_file', 'left');



		if ($category) {
			// $this->db->where("JSON_CONTAINS(t.categories, '$category')");
			$this->db->like('t.categories', "\"$category\"");
		}

		$this->db->where('active', 1);

		$this->db->from('blog t');


		$tempdb = clone $this->db;
		// var_dump($this->db->from('blog t')count_all_results());


		if (is_array($limit)) {
			$this->db->where_in('t.id_blog', $limit);
			$this->db->order_by('t.id_blog', 'FIELD[t.id,' . $join . ']');
			$r = $this->db->get()->result();

			foreach ($r as $i => $v) {

				$r[$i]->link = $this->lang_url('post') . '/' . $v->id_blog . '/' . prep_word_url($v->title);


				// $r[$i]->categories = $v->categories ? json_decode($v->categories) : [];
				$r[$i]->date = date_to_human($v->date);
			}

			return $r;
		} else {
			$this->db->where('lang', $this->data['lang']);

			$start = ($page - 1) * $limit;
			$this->db->limit($limit, $start);
			$this->db->order_by('t.date', 'desc');
			$r = $this->db->get()->result();
		}

		foreach ($r as $i => $v) {
			$r[$i]->link = $this->lang_url('post') . '/' . $v->id_blog . '/' . prep_word_url($v->title);

			// $r[$i]->categories = $v->categories ? json_decode($v->categories) : [];
			$r[$i]->date = date_to_human($v->date);
		}


		$count = $tempdb->get()->num_rows();;

		$result = [
			'data' => $r,
			'current_page' => $page,
			'count_all' => $count,
			'next_page' => ($count > $page * $limit) ? $page + 1 : false,
		];

		return (object)$result;
	}

	public function GetBlogPost($id)
	{
		$this->db->select('t.*');
		$this->db->select('nz.file as file');
		$this->db->join('nz_file nz', 'nz.id_file = t.id_file', 'left');

		$this->db->select('nz3.file as interior_file');
		$this->db->join('nz_file nz3', 'nz3.id_file = t.id_interior_file', 'left');

		$this->db->select('nz2.file as author_file');
		$this->db->select('ba.name as author_name, ba.link as author_link');
		$this->db->join('blog_author ba', 'ba.id_author = t.id_author', 'left');
		$this->db->join('nz_file nz2', 'nz2.id_file = ba.id_file', 'left');

		$this->db->where('lang', $this->data['lang']);
		$this->db->where('id_blog', $id);
		$this->db->from('blog t');
		$r = $this->db->get()->row();

		if (!$r) return false;

		$r->link = $this->lang_url('post') . '/' . $r->id_blog . '/' . prep_word_url($r->title);

		$categories = [];
		if ($r->categories && json_decode($r->categories)) {

			foreach (json_decode($r->categories) as $c) {
				$categories[] = $this->GetBlogCategory($c->category);
			}
		}
		$r->categories = $categories;

		$r->date = date_to_human($r->date);


		$related = [];
		if ($r->related && json_decode($r->related)) {
			foreach (json_decode($r->related) as $c) {
				$related[] = $c->related;
			}
		}
		$r->related = $this->GetBlog($related);

		return $r;
	}

	public function GetEvent()
	{
		$this->db->select('t.*');
		$this->db->select('nz.file as file');
		$this->db->select('nz2.file as file_down');
		$this->db->select('nz2.name as file_name_down');
		$this->db->join('nz_file nz', 'nz.id_file = t.id_file', 'left');
		$this->db->join('nz_file nz2', 'nz.id_file = t.id_file_down', 'left');
		$this->db->where('lang', $this->data['lang']);
		$this->db->where('active', 1);
		$this->db->from('events t');
		$this->db->order_by('id_post', 'DESC');
		$r = $this->db->get()->result_array();

		if (!$r) return false;


		return $r;
	}
	public function GetMember($id)
	{
		$this->db->select('t.*');
		$this->db->select('nz.file as file');
		$this->db->join('nz_file nz', 'nz.id_file = t.id_file', 'left');
		$this->db->where('lang', $this->data['lang']);
		$this->db->where('id_post', $id);
		$this->db->from('members t');
		$r = $this->db->get()->row();

		if (!$r) return false;


		return $r;
	}
	public function GetBlogCategories()
	{
		$sql = "SELECT
		b.id_category AS id,
		b.title
		FROM blog_category b
		WHERE b.active = '1' 
		AND b.lang = '{$this->data['lang']}'
		ORDER BY b.num, b.title";
		$result = $this->db->query($sql)->result();
		// $categories = [];
		foreach ($result as $category) {
			$category->slug = prep_word_url($category->title);
			// $category->link = $this->lang_url().'/news?'.$category->id.'/'. $category->slug;
			$category->link = $this->lang_url('news') . '/?c=' . $category->id . '&' . $category->slug;
			// $categories[$category->slug] = $category;
		}
		// return $categories;
		return $result;
	}
	public function GetBlogCategory($id)
	{
		$sql = "SELECT
		b.id_category AS id,
		b.title
		FROM blog_category b
		WHERE b.id_category = {$id}
		ORDER BY b.num, b.title";
		$category = $this->db->query($sql)->row();

		$category->slug = prep_word_url($category->title);
		$category->link = $this->lang_url('news') . '/?c=' . $category->id . '/' . $category->slug;
		// $categories = [];
		// foreach ($result as $category)
		// {
		// 	$category->slug = prep_word_url($category->title);
		// 	$category->link = $this->lang_url().$category->id.'/'. $category->slug;
		// 	// $categories[$category->slug] = $category;
		// }
		// return $categories;
		return $category;
	}

	public function GetTeam()
	{
		// $start = ($page - 1) * $limit;

		$this->db->select('t.*');
		$this->db->select('nz.file as file');
		$this->db->join('nz_file nz', 'nz.id_file = t.id_file', 'left');
		$this->db->where('lang', $this->data['lang']);
		$this->db->where('active', 1);
		$this->db->from('team t');
		$r = $this->db->get()->result();

		// foreach($r as $i => $v) {
		// 	$r[$i]->link = base_url( 'post/'.$v->id_post.'/'.prep_word_url($v->title) );
		// }

		return $r;
	}
	public function GetServices($limit = 4, $page = 1)
	{

		$this->db->select('t.*');
		$this->db->select('nz.file as file');
		$this->db->join('nz_file nz', 'nz.id_file = t.id_file', 'left');
		$this->db->where('active', 1);
		$this->db->where('lang', $this->data['lang']);
		$this->db->order_by('num');
		$start = ($page - 1) * $limit;
		$this->db->limit($limit, $start);
		$this->db->from('services t');
		$r = $this->db->get()->result();
		return $r;
	}
	public function GetInfoPages()
	{

		$this->db->select('t.*');
		$this->db->where('lang', $this->data['lang']);
		$this->db->where('active', 1);
		$this->db->order_by('num');

		$this->db->from('info_pages t');
		$r = $this->db->get()->result();

		foreach ($r as $i => $v) {
			$r[$i]->link = base_url($this->data['lang'] . '/info/' . $v->id_post . '/' . prep_word_url($v->title));
		}

		return $r;
	}
	public function GetInfoPage($id_post = false)
	{
		if (!$id_post) return false;

		$this->db->select('t.*');
		$this->db->where('active', 1);
		$this->db->where('id_post', $id_post);
		$this->db->order_by('num');

		$this->db->from('info_pages t');
		$r = $this->db->get()->row();

		if (!$r) return false;

		$r->link = base_url($this->data['lang'] . '/info/' . $r->id_post . '/' . prep_word_url($r->title));


		return $r;
	}
	public function GetIcon($id = 0)
	{
		$sql = "SELECT 
			t.*,
			f1.file as img
		FROM home_icon t
		LEFT JOIN nz_file f1 on t.id_file = f1.id_file
		where id_icon = $id";

		$r = $this->db->query($sql)->row();

		return $r;
	}




	public function GetInfo($var, $lang = false)
	{
		$lvar = !$lang ? $var . '_' . $this->data['lang'] : $var . '_' . $lang;
		$r = $this->db->query("SELECT data FROM info WHERE var = '$lvar'")->row();

		if (!$r && $this->data['default_lang'] != $this->data['lang']) {
			$lvar = $var . '_' . $this->data['default_lang'];
			$r = $this->db->query("SELECT data FROM info WHERE var = '$lvar'")->row();
		}

		$data = $r ? (is_json($r->data) ? json_decode($r->data) : $r->data) : 0;

		$lang = $this->data['lang'] == 'es' ? '_es' : '_es';

		if ($data) {
			foreach ($data as $key => $v) {
				if (substr($key, 0, 7) === "id_file") {
					if ((int) $v > 0) {
						$st = "{$key}";
						$data->$st = $this->GetFile((int) $v);
					}
				}
				// }
				// foreach($data as $key => $v) {
				if (substr($key, 0, 10) === "id_gallery") {
					if ((int) $v > 0) {
						$st = "{$key}";
						$data->$st = $this->GetGallery((int) $v);
					}
				}

				$countl = strlen($lang);
				if (substr($key, -(int) $countl) === $lang) {
					$nkey = substr($key, 0, -$countl);
					$data->$nkey = $v;
				}
			}
		}

		return $data;
	}

	public function SetInfo($var, $data)
	{
		$data = json_encode($data);

		$info = $this->GetInfo($var);

		if ($info != false) {
			return $this->db->update('info', ['data' => $data], ['var' => $var]);
		} else {
			return $this->db->insert('info', ['data' => $data, 'var' => $var]);
		}
	}

	public function Content($var = false, $data = false)
	{
		$content = $this->GetContent($var);

		$str = $content ? $content->data : 'Ingresar texto';

		if ($this->data['admin']) {
			return '<div style="display:inline-block" data-var="' . $var . '" class="editor" data-lang="' . $this->data['lang'] . '">' . $str . '</div>';
		} else {
			return $str;
		}
	}
	public function GetContent($var = false, $lang = false)
	{

		$lvar = $var . '_' . $this->data['lang'];

		$r = $this->db->query("SELECT data FROM contents WHERE var = '$lvar'")->row();

		// var_dump($lvar);

		if (!$r && $this->data['default_lang'] != $this->data['lang'] && !$lang) {
			$lvar = $var . '_' . $this->data['default_lang'];
			$r = $this->db->query("SELECT data FROM contents WHERE var = '$lvar'")->row();
		}

		$data = $r ? $r : false;

		return $data;
	}
	public function SetContent($var = false, $data = false)
	{

		$content = $this->GetContent($var, $this->data['lang']);
		$var = $var . '_' . $this->data['lang'];


		if ($content != false) {

			return $this->db->update('contents', ['data' => $data], ['var' => $var]);
		} else {
			return $this->db->insert('contents', ['data' => $data, 'var' => $var]);
		}
	}

	public function lang($str = '')
	{
		if (!$this->translations) return;
		// if (!$this->translations) {
		$this->notranslate[] = $str;

		// 	return $str;
		// }

		$trans = $this->translations->data;

		foreach ($trans as $t) {
			if ($t->original == $str)
				$str = $t->replace;
		}

		return $str;
	}

	public function translate($str = "", $lang = "es")
	{
		$words = $this->words;
		$result = "";

		if (empty($words) || $str == "") return;

		foreach ($words as $key => $value) {
			if ($key == $str)
				$result = $value[$lang];
		}
		return $result;
	}

	public function lang_url($str = '')
	{
		if ($this->data['lang'] == 'es') {
			$key = array_search($str, $this->data['routes']);

			$str = $this->data['routes_es'][$key];
		}
		return base_url() . $this->data['lang'] . '/' . $str;
	}


	public function Instagram()
	{
		$curl = curl_init();
		// set our url with curl_setopt()
		curl_setopt($curl, CURLOPT_URL, "https://demo1.beonshop.com/instagram_kool/");

		// return the transfer as a string, also with setopt()
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);

		// close curl resource to free up system resources
		// (deletes the variable made by curl_init)
		curl_close($curl);

		return json_decode($output);

		// $sql = "select p.*, f.file
		// from instagram p 
		// left join nz_file f on f.id_file = p.id_file
		// where 1 
		// order by p.id_instagram desc
		// LIMIT 0, 16";
		// return $this->db->query($sql)->result();
	}



	// public function getFacebookShares($url)
	// {
	// 	$access_token = '1018659578498370|07976b0179096a1683e49dbcb53ef030';
	// 	$api_url = 'https://graph.facebook.com/v3.0/?id=' . urlencode( $url ) . '&fields=engagement&access_token=' . $access_token;
	// 	$fb_connect = curl_init(); // initializing
	// 	curl_setopt( $fb_connect, CURLOPT_URL, $api_url );
	// 	curl_setopt( $fb_connect, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	// 	curl_setopt( $fb_connect, CURLOPT_TIMEOUT, 20 );
	// 	$json_return = curl_exec( $fb_connect ); // connect and get json data
	// 	curl_close( $fb_connect ); // close connection
	// 	$body = json_decode( $json_return );

	// 	return $body ? intval( $body->engagement->share_count ) : 0;
	// }

	// public function getTwitterShares($url)
	// {
	// 	$access_token = '1018659578498370|07976b0179096a1683e49dbcb53ef030';
	// 	$api_url = 'https://graph.facebook.com/v3.0/?id=' . urlencode( $url ) . '&fields=engagement&access_token=' . $access_token;
	// 	$fb_connect = curl_init(); // initializing
	// 	curl_setopt( $fb_connect, CURLOPT_URL, $api_url );
	// 	curl_setopt( $fb_connect, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	// 	curl_setopt( $fb_connect, CURLOPT_TIMEOUT, 20 );
	// 	$json_return = curl_exec( $fb_connect ); // connect and get json data
	// 	curl_close( $fb_connect ); // close connection
	// 	$body = json_decode( $json_return );

	// 	return $body ? intval( $body->engagement->share_count ) : 0;
	// }
}