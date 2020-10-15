<a?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class <?= $controller ?> extends AppController {

  public 
    $cfg = array();

  public function __construct()
  {
    parent::__construct();
    $this->cfg['title'] = $this->lang->line('<?= $title ?>');
  }

}