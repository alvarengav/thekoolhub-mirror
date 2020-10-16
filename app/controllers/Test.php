<?php

class Test extends CI_Controller{

    public function index(){
        // $query = $this->db->get_where('newsletter', array('mail' => 'test@mail.com'));

        // var_dump($query);
        
        echo ENVIRONMENT . "<br>";
        echo FCPATH . "<br>";
        echo SELF . "<br>";
        echo BASEPATH . "<br>";
        echo APPPATH . "<br>";
        echo VIEWPATH . "<br>";
        echo CI_VERSION . "<br>";
    }
}