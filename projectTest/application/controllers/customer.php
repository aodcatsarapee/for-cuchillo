<?php
class customer extends CI_Controller{

    public function _construct(){
      parent_construct();
    }

    public function index(){
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['customer']=$this->db->get('customer')->result_array();

      $this->load->view("home/header",$data);
      $this->load->view("customer/index",$data);
    }

    public function form_insert(){
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $this->load->view('home/header',$data);
      $this->load->view('customer/form_insert');
    }

    public function insert(){
      $data=array(
          "cus_cardid"=>$this->input->post("cus_cardid"),
          "cus_name"=>$this->input->post("cus_name"),
          "cus_address"=>$this->input->post("cus_address"),
          "cus_tel"=>$this->input->post("cus_tel"),
          "cus_type"=>$this->input->post("cus_type"),
          "cus_date"=>date('Y-m-d H:i:s')
        );

      $this->db->insert("customer",$data);
      echo json_encode($data);
      //redirect("customer","refresh");
      //exit();
    }

    public function form_update(){
      /*$data['customer']=$this->db->where('cus_id',$id)->get('customer')->row_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $this->load->view('home/header',$data);
      $this->load->view('customer/form_update',$data);*/

      $id=$this->input->post("idEditCus");
      $data=$this->db->where("cus_id",$id)->get("customer")->row_array();
      echo json_encode($data);
    }

    public function update(){
      /*$customer=array(
        "cus_cardid"=>$this->input->post("cus_cardid"),
        "cus_name"=>$this->input->post("cus_name"),
        "cus_address"=>$this->input->post("cus_address"),
        "cus_tel"=>$this->input->post("cus_tel")
      );
        $this->db->where('cus_id',$id)->update('customer',$customer); //update เข้าตาราง product โดยใช้ข้อมูลที่เก็บไว้ใน $product
        redirect("customer","refesh");
        exit();*/
        $id = $this->input->post("id");
        $data=array(
            "cus_cardid"=>$this->input->post("cus_cardid"),
            "cus_name"=>$this->input->post("cus_name"),
            "cus_address"=>$this->input->post("cus_address"),
            "cus_tel"=>$this->input->post("cus_tel")
          );

        $this->db->where("cus_id",$id)->update("customer",$data);
        echo json_encode($data);

    }

    public function delete(){
      $id=$this->input->post('Del_id');
      $data=$this->db->delete("customer",array('cus_id'=>$id));
      echo json_encode($data);
    }


}





?>
