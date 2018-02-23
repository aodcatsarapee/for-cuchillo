<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/22/2018
 * Time: 15:03
 */

class Order_debtor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Produce_models');

    }

    public function index()
    {
        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header", $data);

        $this->db->join('partners','partners.partners_id = creditor.partners_id','left');
        $data['creditor']=$this->db->get('creditor')->result();

        $this->load->view("order_debtor/index",$data);
    }

    public function history_order_debtor()
    {
        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header", $data);

        $this->db->join('partners','partners.partners_id = creditor.partners_id','left');
        $data['creditor']=$this->db->get('creditor')->result();

        $this->load->view("order_debtor/history_order_debtor",$data);
    }

    public function pay_order_debtor($creditor_id){
        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header", $data);

        $this->db->where('creditor_id' , $creditor_id);
        $data['creditor_detail']=$this->db->get('creditor_detail')->result();

        $this->load->view("order_debtor/pay_order_debtor",$data);
    }

    public function pay_order_debtor_list($creditor_id,$creditor_detail_id ,$num , $price)
    {
        $creditor_detail = array(
            'creditor_detail_status' => 'ชำระเงินเเล้ว',
            'creditor_detail_date_pay' => date("Y-m-d H:i:s"),
        );
        $this->db->where('creditor_id' , $creditor_id);
        $this->db->where('creditor_detail_id' , $creditor_detail_id);
        $this->db->update('creditor_detail', $creditor_detail);

        $account = array(
            'account_detail' => 'รายจ่ายจากการชำระหนี้',
            'account_expenses' => $price,
            'account_type' => 'รายจ่าย',
            'account_datasave' => date("Y-m-d H:i:s"),
        );
        $this->db->insert('account', $account);

        $this->db->where('creditor_id' , $creditor_id);
        $total_creditor=$this->db->get('creditor')->row()->total_all;
        $total_all_num = $total_creditor - $price ;
        $creditor = array(
            'creditor_status' => 'ชำระเงินงวดที่'.$num.'เเล้ว',
            'total_all' => $total_all_num,
            'date' => date("Y-m-d H:i:s"),
        );
        $this->db->where('creditor_id' , $creditor_id);
        $this->db->update('creditor', $creditor);

        redirect(base_url().'order_debtor/pay_order_debtor/'.$creditor_id);
    }

    public function print_order_debtor($id)
    {
        $this->load->library('pdf2');
        $data1['creditor_id']=$id;
        $pdf = $this->pdf2->loadthaiA4();
        $pdf->AddPage('', '', '', '', '', 15, 15, 20, 15, 0, 0);

        $pdf->SetHTMLHeader($this->PageHead());
        $pdf->WriteHTML($this->load->view('order_debtor/print_order_debtor', $data1, true));
        $pdf->Output('ใบรายชื่อนักกีฬา.pdf', 'I');
        exit;
    }

    public function PageHead()
    {
        $text = '<div align="right" style="padding-top: 40px; font-size: 16pt;">หน้า {PAGENO} / {nb}</div>';
        return $text;
    }

}