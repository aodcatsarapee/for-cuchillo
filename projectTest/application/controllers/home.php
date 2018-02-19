<?php
class home extends CI_Controller{
  public function _construct(){
    parent_construct();
  }

  public function index(){
    $this->load->view("home/index");
  }
}

?>
