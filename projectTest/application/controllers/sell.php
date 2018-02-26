<?php
class sell extends CI_Controller{

  public function __construct()
  {
      parent::__construct();

      $this->load->library('Pdf');
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
      $data['customer']=$this->db->where('cus_type !=','ลูกค้าทั่วไป')->get('customer')->result_array();
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
        $Startdate = date('Y-m-d');
      }

      if($this->input->post('Enddate') != null){
        $Enddate = $this->input->post('Enddate');
      }else{
        $Enddate = date('Y-m-d');
      }

      $data['history']=$this->db->where("sell_detail_date BETWEEN '$Startdate' AND '$Enddate'")->where("sell_detail_type !=",'4')->get('product_sell_detail')->result_array();
      $data['product_sell']=$this->db->where("sell_date BETWEEN '$Startdate' AND '$Enddate'")->join("customer","customer.cus_id = product_sell.cus_id")->where("sell_type !=",'4')->get('product_sell')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['Start']=$Startdate;
      $data['End']=$Enddate;

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
        $Startdate = date('Y-m-d');
      }

      if($this->input->post('Enddate') != null){
        $Enddate = $this->input->post('Enddate');
      }else{
        $Enddate = date('Y-m-d');
      }
      $data['history']=$this->db->where("sell_detail_date BETWEEN '$Startdate' AND '$Enddate'")->where("sell_detail_type","4")->get('product_sell_detail')->result_array();
      $data['product_sell']=$this->db->where("sell_date BETWEEN '$Startdate' AND '$Enddate'")->join("member","product_sell.member_id = member.member_id")->where("sell_type","4")->get('product_sell')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $data['Start']=$Startdate;
      $data['End']=$Enddate;
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





    public function sell_detail_history()
    {


        // สร้าง object สำหรับใช้สร้าง pdf
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // กำหนดรายละเอียดของ pdf
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Account');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        $pdf->setPrintHeader(false);

        // กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // กำหนด margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // กำหนดการแบ่งหน้าอัตโนมัติ
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // กำหนดรูปแบบการปรับขนาดของรูปภาพ
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // กำหนดฟอนท์
        // ฟอนท์ freeserif รองรับภาษาไทย
        $pdf->SetFont('freeserif', '', 14, '', true);



        // เพิ่มหน้า pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->AddPage('L', 'A4');

        // กำหนดเงาของข้อความ
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// กำหนดเนื้อหาข้อมูลที่จะสร้าง pdf ในที่นี้เราจะกำหนดเป็นแบบ html โปรดระวัง EOD; โค้ดสุดท้ายต้องชิดซ้ายไม่เว้นวรรค



        $id=$_GET['id'];

        $date_start= date($_GET['date_start']);

        $date_end= date($_GET['date_end']);


        $nice_date_start = date('d-m-Y', strtotime($date_start));

        $nice_date_end = date('d-m-Y', strtotime($date_end));



        $tbl = '<table cellspacing="0" cellpadding="8" >
                   <tr>
                          <th style="border: 1px solid #000000;  text-align:center;" colspan="4" > ร้าน สถิตพรอะไหล่ <br>  ข้อมูลการขายสินค้า (หลังร้าน)<br>ระหว่างวันที่ '.$nice_date_start.' ถึงวันที่ '.$nice_date_end.'</th>

                   </tr> ';


        // ถึงวันที่ '.$nice_date_end

        // -----------------------------------------------------------------------------
        $tbl = $tbl . ' <thead> <tr>
         <th  width="11%" style="border: 1px solid #000000;  text-align:center;"><b> รหัสการขาย</b></th>
          <th width="25%"  style="border: 1px solid #000000; "><b>ชื่อสินค้า</b></th>
          <th width="15%"  style="border: 1px solid #000000;  text-align:right;"><b>ราคา/ชิ้น</b></th>
           <th width="10%"  style="border: 1px solid #000000;  text-align:center;"><b>จำนวน</b></th>
          <th width="15%" style="border: 1px solid #000000;  text-align:right;"><b>รวมจำนวนเงิน</b></th>
          <th width="10%" style="border: 1px solid #000000;  text-align:center;"><b>สถานะ</b></th>
          <th width="14%" style="border: 1px solid #000000;  text-align:center;"><b>ว/ด/ป</b></th>

      </tr>  </thead>';


        $this->load->model('Genpdf_models');

        $history=$this->Genpdf_models->sell_detail_history($id,$date_start,$date_end);

        foreach ($history as $value) {
            # code...
            $date=date_create($value['sell_detail_date']);

            $date_format = date_format($date,"d-m-Y");
            if($value['sell_detail_type'] == 1){
              $type = "ขายสด";
            }else if($value['sell_detail_type'] == 2){
              $type = "ขายเชื่อ";
            }else if($value['sell_detail_type'] == 3){

            }

            $tbl .='
    <tbody>
    <tr nobr="true">
    <td width="11%"  style="border: 1px solid #000000;  text-align:center">'.$value['sell_order_id'].' </td>
    <td width="25%" style="border: 1px solid #000000; ">'.$value['sell_detail_name'].' </td>
    ';
            $tbl .='
    <td width="15%" style="border: 1px solid #000000;  text-align:right">'.number_format($value['sell_detail_price']).' บาท</td>
    ';

            $tbl .='
    <td  width="10%" style="border: 1px solid #000000;  text-align:center">'.$value['sell_detail_amount'].' </td>
    <td width="15%" style="border: 1px solid #000000;  text-align:right">'.number_format($value['sell_detail_price']*$value['sell_detail_amount']).' บาท</td>
    <td width="10%" style="border: 1px solid #000000;  text-align:center">'.$type.'</td>
    <td style="border: 1px solid #000000;  text-align:center">'.$date_format.'</td>

    </tr>

    ';


        }

        if(count($history)==0){

            $tbl = $tbl . '
      <tr>
          <td  width="11%" style="border: 1px solid #000000;  text-align:center; "> - </td>
          <td  width="25%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="15%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td width="10%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="15%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td width="10%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td style="border: 1px solid #000000;  text-align:center"> - </td>

      </tr>

      ';

        }else{
          /*  $total1=0;
            $total2=0;
            foreach ($accounts as $key => $value) {

                $total1+=$value['account_income'];
                $total2+=$value['account_expenses'];


                if ($value === end($accounts)) {

                    $tbl = $tbl . '
     <tr>
           <td style="border: 1px solid #000000;  text-align:center; ">รวม</td>
           <td style="border: 1px solid #000000;  text-align:center"> - </td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total1,2).' บาท</td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total2,2).' บาท </td>
            <td style="border: 1px solid #000000;  text-align:center"> - </td>
             <td style="border: 1px solid #000000;  text-align:center"> - </td>

      </tr>
<tbody>
      ';

                }
            }*/
        }

        $tbl = $tbl . '</table>';




        $pdf->writeHTML($tbl, true, false, false, false, '');


        // สร้างข้อเนื้อหา pdf ด้วยคำสั่ง writeHTMLCell()
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// write some JavaScript code
        $js = <<<EOD

EOD;

// force print dialog
        $js .= 'print(true);';

// set javascript
        $pdf->IncludeJS($js);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('amount_detail.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
    }

    public function sell_detail_history_online()
    {


        // สร้าง object สำหรับใช้สร้าง pdf
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // กำหนดรายละเอียดของ pdf
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Account');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        $pdf->setPrintHeader(false);

        // กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // กำหนด margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // กำหนดการแบ่งหน้าอัตโนมัติ
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // กำหนดรูปแบบการปรับขนาดของรูปภาพ
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // กำหนดฟอนท์
        // ฟอนท์ freeserif รองรับภาษาไทย
        $pdf->SetFont('freeserif', '', 14, '', true);



        // เพิ่มหน้า pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->AddPage('L', 'A4');

        // กำหนดเงาของข้อความ
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// กำหนดเนื้อหาข้อมูลที่จะสร้าง pdf ในที่นี้เราจะกำหนดเป็นแบบ html โปรดระวัง EOD; โค้ดสุดท้ายต้องชิดซ้ายไม่เว้นวรรค



        $id=$_GET['id'];

        $date_start= date($_GET['date_start']);

        $date_end= date($_GET['date_end']);


        $nice_date_start = date('d-m-Y', strtotime($date_start));

        $nice_date_end = date('d-m-Y', strtotime($date_end));



        $tbl = '<table cellspacing="0" cellpadding="8" >
                   <tr>
                          <th style="border: 1px solid #000000;  text-align:center;" colspan="4" > ร้าน สถิตพรอะไหล่ <br>  ข้อมูลการขายสินค้า (ออนไลน์)<br>ระหว่างวันที่ '.$nice_date_start.' ถึงวันที่ '.$nice_date_end.'</th>

                   </tr> ';


        // ถึงวันที่ '.$nice_date_end

        // -----------------------------------------------------------------------------
        $tbl = $tbl . ' <thead> <tr>
         <th  width="11%" style="border: 1px solid #000000;  text-align:center;"><b> รหัสการขาย</b></th>
          <th width="25%"  style="border: 1px solid #000000; "><b>ชื่อสินค้า</b></th>
          <th width="15%"  style="border: 1px solid #000000;  text-align:right;"><b>ราคา/ชิ้น</b></th>
           <th width="10%"  style="border: 1px solid #000000;  text-align:center;"><b>จำนวน</b></th>
          <th width="15%" style="border: 1px solid #000000;  text-align:right;"><b>รวมจำนวนเงิน</b></th>
          <th width="10%" style="border: 1px solid #000000;  text-align:center;"><b>สถานะ</b></th>
          <th width="14%" style="border: 1px solid #000000;  text-align:center;"><b>ว/ด/ป</b></th>

      </tr>  </thead>';


        $this->load->model('Genpdf_models');

        $history=$this->Genpdf_models->sell_detail_history_online($id,$date_start,$date_end);

        foreach ($history as $value) {
            # code...
            //$date=date_create($value['sell_detail_date']);
            $date=$value['sell_detail_date'];
            //$date_format = date_format($date,"d-m-Y H:iP");
            if($value['sell_detail_type'] == 4){
              $type = "Web Site";
            }

            $tbl .='
    <tbody>
    <tr nobr="true">
    <td width="11%"  style="border: 1px solid #000000;  text-align:center">'.$value['sell_order_id'].' </td>
    <td width="25%" style="border: 1px solid #000000; ">'.$value['sell_detail_name'].' </td>
    ';
            $tbl .='
    <td width="15%" style="border: 1px solid #000000;  text-align:right">'.number_format($value['sell_detail_price']).' บาท</td>
    ';

            $tbl .='
    <td  width="10%" style="border: 1px solid #000000;  text-align:center">'.$value['sell_detail_amount'].' </td>
    <td width="15%" style="border: 1px solid #000000;  text-align:right">'.number_format($value['sell_detail_price']*$value['sell_detail_amount']).' บาท</td>
    <td width="10%" style="border: 1px solid #000000;  text-align:center">'.$type.'</td>
    <td style="border: 1px solid #000000;  text-align:center">'.$date.'</td>

    </tr>

    ';


        }

        if(count($history)==0){

            $tbl = $tbl . '
      <tr>
          <td  width="11%" style="border: 1px solid #000000;  text-align:center; "> - </td>
          <td  width="25%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="15%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td width="10%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="15%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td width="10%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td style="border: 1px solid #000000;  text-align:center"> - </td>

      </tr>

      ';

        }else{
          /*  $total1=0;
            $total2=0;
            foreach ($accounts as $key => $value) {

                $total1+=$value['account_income'];
                $total2+=$value['account_expenses'];


                if ($value === end($accounts)) {

                    $tbl = $tbl . '
     <tr>
           <td style="border: 1px solid #000000;  text-align:center; ">รวม</td>
           <td style="border: 1px solid #000000;  text-align:center"> - </td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total1,2).' บาท</td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total2,2).' บาท </td>
            <td style="border: 1px solid #000000;  text-align:center"> - </td>
             <td style="border: 1px solid #000000;  text-align:center"> - </td>

      </tr>
<tbody>
      ';

                }
            }*/
        }

        $tbl = $tbl . '</table>';




        $pdf->writeHTML($tbl, true, false, false, false, '');


        // สร้างข้อเนื้อหา pdf ด้วยคำสั่ง writeHTMLCell()
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// write some JavaScript code
        $js = <<<EOD

EOD;

// force print dialog
        $js .= 'print(true);';

// set javascript
        $pdf->IncludeJS($js);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('amount_detail.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
    }

    function approve(){
      $data['result']=$this->db->where("sell_status","ขายโอน")->where('pay_status','รอการโอนเงิน')->join("member","product_sell.member_id = member.member_id ")->get("product_sell")->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

      $this->load->view("home/header",$data);
      $this->load->view('seller/approve',$data);
    }

    function change_status($id){
      $data=array(
        "pay_status"=>'ชำระเงินแล้ว'
      );
      $this->db->where("sell_id",$id)->update("product_sell",$data);

      $delivery=array(
        "sell_order_id"=>$id,
        "delivery_status"=>'1'
      );
      $this->db->insert("delivery",$delivery);

      $result=$this->sale_model->get_sell_debtor($id);

      $account=array(
        "account_detail"=>'รายรับจากการขายสด (ออนไลน์)',
        "account_income"=>$result['sell_total'],
        "account_type"=>'รายรับ',
        "account_datasave"=>date('Y-m-d H:i:s')
      );
      $this->db->insert("account",$account);

      redirect("sell/approve","refesh");
      exit();
    }

    public function detail_approve(){
      $id=$this->input->post("idShow");
      $data=$this->db->where("sell_order_id",$id)->get('product_sell_detail')->result_array();
      echo json_encode($data);
    }

      public function conclude_approve(){
      $data['member']=$this->db->group_by('member_firstname')->join("member","member.member_id = product_sell.member_id")->order_by('sell_id','ASC')->get('product_sell')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $this->load->view("home/header",$data);
      $this->load->view('seller/conclude_approve',$data);
    }

    public function conclude_approve_detail($id){
      $this->load->library('pdf2');

      $result['detail']=$this->db->where('sell_detail_mem',$id)->join('product_sell','product_sell_detail.sell_order_id = product_sell.sell_order_id')->order_by('sell_detail_date','ASC')->group_by('sell_detail_date')->get('product_sell_detail')->result_array();
      $result['detail_name']=$this->db->where('sell_detail_mem',$id)->join('product_sell','product_sell_detail.sell_order_id = product_sell.sell_order_id')->order_by('sell_detail_date','ASC')->get('product_sell_detail')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $result['payment']=$this->db->where('product_payment_no',$id)->get('product_payment')->result_array();
      $result['member']=$this->db->where('member_id',$id)->get('member')->row_array();
      $pdf = $this->pdf2->loadthaiA4();

      $pdf->AddPage('', '', '', '', '', 15, 15, 20, 15, 0, 0);

      $pdf->SetHTMLHeader($this->PageHead());
      $pdf->WriteHTML($this->load->view('seller/print_conclude', $result, true));
      $pdf->Output('ใบรายชื่อนักกีฬา.pdf', 'I');
      exit;
    }

    public function PageHead()
    {
        $text = '<div align="right" style="padding-top: 40px; font-size: 16pt;">หน้า {PAGENO} / {nb}</div>';
        return $text;
    }

    public function conclude_sell()
    {
        $data['detail']=$this->db->where('sell_detail_type','1')->get('product_sell_detail')->result_array();
        $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header",$data);
        $this->load->view('seller/conclude_sell',$data);
    }

    public function conclude_sell_detail()
    {


        // สร้าง object สำหรับใช้สร้าง pdf
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // กำหนดรายละเอียดของ pdf
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Account');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        $pdf->setPrintHeader(false);

        // กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // กำหนด margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // กำหนดการแบ่งหน้าอัตโนมัติ
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // กำหนดรูปแบบการปรับขนาดของรูปภาพ
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // กำหนดฟอนท์
        // ฟอนท์ freeserif รองรับภาษาไทย
        $pdf->SetFont('freeserif', '', 14, '', true);



        // เพิ่มหน้า pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->AddPage('L', 'A4');

        // กำหนดเงาของข้อความ
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// กำหนดเนื้อหาข้อมูลที่จะสร้าง pdf ในที่นี้เราจะกำหนดเป็นแบบ html โปรดระวัง EOD; โค้ดสุดท้ายต้องชิดซ้ายไม่เว้นวรรค



        $id=$_GET['id'];

        $date_start= date($_GET['date_start']);

        $date_end= date($_GET['date_end']);


        $nice_date_start = date('d-m-Y', strtotime($date_start));

        $nice_date_end = date('d-m-Y', strtotime($date_end));



        $tbl = '<table cellspacing="0" cellpadding="8" >
                   <tr>
                          <th style="border: 1px solid #000000;  text-align:center;" colspan="4" >   ข้อมูลรายรับ-รายจ่าย<br>ระหว่างวันที่ '.$nice_date_start.' ถึงวันที่ '.$nice_date_end.'</th>

                   </tr> ';


        // ถึงวันที่ '.$nice_date_end

        // -----------------------------------------------------------------------------
        $tbl = $tbl . ' <thead> <tr>
         <th  width="20%" style="border: 1px solid #000000;  text-align:center;"><b>รหัสอ้างอิงการขาย</b></th>
          <th width="20%"  style="border: 1px solid #000000;  text-align:center;"><b>ชื่อสินค้า</b></th>
          <th width="15%"  style="border: 1px solid #000000;  text-align:center;"><b>ราคา/ชิ้น</b></th>
           <th width="14%"  style="border: 1px solid #000000;  text-align:center;"><b>จำนวน</b></th>
          <th width="17%" style="border: 1px solid #000000;  text-align:center;"><b>รวมราคา</b></th>
          <th width="14%" style="border: 1px solid #000000;  text-align:center;"><b>ว/ด/ป</b></th>

      </tr>  </thead>';


        $this->load->model('Genpdf_models');

        $accounts=$this->Genpdf_models->conclude_sell($id,$date_start,$date_end);

        foreach ($accounts as $value) {
            # code...
            //$date=date_create($value['account_datasave']);

            //$date_format = date_format($date,"d-m-Y");


            $tbl .='
    <tbody>
    <tr nobr="true">
    <td width="20%"  style="border: 1px solid #000000;  text-align:center">'.$value['sell_detail_id'].' </td>
    <td width="20%" style="border: 1px solid #000000;  text-align:center">'.$value['sell_detail_name'].' </td>
    ';

                $tbl .='
    <td width="15%" style="border: 1px solid #000000;  text-align:center">'.number_format($value['sell_detail_price'],2).' บาท</td>
    ';

            $tbl .='
    <td  width="17%" style="border: 1px solid #000000;  text-align:center">'.$value['sell_detail_amount'].' </td>
      <td  width="17%" style="border: 1px solid #000000;  text-align:center">'.number_format(($value['sell_detail_amount']*$value['sell_detail_price']),2).' </td>
    <td style="border: 1px solid #000000;  text-align:center">'.$date_format.'</td>

    </tr>

    ';


        }

        if(count($accounts)==0){

            $tbl = $tbl . '
      <tr>
          <td  width="20%" style="border: 1px solid #000000;  text-align:center; ">-</td>
          <td  width="20%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="15%" style="border: 1px solid #000000;  text-align:center"> -</td>
          <td width="14%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="17%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td style="border: 1px solid #000000;  text-align:center"> - </td>

      </tr>

      ';

        }else{
            $total1=0;
            $total2=0;
            foreach ($accounts as $key => $value) {

                $total1+=$value['account_income'];
                $total2+=$value['account_expenses'];


                if ($value === end($accounts)) {

                    $tbl = $tbl . '
     <tr>
           <td style="border: 1px solid #000000;  text-align:center; ">รวม</td>
           <td style="border: 1px solid #000000;  text-align:center"> - </td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total1,2).' บาท</td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total2,2).' บาท </td>
            <td style="border: 1px solid #000000;  text-align:center"> - </td>
             <td style="border: 1px solid #000000;  text-align:center"> - </td>

      </tr>
<tbody>
      ';

                }
            }
        }

        $tbl = $tbl . '</table>';




        $pdf->writeHTML($tbl, true, false, false, false, '');


        // สร้างข้อเนื้อหา pdf ด้วยคำสั่ง writeHTMLCell()
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// write some JavaScript code
        $js = <<<EOD

EOD;

// force print dialog
        $js .= 'print(true);';

// set javascript
        $pdf->IncludeJS($js);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('amount_detail.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
    }


}




?>
