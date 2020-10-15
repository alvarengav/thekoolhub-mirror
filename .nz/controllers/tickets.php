<?php

class Tickets extends AppController
{

  public function __construct()
  {
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Incidencias');
  }
  
  public function index()
  {    
    $this->MApp->dbfiles = $this->config->item('db-global', 'app');
    $this->cfg['subtitle'] = false;
    $this->cfg['order-column'] = "modification";
    $this->cfg['order-type'] = "desc";
    $this->cfg['folder'] = 6;
    $this->cfg['folder-global'] = true;
    $this->cfg['duplicate'] = false;
    $this->cfg['routes'] = array('element' => 'index_element','view' => 'index_view');
    $this->load->library("abm", $this->cfg);
  }
  
  public function index_element()
  {
    $this->model->id = $this->abm->idItem;
    $this->load->library('form_validation', array(), 'validation');
    $this->validation->set_rules($this->abm->model->ValidationRules());
    $this->abm->globalActions();
    if($this->abm->idItem)
    {
      $this->abm->data['traceBack'] = true;
      $this->abm->data['backUrl'] = base_url() . "tickets/index/view/{$this->abm->idItem}";
    }
    if($this->validation->run() !== FALSE)
    {
      $new = ($this->abm->idItem==0);
      $this->abm->idItem = $this->abm->model->SavePost();
      $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);
      if($new)
      {
        $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
          'id_type' => 4,
          'id_project' => $this->data['dataItem']['id_project'],
          'data' => json_encode(array(
            'id_user' => $this->MApp->user->id,
            'id_notification' => $this->abm->idItem,
            'noteTitle' => $this->data['dataItem']['title']
          )),
          'text' => ($this->data['dataItem']['id_category'] == 1) ? '{userName} reportó una nueva incidencia' : '{userName} reportó una nueva incidencia' ,
          'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
        ));
      }
      else
      {
        $this->model->UpdateTicket();
        if( !$this->input->post('no-notification') )
        {
          $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
            'id_type' => 4,
            'id_project' => $this->data['dataItem']['id_project'],
            'data' => json_encode(array(
              'id_user' => $this->MApp->user->id,
              'id_notification' => $this->abm->idItem,
              'noteTitle' => $this->data['dataItem']['title']
            )),
            'text' => '{userName} realizó una modificación en la incidencia {notificationTitle}',
            'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
          ));
        }
      }
      if($this->abm->data['quickOpen'])
      {
        die($this->load->view("script/window-close", array(), true));
      }
      if($this->input->post('goback'))
        return $this->abm->redirect();
      if($new) return redirect("tickets/index/view/{$this->abm->idItem }");
      $this->abm->model->id = $this->abm->idItem;
    }
    $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);
    if($this->abm->idItem)
    {
      if( !isset($this->abm->data['dataItem']['id']) || !$this->abm->data['dataItem']['id'] )
        return $this->abm->error404();
      $this->abm->data['appTitle'][] = $this->abm->model->Name();
    }
    else
    {
      if(!$this->abm->config['new-element'] || !$this->MApp->secure->edit)
        return $this->abm->error404();
      $this->abm->data['appNoChangeMenu'] = true;
      $this->abm->data['appTitle'][] = $this->lang->line("Reportar");
    }
    $this->abm->data['idItem'] = $this->abm->idItem;
    $this->abm->data['select'] = $this->abm->model->DataSelects();
    $this->load->view("{$this->abm->config['fview']}element", $this->abm->data);
  }
  
  public function index_view()
  {  
    $this->abm->globalActions();
    $action = $this->input->post('action');
    
    if($action == 'file-add')
    {
      header('Content-Type: application/json; charset=UTF-8');
      $this->model->id = $this->data['idItem'] = $this->abm->idItem;
      $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);        
      if($this->input->post('file'))
      {
        $this->MApp->AddGalleryItem($this->data['dataItem']['id_gallery'], $this->input->post('file'));
        $this->model->AddToHistoric('Agregado archivo', $this->input->post('filename'));
        $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
          'id_type' => 4,
          'id_project' => $this->data['dataItem']['id_project'],
          'data' => json_encode(array(
            'id_user' => $this->MApp->user->id,
            'id_notification' => $this->abm->idItem,
            'noteTitle' => $this->data['dataItem']['title']
          )),
          'text' => '{userName} agregó a un nuevo archivo en la incidencia {notificationTitle}',
          'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
        ));
        $this->model->UpdateTicket();
        die('{"success": 1}');
      }
      die('{"success": 0}');
    }
    
    if($action == 'remove-note')
    {
      header('Content-Type: application/json; charset=UTF-8');
      $this->model->id = $this->data['idItem'] = $this->abm->idItem;
      if($this->input->post('note'))
      {
        $this->model->RemoveNote($this->input->post('note'), $this->input->post('visibility'));
        $this->model->UpdateTicket();
        die('{"success": 1}');
      }
      die('{"success": 0}');
    }
    
    if($action == 'confirm-ticket')
    {
      header('Content-Type: application/json; charset=UTF-8');
      $this->model->id = $this->data['idItem'] = $this->abm->idItem;
      $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);
      $this->model->Confirm();
      $this->model->UpdateTicket();
      $this->model->AddToHistoric('Resolución confirmada');
      $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
        'id_type' => 4,
        'id_project' => $this->data['dataItem']['id_project'],
        'data' => json_encode(array(
          'id_user' => $this->MApp->user->id,
          'id_notification' => $this->abm->idItem,
          'noteTitle' => $this->data['dataItem']['title']
        )),
        'text' => '{userName} confirmó la resolución de la incidencia {notificationTitle}',
        'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
      ));
      die('{"success": 1}');
    }
    
    if($action == 'cancel-ticket')
    {
      header('Content-Type: application/json; charset=UTF-8');
      $this->model->id = $this->data['idItem'] = $this->abm->idItem;
      $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);
      $this->model->CancelTicket();
      $this->model->UpdateTicket();
      $this->model->AddToHistoric('No se resolvió la incidencia');
      $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
        'id_type' => 4,
        'id_project' => $this->data['dataItem']['id_project'],
        'data' => json_encode(array(
          'id_user' => $this->MApp->user->id,
          'id_notification' => $this->abm->idItem,
          'noteTitle' => $this->data['dataItem']['title']
        )),
        'text' => '{userName} marcó la incidencia {notificationTitle} como no resuelta',
        'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
      ));
      die('{"success": 1}');
    }
    
    if($action == 'resolve-ticket')
    {
      header('Content-Type: application/json; charset=UTF-8');
      $this->model->id = $this->data['idItem'] = $this->abm->idItem;
      $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);
      $this->model->Resolve();
      $this->model->UpdateTicket();
      $this->model->AddToHistoric('Incidencia resuelta');
      $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
        'id_type' => 4,
        'id_project' => $this->data['dataItem']['id_project'],
        'data' => json_encode(array(
          'id_user' => $this->MApp->user->id,
          'id_notification' => $this->abm->idItem,
          'noteTitle' => $this->data['dataItem']['title']
        )),
        'text' => '{userName} marcó la incidencia {notificationTitle} como resuelta. Se requiere revisar la misma y confirmar resolución.',
        'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
      ));
      die('{"success": 1}');
    }
    
    if($action == 'reopen-ticket')
    {
      header('Content-Type: application/json; charset=UTF-8');
      $this->model->id = $this->data['idItem'] = $this->abm->idItem;
      $this->abm->data['dataItem'] = $this->abm->model->DataElement($this->abm->idItem);
      $this->model->Reopen();
      $this->model->UpdateTicket();
      $this->model->AddToHistoric('Incidencia reabierta');
      $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
        'id_type' => 4,
        'id_project' => $this->data['dataItem']['id_project'],
        'data' => json_encode(array(
          'id_user' => $this->MApp->user->id,
          'id_notification' => $this->abm->idItem,
          'noteTitle' => $this->data['dataItem']['title']
        )),
        'text' => '{userName} reabrió la incidencia {notificationTitle}',
        'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem
      ));
      die('{"success": 1}');
    }
    
    $this->data['dataItem'] = $this->model->DataElement($this->abm->idItem, true);
    if(!$this->data['dataItem']) return $this->abm->error404();
    $this->model->id = $this->data['idItem'] = $this->abm->idItem;
        
    if($action == 'add-note' && $this->input->post('note'))
    {
      $note = $this->model->SaveNote(array(
        'note' => $this->input->post('note'),
        'id_visibility' => $this->input->post('id_visibility')
      ));  
      $id = $note['id_note'];      
      if($note['id_visibility'] == 1)
      {
        $this->MApp->AddNotification($this->ticket_users($this->data['dataItem']), array(
          'id_type' => 4,
          'id_project' => $this->data['dataItem']['id_project'],
          'data' => json_encode(array(
            'id_user' => $this->MApp->user->id,
            'id_notification' => $this->abm->idItem,
            'noteTitle' => $this->data['dataItem']['title']
          )),
          'text' => '{userName} agregó a una nota en la incidencia {notificationTitle}',
          'link' => base_url() . 'tickets/index/view/' . $this->abm->idItem . '/' . $id
        ));
      }      
      $this->model->UpdateTicket();
      $this->data['noteScroll'] = $id;
    }
    
    if($note = $this->uri->segment(5, 0)) 
      $this->data['noteScroll'] = $note;
    
    $this->data['notesList'] = $this->model->Notes();
    $this->data['historic'] = $this->model->Historic();
    $this->data['appTitle'] = array($this->lang->line('Incidencia'), str_pad($this->abm->idItem, 5, "0", STR_PAD_LEFT), mb_ucfirst($this->model->Name()));
    $this->load->view('tickets/index/view', $this->abm->data);
  }
  
  private function ticket_users( $item = false )
  {
    $users = array();
    $users[$item['id_reporter']] = true;
    $users[$item['id_monitor']] = true;
    $users[$item['id_assigned']] = true;
    unset($users[$this->MApp->user->id]);    
    $usersf = array();
    foreach($users as $key => $value)
      $usersf[] = $key;
    return $usersf;
  }
  
  public function report()
  {  
    redirect('tickets/index/new');
  }
  
  public function categories()
  {  
    $this->cfg['subtitle'] = $this->lang->line('Categorías');
    $this->cfg['order-column'] = "num";
    $this->cfg['order-type'] = "asc";
    $this->cfg['duplicate'] = false;
    $this->load->library("abm", $this->cfg);
  }
  
}