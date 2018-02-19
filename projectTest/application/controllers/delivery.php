<?php
class delivery extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['delivery']=$this->db->join('product_sell','delivery.sell_order_id = product_sell.sell_order_id')->join('member','product_sell.member_id = member.member_id')->where("product_sell.sell_type","4")->where("delivery.delivery_status","1")->group_by('product_sell.sell_order_id')->get('delivery')->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("delivery/index",$data);
    $this->load->view("home/footer");
  }

  public function record(){
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['delivery']=$this->db->get('delivery')->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("delivery/index",$data);
    $this->load->view("home/footer");
  }

  public function detail(){
    $id=$this->input->post("idShow");
    $data=$this->db->where("sell_order_id",$id)->get('product_sell_detail')->result_array();
    echo json_encode($data);
  }

  public function change_status($id){
    $status = $this->input->post('Status');
    $data=array(
      "delivery_status"=>$status,
      "delivery_date"=>date('Y-m-d H:i:s')
    );
    $this->db->where("sell_order_id",$id)->update("delivery",$data);
    redirect("delivery","refesh"); //กลับหน้าเดิม
    exit();
  }

  public function history(){
    if($this->input->post('Startdate') != null){
      $Startdate = $this->input->post('Startdate');
    }else{
      $Startdate = "''";
    }

    if($this->input->post('Enddate') != null){
      $Enddate = $this->input->post('Enddate');
    }else{
      $Enddate = "''";
    }
    echo $Startdate;
    echo "<br>";
    echo $Enddate;
    $data['delivery']=$this->db->where("delivery_date BETWEEN '$Startdate' AND '$Enddate'")->where("product_sell.sell_type","2")->where("delivery.delivery_status","1")->join('product_sell','delivery.sell_order_id = product_sell.sell_order_id')->join('member','product_sell.member_id = member.member_id')->group_by('product_sell.sell_order_id')->get('delivery')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $this->load->view("home/header",$data);
    $this->load->view("delivery/history",$data);
  }

}








?>
