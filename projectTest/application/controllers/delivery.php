<?php
class delivery extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['delivery']=$this->db->join('product_sell','delivery.sell_order_id = product_sell.sell_order_id')->join('member','product_sell.member_id = member.member_id')->where("product_sell.sell_type","4")->where('pay_status','ชำระเงินแล้ว')->where('delivery_status','1')->group_by('product_sell.sell_order_id')->get('delivery')->result_array();

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

  public function delivery_detail($id){
    $this->load->library('pdf2');

    $result['detail']=$this->db->where('product_sell_detail.sell_order_id',$id)->join('product_sell','product_sell_detail.sell_order_id = product_sell.sell_order_id')->order_by('sell_detail_date','ASC')->group_by('sell_detail_date')->get('product_sell_detail')->result_array();
    $result['detail_name']=$this->db->where('product_sell_detail.sell_order_id',$id)->join('product_sell','product_sell_detail.sell_order_id = product_sell.sell_order_id')->order_by('sell_detail_date','ASC')->get('product_sell_detail')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $result['payment']=$this->db->where('product_payment_no',$id)->get('product_payment')->result_array();
    $result['member']=$this->db->where('sell_id',$id)->join('member','product_sell.member_id = member.member_id')->get('product_sell')->row_array();
    $pdf = $this->pdf2->loadthaiA4();

    $pdf->AddPage('', '', '', '', '', 15, 15, 20, 15, 0, 0);

    $pdf->SetHTMLHeader($this->PageHead());
    $pdf->WriteHTML($this->load->view('delivery/print_detail', $result, true));
    $pdf->Output('ใบรายชื่อนักกีฬา.pdf', 'I');
    exit;


    /*$data=$this->db->where("sell_order_id",$id)->get('product_sell_detail')->result_array();
    echo json_encode($data);*/
  }

  public function PageHead()
  {
      $text = '<div align="right" style="padding-top: 40px; font-size: 16pt;">หน้า {PAGENO} / {nb}</div>';
      return $text;
  }


  public function change_status($id){
    $status = $this->input->post('Status');
    $data=array(
      "delivery_status"=>$status,
      "delivery_date"=>date('Y-m-d'),
      "delivery_time"=>date('H:i:s')
    );

    $this->db->where("sell_order_id",$id)->update("delivery",$data);
    redirect("delivery","refesh"); //กลับหน้าเดิม
    exit();
  }

  public function history(){
    if($this->input->post('Startdate') != null){
      $Startdate = $this->input->post('Startdate');
    }else{
      $Startdate = date('Y-m-d');
    }

    if($this->input->post('Enddate') != null){
      $Enddate = $this->input->post('Enddate');
    }else{
      $Enddate = date('Y-m-d');
    }

    $data['Start']=$Startdate;
    $data['End']=$Enddate;
    $data['delivery']=$this->db->where("delivery_date BETWEEN '$Startdate' AND '$Enddate'")->where("product_sell.sell_type","4")->where("delivery.delivery_status","2")->join('product_sell','delivery.sell_order_id = product_sell.sell_order_id')->join('member','product_sell.member_id = member.member_id')->group_by('product_sell.sell_order_id')->get('delivery')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $this->load->view("home/header",$data);
    $this->load->view("delivery/history",$data);
  }

}








?>
