<?php
class Order extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Produce_models');
        
    }

  public function index(){

  echo "index";

  }

  public function view (){
    $this->db->join('band', 'band.band_id = product.product_band' ,'left');
    $data['rs']=$this->db->get('product')->result_array();
    $this->load->view("order/order_view", $data);
  }

  public function add(){
                $stock_detail = array(
                "stock_detail_status" => "กำลังดำเนินการ",
                "stock_detail_date" => date("Y-m-d H:i:s"),
            );
            $stock_detail_id = $this->Produce_models->insert_sotck_new($stock_detail);

            foreach ($_POST['product_name'] as $key => $product_name) {

                foreach ($_POST['product_amount'] as $key1 => $product_amount) {

                    foreach ($_POST['product_type'] as $key2 => $product_type) {

                        foreach ($_POST['product_id'] as $key3 => $product_id) {

                            if ($key == $key1 && $key1 == $key2 && $key2 == $key3) {

                                $stock = array(

							        "stock_detail_id" => $stock_detail_id,

                                    "product_id" => $product_id,

                                    "stock_product_name" => $product_name,

                                    "stock_amount" => $product_amount,

                                    "stock_product_type" => $product_type,

                                    "employee_id" => $_SESSION['employee_id'],
                                );
                                
                                $this->db->insert("stock",$stock);
                            }
                        }
                    }
                }
            }

            // echo print_r($stock);

             redirect('Order');
  }
}
?>
