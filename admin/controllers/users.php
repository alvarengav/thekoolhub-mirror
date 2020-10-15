<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class users extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {   
    $this->safeFunctionsU = array('export_registers');

    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Contenidos');
  }
  
  public function newsletter()
  {   
    
    $this->MApp->secure = (object)[
    'view'=>true,
    'edit'=>false,
    'delete'=>true,
    'special'=>false,
  ];
    $this->cfg['subtitle'] = $this->lang->line('Newsletter');
    $this->cfg['folder'] = 11;
    $this->load->library("abm", $this->cfg);
  }

  public function contact()
  {
    
    $this->MApp->secure = (object)[
      'view'=>true,
      'edit'=>false,
      'delete'=>true,
      'special'=>false,
    ];
    
    $this->cfg['subtitle'] = $this->lang->line('Contactos');
    $this->cfg['folder'] = 13;
    $this->load->library("abm", $this->cfg);
  }


  public function user()
  {
    $this->cfg['subtitle'] = $this->lang->line('Registrados');
    $this->cfg['folder'] = 28;
    $this->load->library("abm", $this->cfg);
  }

  public function questions_response()
  {
    $this->cfg['subtitle'] = $this->lang->line('Respuestas Valem Saber');
    $this->cfg['folder'] = 34;

    $this->MApp->secure = (object)[
      'view'=>true,
      'edit'=>false,
      'delete'=>false,
      'special'=>false,
    ];
    // die;
    $this->load->library("abm", $this->cfg);
  }

  // public function registers()
  // {
  //   // $this->MApp->secure = (object)[
  //   //   'view'=>true,
  //   //   'edit'=>false,
  //   //   'delete'=>false,
  //   //   'special'=>false,
  //   // ];
  //   $this->cfg['subtitle'] = $this->lang->line('Registro');
  //   $this->cfg['folder'] = 2;
  //   $this->load->library("abm", $this->cfg);
  // }

  public function export_contacts()
  {
    $csv = '';
    $sql = "SELECT 
    -- id_register as ID,
    created as Fecha,
    mail as Mail,
    first_name as Nombre,
    last_name as Apellido,
    phone as 'Teléfono',
    interested as 'Interesado en',
    number_persons as 'N° Personas',
    lang as Idioma
    FROM contact as t
    ";
    $results = $this->db->query($sql);


    $filename = 'Contactos ' . date('d-m-Y') . '.csv';

    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");

    $file = fopen('php://output', 'a');
    fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

    if ($results->num_rows() > 0) {
      foreach ($results->result_array() as $key => $row) {
        $row['N° Personas'] = '  '. $row['N° Personas'];

        if ($key == 0) {
          $values = array_keys($row);
          $values = implode(';', $values) . PHP_EOL;

          fwrite($file, $values);
        }

        $values = array_values($row);
        $values = implode(';', $values) . PHP_EOL;

        fwrite($file, $values);
      }
    }

    fclose($file);
  }

  public function export_newsletter()
  {
    $csv = '';
    $sql = "SELECT 
    DATE_FORMAT(created, '%d%/%m%/%Y') as fecha, mail as mail
    FROM newsletter as t
    where active = 1
    ";
    $results = $this->db->query($sql);

    $filename = 'Newsletter ' . date('d-m-Y') . '.xls';

    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");

    $file = fopen('php://output', 'a');
    fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

    if ($results->num_rows() > 0) {
      foreach ($results->result_array() as $key => $row) {
        if ($key == 0) {
          $values = array_keys($row);
          $values = implode(';', $values) . PHP_EOL;

          fwrite($file, $values);
        }

        $values = array_values($row);
        $values = implode(';', $values) . PHP_EOL;

        fwrite($file, $values);
      }
    }

    fclose($file);

    // // header("Content-type: application/octet-stream");
    // // header("Content-Disposition: attachment; filename=Currículums ".date('d-m-Y').".csv");

    // header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    // header("Content-Disposition: attachment; filename=Currículums ".date('d-m-Y').".xls");

    // header("Pragma: no-cache");
    // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // header("Cache-Control: private",false);
    // header("Expires: 0");
    // print "$csv";
  }
}