<?php
class product extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $data['product']=$this->db->get('product')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['cate']=$this->db->get('categories')->result_array();
    $data['band']=$this->db->get('band')->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("product/index",$data);
    //$this->load->view("home/footer");
  }

  public function form_insert(){
    $cate=$this->db->get('categories');
    $band=$this->db->get('band');

    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $data['cate']=$cate->result_array();
    $data['band']=$band->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("product/form_insert",$data);
    $this->load->view("home/footer");
  }

  public function insert(){
    $config['upload_path'] = 'assets/images/shop/product';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
    $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย

    $this->load->library('upload',$config);

    if($this->upload->do_upload('product_picture')) //ถ้า upload ไม่มีปัญหา
    {
      $picture_product=$this->upload->data();
      rename($picture_product['full_path'],$picture_product['file_path'].date("YmdHis").$picture_product['file_ext']);
      $config['image_library']="gd2";
      $config['source_image']=$picture_product['file_path'].date("YmdHis").$picture_product['file_ext'];
      $config['width']=600;
      $config['height']=600;
      $this->load->library("image_lib",$config);
      $this->image_lib->resize();
      $picture_product = date("YmdHis").$picture_product['file_ext'];
    }
    else
    {
      $picture_product="default.jpg";
    }

    $data=array(
      "product_barcode"=>$this->input->post("barcode_product"),
      "product_name"=>$this->input->post("name_product"),
      "product_cost"=>$this->input->post("cost_product"),
      "product_price"=>$this->input->post("price_product"),
      "product_quantity"=>$this->input->post("quantity_product"),
      "product_cate"=>$this->input->post("cate_product"),
      "product_band"=>$this->input->post("band_product"),
      "product_detail"=>$this->input->post("detail_product"),
      "product_picture"=>$picture_product
    );

    $this->db->insert("product",$data); //ทำการ insert ไปยังตาราง employee โดยใช้ข้อมูลในตัวแปร data
    redirect("product","refesh"); //กลับหน้าเดิม
    exit();
    //$data_pic=array(
      //"product_picture"=>$name
    //);

    //$this->db->where("product_barcode",$barcode)->update("product",$data_pic);

    //echo json_encode($data);

    /*if($this->input->post("insert_product")!=null){
        if($this->upload->do_upload('product_picture')){  //ถ้า upload ไม่มีปัญหา
          $picture_product=$this->upload->data('file_name');
          //data() แสดงข้อมูล ที่เป็นรายละเอียดของไฟล์ ที่เราทำการ upload ex.ชื่อไฟล์ นามสกุล ขนาดไฟล์

          $product=array(
            "product_barcode"=>$this->input->post("barcode_product"),
            "product_name"=>$this->input->post("name_product"),
            "product_cost"=>$this->input->post("cost_product"),
            "product_price"=>$this->input->post("price_product"),
            "product_cate"=>$this->input->post("cate_product"),
            "product_band"=>$this->input->post("band_product"),
            "product_picture"=>$picture_product);

          $this->db->insert("product",$product); //ทำการ insert ไปยังตาราง product โดยใช้ข้อมูลในตัวแปร product
          redirect("product","refesh"); //กลับหน้าเดิม
          exit();
        }else{
          $picture_product="default.jpg";

          $product=array(
            "product_barcode"=>$this->input->post("barcode_product"),
            "product_name"=>$this->input->post("name_product"),
            "product_cost"=>$this->input->post("cost_product"),
            "product_price"=>$this->input->post("price_product"),
            "product_cate"=>$this->input->post("cate_product"),
            "product_band"=>$this->input->post("band_product"),
            "product_picture"=>$picture_product);

          $this->db->insert("product",$product); //ทำการ insert ไปยังตาราง product โดยใช้ข้อมูลในตัวแปร product
          redirect("product","refesh"); //กลับหน้าเดิม
          exit();
        }
    }*/
  }

  public function detail($product_id){
    $data['result']=$this->db->where('product.product_id',$product_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->get('product')->row_array();
    $data['cate']=$this->db->get('categories')->result_array();
    $data['band']=$this->db->get('band')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("product/detail",$data);
  }


  public function form_update(){
    $id=$this->input->post("idEdit");
    $data=$this->db->where("product_id",$id)->get("product")->row_array();
    echo json_encode($data);

    /*$data['result']=$this->db->where('product_id',$product_id)->get('product')->row_array();  //คือ select * from product
    $data['cate']=$this->db->get('categories')->result_array();
    $data['band']=$this->db->get('band')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    //result_array(); ข้อมูลออกมาทั้งหมดเหมือนใช้ for วนออกมา
    //row_array(); ข้อมูลชุดเดียว เปรียบเสมือน query ออกมาแต่ไม่ใช้ for วนข้อมูลออกมา
    $this->load->view("home/header",$data);
    $this->load->view("product/form_update",$data);*/
  }

  public function update(){
    $config['upload_path'] = 'assets/images/shop/product';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
    $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย

    $this->load->library('upload',$config);

    if($this->upload->do_upload('Edit_product_picture')) //ถ้า upload ไม่มีปัญหา
    {
      $picture_product=$this->upload->data();
      rename($picture_product['full_path'],$picture_product['file_path'].date("YmdHis").$picture_product['file_ext']);
      $config['image_library']="gd2";
      $config['source_image']=$picture_product['file_path'].date("YmdHis").$picture_product['file_ext'];
      $config['width']=600;
      $config['height']=600;
      $this->load->library("image_lib",$config);
      $this->image_lib->resize();
      $pic_product = date("YmdHis").$picture_product['file_ext'];
    }
    else
    {
      $pic_product=$this->input->post("old_product_picture");
    }

    $id=$this->input->post("Edit_id_product");
    $prodcut=array(
      "product_barcode"=>$this->input->post("Edit_barcode_product"),
      "product_name"=>$this->input->post("Edit_name_product"),
      "product_cost"=>$this->input->post("Edit_cost_product"),
      "product_price"=>$this->input->post("Edit_price_product"),
      "product_quantity"=>$this->input->post("Edit_quantity_product"),
      "product_cate"=>$this->input->post("Edit_cate_product"),
      "product_band"=>$this->input->post("Edit_band_product"),
      "product_detail"=>$this->input->post("Edit_detail_product"),
      "product_picture"=>$pic_product
    );
    $this->db->where("product_id",$id)->update("product",$prodcut);
    redirect("product","refesh"); //กลับหน้าเดิม
    exit();
    //echo $pic_product;
    //echo json_encode($prodcut);

    /*if($this->input->post("update_product")!=null){
        if($this->upload->do_upload('product_picture')){  //ถ้า upload ไม่มีปัญหา
          //unlink('imgages/'.$pic_old);
          $picture_product=$this->upload->data('file_name');
          //data() แสดงข้อมูล ที่เป็นรายละเอียดของไฟล์ ที่เราทำการ upload ex.ชื่อไฟล์ นามสกุล ขนาดไฟล์

          $product_id=$_POST['id_product'];
          $product=array(
            "product_barcode"=>$this->input->post("barcode_product"),
            "product_name"=>$this->input->post("name_product"),
            "product_price"=>$this->input->post("price_product"),
            "product_quantity"=>$this->input->post("quantity_product"),
            "product_cate"=>$this->input->post("cate_product"),
            "product_band"=>$this->input->post("band_product"),
            "product_picture"=>$picture_product);

            $this->db->where('product_id',$product_id);
            $this->db->update('product',$product); //update เข้าตาราง product โดยใช้ข้อมูลที่เก็บไว้ใน $product
            redirect("product","refesh");
            exit();
        }else{
          $product_id=$_POST['id_product'];
          $product=array(
            "product_barcode"=>$this->input->post("barcode_product"),
            "product_name"=>$this->input->post("name_product"),
            "product_price"=>$this->input->post("price_product"),
            "product_quantity"=>$this->input->post("quantity_product"),
            "product_cate"=>$this->input->post("cate_product"),
            "product_band"=>$this->input->post("band_product"));

            $this->db->where('product_id',$product_id);
            $this->db->update('product',$product); //update เข้าตาราง product โดยใช้ข้อมูลที่เก็บไว้ใน $product
            redirect("product","refesh");
            exit();
        }
    }*/


  }

  public function delete($product_id){
      $this->db->delete("product",array('product_id'=>$product_id));
      redirect("product","refesh");
      exit();
  }

  public function selectproduct(){
    $id=$this->input->post("ID");
    $type=$this->input->post("TYPE");

    if($type=='product'){
        $product=$this->db->get('product');
        $data['product']=$product->result_array();
    }else if($type=='product_cate'){
        $cate=$this->db->get('categories');
        $data['categories']=$cate->result_array();
    }
    echo json_encode($data);
    $this->load->view("seller/index",$data);
  }

  public function product_list(){
    $product=$this->db->get('product');
    $result['product']=$prodcut->result_array();

    $this->load->view("seller/index",$result);
  }


  public function testinsertbyonkey(){
    $product=array(
      "product_id"=>$this->input->post("price_product"),
      "product_name"=>$this->input->post("name_product"),
      "product_price"=>$this->input->post("price_product"));

    $this->db->insert("sell",$product); //ทำการ insert ไปยังตาราง product โดยใช้ข้อมูลในตัวแปร product
    //$test=array()$this->input->post("price_product"));
    //$this->load->view("seller/index",$test);

  }

  public function categories(){
    $data['categories']=$this->db->get('categories')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("product/categories",$data);
  }

  public function cate_insert(){
    $data=array(
      "cate_name"=>$this->input->post("name_cate")
    );
    $this->db->insert("categories",$data);
    echo json_encode($data);
  }

  public function form_update_cate(){
    $id=$this->input->post("idEdit");
    $data=$this->db->where("cate_id",$id)->get("categories")->row_array();
    echo json_encode($data);
  }

  public function cate_update(){
    $id=$this->input->post("up_id");
    $data=array(
      "cate_name"=>$this->input->post("up_name")
      );

    $this->db->where("cate_id",$id)->update("categories",$data);
    echo json_encode($data);
  }

  public function delete_cate($_id){
      $this->db->delete("categories",array('cate_id'=>$_id));
      redirect("product/categories","refesh");
      exit();
  }

  public function band(){
    $data['band']=$this->db->get('band')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("product/band",$data);
  }

  public function band_insert(){
    $data=array(
      "band_name"=>$this->input->post("name_band")
    );
    $this->db->insert("band",$data);
    echo json_encode($data);
  }

  public function form_update_band(){
    $id=$this->input->post("idEdit");
    $data=$this->db->where("band_id",$id)->get("band")->row_array();
    echo json_encode($data);
  }

  public function band_update(){
    $id=$this->input->post("up_id");
    $data=array(
      "band_name"=>$this->input->post("up_name")
      );

    $this->db->where("band_id",$id)->update("band",$data);
    echo json_encode($data);
  }

  public function delete_band($_id){
      $this->db->delete("band",array('band_id'=>$_id));
      redirect("product/band","refesh");
      exit();
  }

}

?>
