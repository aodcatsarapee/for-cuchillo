<?php
class member extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['member']=$this->db->get('member')->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("member/index",$data);
    $this->load->view("home/footer");
  }

  public function delete($id){
    $this->db->delete("member",array('member_id'=>$id));
    redirect("member","refesh");
    exit();
  }


}








?>
