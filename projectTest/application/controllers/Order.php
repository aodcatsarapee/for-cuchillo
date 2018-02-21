<?php

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Produce_models');

    }

    public function index()
    {

        $cus = $this->db->get('customer');
        $product_cate = $this->db->get('categories');
        $product = $this->db->get('product');

        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $data['customer'] = $cus->result_array();
        $data['categories'] = $product_cate->result_array();
        $data['product'] = $product->result_array();

        $data['stock'] = $this->db->get('stock_detail')->result();

        $this->load->view("home/header", $data);
        $this->load->view("order/index", $data);

    }

    public function history_order()
    {

        $cus = $this->db->get('customer');
        $product_cate = $this->db->get('categories');
        $product = $this->db->get('product');

        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $data['customer'] = $cus->result_array();
        $data['categories'] = $product_cate->result_array();
        $data['product'] = $product->result_array();

        $data['stock'] = $this->db->get('stock_detail')->result();

        $this->load->view("home/header", $data);
        $this->load->view("order/history_order", $data);
    }

    public function view()
    {
        $this->db->join('band', 'band.band_id = product.product_band', 'left');
        $data['rs'] = $this->db->get('product')->result_array();

        $cus = $this->db->get('customer');
        $product_cate = $this->db->get('categories');
        $product = $this->db->get('product');

        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $data['customer'] = $cus->result_array();
        $data['categories'] = $product_cate->result_array();
        $data['product'] = $product->result_array();

        $data['partners'] = $this->db->get('partners')->result();

        $this->load->view("home/header", $data);
        $this->load->view("order/order_view", $data);
    }

    public function add()
    {
        $stock_detail = array(
            "stock_detail_status" => "รอรับสินค้าเข้าคลัง",
            "partners_id" => $this->input->post('partners'),
            "stock_detail_date" => date("Y-m-d H:i:s"),
        );
        $stock_detail_id = $this->Produce_models->insert_sotck_new($stock_detail);

        $total_all = 0;
        foreach ($_POST['product_name'] as $key => $product_name) {

            foreach ($_POST['product_amount'] as $key1 => $product_amount) {

                foreach ($_POST['product_price'] as $key2 => $product_price) {

                    foreach ($_POST['product_id'] as $key3 => $product_id) {

                        if ($key == $key1 && $key1 == $key2 && $key2 == $key3) {


                            if ($product_amount == 0) {
                                $product_price = 0;
                            }

                            $total_price = $product_amount * $product_price;

                            $total_all += $total_price;

                            $stock = array(

                                "stock_detail_id" => $stock_detail_id,

                                "product_id" => $product_id,

                                "stock_product_name" => $product_name,

                                "stock_amount" => $product_amount,

                                "stock_product_type" => $product_price,

                                "stock_price_total" => $total_price,
                            );

                            $this->db->insert("stock", $stock);
                        }
                    }
                }
            }
        }


        if ($this->input->post('order_sell') == '1') {
            $account = array(
                'account_detail' => 'รายจ่ายจากการสั่งซื้อสินค้า',
                'account_expenses' => $total_all,
                'account_type' => 'รายจ่าย',
                'account_datasave' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('account', $account);

            $stock_detail = array(
                "stock_detail_total" => $total_all,
                "stock_detail_status_buy" => 'สั่งซื้อสินค้าเป็นเงินสด',
                "stock_detail_date" => date("Y-m-d H:i:s"),
            );
            $this->db->where('stock_detail_id', $stock_detail_id);
            $this->db->update('stock_detail', $stock_detail);
        } else {

            echo $tax = ($total_all * $this->input->post('tax')) / 100;
            echo $total_creditor = $total_all + $tax;

            $stock_detail = array(
                "stock_detail_total" => $total_creditor,
                "stock_detail_status_buy" => 'สั่งซื้อสินค้าเป็นเงินเชื่อ',
                "stock_detail_date" => date("Y-m-d H:i:s"),
            );
            $this->db->where('stock_detail_id', $stock_detail_id);
            $this->db->update('stock_detail', $stock_detail);

            $creditor = array(
                'creditor_id' => 'รายจ่ายจากการสั่งซื้อสินค้า',
                'partners_id' => $this->input->post('partners'),
                'tax' => $tax,
                'price' => $total_all,
                'total_all' => $total_creditor,
                'creditor_status' => 'ยังไม่ได้ชำระเงิน',
                'date' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('creditor', $creditor);
            $creditor_id = $this->db->insert_id();

            $num_per_pay = $total_creditor / $this->input->post('payment');

            for ($i = 1; $i <= $this->input->post('payment'); $i++) {

                $creditor_detail = array(
                    'creditor_detail_num' => $i,
                    'creditor_id' => $creditor_id,
                    'creditor_detail_total' => $num_per_pay,
                    'creditor_detail_status' => 'ยังไม่ได้ชำระเงิน',
                    'creditor_detail_date' => date("Y-m-d H:i:s"),
                );
                $this->db->insert('creditor_detail', $creditor_detail);
            }

        }


        redirect('Order');


    }

    public function insert_amount($stock_detail_id)
    {

        $stock_id = $stock_detail_id;

        $datasave = date("Y-m-d H:i:s");

        $product = $this->Produce_models->select_product_amount();

        $stock = $this->Produce_models->select_stock_detail($stock_id);

        foreach ($product as $value) {

            foreach ($stock as $value1) {

                if ($value['product_id'] == $value1['product_id']) {

                    if ($value1['order_id'] == null) {

                        $amount = array(

                            "product_quantity" => $value['product_quantity'] += $value1['stock_amount'],
                            "date" => $datasave,

                        );
                        $this->db->where("product_id", $value['product_id']);
                        $this->db->update("product", $amount);

                    } else {

                        $amount = array(

                            "product_amount_order" => $value['product_amount_order'] += $value1['stock_amount'],
                            "date" => $datasave,

                        );
                        $this->db->where("product_id", $value['product_id']);
                        $this->db->update("product", $amount);


                        $order = array(

                            'order_detail_status' => 'พร้อมขายสินค้า',
                            'order_detail_date' => $datasave,

                        );

                        $this->db->where("order_detail_id", $value1['order_id']);
                        $this->db->update("order_detail", $order);


                    }

                }

                # code...


            }
            # code...
        }

        $ar = array(

            "stock_detail_status" => "รับสินค้าเข้าคลังเเล้ว",
            "stock_detail_date" => $datasave,

        );

        $this->Produce_models->insert_amount($stock_id, $ar);

        redirect('Order');
    }

    public function print_order($stock_detail_id)
    {
        $this->load->library('pdf2');
//        $this->load->model('report/Printlist_sport_model');

        $this->db->join('partners', 'partners.partners_id = stock_detail.partners_id');
        $this->db->where('stock_detail.stock_detail_id', $stock_detail_id);
        $data1['stock_detail'] = $this->db->get('stock_detail')->row();


        $this->db->where('stock_detail_id', $stock_detail_id);
        $this->db->where('stock_amount !=', 0);
        $data1['stock'] = $this->db->get('stock')->result();


        $pdf = $this->pdf2->loadthaiA4();

        $pdf->AddPage('', '', '', '', '', 15, 15, 20, 15, 0, 0);

        $pdf->SetHTMLHeader($this->PageHead());
        $pdf->WriteHTML($this->load->view('order/print_order', $data1, true));
        $pdf->Output('ใบรายชื่อนักกีฬา.pdf', 'I');
        exit;
    }

    public function PageHead()
    {
        $text = '<div align="right" style="padding-top: 40px; font-size: 16pt;">หน้า {PAGENO} / {nb}</div>';
        return $text;
    }


}

?>
