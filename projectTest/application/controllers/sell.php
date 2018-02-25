<?php
class sell extends CI_Controller{

    public function _construct(){
      parent_construct();
    }

    public function index(){
      $data['product']=$this->sale_model->get_product();
      $data['customer']=$this->db->get('customer')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['sell']=$this->db->order_by("sell_id","desc")->get('product_sell')->row_array();

      $this->load->view("home/header",$data);
      $this->load->view("seller/index",$data);
      $this->load->view("home/footer");

    }

    public function sell_product(){
      if($this->input->post("submit_sale")!=null){
            $pay_status="ชำระเงินแล้ว";
            $sell_id=$this->input->post("sell_id");
            $newsell_id=$sell_id+1;
            $sell=array(
              "sell_status"=>"ขายสด",
              "pay_status"=>$pay_status,
              "sell_total"=>$this->input->post("totalsellbeforecomma"),
              "sell_receive"=>$this->input->post("receive"),
              "sell_change"=>$this->input->post("change"),
              "sell_date"=>date('Y-m-d'),
              "sell_time"=>date('H:i:s'),
              "sell_order_id"=>$newsell_id,
              "sell_type"=>'1',
              "cus_id"=>'7',
              "emp_name"=>$this->input->post("emp_name")
            );

            $this->db->insert("product_sell",$sell);

            $data_cart=$this->cart->contents();
            //echo print_r($data_cart);
            foreach($data_cart as $datacart){
                $name_cart=$datacart['name'];
                $price_cart=$datacart['price'];
                $amount_cart=$datacart['qty'];
                $old_quantity=$datacart['quantity'];
                $id=$datacart['id'];
                $cost=$datacart['cost'];
                $cate=$datacart['cate'];
                $band=$datacart['band'];

                $sell_detail=array(
                  "sell_order_id"=>$newsell_id,
                  "sell_detail_name"=>$name_cart,
                  "sell_detail_cost"=>$cost,
                  "sell_detail_price"=>$price_cart,
                  "sell_detail_pricePay"=>"0",
                  "sell_detail_amount"=>$amount_cart,
                  "sell_detail_cate"=>$cate,
                  "sell_detail_band"=>$band,
                  "sell_detail_type"=>'1',
                  "sell_detail_date"=>date('Y-m-d H:i:s')//,
                  //"sell_detail_cus"=>
                );
                $this->db->insert("product_sell_detail",$sell_detail);

            $new_quantity=$old_quantity-$amount_cart;
            $quantity=array("product_quantity"=>$new_quantity);

            $this->db->where("product_id",$id);
            $this->db->update("product",$quantity);
           }
           $account=array(
             "account_detail"=>'รายรับจากการขายสด',
             "account_income"=>$this->input->post("totalsellbeforecomma"),
             "account_type"=>'รายรับ',
             "account_datasave"=>date('Y-m-d H:i:s')
           );
           $this->db->insert("account",$account);
           $this->cart->destroy();

        redirect("sell/print_sell","refesh"); //กลับหน้าเดิม
        exit();
      }
    }

    public function add(){
      //$data=$this->sale_model->get_product_id($this->input->post("productid"));
      $barcode=$this->input->post("barcode");
      //$N_barcode=explode("<label",$barcode);
      //$G_barcode=$N_barcode['0'];
      //$data=$this->sale_model->get_product_barcode($G_barcode);
      $data=$this->sale_model->get_product_barcode($barcode);
      $product=array(
        "id"=>$data['product_id'],
        "price"=>$data['product_price'],
        "qty"=>1,
        "name"=>$data['product_name'],
        "quantity"=>$data['product_quantity'],
        "barcode"=>$data['product_barcode'],
        "cost"=>$data['product_cost'],
        "cate"=>$data['product_cate'],
        "band"=>$data['product_band'],
        "quantity"=>$data['product_quantity']
      );
      //print_r($product);
      $this->cart->insert($product);
      $data_cart=$this->cart->contents();

      redirect("sell","refresh");
      exit();
    }

    public function add_cusDebtor(){
      $ID=$this->input->post("cus_name");
      $data=$this->sale_model->get_customer($ID);

      $session=array(
          "cusname"=>$data['cus_name'],
          "cusid"=>$data['cus_id']
      );
      $this->session->set_userdata($session);

      redirect("sell/debtor","refresh");
      exit();
    }

    public function del_cusDebtor(){
      if(!empty($this->session->userdata['cusname'])){
        $this->session->unset_userdata('cusname');
        $this->session->unset_userdata('cusid');
      }

      redirect("sell/debtor","refresh");
      exit();
    }

    public function update(){
      $cart_info =  $_POST['cart'] ;
      foreach( $cart_info as $id => $cart)
		  {
  			$rowid  = $cart['rowid'];
  			$price  = $cart['price'];
  			$amount = $price * $cart['qty'];
  			$qty    = $cart['qty'];
        $Product_id     = $cart['id'];

  			$data    = array(
  					'rowid'  => $rowid,
  					'qty'    => $qty
  			);
  			$this->cart->update($data);
  		}
      redirect("sell/","refresh");


      /*$newqty=$this->input->post("addtotal");
      $rowid=$this->input->post("rowid");
      $old_cost=$this->input->post("product_cost");
      $new_cost=$this->input->post("product_cost");
      $cost=$old_cost+$new_cost;
      $product=array(
        "rowid"=>$rowid,
        "qty"=>$newqty,
        "cost"=>$cost
      );
      $this->cart->update($product);
      $data_cart=$this->cart->contents();

      redirect("sell","refresh");
      exit();*/
    }

    public function del($rowid){
      $product=array(
        "rowid"=>$rowid,
        "qty"=>"0"
      );
      $this->cart->update($product);

      redirect("sell","refresh");
      exit();
    }

    public function del_all(){
      $this->cart->destroy();
      redirect("sell","refresh");
      exit();
    }

    public function payment(){
      $change=$this->sale_model->get_payment();
      $this->load->view("seller/index",$change);
    }


    public function debtor(){
      $data['product']=$this->sale_model->get_product();
      $data['customer']=$this->db->where('cus_type','ลูกค้าสมาชิก')->get('customer')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['sell']=$this->db->order_by("sell_id","desc")->get('product_sell')->row_array();

      $this->load->view("home/header",$data);
      $this->load->view("seller/sell_debtor",$data);
      $this->load->view("home/footer");

    }

    public function add_debtor(){
      $barcode=$this->input->post("barcode");
      $data=$this->sale_model->get_product_barcode($barcode);
      $product=array(
        "id"=>$data['product_id'],
        "price"=>$data['product_price'],
        "qty"=>1,
        "name"=>$data['product_name'],
        "quantity"=>$data['product_quantity'],
        "barcode"=>$data['product_barcode'],
        "cost"=>$data['product_cost'],
        "cate"=>$data['product_cate'],
        "band"=>$data['product_band'],
        "quantity"=>$data['product_quantity']
      );
      //print_r($product);
      $this->cart->insert($product);

      redirect("sell/debtor","refresh");
      exit();
    }

    public function sell_product_debtor(){
      if($this->input->post("submit_sale")!= null){
            $pay_status="ยังไม่ได้ชำระเงิน";
            $paymentBalance = $this->input->post("totalsellbeforecomma");
            $SumpaymentBalance = $paymentBalance*0.10;
            $totalpaymentBalance = $paymentBalance + $SumpaymentBalance;
            $newtotal=$this->input->post("totalsellbeforecomma");
            $change=$this->input->post("debtor_change");
            $payment_total =$totalpaymentBalance/6;
            $sell_id=$this->input->post("sell_id");
            $newsell_id=$sell_id+1;
            $sell=array(
              "sell_status"=>"ขายเชื่อ",
              "pay_status"=>$pay_status,
              "sell_total"=>$totalpaymentBalance,
              "sell_receive"=>'0',
              "sell_change"=>'0',
              "sell_date"=>date('Y-m-d'),
              "sell_time"=>date('H:i:s'),
              "sell_order_id"=>$newsell_id,
              "sell_type"=>"2",
              "payment_month"=>"10",
              "payment_total"=>$payment_total,
              "payment_balance"=>$totalpaymentBalance,
              "payment_pay"=>$totalpaymentBalance,
              "cus_id"=>$this->input->post("cus_id"),
              "emp_name"=>$this->input->post("emp_name")
            );

            $this->db->insert("product_sell",$sell);

            $data_cart=$this->cart->contents();

            foreach($data_cart as $datacart){
                $name_cart=$datacart['name'];
                $price_cart=$datacart['price'];
                $amount_cart=$datacart['qty'];
                $old_quantity=$datacart['quantity'];
                $id=$datacart['id'];
                $cost=$datacart['cost'];
                $cate=$datacart['cate'];
                $band=$datacart['band'];

                $sell_detail=array(
                  "sell_order_id"=>$newsell_id,
                  "sell_detail_name"=>$name_cart,
                  "sell_detail_cost"=>$cost,
                  "sell_detail_price"=>$price_cart,
                  "sell_detail_pricePay"=>$totalpaymentBalance,
                  "sell_detail_amount"=>$amount_cart,
                  "sell_detail_cate"=>$cate,
                  "sell_detail_band"=>$band,
                  "sell_detail_type"=>"2",
                  "sell_detail_date"=>date('Y-m-d H:i:s'),
                  "sell_detail_cus"=>$this->input->post("cus_id")
                );
                $this->db->insert("product_sell_detail",$sell_detail);

            $new_quantity=$old_quantity-$amount_cart;
            $quantity=array("product_quantity"=>$new_quantity);

            $this->db->where("product_id",$id);
            $this->db->update("product",$quantity);
           }

            $this->cart->destroy();
            if(!empty($this->session->userdata['cusname'])){
              $this->session->unset_userdata('cusname');
              $this->session->unset_userdata('cusid');
            }
        redirect("sell/debtor","refesh");
        exit();
      }
    }

    public function update_debtor(){
      $cart_info =  $_POST['cart'] ;
      foreach( $cart_info as $id => $cart)
		  {
  			$rowid  = $cart['rowid'];
  			$price  = $cart['price'];
  			$amount = $price * $cart['qty'];
  			$qty    = $cart['qty'];
        $Product_id     = $cart['id'];

  			$data    = array(
  					'rowid'  => $rowid,
  					'qty'    => $qty
  			);
  			$this->cart->update($data);
  		}
      redirect("sell/debtor","refresh");

    }

    public function update_debtor_backup(){
      $newqty=$this->input->post("addtotal");
      $rowid=$this->input->post("rowid");
      $product_id=$this->input->post("product_id");
      $old_cost=$this->input->post("product_cost");
      $new_cost=$this->input->post("product_cost");
      $cost=$old_cost+$new_cost;

      $data=$this->sale_model->get_product_id($product_id);

      if($newqty > $data['product_quantity']){
        $session=array(
            "product_quantity"=>"Fail",
            "balance_quantity"=>$data['product_quantity']
        );
        $this->session->set_userdata($session);
      }else{
        $product=array(
          "rowid"=>$rowid,
          "qty"=>$newqty,
          "cost"=>$cost
        );
        echo $newqty;
        echo "<br>";
        echo $product_id;
        //print_r($data);

        $this->cart->update($product);
        $data_cart=$this->cart->contents();

        if(!empty($this->session->userdata['product_quantity'])){
          $this->session->unset_userdata('product_quantity');
          $this->session->unset_userdata('balance_quantity');
        }
      }

      //redirect("sell/debtor","refresh");
      //exit();
    }

    public function del_debtor($rowid){
      $product=array(
        "rowid"=>$rowid,
        "qty"=>"0"
      );
      $this->cart->update($product);
      $data_cart=$this->cart->contents();

      redirect("sell/debtor","refresh");
      exit();
    }

    public function del_all_debtor(){
      $this->cart->destroy();
      redirect("sell/debtor","refresh");
      exit();
    }

    public function income(){
      $today=date('d');
      $data['income']=$this->db->select_sum('sell_detail_price')->where("DAY(sell_detail_date)",$today)->get('product_sell_detail')->row_array();
      $data['cost']=$this->db->select_sum('sell_detail_cost')->where("DAY(sell_detail_date)",$today)->get('product_sell_detail')->row_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      //$data['sell']=$this->db->select_sum('sell_total')->where("DAY(sell_date)",$today)->get('product_sell')->row_array();


      $this->load->view("home/header",$data);
      $this->load->view("seller/income",$data);
      $this->load->view("home/footer");

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

      $data['history']=$this->db->where("sell_detail_date BETWEEN '$Startdate' AND '$Enddate'")->where("sell_detail_type !=",'4')->get('product_sell_detail')->result_array();
      $data['product_sell']=$this->db->where("sell_date BETWEEN '$Startdate' AND '$Enddate'")->join("customer","customer.cus_id = product_sell.cus_id")->where("sell_type !=",'4')->get('product_sell')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $this->load->view("home/header",$data);
      $this->load->view("seller/history",$data);
      $this->load->view("home/footer");
    }

    public function history_detail(){
      $id=$this->input->post("idShow");
      $data=$this->db->where("sell_order_id",$id)->get('product_sell_detail')->result_array();
      echo json_encode($data);
    }

    public function history_website_detail(){
      $id=$this->input->post("idShow");
      $data=$this->db->where("sell_order_id",$id)->get('product_sell_detail')->result_array();
      echo json_encode($data);
    }

    public function history_website(){
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
      $data['history']=$this->db->where("sell_detail_date BETWEEN '$Startdate' AND '$Enddate'")->where("sell_detail_type","4")->get('product_sell_detail')->result_array();
      $data['product_sell']=$this->db->where("sell_date BETWEEN '$Startdate' AND '$Enddate'")->join("member","product_sell.member_id = member.member_id")->where("sell_type","4")->get('product_sell')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      echo json_encode($data['product_sell']);
      $this->load->view("home/header",$data);
      $this->load->view("seller/history_website",$data);
      $this->load->view("home/footer");
    }

    public function ranking(){
      $month = $this->input->post('month');
      $year = $this->input->post('year');
      $cate = $this->input->post('cate');
      $band = $this->input->post('band');

      if($cate == 'All'){
        $name_cate['cate_name'] = 'ทั้งหมด';
      }else{
        $name_cate = $this->sale_model->get_cate($cate);
      }

      if($band == 'All'){
        $name_band['band_name'] = 'ทั้งหมด';
      }else{
        $name_band = $this->sale_model->get_band($band);
      }

      if(empty($year)){
        if($cate == "All"){
          if($band == "All"){
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }else{
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('sell_detail_band',$band)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }
        }else{
          if($band == "All"){
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('sell_detail_cate',$cate)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }else{
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('sell_detail_cate',$cate)->where('sell_detail_band',$band)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }
        }
      }else if(empty($month)){
        if($cate == "All"){
          if($band == "All"){
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('YEAR(sell_detail_date)',$year)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }else{
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('YEAR(sell_detail_date)',$year)->where('sell_detail_band',$band)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }
        }else{
          if($band == "All"){
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('YEAR(sell_detail_date)',$year)->where('sell_detail_cate',$cate)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }else{
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('YEAR(sell_detail_date)',$year)->where('sell_detail_cate',$cate)->where('sell_detail_band',$band)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }
        }
      }else{
        if($cate == "All"){
          if($band == "All"){
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('YEAR(sell_detail_date)',$year)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }else{
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('YEAR(sell_detail_date)',$year)->where('sell_detail_band',$band)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }
        }else{
          if($band == "All"){
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('YEAR(sell_detail_date)',$year)->where('sell_detail_cate',$cate)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }else{
            $data['ranking']=$this->db->select('product_sell_detail.sell_detail_name,categories.cate_name,band.band_name')->select_sum('sell_detail_amount')->order_by("sell_detail_amount","desc")->group_by('sell_detail_name')->where('MONTH(sell_detail_date)',$month)->where('YEAR(sell_detail_date)',$year)->where('sell_detail_cate',$cate)->where('sell_detail_band',$band)->join('categories','product_sell_detail.sell_detail_cate = categories.cate_id')->join('band','product_sell_detail.sell_detail_band = band.band_id')->get('product_sell_detail')->result_array();
          }
        }
      }

      $data['cate']=$this->db->get('categories')->result_array();
      $data['band']=$this->db->get('band')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $data['time']=array("month"=>$month,"year"=>$year,"cate"=>$cate,"band"=>$band);
      $this->load->view("home/header",$data);
      $this->load->view("seller/rangking",$data);
      $this->load->view("home/footer");
    }

    public function print_sell(){
      $or_id=$this->sale_model->get_order_id();
      $id=$or_id['sell_order_id'];
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['product_print']=$this->db->select('sell_detail_name','sell_detail_price')->select_sum('sell_detail_price')->where('sell_order_id',$id)->group_by('sell_detail_name')->get('product_sell_detail')->row_array();
      $data['product_sell']=$this->db->where('sell_order_id',$id)->get('product_sell_detail')->result_array();
      $data['product']=$this->db->where('sell_order_id',$id)->get('product_sell')->row_array();


      //$this->load->view("home/header",$data);
      $this->load->view("seller/print",$data);
      //$this->load->view("home/footer");
    }



}




?>
