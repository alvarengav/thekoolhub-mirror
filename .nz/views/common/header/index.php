<?

if($this->MApp->user && $this->MApp->user->valid != 2)
  $this->load->view("common/header/full");
else
  $this->load->view("common/header/basic");