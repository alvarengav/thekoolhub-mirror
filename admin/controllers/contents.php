<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class contents extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    $this->safeFunctionsU = [
      'component_info_table',
      'component_info_table_col4',
      'vertical_gallery_and_text',
      'one_file',
      'one_link',
      'one_gallery',
      'seo',
      'news',
      'three_files',
      'events_list',
      'members_list',
      'add_links',
      'info_links',
      'one_info_links',
      'social_links',
      'add_items_image',
      'translations',
    ];
    $this->default_lang = 'es';

    parent::__construct();
    $this->cfg['title'] = $this->lang->line('Contenidos');
  }


  public function cogs()
  {
    $this->info_controller('cogs');
  }
  public function component_info_table()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'component_info_table');
  }
  public function component_info_table_col4()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'component_info_table_col4');
  }
  public function vertical_gallery_and_text()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'vertical_gallery_and_text');
  }
  public function one_file()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'one_file');
  }
  public function one_link()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'one_link');
  }
  public function one_gallery()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'one_gallery');
  }
  public function seo()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'seo');
  }
  public function news()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'news');
  }
  public function three_files()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'three_files');
  }
  public function events_list()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'events_list');
  }
  public function members_list()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'members_list');
  }
  public function add_links()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'add_links');
  }
  public function info_links()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'info_links');
  }
  public function one_info_links()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'one_info_links');
  }
  public function social_links()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'social_links');
  }
  public function add_items_image()
  {
    $id = $this->uri->segment('4');
    $this->info_controller($id,'add_items_image');
  }

  public function translations()
  {
    $var = 'translations';
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $this->data['lang'] = $this->uri->segment(3, $langs[0]);
    $this->data['hide_new_line'] = $langs[0] != $this->data['lang'];
    $this->load->model('InfoModel', 'model');
    $this->data['dataItem_default_lang'] = $this->model->Get( $var.'_'.$langs[0] );

    $this->data['lang'] = $this->uri->segment(3, $langs[0]);
    $lvar = $var.'_'.$this->data['lang'];
    
    $this->load->library('form_validation', array(), 'validation');
    $this->load->model('InfoModel', 'model');
    $this->model->var = $lvar;
    $this->data['appController'] = 'contents';
    $this->data['appFunction'] = $var;
    $nd = [];
    $this->data['dataItem'] = $this->model->Get();

    if( !$this->data['dataItem'] ) {
      $this->data['dataItem']->data = $this->data['dataItem_default_lang']->data;
    } else if( $this->data['lang'] != $langs[0] ) {
      foreach( $this->data['dataItem_default_lang']->data as $key => $value ) {
        $replace = false;
        foreach( $this->data['dataItem']->data as $c ) {
          if( $c->original == $value->original ) {
            $replace = $c->replace;
          }
        }
        $nd[$key] = (object)[
          'original'=> $value->original,
          'replace'=> $replace ? $replace : $value->replace,
        ];
      }
    }

    if(!$this->data['dataItem']) $this->data['dataItem'] = (object)[];

    $this->data['dataItem']->data = $nd ? $nd : $this->data['dataItem']->data;
    

    $this->load->view('contents/'.$var,$this->data);

    if( $this->input->post() ) {
      $this->model->Set($this->input->post());
      
      redirect($this->uri->uri_string());
    }
    

  }

  public function info_controller($var = false, $view = false) {
    if(!$var) return false;
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );

    $this->data['lang'] = $this->uri->segment(3, $langs[0]);

    $lvar = $var.'_'.$this->data['lang'];
    
    $this->load->library('form_validation', array(), 'validation');
    $this->load->model('InfoModel', 'model');
    $this->model->var = $lvar;
    $this->data['dataItem'] = $this->model->Get( );
    
    
    /*
    if( $this->data['lang'] != $this->default_lang ) {
      $this->data['dataItemD'] = $this->model->Get( $var.'_'.$this->default_lang  );
      $dataItem = (array)$this->data['dataItem'];
      $dataItemD = (array)$this->data['dataItemD'];
      

      if( !$dataItem || $dataItem[0]==false ) {
        $dataItem = $dataItemD;
      } else {
        foreach($dataItem as $i => $v) {
          if(!$v) {
            $dataItem [$i] = $dataItemD[$i];
          }
        }
      }

      // var_dump($dataItemD);
      $this->data['dataItem'] = (object)$dataItem;


    }*/

    $this->data['appController'] = 'contents';
    $this->data['appFunction'] = $var;

    $this->custom_lang = $this->data['lang'];


    $this->load->view('contents/'.($view?$view:$var),$this->data);
    
    if( $this->input->post() ) {
      $this->model->Set($this->input->post());
      
      redirect($this->uri->uri_string());
    }
  }

  public function liveadmin($view = false) {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }

    
    $this->custom_lang = $this->data['lang'];

    
    $this->cfg['subtitle'] = $this->lang->line('Equipo');
    $this->cfg['folder'] = 8;

    $this->load->view('contents/liveadmin', $this->data);
  }

  public function blog_post()
  {
    $this->cfg['subtitle'] = $this->lang->line('Artículos');
    $this->cfg['folder'] = 4;
    
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }
    
    $this->custom_lang = $this->data['lang'];

    $this->load->library("abm", $this->cfg);
  }

  public function blog()
  {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }
    
    $this->custom_lang = $this->data['lang'];
    
    $this->cfg['subtitle'] = $this->lang->line('Blog');
    $this->cfg['folder'] = 6;
    $this->load->library("abm", $this->cfg);
  }



  public function info_pages()
  {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }
    
    $this->custom_lang = $this->data['lang'];

    $this->cfg['subtitle'] = $this->lang->line('Servicios');
    $this->cfg['folder'] = 8;
    $this->load->library("abm", $this->cfg);
  }
  
  public function team()
  {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }

    
    $this->custom_lang = $this->data['lang'];

    
    $this->cfg['subtitle'] = $this->lang->line('Equipo');
    $this->cfg['folder'] = 8;
    $this->load->library("abm", $this->cfg);
  }

  public function events()
  {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }
    $this->custom_lang = $this->data['lang'];

    $this->cfg['subtitle'] = $this->lang->line('Eventos');
    $this->cfg['folder'] = 10;
    $this->load->library("abm", $this->cfg);
  }

  public function members()
  {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }
    $this->custom_lang = $this->data['lang'];

    
    $this->cfg['subtitle'] = $this->lang->line('Miembros');
    $this->cfg['folder'] = 12;
    $this->load->library("abm", $this->cfg);
  }

  public function blog_category()
  {
    $this->data['lang'] = $this->session->userdata('lang');
    
    $this->data['custom_lang'] = $this->config->item('custom_lang', 'app');
    $langs = array_keys( $this->data['custom_lang'] );
    $urilang = in_array( $this->uri->segment(3), $langs ) ? $this->uri->segment(3) : false;
    
    
    if( $urilang && $urilang != $this->data['lang'] ) {
      $this->session->set_userdata('lang', $urilang);
      redirect( $this->uri->segment(1) . '/' . $this->uri->segment(2) );
    }
    if( !$this->data['lang'] ) {
      $this->data['lang'] = 'es';
    }

    
    $this->custom_lang = $this->data['lang'];
    
    $this->cfg['subtitle'] = $this->lang->line('Blog Categorías');
    $this->cfg['folder'] = 14;
    $this->load->library("abm", $this->cfg);
  }

  public function blog_author()
  {
    $this->cfg['subtitle'] = $this->lang->line('Autores');
    $this->cfg['folder'] = 10;
    $this->load->library("abm", $this->cfg);
  }

}