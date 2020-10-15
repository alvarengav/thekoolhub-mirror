<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataGModel extends AppModel {

	public function __construct()
	{  	 
		parent::__construct();
		$this->LoadBasicData();
	}

	public function LoadBasicData()
	{
		$this->dbglobal = $this->MApp->dbglobal;

		$this->langs = $this->config->item('langs', 'app');
		$this->flang = $this->langs[0];

		$this->langs_admin  = $this->config->item('langs-admin', 'app');
		$this->lang_admin 	= $this->config->item('lang-admin', 'app') ?: $this->langs_admin[0] ?? 'es';

		$this->lang_locale  = $this->flang;
		$this->lang_prefix  = '->>"$.'.$this->flang.'"';
		$this->langl 				= '_lang';
		$this->lang_ 				= $this->langl.$this->lang_prefix;
		$this->lang_as 			= $this->lang_.' AS ';
	}

	public function get_lang()
	{
		if ($this->flang !== FALSE)
		{
			return $this->flang;
		}
		return 'es';
	}

	public function get_lang_initial()
	{
		if ($this->flang !== FALSE)
		{
			return $this->flang;
		}
		return 'es';
	}

	public function json_field($table = '', $field = '', $as_field = FALSE)
	{
		$as_field  = ($as_field === FALSE) ? $field : $as_field;
		$alt_field = '';
		$initial 	 = $this->get_lang_initial();
		$active 	 = $this->get_lang();
		$sql = "IF(COALESCE({$table}.{$field}_lang, '') = '', 
		{$table}.{$field}, 
		COALESCE({$table}.{$field}{$this->lang_}, {$table}.{$field})
		)";
		if ($this->get_lang_initial() != $this->get_lang())
		{		
			$sql = "IF({$sql} != '', {$sql}, COALESCE({$table}.{$field}_lang{$initial->prefix}, ''))";
		}
		$sql .= " AS {$as_field}";
		return $sql;
	}


  public function SelectMenu( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_menu as id, name as el FROM nz_menu $where order by num, el"), $all, true);
  }

  public function GetMonth($month = 1)
  {
    $months = $this->GetMonthsArray();
    return isset($months[round($month)]) ? $months[round($month)] : '';
  }

  public function GetMonthsArray()
  {
    return array(1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
  }

  public function GetMenuIco( $controller = '' )
  {
    $ico = "deficons-black-big deficons-1";
    if(!$controller) return $ico;
    $sql = "select mi.class as ico
    from nz_menu m
    left join {$this->dbglobal}ico mi on mi.id_ico = m.id_ico
    where m.controller = '{$controller}'";
    $row = $this->db->query($sql)->row();
    if(!$row || !$row->ico) return $ico;
    return $row->ico;
  }

  public function DataProject( $id = 0 )
  {
    $sql = "SELECT t.id_project as id, t.*,
    lj0.client as client, lj1.file as picture
    FROM {$this->dbglobal}project as t
    LEFT JOIN {$this->dbglobal}client lj0 on t.id_client = lj0.id_client
    LEFT JOIN {$this->dbglobal}nz_file lj1 on t.id_file = lj1.id_file
    WHERE t.id_project = '{$id}'
    LIMIT 0, 1";
    return $this->db->query($sql)->row();
  }

  public function SelectCompanyType( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_type as id, type as el FROM {$this->dbglobal}company_type $where order by el"), $all, true);
  }

  public function SelectUserType( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_type as id, type as el FROM {$this->dbglobal}user_type $where order by num"), $all, true);
  }

  public function SelectCompanyProyect( $all = '' )
  {
    if(!$this->MApp->project)
    {
      return create_select_options($this->db->query("SELECT id_company as id, company as el FROM {$this->dbglobal}company where id_type = '1' and active = '1' order by el"), $all, true);
    }
    $options = create_select_options($this->db->query("SELECT c.id_company as id, c.company as el
    FROM {$this->dbglobal}project_company cc
    left join {$this->dbglobal}company c on c.id_company = cc.id_company and cc.id_project = '{$this->MApp->project}'
    where c.active = '1'
    order by cc.num"), $all, true);
    if(count($options)) return $options;
    return create_select_options($this->db->query("SELECT id_company as id, company as el FROM {$this->dbglobal}company where id_type = '1' and active = '1' order by el"), $all, true);
  }

  public function SelectCompany( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_company as id, company as el FROM {$this->dbglobal}company $where order by el"), $all, true);
  }

  public function SelectIco( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_ico as id, ico as el FROM {$this->dbglobal}ico $where order by el"), $all, true);
  }

  public function SelectUser( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_user as id, name as el FROM {$this->dbglobal}user $where order by el"), $all, true);
  }

  public function SelectUserTicket( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT u.id_user as id, CONCAT(c.company, ' - ', u.name, ' ', u.lastname) as el
    FROM {$this->dbglobal}user u
    left join {$this->dbglobal}company c on c.id_company = u.id_company
    $where order by el"), $all, true);
  }

  public function SelectTicketCategory( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_category as id, category as el FROM {$this->dbglobal}ticket_category $where order by num, el"), $all, true);
  }

  public function SelectTicketReproducibility( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_reproducibility as id, reproducibility as el FROM {$this->dbglobal}ticket_reproducibility $where order by num"), $all, true);
  }

  public function SelectTicketSeverity( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_severity as id, severity as el FROM {$this->dbglobal}ticket_severity $where order by num"), $all, true);
  }

  public function SelectTicketPriority( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_priority as id, priority as el FROM {$this->dbglobal}ticket_priority $where order by num"), $all, true);
  }

  public function SelectTicketState( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_state as id, state as el FROM {$this->dbglobal}ticket_state $where order by num"), $all, true);
  }

  public function SelectTicketResolution( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_resolution as id, resolution as el FROM {$this->dbglobal}ticket_resolution $where order by num"), $all, true);
  }

  public function SelectTicketVisibility( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_visibility as id, visibility as el FROM {$this->dbglobal}ticket_visibility $where order by num"), $all, true);
  }

  public function SelectClient( $where = '', $all = '' )
  {
    if( $where )
      $where = 'where '. $where;
    return create_select_options($this->db->query("SELECT id_client as id, client as el FROM {$this->dbglobal}client $where order by el"), $all, true);
  }

  public function SelectProjectTickets( $all = '' )
  {
    return create_select_options($this->db->query("SELECT p.id_project as id,
    CONCAT(c.client, ' - ', p.project) as el
    FROM {$this->dbglobal}project p
    left join {$this->dbglobal}client c on c.id_client = p.id_client
    left join {$this->dbglobal}project_company s on s.id_project = p.id_project
    where (s.id_company = '{$this->MApp->user->company}' OR p.id_project = '{$this->MApp->project}') AND (p.finish = '0' OR p.id_project = '{$this->MApp->project}')
    order by el"), $all, true);
  }

}
