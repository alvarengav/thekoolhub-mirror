<?php

class IndexModel extends AppModel {

  public function __construct()
  {
    parent::__construct();
    $this->table = "{$this->dbglobal}ticket";
  }
  
  public function ListItems()
  {
    $where = $this->ListWhere(true);
    $init = $this->input->post('iDisplayStart') ? $this->input->post('iDisplayStart') : 0;
    $perpage = $this->input->post('iDisplayLength') ? $this->input->post('iDisplayLength') : 10;
    $orderby = $this->input->post('filter-sort-column') ? $this->input->post('filter-sort-column') : $this->mconfig['order-column'];
    $ascdesc = $this->input->post('filter-sort-type') ? $this->input->post('filter-sort-type') : $this->mconfig['order-type'];
    $sql = "SELECT t.id_ticket as id, t.*,
    (select count(*) from {$this->dbglobal}ticket_note where id_ticket = t.id_ticket ) as notes,
    lj0.category as category,
    lj1.reproducibility as reproducibility,
    lj2.severity as severity,
    lj3.priority as priority,
    lj4.state as state,
    lj5.resolution as resolution,
    lj6.visibility as visibility,
    lj7.name as reporter,
    lj8.name as monitor,
    lj9.name as assigned, ljp.project as project,
    (select count(*) as total from {$this->dbglobal}nz_gallery_file gf where gf.id_gallery  = t.id_gallery) as fmg1    
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}project ljp on t.id_project = ljp.id_project
    LEFT JOIN {$this->dbglobal}ticket_category lj0 on t.id_category = lj0.id_category      
    LEFT JOIN {$this->dbglobal}ticket_reproducibility lj1 on t.id_reproducibility = lj1.id_reproducibility      
    LEFT JOIN {$this->dbglobal}ticket_severity lj2 on t.id_severity = lj2.id_severity      
    LEFT JOIN {$this->dbglobal}ticket_priority lj3 on t.id_priority = lj3.id_priority      
    LEFT JOIN {$this->dbglobal}ticket_state lj4 on t.id_state = lj4.id_state      
    LEFT JOIN {$this->dbglobal}ticket_resolution lj5 on t.id_resolution = lj5.id_resolution      
    LEFT JOIN {$this->dbglobal}ticket_visibility lj6 on t.id_visibility = lj6.id_visibility      
    LEFT JOIN {$this->dbglobal}user lj7 on t.id_reporter = lj7.id_user      
    LEFT JOIN {$this->dbglobal}user lj8 on t.id_monitor = lj8.id_user      
    LEFT JOIN {$this->dbglobal}user lj9 on t.id_assigned = lj9.id_user      
    WHERE $where 
    ORDER BY `{$orderby}` {$ascdesc} LIMIT {$init}, {$perpage}";
    return $this->db->query($sql)->result();
  }  
  
  public function ListTotal($filter = false)
  {
    $where = $this->ListWhere($filter);
    $sql = "SELECT count(*) as total 
    FROM {$this->table} as t    
    LEFT JOIN {$this->dbglobal}ticket_category lj0 on t.id_category = lj0.id_category     
    LEFT JOIN {$this->dbglobal}ticket_reproducibility lj1 on t.id_reproducibility = lj1.id_reproducibility     
    LEFT JOIN {$this->dbglobal}ticket_severity lj2 on t.id_severity = lj2.id_severity     
    LEFT JOIN {$this->dbglobal}ticket_priority lj3 on t.id_priority = lj3.id_priority     
    LEFT JOIN {$this->dbglobal}ticket_state lj4 on t.id_state = lj4.id_state     
    LEFT JOIN {$this->dbglobal}ticket_resolution lj5 on t.id_resolution = lj5.id_resolution     
    LEFT JOIN {$this->dbglobal}ticket_visibility lj6 on t.id_visibility = lj6.id_visibility     
    LEFT JOIN {$this->dbglobal}user lj7 on t.id_reporter = lj7.id_user     
    LEFT JOIN {$this->dbglobal}user lj8 on t.id_monitor = lj8.id_user     
    LEFT JOIN {$this->dbglobal}user lj9 on t.id_assigned = lj9.id_user 
    WHERE $where";
    return $this->db->query($sql)->row()->total;
  }
  
  private function ListWhere($filter = false)
  {
    $project = $this->MApp->project;
    $sql = "SELECT p.id_project as id
    FROM {$this->dbglobal}project p
    left join {$this->dbglobal}project_company s on s.id_project = p.id_project
    where s.id_company = '{$this->MApp->user->company}' OR p.id_project = '{$project}'";
    $result = $this->db->query($sql)->result();
    $ids = array(0);
    foreach($result as $r)
      $ids[] = $r->id;
    #$sql .= " AND ( t.id_category != '1' OR (t.id_category = '1' AND t.id_project IN (" . implode($ids) . ") )) ";    
    $sql = "1";
    $sql .= " AND t.id_project IN (" . implode(',', $ids) . ") ";    
    if(!$filter) 
      return $sql;  
    if(!$this->input->post('filter-closed') && !$this->input->post('filter-id_state'))
      $sql .= " AND t.id_state != '8'";
    $text = $this->input->post('filter-text') ? $this->input->post('filter-text') : false;          
    if(!$text)      
      $text = $this->input->post('sSearch') ? $this->input->post('sSearch') : false;
    if($this->input->post('filter-id_category'))
      $sql .= " AND t.id_category = '". $this->input->post('filter-id_category') ."'";
    if($this->input->post('filter-id_project'))
      $sql .= " AND t.id_project = '". $this->input->post('filter-id_project') ."'";
    if($this->input->post('filter-id_reproducibility'))
      $sql .= " AND t.id_reproducibility = '". $this->input->post('filter-id_reproducibility') ."'";
    if($this->input->post('filter-id_severity'))
      $sql .= " AND t.id_severity = '". $this->input->post('filter-id_severity') ."'";
    if($this->input->post('filter-id_priority'))
      $sql .= " AND t.id_priority = '". $this->input->post('filter-id_priority') ."'";
    if($this->input->post('filter-id_state'))
      $sql .= " AND t.id_state = '". $this->input->post('filter-id_state') ."'";
    if($this->input->post('filter-id_resolution'))
      $sql .= " AND t.id_resolution = '". $this->input->post('filter-id_resolution') ."'";
    if($this->input->post('filter-id_visibility'))
      $sql .= " AND t.id_visibility = '". $this->input->post('filter-id_visibility') ."'";
    if($this->input->post('filter-id_reporter'))
      $sql .= " AND t.id_reporter = '". $this->input->post('filter-id_reporter') ."'";
    if($this->input->post('filter-id_monitor'))
      $sql .= " AND t.id_monitor = '". $this->input->post('filter-id_monitor') ."'";
    if($this->input->post('filter-id_assigned'))
      $sql .= " AND t.id_assigned = '". $this->input->post('filter-id_assigned') ."'";
    if($this->input->post('filter-id_gallery'))
      $sql .= " AND t.id_gallery = '". $this->input->post('filter-id_gallery') ."'";
    if($text)
      $sql .= " AND ( t.title like '%{$text}%'  OR  t.details like '%{$text}%'  OR  t.steps_to_reproduce like '%{$text}%'  OR  
      t.additional_info like '%{$text}%'  OR t.id_ticket = '{$text}') ";   
    if($this->input->post('filter-id'))
      $sql .= " AND t.id_ticket = '". $this->input->post('filter-id') ."'";  
    return $sql;
  }  
  
  public function JSON()
  {
    $total = $this->ListTotal();
    $total2 = $this->ListTotal(true);
    $json = $this->ListItems();
    $sEcho = $this->input->post('sEcho');
    return '{"sEcho":' . $sEcho . ',"iTotalRecords": '. $total .',"iTotalDisplayRecords": '. $total2 .',"aaData":' . json_encode($json) . '}';
  }
  
  public function DataSelects()
  {
    return array(
      'SelectTicketCategory' => $this->DataG->SelectTicketCategory('', $this->lang->line('Selecciona una opción')),
      'SelectTicketReproducibility' => $this->DataG->SelectTicketReproducibility('', $this->lang->line('Selecciona una opción')),
      'SelectTicketSeverity' => $this->DataG->SelectTicketSeverity('', $this->lang->line('Selecciona una opción')),
      'SelectTicketPriority' => $this->DataG->SelectTicketPriority('', $this->lang->line('Selecciona una opción')),
      'SelectTicketState' => $this->DataG->SelectTicketState('', $this->lang->line('Selecciona una opción')),
      'SelectTicketResolution' => $this->DataG->SelectTicketResolution('', $this->lang->line('Selecciona una opción')),
      'SelectTicketVisibility' => $this->DataG->SelectTicketVisibility('', $this->lang->line('Selecciona una opción')),
      'SelectUser' => $this->DataG->SelectUserTicket('', $this->lang->line('Selecciona una opción'))
    );
  }
  
  public function ValidationRules()
  {
    return array(
      array(
       'field'   => 'id_category', 
       'label'   => $this->lang->line('Categoría'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_project', 
       'label'   => $this->lang->line('Proyecto'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_reproducibility', 
       'label'   => $this->lang->line('Reproducibilidad'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_severity', 
       'label'   => $this->lang->line('Severidad'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_priority', 
       'label'   => $this->lang->line('Prioridad'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_state', 
       'label'   => $this->lang->line('Estado'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_resolution', 
       'label'   => $this->lang->line('Resolución'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_visibility', 
       'label'   => $this->lang->line('Visibilidad'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_reporter', 
       'label'   => $this->lang->line('Informador'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_monitor', 
       'label'   => $this->lang->line('Monitorizador'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'id_assigned', 
       'label'   => $this->lang->line('Asignado'), 
       'rules'   => 'trim|numeric'
      ),
      array(
       'field'   => 'creation', 
       'label'   => $this->lang->line('Creación'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'modification', 
       'label'   => $this->lang->line('Actulización'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'title', 
       'label'   => $this->lang->line('Título'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'details', 
       'label'   => $this->lang->line('Descripción'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'steps_to_reproduce', 
       'label'   => $this->lang->line('Pasos para reproducir	'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'additional_info', 
       'label'   => $this->lang->line('Información Adicional'), 
       'rules'   => 'trim'
      ),
      array(
       'field'   => 'id_gallery', 
       'label'   => $this->lang->line('Archivos'), 
       'rules'   => 'trim'
      ),
    );
  }
  
  public function Name( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "SELECT title as `name`
    FROM {$this->table}
    WHERE id_ticket = '{$id}'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return clean_title($row->name);
  }
  
  public function Duplicate( $id = 0 )
  {    
    $sql = "select * from {$this->table} where id_ticket = '{$id}'";
    $row = $this->db->query($sql)->row_array();  
    if(!$row) return false;
    unset($row['id_ticket']);    
        if($row['id_gallery'])
    {
      $oldID = $row['id_gallery'];
      $row['id_gallery'] = $this->MApp->CreateGallery();
      $this->MApp->DuplicateGallery($oldID,$row['id_gallery']);
    }    
        
    $sql = $this->db->insert_string($this->table, $row );
    $this->db->query($sql); 
    $id =  $this->db->insert_id();
    return $id;
  }
  
  public function Confirm()
  {
    if(!$this->MApp->secure->edit) return;
    $sql = $this->db->update_string($this->table, array('id_state' => 8), "id_ticket = '{$this->id}'" );
    $this->db->query($sql);
  }
  
  public function Reopen()
  {
    if(!$this->MApp->secure->edit) return;
    $sql = $this->db->update_string($this->table, array('id_state' => 1, 'id_resolution' => 3), "id_ticket = '{$this->id}'" );
    $this->db->query($sql);
  }
  
  public function Resolve()
  {
    if(!$this->MApp->secure->edit) return;
    $sql = $this->db->update_string($this->table, array('id_state' => 7), "id_ticket = '{$this->id}'" );
    $this->db->query($sql);
  }
  
  public function CancelTicket()
  {
    if(!$this->MApp->secure->edit) return;
    $sql = $this->db->update_string($this->table, array('id_state' => 2), "id_ticket = '{$this->id}'" );
    $this->db->query($sql);
  }
  
  public function SavePost()
  {
    if(!$this->MApp->secure->edit) return;
    $new = ($this->id == 0);
    if($new)
    {
      $data = array(
        'id_category' => $this->input->post('id_category'),
        'id_project' => $this->input->post('id_project'),
        'id_reproducibility' => $this->input->post('id_reproducibility'),
        'id_severity' => $this->input->post('id_severity'),
        'id_priority' => $this->input->post('id_priority'),
        'id_state' => 1,
        'id_resolution' => 1,
        'id_visibility' => 1,
        'id_reporter' => $this->MApp->user->id,
        'id_monitor' => 1,
        'id_assigned' => 0,
        'creation' => date('Y/m/d H:i:s'),
        'modification' => date('Y/m/d H:i:s'),
        'title' => $this->input->post('title'),
        'details' => $this->input->post('details'),
        'steps_to_reproduce' => $this->input->post('steps_to_reproduce'),
        'additional_info' => $this->input->post('additional_info'),
        'id_gallery' => $this->input->post('id_gallery')
      );      
      $gitems = explode(',', $this->input->post('id_gallery-items'));
      if($data['id_gallery'])
        $this->MApp->EmptyGallery($data['id_gallery']);
      if(count($gitems))
      {
        if(!$this->input->post('id_gallery'))
          $data['id_gallery'] = $this->MApp->CreateGallery();
        $this->MApp->AddGalleryItems($data['id_gallery'], $gitems);
      }
      $sql = $this->db->insert_string($this->table, $data );       
      $this->db->query($sql); 
      $this->id = $this->db->insert_id();
      $this->AddToHistoric('Nueva Incidencia');
      return $this->id;
    }
    $fieldsH = array('details', 'steps_to_reproduce', 'additional_info');
    $fields = array(        
      'id_reproducibility' => 'Reproducibilidad',
      'id_severity' => 'Severidad',
      'id_priority' => 'Prioridad',
      'id_state' => 'Estado',
      'id_resolution' => 'Resolución',
      'title' => 'Título',
      'details' => 'Descripción',
      'steps_to_reproduce' => 'Pasos para reproducir',
      'additional_info' => 'Información Adicional'
    );
    $ticket = $this->DataElement($this->id, true);
    $data = array();
    foreach($fields as $key => $value)
    {
      if(isset($_POST[$key]) && $this->input->post($key) != $ticket[$key])
      {
        $data[$key] = $this->input->post($key);
      }
    }
    if(isset($_POST['id_assigned']))
      $data['id_assigned'] = $this->input->post('id_assigned');      
    if(!count($data)) return $this->id;
    $sql = $this->db->update_string($this->table, $data, "id_ticket = '{$this->id}'" );
    $this->db->query($sql);
    $ticketN = $this->DataElement($this->id, true);
    foreach($data as $key => $value)
    {
      $nkey = str_replace('id_','', $key);
      if(isset($fields[$key]))
        $this->AddToHistoric('Modificación - ' . $fields[$key], in_array($key, $fieldsH) ? "" : "{$ticket[$nkey]} => {$ticketN[$nkey]}");
    }
    if($ticket['id_assigned'] != $ticketN['id_assigned'] && $ticketN['id_assigned'])
      $this->AddToHistoric('Asignada a ' . $ticketN['assigned'] );
    return $this->id;
  }
  
  public function Delete( $id = 0 )
  {
    if(!$this->MApp->secure->delete) return false;
    $data = $this->DataElement($id,true);
    if(!$data) return false;
    if( ($this->MApp->user->type != 1 || $this->MApp->user->atype != 1 ) && $data['id_reporter'] != $this->MApp->user->id) return false;
    $sql = "DELETE FROM {$this->dbglobal}ticket_note
    WHERE id_ticket = '{$id}'";
    $this->db->query($sql);    
    $sql = "DELETE FROM {$this->dbglobal}ticket_history
    WHERE id_ticket = '{$id}'";
    $this->db->query($sql); 
    $sql = "DELETE FROM {$this->table}
    WHERE id_ticket = '{$id}'";
    $this->db->query($sql);
    $this->MApp->DeleteGallery($data['id_gallery']);
    return true;
  }
    
  public function SaveNote( $data = array(), $note = 0 )
  {
    $data['id_ticket'] = $this->id;
    $data['id_visibility'] = (!empty($this->MApp->user->atype) && $this->MApp->user->atype == 1) ? $data['id_visibility'] : 1;
    $data['id_user'] = empty($this->MApp->user->id) ? 0 : $this->MApp->user->id;
    $sql = $this->db->insert_string("{$this->dbglobal}ticket_note", $data );
    $this->db->query($sql); 
    $note = $this->db->insert_id();
    $this->AddToHistoric('Nota añadida: ' . str_pad($this->id, 5, "0", STR_PAD_LEFT) .'-'. str_pad($note, 5, "0", STR_PAD_LEFT), '', $data['id_visibility']);
    $data['id_note'] = $note;
    return $data;
  }
  
  public function RemoveNote( $note = 0, $visibility = 1)
  {
    if($this->MApp->user->type == 1 || $this->MApp->user->atype == 1 )
      $sql = "delete from {$this->dbglobal}ticket_note where id_note = '{$note}'";
    else
      $sql = "delete from {$this->dbglobal}ticket_note where id_note = '{$note}' and id_user = '{$this->MApp->user->id}'";

    $this->AddToHistoric('Nota eliminada: ' . str_pad($this->id, 5, "0", STR_PAD_LEFT) .'-'. str_pad($note, 5, "0", STR_PAD_LEFT),'', $visibility);
    $this->db->query($sql); 
  }
    
  public function Notes( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "select n.id_note as id, n.date as date, n.note as note, n.id_user as id_user, n.id_visibility as id_visibility, v.visibility as visibility,
    CONCAT(u.name,' ', u.lastname) as user, c.company as company
    from {$this->dbglobal}ticket_note n       
    LEFT JOIN {$this->dbglobal}ticket_visibility v on n.id_visibility = v.id_visibility     
    LEFT JOIN {$this->dbglobal}user u on n.id_user = u.id_user       
    LEFT JOIN {$this->dbglobal}company c on c.id_company = u.id_user       
    WHERE n.id_ticket = '{$id}' " . ( ($this->MApp->user->atype != 1) ? " and n.id_visibility = '1' " : "") .
    "order by n.date";
    return $this->db->query($sql)->result();
  }
  
  public function AddToHistoric( $action = '',  $details = '', $visibility = 1 )
  {
    $data = array(
      'id_ticket' => $this->id,
      'id_user' => $this->MApp->user->id,
      'action' => $action,
      'details' => $details,
      'id_visibility' => $visibility      
    );
    $sql = $this->db->insert_string("{$this->dbglobal}ticket_history", $data);
    $this->db->query($sql); 
  }
  
  public function UpdateTicket( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "update {$this->table} set modification = NOW() where id_ticket = '{$id}'";
    $this->db->query($sql);
  }
  
  public function Historic( $id = 0 )
  {
    $id = $id ? $id : $this->id;
    $sql = "select n.*, v.visibility as visibility,
    CONCAT(u.name,' ', u.lastname) as user, c.company as company
    from {$this->dbglobal}ticket_history n
    LEFT JOIN {$this->dbglobal}ticket_visibility v on n.id_visibility = v.id_visibility     
    LEFT JOIN {$this->dbglobal}user u on n.id_user = u.id_user       
    LEFT JOIN {$this->dbglobal}company c on c.id_company = u.id_company       
    WHERE n.id_ticket = '{$id}' " . ( ($this->MApp->user->atype != 1) ? " and n.id_visibility = '1' " : "") .
    "order by n.date";
    return $this->db->query($sql)->result();
  }
    
  public function DataElement( $id = 0, $null = false)
  {
    $ret = array();
    if($id)
    {
      $sql = "SELECT t.id_ticket as id, t.*,
      lj0.category as category,
      lj1.reproducibility as reproducibility,
      lj2.severity as severity,
      lj3.priority as priority,
      lj4.state as state,
      lj5.resolution as resolution,
      lj6.visibility as visibility,
      CONCAT(lj7.name, ' ', lj7.lastname, ' (', lj7c.company, ')') as reporter,
      CONCAT(lj8.name,' ', lj8.lastname) as monitor,
      CONCAT(lj9.name,' ', lj9.lastname) as assigned,
      ljp.project as project     
      FROM {$this->table} as t      
      LEFT JOIN {$this->dbglobal}project ljp on t.id_project = ljp.id_project
      LEFT JOIN {$this->dbglobal}ticket_category lj0 on t.id_category = lj0.id_category       
      LEFT JOIN {$this->dbglobal}ticket_reproducibility lj1 on t.id_reproducibility = lj1.id_reproducibility       
      LEFT JOIN {$this->dbglobal}ticket_severity lj2 on t.id_severity = lj2.id_severity       
      LEFT JOIN {$this->dbglobal}ticket_priority lj3 on t.id_priority = lj3.id_priority       
      LEFT JOIN {$this->dbglobal}ticket_state lj4 on t.id_state = lj4.id_state       
      LEFT JOIN {$this->dbglobal}ticket_resolution lj5 on t.id_resolution = lj5.id_resolution
      LEFT JOIN {$this->dbglobal}ticket_visibility lj6 on t.id_visibility = lj6.id_visibility
      LEFT JOIN {$this->dbglobal}user lj7 on t.id_reporter = lj7.id_user       
      LEFT JOIN {$this->dbglobal}company lj7c on lj7c.id_company = lj7.id_company       
      LEFT JOIN {$this->dbglobal}user lj8 on t.id_monitor = lj8.id_user       
      LEFT JOIN {$this->dbglobal}user lj9 on t.id_assigned = lj9.id_user       
      WHERE t.id_ticket = '{$id}' 
      LIMIT 0, 1";
      $ret = $this->db->query($sql)->row_array();
      if($ret) return $ret;
      if($null) return false;
    }    
    $ret['id_category'] = $this->input->post() ? $this->input->post('id_category') : '';
    $ret['id_project'] = $this->input->post() ? $this->input->post('id_project') : '';
    $ret['id_reproducibility'] = $this->input->post() ? $this->input->post('id_reproducibility') : 4;
    $ret['id_severity'] = $this->input->post() ? $this->input->post('id_severity') : 5;
    $ret['id_priority'] = $this->input->post() ? $this->input->post('id_priority') : 3;
    $ret['id_state'] = $this->input->post() ? $this->input->post('id_state') : 1;
    $ret['id_resolution'] = $this->input->post() ? $this->input->post('id_resolution') : 1;
    $ret['id_visibility'] = $this->input->post() ? $this->input->post('id_visibility') : 1;
    $ret['id_reporter'] = $this->input->post() ? $this->input->post('id_reporter') : '';
    $ret['id_monitor'] = $this->input->post() ? $this->input->post('id_monitor') : '';
    $ret['id_assigned'] = $this->input->post() ? $this->input->post('id_assigned') : '';
    $ret['creation'] = $this->input->post() ? $this->input->post('creation') : '';
    $ret['modification'] = $this->input->post() ? $this->input->post('modification') : '';
    $ret['title'] = $this->input->post() ? $this->input->post('title') : '';
    $ret['details'] = $this->input->post() ? $this->input->post('details') : '';
    $ret['steps_to_reproduce'] = $this->input->post() ? $this->input->post('steps_to_reproduce') : '';
    $ret['additional_info'] = $this->input->post() ? $this->input->post('additional_info') : '';
    $ret['id_gallery'] = $this->input->post() ? $this->input->post('id_gallery') : '';
    return $ret;
  }

}
