<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppModel extends CI_Model {

  public 
    $dbglobal = "",
    $dbfiles = "",
    $mconfig = array(),
    $id = 0;
    
  function __construct()
  {
    parent::__construct();
    $CI =& get_instance();
    $this->dbglobal = $CI->config->item('db-global', 'app');
    $this->langs = $CI->config->item('langs', 'app');
    $this->flang = $this->langs[0];
    $this->message_string = false;
    $this->table = false;
    $this->table_field_id = false;
    $this->table_field_active = 'active';
  }


  public function get_table_id()
  {
    if ( ! $this->table)
    {
      return false;
    }

    $field_id = 'id_'.$this->table;
    if($this->db->field_exists($field_id, $this->table))
    {
      return $this->table_field_id = $field_id;
    }

    foreach($this->db->field_data($this->table) as $field)
    {
      if($field->primary_key)
      {
        $this->table_field_id = $field->name;
        break;
      }
    }
    return $this->table_field_id;
  }
  
  public function ChangeState($id = 0)
  {

    $texts = [
      'La accion no pudo realizarse',
      'Elemento desactivado',
      'Elemento activado',
    ];

    if ( ! $this->MApp->secure->edit || ! property_exists($this, 'table') || ! $this->table)
    {
      $this->message_string = $texts[0];
      return false;
    }
    
    $field = $this->table_field_active ?: 'active';
    if ( ! $this->db->field_exists($field, $this->table))
    {
      $this->message_string = $texts[0];
      return false;
    }

    if ( ! $this->table_field_id)
    {
      $this->table_field_id = $this->get_table_id();
    }

    if ( ! $this->table_field_id)
    {
      $this->message_string = $texts[0];
      return false;
    }
    
    $sql = "SELECT {$field} as value FROM {$this->table} WHERE {$this->table_field_id} = ?";
    $row = $this->db->query($sql, [$id])->row();    
    if ( ! $row)
    {
      $this->message_string = $texts[0];
      return false;
    }
    
    $row->value = ! $row->value;
    
    $this->db->update(
      $this->table,
      [$field => $row->value],
      [$this->table_field_id => $id]
    );
    $result = ($this->db->affected_rows() > 0);

    $index = 0;
    if ($result)
    {
      $index++;
      if ($row->value)
      {
        $index++;
      }
    }

    if($field == 'active' || ! $index)
    {
      $this->message_string = $texts[$index];
    }
    else
    {
      $this->message_string = 'Modificación realizada';
    }

    return $result;
  }
    
}
