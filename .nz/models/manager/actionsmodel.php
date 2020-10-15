<?php

class ActionsModel extends AppModel {
  
  public function DeleteFiles()
  {
    $folder = $this->config->item('uploads', 'app');
    $allowed = array(".", "..", ".htaccess");
    if(is_dir($folder))
    {
      $objects = scandir($folder); 
      foreach($objects as $object)
        if(!in_array($object, $allowed))
          rrmdir("{$folder}/{$object}");
    }
    $sql = "truncate table nz_file";
    $this->db->query($sql);
    $sql = "truncate table nz_gallery";
    $this->db->query($sql);
    $sql = "truncate table nz_gallery_file";
    $this->db->query($sql);
  }
  
  public function DeleteThumbs()
  {
    $folder = $this->config->item('uploads', 'app') . "/thumb";
    if(is_dir($folder))
      rrmdir($folder);
  }
  
  public function DeleteOldThumbs()
  {
    $folder = $this->config->item('uploads', 'app') . "/thumb";
    if(!is_dir($folder)) return;
    $allowed = array(".", "..");
    $objects = scandir($folder); 
    foreach($objects as $object)
    {
      if(!in_array($object, $allowed))
      {
        $foldery = "{$folder}/{$object}";
        if(round($object) < round(date('Y')))
        {
          rrmdir($foldery);
          continue;
        }
        $objectsy = scandir($foldery); 
        foreach($objectsy as $object)
        {
          if(!in_array($object, $allowed))
          {
            $folderm = "{$foldery}/{$object}";
            if(round($object) < round(date('m')))
            {
              rrmdir($folderm);
              continue;
            }
            $objectsm = scandir($folderm); 
            foreach($objectsm as $object)
            {
              if(!in_array($object, $allowed))
              {
                $folderd = "{$folderm}/{$object}";
                if(round($object) < round(date('d')) - 2)
                {
                  rrmdir($folderd);
                }
              }
            }
          }
        }
      }
    }
  }
  
  public function DeleteFolders()
  {   
    $sql = "truncate table nz_folder";
    $this->db->query($sql);
  }
  
  public function TruncateSystem()
  {
    $allow = array(".", "..");
    $extra = array(
      'cache' => array(),
      'controllers' => array('app.php', 'manager.php', 'tickets.php'),
      'helpers' => array(),
      'hooks' => array(),
      'language' => array(),
      'libraries' => array(),
      'logs' => array(),
      'models' => array(),
      'views' => array()
    );
    foreach($extra as $key  => $allowed)
    {
      $folder = APPPATH . $key;
      $objects = scandir($folder); 
      foreach($objects as $object)
      {
        if(!in_array($object, $allowed) && !in_array($object, $allow))
        {
          echo "{$folder}/{$object}\n";
          rrmdir("{$folder}/{$object}");
        }
      }
    }
  }
  
  public function EmptyUserData()
  {
    $sql = "truncate table nz_user_data";
    $this->db->query($sql);
  }
  
  public function ResetPermissions()
  {
    $sql = "select id_company from {$this->dbglobal}company";
    $companies = $this->db->query($sql)->result();
  }
  
  public function ResetMenu()
  {   
    $sql = "truncate table nz_menu";
    $this->db->query($sql);
    $sql = "truncate table nz_submenu";
    $this->db->query($sql);
    $sql = "insert into nz_menu select * from {$this->dbglobal}menu_basic";
    $this->db->query($sql);
    $sql = "ALTER TABLE nz_menu AUTO_INCREMENT = 50";
    $this->db->query($sql);
    $sql = "insert into nz_submenu select * from {$this->dbglobal}submenu_basic";
    $this->db->query($sql);
    $sql = "ALTER TABLE nz_submenu AUTO_INCREMENT = 400";
    $this->db->query($sql);
  }
  
}
