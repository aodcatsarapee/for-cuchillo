<?php
class debtor extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->load->library('payment_pdf');
    }

    public function index(){
      $data['result']=$this->db->where("sell_status","ขายเชื่อ")->join("customer","customer.cus_id = product_sell.cus_id")->get("product_sell")->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $this->load->view("home/header",$data);
      $this->load->view("debtor/index",$data);
    }

    public function data(){
      //$data['result']=$this->db->where("sell_order_id",'74')->get("product_sell_detail")->row_array();

      $data=$this->db->get("product_sell_detail")->result();

      return json_encode($data);
    }

    public function insert(){
        $data=array(
            "emp_name"=>$this->input->post("emp_name"),
            "cus_cardid"=>$this->input->post("cus_cardid"),
            "cus_name"=>$this->input->post("cus_name"),
            "cus_address"=>$this->input->post("cus_address"),
            "cus_tel"=>$this->input->post("cus_tel"),
            "cus_credit"=>$this->input->post("cus_credit"),
            "cus_date"=>$this->input->post("cus_date")
        );

        $this->db->insert("customer",$data);
        redirect("seller","refesh");
    }

    public function detail($id){
      $result['detail']=$this->db->where('product_sell_detail.sell_order_id',$id)->join('product_sell','product_sell_detail.sell_order_id = product_sell.sell_order_id')->get('product_sell_detail')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $result['total']=$this->db->where('sell_order_id',$id)->get('product_sell')->row_array();
      $result['payment']=$this->db->where('product_payment_no',$id)->get('product_payment')->result_array();

      $this->load->view("home/header",$data);
      $this->load->view("debtor/detail",$result);
    }

    public function payment($id){
      $data=$this->sale_model->get_sell_debtor($id);
      $detail_id=$data['sell_order_id'];
      $price=$this->input->post("price");
      /*echo "<br>";
      echo $data['payment_balance'];
      echo "<br>";*/
      $month = $data['payment_month'];
      if($month == 10){
        $month = 1;
        $payment_total=$data['payment_total'];
        $payment_balance=$data['payment_pay'] - $price;
      }else{
        $month += 1;
        $payment_total = $data['payment_total'] + $price;
        $payment_balance = $data['payment_pay'] - $price;
      }

      if($month == 6){
        $data=array(
          "pay_status"=>ชำระเงินแล้ว,
          "payment_month"=>$month,
          "payment_total"=>$payment_total,
          "payment_pay"=>$payment_balance
        );
      }else{
        $data=array(
          "payment_month"=>$month,
          "payment_total"=>$payment_total,
          "payment_pay"=>$payment_balance
        );
      }

      $this->db->where('sell_id',$id)->update('product_sell',$data);

      $payment_detail=array(
        "product_payment_no"=>$this->input->post('payment_no'),
        "product_payment_month"=>$month,
        "product_payment_price"=>$payment_total,
        "product_payment_pay"=>$price,
        "product_payment_balance"=>$payment_balance,
        "product_payment_date"=>date('Y-m-d H:i:s')
      );
      $this->db->insert("product_payment",$payment_detail);

      redirect("debtor/detail/$detail_id","refesh");
      exit();
      //echo $payment_balance=$data['payment_balance'] - $price;
    }

    public function report_payment_debtor($id){
      $data['product']=$this->db->where('product_sell_detail.sell_order_id',$id)->join('product_sell','product_sell_detail.sell_order_id = product_sell.sell_order_id')->get('product_sell_detail')->result_array();
      $data['detail']=$this->db->where('sell_order_id',$id)->join('customer','product_sell.cus_id = customer.cus_id')->join('employee','product_sell.emp_name = employee.emp_name')->get('product_sell')->row_array();
      $this->load->view('debtor/report_debtor',$data);
    }

}


?>
