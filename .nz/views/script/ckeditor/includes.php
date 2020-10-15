<?

$scripts = array(
  layout() . "js/ckeditor/ckeditor.js"
);

$this->load->view('script/required', array('scripts' => $scripts));
