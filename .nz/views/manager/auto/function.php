
  public function <?= $function ?>()
  {
    $this->cfg['subtitle'] = $this->lang->line('<?= $subtitle ?>');
    $this->cfg['folder'] = <?= $folder ?>;
    $this->load->library("abm", $this->cfg);
  }
