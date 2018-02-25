<?php
class repair extends CI_Controller{

    public function _construct(){
      parent_construct();
    }

    public function index(){
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['repair']=$this->db->where('repair_status !=','5')->get('repair')->result_array();
      $data['status']=$this->db->get('repair_status')->result_array();
      $data['type']=$this->db->get('repair_type')->result_array();
      $data['band']=$this->db->get('repair_band')->result_array();
      $data['product']=$this->db->join('band','product.product_band = band.band_id')->get('product')->result_array();

      $this->load->view("home/header",$data);
      $this->load->view("repair/index");
    }

    public function form_insert(){
      $data['type']=$this->db->get('repair_type')->result_array();
      $data['band']=$this->db->get('repair_band')->result_array();
      $data['status']=$this->db->get('repair_status')->result_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $this->load->view("home/header",$data);
      $this->load->view("repair/form_insert",$data);
    }

    public function insert(){
      if($this->input->post('saveRepair') != null){
        $config['upload_path'] = 'assets/images/shop/repair';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
        $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย
        $this->load->library('upload',$config);

        if($this->upload->do_upload('repair_picture'))
        {  //ถ้า upload ไม่มีปัญหา
          $repair_picture=$this->upload->data();
          rename($repair_picture['full_path'],$repair_picture['file_path'].date("YmdHis").$repair_picture['file_ext']);
          $config['image_library']="gd2";
          $config['source_image']=$repair_picture['file_path'].date("YmdHis").$repair_picture['file_ext'];
          $config['width']=600;
          $config['height']=600;
          $this->load->library("image_lib",$config);
          $this->image_lib->resize();
          $picture = date("YmdHis").$repair_picture['file_ext'];
        }
        else
        {
          $picture="default.jpg";
        }
          $test = $this->input->post("optgroup");
          $result_multi = implode(" - ",$test);
          $repairproduct = $this->input->post("repair_product");
          $repair=array(
            "customer_name"=>$this->input->post("cus_name"),
            "customer_tel"=>$this->input->post("cus_tel"),
            "repair_type"=>$this->input->post("repair_type"),
            "repair_band"=>$this->input->post("repair_band"),
            "repair_label"=>$this->input->post("repair_label"),
            "repair_picture"=>$picture,
            "repair_status"=>'1',
            "repair_cause"=>$this->input->post("repair_cause"),
            "repair_product"=>$result_multi,
            "repair_date"=>date('Y-m-d H:i:s'),
            "emp_name"=>$this->input->post("emp_name")
          );
          $this->db->insert("repair",$repair);
      }
            redirect("repair","refesh");
            exit();
    }

    public function detail($id){
      $data['result']=$this->db->where('repair_id',$id)->join('repair_band','repair.repair_band = repair_band.repair_band_id')->join('repair_type','repair.repair_type = repair_type.repair_type_id')->get('repair')->row_array();
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $re_pro=explode(" - ",$data['result']['repair_product']);
      for($i=0; $i<count($re_pro); $i++){
        $result=$this->sale_model->get_product_id_count($re_pro[$i]);
        $detail[] = $result['product_name'];
        $detail_amount[] = $result['total_name'];
      }
      $data['detail_pro']=implode("+",$detail);
      $data['detail_amount']=implode("+",$detail_amount);
      $this->load->view("home/header",$data);
      $this->load->view('repair/detail',$data);
    }

    public function form_update(){
      $id=$this->input->post("idEdit");
      $data=$this->db->where('repair_id',$id)->join('repair_band','repair.repair_band = repair_band.repair_band_id')->join('repair_type','repair.repair_type = repair_type.repair_type_id')->join('repair_status','repair.repair_status = repair_status.re_status_id')->get('repair')->row_array();
      echo json_encode($data);
    }

    public function update(){
      $config['upload_path'] = 'assets/images/shop/repair';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
      $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย
      $this->load->library('upload',$config);

          if($this->upload->do_upload('repair_picture'))
          {  //ถ้า upload ไม่มีปัญหา
            $repair_picture=$this->upload->data();
            rename($repair_picture['full_path'],$repair_picture['file_path'].date("YmdHis").$repair_picture['file_ext']);
            $config['image_library']="gd2";
            $config['source_image']=$repair_picture['file_path'].date("YmdHis").$repair_picture['file_ext'];
            $config['width']=600;
            $config['height']=600;
            $this->load->library("image_lib",$config);
            $this->image_lib->resize();
            $picture = date("YmdHis").$repair_picture['file_ext'];
          }
          else
          {
            $picture=$this->input->post("old_pic");
          }
            $id=$this->input->post("edit_id");
            $repair=array(
              "customer_name"=>$this->input->post("edit_cus_name"),
              "customer_tel"=>$this->input->post("edit_cus_tel"),
              "repair_type"=>$this->input->post("edit_repair_type"),
              "repair_band"=>$this->input->post("edit_repair_band"),
              "repair_label"=>$this->input->post("edit_repair_label"),
              "repair_picture"=>$picture,
              "repair_status"=>$this->input->post("edit_repair_status"),
              "repair_cause"=>$this->input->post("edit_repair_cause"),
              "repair_product"=>$this->input->post("edit_repair_product")
            );
            $this->db->where("repair_id",$id)->update("repair",$repair);
            redirect("repair","refesh"); //กลับหน้าเดิม
            exit();
    }

    public function delete($id){
      $this->db->delete("repair",array('repair_id'=>$id));
      redirect("repair","refesh");
      exit();
    }

    public function conclude(){
      $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
      $data['conclude']=$this->db->join('repair','repair_conclude.conclude_repair_id = repair.repair_id')->join('repair_band','repair.repair_band = repair_band.repair_band_id')->join('repair_type','repair.repair_type = repair_type.repair_type_id')->get('repair_conclude')->result_array();

      $this->load->view("home/header",$data);
      $this->load->view('repair/conclude',$data);
    }

    public function add_conclude($id){
      $detail_repair = $this->sale_model->get_repair($id);
      $newrepair=explode(",",$detail_repair['repair_product']);
      $sell_order_id = $this->sale_model->get_order_id();
      $newsell_id = $sell_order_id['sell_order_id']+1;
      $sell_total=0;

      $update_repair=array(
        "repair_status"=>'5'
      );

      $this->db->where('repair_id',$id)->update('repair',$update_repair);

      for($i=0; $i<count($newrepair); $i++){
        $product = $this->sale_model->get_product_barcode($newrepair[$i]);
        if(empty($product)){
          $pro_name = "";
          $pro_cost="";
          $pro_price="";
          $pro_cate="";
          $pro_band="";
        }else{
          $pro_name = $product['product_name'];
          $pro_cost=$product['product_cost'];
          $pro_price=$product['product_price'];
          $pro_cate=$product['product_cate'];
          $pro_band=$product['product_band'];
        }
        $sell_detail=array(
          "sell_order_id"=>$newsell_id,
          "sell_detail_name"=>$pro_name,
          "sell_detail_cost"=>$pro_cost,
          "sell_detail_price"=>$pro_price,
          "sell_detail_pricePay"=>"0",
          "sell_detail_amount"=>'1',
          "sell_detail_cate"=>$pro_cate,
          "sell_detail_band"=>$pro_band,
          "sell_detail_type"=>'3',
          "sell_detail_date"=>date('Y-m-d H:i:s')
        );
        $this->db->insert("product_sell_detail",$sell_detail);
        $sell_total += $product['product_price'];
      }

        $sell=array(
          "sell_status"=>"ขายสด",
          "pay_status"=>"ยังไม่ได้ชำระเงิน",
          "sell_total"=>$sell_total,
          "sell_receive"=>'0',
          "sell_change"=>'0',
          "sell_date"=>date('Y-m-d'),
          "sell_time"=>date('H:i:s'),
          "sell_order_id"=>$newsell_id,
          "sell_type"=>'3',
          "cus_id"=>'0',
          "emp_name"=>$this->session->userdata['name']
        );
        $this->db->insert("product_sell",$sell);

        $conclude=array(
          "conclude_title"=>$detail_repair['repair_cause'],
          "conclude_detail"=>$this->input->post('how_repair'),
          "conclude_product"=>$detail_repair['repair_product'],
          "conclude_repair_id"=>$detail_repair['repair_id'],
          "conclude_order_id"=>$newsell_id,
          "conclude_date"=>date('Y-m-d'),
          "conclude_time"=>date('H:i:s')
        );
        $this->db->insert("repair_conclude",$conclude);

        redirect("repair/conclude","refesh");
        exit();
      }

      public function conclude_detail(){
        $id=$this->input->post("idDetail");
        $data=$this->db->where('conclude_repair_id',$id)->get('repair_conclude')->row_array();
        echo json_encode($data);
      }

      public function conclude_product(){
        $id=$this->input->post("idProduct");
        $pro=$this->db->where('sell_order_id',$id)->group_by('sell_detail_name')->get('product_sell_detail')->result_array();
        echo json_encode($pro);
      }

      public function history(){
        $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
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

        $data['history']=$this->db->select('repair_band_name , repair_type_name , COUNT(repair_type) as total_type')->where("conclude_date BETWEEN '$Startdate' AND '$Enddate'")->join('repair','repair_conclude.conclude_repair_id = repair.repair_id')->join('repair_band','repair.repair_band = repair_band.repair_band_id')->join('repair_type','repair.repair_type= repair_type.repair_type_id')->group_by('repair_type')->get('repair_conclude')->result_array();
        $data['time']=array("Startdate"=>$Startdate,"Enddate"=>$Enddate);
        $this->load->view("home/header",$data);
        $this->load->view('repair/history',$data);
      }

      function add_pro(){
        $id=$this->input->post('product_id');
        $data=$this->db->where('product_id',$id)->get('product')->row_array();
        echo json_encode($data);
      }

}






?>
