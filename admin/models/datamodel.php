<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataModel extends CI_Model
{
 
  public function getMonthString($number = 0)
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

  public function GetFile( $file = '' )
  {
    if(!$file) return false;
    $this->dbfiles = '';
    $this->dbglobal = $this->config->config['app']['db-global'];
    $r = $this->db->query("select f.*, t.type
    from {$this->dbfiles}nz_file f
    left join {$this->dbglobal}file_type t on t.id_type = f.id_type
    left join {$this->dbfiles}nz_folder ff on ff.id_folder = f.id_folder
    WHERE f.id_file = '{$file}'")->row();

    return $r;
  }

  public function SelectTags( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_tag as id, tag as el 
    	FROM blog_tag $where order by num, tag"), $all);
  }

  public function SelectHomeIcon( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_icon as id, text_es as el 
    	FROM home_icon $where order by num, text_es"), $all);
  }

  public function SelectBlog( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_blog as id, 
    	CONCAT(DATE_FORMAT(date, '%M %D, %Y'), ' - ', IF(active, title, CONCAT(title,' (inactive)'))) as el 
    	FROM blog $where order by date desc, el"), $all);
  }

  public function GetDataPost($id = 0)
  {
    return $this->db->query("SELECT id_post as id, 
  	CONCAT(DATE_FORMAT(date, '%M %D, %Y'), ' - ', IF(active, title, CONCAT(title,' (inactive)'))) as el 
  	FROM blog_post where id_post = '{$id}'")->row_array();
  }

  public function SelectBlogCategory( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'AND '. $where;

    return create_select_options($this->db->query("SELECT id_category as id, title as el
    	FROM blog_category WHERE lang = '{$this->custom_lang}' $where order by num, el"), $all);
  }

  public function ResultBlogCategory()
  {
  	$sql = "SELECT id_category as id, category, color
  	FROM blog_category
  	ORDER BY num, category";
    return $this->db->query($sql)->result();
  }


  public function SelectHomes( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_home as id, name as el FROM home $where order by el"), $all);
  }

  public function SelectCellars( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_cellar as id, name as el FROM cellars $where order by el"), $all);
  }

  public function SelectWines( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_wine as id, name as el FROM wines $where order by el"), $all);
  }
  public function SelectActivities( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_activity as id, title as el FROM activities $where order by el"), $all);
  }

  public function SelectUser( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_user as id, mail as el FROM user $where order by el"), $all);
  }

  public function SelectAuthor( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_author as id, name as el FROM blog_author $where order by el"), $all);
  }
  public function SelectBlogPost( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'AND '. $where;
    return create_select_options($this->db->query("SELECT id_post as id, title as el FROM blog_post WHERE lang = '{$this->custom_lang}' $where order by el"), $all);
  }
  public function SelectEvents( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'AND '. $where;
    return create_select_options($this->db->query("SELECT id_post as id, title as el FROM events WHERE lang = '{$this->custom_lang}' $where order by el"), $all);
  }
  public function SelectMembers( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'AND '. $where;
    return create_select_options($this->db->query("SELECT id_post as id, title as el FROM members WHERE lang = '{$this->custom_lang}' $where order by el"), $all);
  }

  public function SelectProject( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_project as id, title as el FROM project $where order by el"), $all);
  }
  public function SelectInfo( $where = '', $all = '' )
  {
    if( $where ) 
      $where = 'AND '. $where;
    return create_select_options($this->db->query("SELECT id_post as id, title as el FROM info_pages WHERE lang = '{$this->custom_lang}' $where order by el"), $all);
  }

  
	public function WebLinks()
	{
		$array = [
      '' => 'Home',
      'about' => 'About',
      'spaces' => 'Espacios',
      // 'info' => '',
      'skool' => 'Skool',
      'community' => 'Comunidad',
      'news' => 'Blog',
      'contact' => 'Contacto',
      // 'post' => '',
      'events' => 'Eventos',
    ];

    sort($array);

		return $array;	
	}
}