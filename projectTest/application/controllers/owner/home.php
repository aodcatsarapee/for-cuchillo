<?php
class home extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $cus=$this->db->get('customer');
    $product_cate=$this->db->get('categories');
    $product=$this->db->get('product');

    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['customer']=$cus->result_array();
    $data['categories']=$product_cate->result_array();
    $data['product']=$product->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("home/home",$data);
  }

}


?>
