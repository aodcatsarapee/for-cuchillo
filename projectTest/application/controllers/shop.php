<?php
class shop extends CI_Controller{

  public function _construct(){
    parent_construct();
    $this->load->model('crud_model');
  }

  /*public function index(){
    $data['product']=$this->db->join('band','product.product_band = band.band_id')->order_by('product_id','DESC')->limit('4')->get('product')->result_array();
    $data['band']=$this->db->get('band');
    $this->load->view("shop/index",$data);
  }*/

  public function index(){
    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();
    $data['product']=$this->db->join('band','product.product_band = band.band_id')->order_by('product_id','DESC')->limit('4')->get('product')->result_array();
    $data['band']=$this->db->get('band');
    $this->load->view("shop/Test",$data);
  }

  public function checkuser(){
    $user_name = $this->input->post('user_name');
    if(!empty($user_name)){
      $data=$this->sale_model->getuserNew($user_name);
      if(count($data) > 0){
        echo json_encode($data);
      }else{
        echo json_encode($data);
      }
    }
  }

  public function product(){
    $this->load->library("pagination");
    $config['base_url']=base_url()."index.php/shop/product";
    $config['per_page']=8;
    $config['total_rows']=$this->db->count_all("product");;
    $config['first_link'] = 'หน้าแรก';
    $config['last_link'] = 'หน้าสุดท้าย';
    $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
    $config['last_tagl_close'] = "</li>";
    $this->pagination->initialize($config);

    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();
    $cate_id = $this->input->post("num_cate");
    $band_id = $this->input->post("num_band");
    $data['cate']=$this->db->get('categories')->result_array();
    $data['band']=$this->db->get('band')->result_array();

    if(empty($cate_id)){
      if(empty($band_id)){
        $data['product']=$this->db->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>'all');
      }else{
        $data['product']=$this->db->where('product_band',$band_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>$band_id);
      }
    }else if($cate_id == 'all'){
      if(empty($band_id)){
        $data['product']=$this->db->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>'all');
      }else if($band_id == 'all'){
        $data['product']=$this->db->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>'all');
      }else{
        $data['product']=$this->db->where('product_band',$band_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>$band_id);
      }
    }else{
      if(empty($band_id)){
        $data['product']=$this->db->where('product_cate',$cate_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>$cate_id,'band'=>'all');
      }else if($band_id == 'all'){
        $data['product']=$this->db->where('product_cate',$cate_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>$cate_id,'band'=>'all');
      }else{
        $data['product']=$this->db->where('product_band',$band_id)->where('product_cate',$cate_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>$cate_id,'band'=>$band_id);
      }
    }

    $this->load->view("shop/products",$data);
  }

  public function register(){
    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();
    $this->load->view('shop/register',$data);
  }

  public function bestsell(){
    $this->load->library("pagination");
    $config['base_url']=base_url()."index.php/shop/product";
    $config['per_page']=8;
    $config['total_rows']=$this->db->count_all("product");;
    $config['first_link'] = 'หน้าแรก';
    $config['last_link'] = 'หน้าสุดท้าย';
    $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
    $config['last_tagl_close'] = "</li>";
    $this->pagination->initialize($config);

    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();
    $cate_id = $this->input->post("num_cate");
    $band_id = $this->input->post("num_band");
    $data['cate']=$this->db->get('categories')->result_array();
    $data['band']=$this->db->get('band')->result_array();

    if(empty($cate_id)){
      if(empty($band_id)){
        $data['product']=$this->db->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->join('product_sell_detail','product.product_name = product_sell_detail.sell_detail_name')->order_by("sell_detail_amount","desc")->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>'all');
      }else{
        $data['product']=$this->db->where('product_band',$band_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>$band_id);
      }
    }else if($cate_id == 'all'){
      if(empty($band_id)){
        $data['product']=$this->db->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>'all');
      }else if($band_id == 'all'){
        $data['product']=$this->db->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>'all');
      }else{
        $data['product']=$this->db->where('product_band',$band_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->limit($config['per_page'],$this->uri->segment(3))->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>'all','band'=>$band_id);
      }
    }else{
      if(empty($band_id)){
        $data['product']=$this->db->where('product_cate',$cate_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>$cate_id,'band'=>'all');
      }else if($band_id == 'all'){
        $data['product']=$this->db->where('product_cate',$cate_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>$cate_id,'band'=>'all');
      }else{
        $data['product']=$this->db->where('product_band',$band_id)->where('product_cate',$cate_id)->join('categories','product.product_cate = categories.cate_id')->join('band','product.product_band = band.band_id')->order_by('product_id','ASC')->get('product')->result_array();
        $data['Sel_cate']=array('cate'=>$cate_id,'band'=>$band_id);
      }
    }

    $this->load->view("shop/bestsell",$data);
  }

  public function add_register(){
    if($this->input->post("register")!=null){
      $data['member_username']=$this->input->post("re_username");
      $data['member_password']=$this->input->post("re_pass");
      $data['member_firstname']=$this->input->post("re_first");
      $data['member_lastname']=$this->input->post("re_last");
      $data['member_email']=$this->input->post("re_email");
      $data['member_tel']=$this->input->post("re_tel");
      $data['member_address']=$this->input->post("re_add");

      $this->db->insert("member",$data);

      redirect('shop/product');
      exit();
    }else{
      redirect('shop/product');
    }

  }

  public function login(){
    $data['product']=$this->db->join('band','product.product_band = band.band_id')->order_by('product_id','DESC')->limit('4')->get('product')->result_array();
    $data['band']=$this->db->get('band');
    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();

    $username=$this->input->post("username");
    $password=$this->input->post("password");
    $result=$this->sale_model->check_login_member($username,$password);

    $session=array(
        "membername"=>$result['member_username'],
        "memberpass"=>$result['member_password']
    );
    $this->session->set_userdata($session);

    if($this->session->userdata('membername') != null){
      redirect('shop/index');
    }else{
      $data['error']="ไม่สามารถเข้าสู่ระบบได้";
      $this->load->view('shop/register',$data);
    }
  }

  public function add($id){
    $data=$this->sale_model->get_product_row($id);
    $data=array(
        "id"=>$data['product_id'],
        "price"=>$data['product_price'],
        "qty"=>1,
        "name"=>$data['product_name'],
        "quantity"=>$data['product_quantity'],
        "picture"=>$data['product_picture'],
        "pro_id"=>$data['product_id']
    );

    $this->cart->insert($data);
    $cart=$this->cart->contents();
    redirect("shop/product","refresh");
    exit();
  }

  public function cart(){
    $this->load->view('shop/cart');
  }

  public function delcart($rowid){
    $product=array(
      "rowid"=>$rowid,
      "qty"=>"0"
    );
    $this->cart->update($product);
    $data_cart=$this->cart->contents();

    redirect("shop/checkout","refresh");
    exit();
  }

  public function checkout(){
    $data['sell']=$this->db->select('sell_id')->order_by("sell_id","desc")->get('product_sell')->row_array();
    $member=$this->session->userdata('membername');
    $data['member']=$this->db->where('member_username',$member)->get('member')->row_array();
    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();
    $this->load->view('shop/checkout',$data);
  }

  public function detail($id){
    $this->load->library("pagination");
    $config['base_url']=base_url()."index.php/product/index";
    $config['per_page']=4;
    $config['total_rows']=$this->db->count_all("product");
    $config['first_link'] = 'หน้าแรก';
    $config['last_link'] = 'หน้าสุดท้าย';
    $config['full_tag_open']="<div class='pagination'>";
    $config['full_tag_close']="</div>";
    $this->pagination->initialize($config);
    $data['Get_product']=$this->db->select('product_id')->get('product')->row_array();
    $data['allproduct']=$this->db->limit($config['per_page'])->join('categories','product.product_cate = categories.cate_id')->order_by('product_id', 'RANDOM')->get('product')->result_array();
    $data['product']=$this->db->where('product_id',$id)->join('band','product.product_band = band.band_id')->join('categories','product.product_cate = categories.cate_id')->get('product')->row_array();
    $this->load->view('shop/detail',$data);
  }

  public function confirmorder(){
    $total=$this->input->post("sell_total");
    if($this->session->userdata('membername') != null){
            $sell_id=$this->input->post("sell_id");
            $newsell_id=$sell_id+1;
            $sell=array(
              "sell_status"=>"ขายโอน",
              "pay_status"=>"รอการโอนเงิน",
              "sell_total"=>$total,
              "sell_receive"=>"รอการโอนเงิน",
              "sell_change"=>"0",
              "sell_date"=>date('Y-m-d'),
              "sell_time"=>date('H:i:s'),
              "sell_order_id"=>$newsell_id,
              "sell_type"=>"4",
              "member_id"=>$this->input->post("member_id"),
              "emp_name"=>"website"
            );

            $this->db->insert("product_sell",$sell); //ทำการ insert ไปยังตาราง product โดยใช้ข้อมูลในตัวแปร product

            $data_cart=$this->cart->contents();
            //echo print_r($data_cart);
            foreach($data_cart as $datacart){
                $name_cart=$datacart['name'];
                $price_cart=$datacart['price'];
                $amount_cart=$datacart['qty'];
                $old_quantity=$datacart['quantity'];
                $id=$datacart['id'];
                //$cost=$datacart['cost'];

                $sell_detail=array(
                  "sell_order_id"=>$newsell_id,
                  "sell_detail_name"=>$name_cart,
                  //"sell_detail_cost"=>$cost,
                  "sell_detail_price"=>$price_cart,
                  "sell_detail_pricePay"=>"0",
                  "sell_detail_amount"=>$amount_cart,
                  "sell_detail_type"=>"4",
                  "sell_detail_date"=>date('Y-m-d H:i:s')
                );
                $this->db->insert("product_sell_detail",$sell_detail);

            //$new_quantity=$old_quantity-$amount_cart;
            //$quantity=array("product_quantity"=>$new_quantity);

            //$this->db->where("product_id",$id);
            //$this->db->update("product",$quantity);
           }
            $this->cart->destroy();
            header('Location:'.base_url().'/shop/detailsell/'.$newsell_id);
            //redirect("shop/detailsell","refesh"); //กลับหน้าเดิม
            exit();
    }else{
      redirect("shop/register","refesh");
    }
  }

  public function detailsell($id){
    $data['detail']=$this->db->where('sell_order_id',$id)->join('member','product_sell.member_id = member.member_id')->get('product_sell')->row_array();
    $this->load->view('shop/detailsell',$data);
  }

  public function account($id){
    $data['detail']=$this->db->where('member_username',$id)->get('member')->row_array();
    $this->load->view('shop/account',$data);
  }

  public function editPersonal($id){
    if($this->input->post('up_submit') != null){
      $data=array(
        "member_firstname"=>$this->input->post('up_first'),
        "member_lastname"=>$this->input->post('up_last'),
        "member_email"=>$this->input->post('up_email'),
        "member_tel"=>$this->input->post('up_tel'),
        "member_address"=>$this->input->post('up_add')
      );
      $this->db->where("member_id",$id)->update("member",$data);
      redirect("shop","refesh");
      exit();
    }else{
      redirect("shop","refesh");
      exit();
    }
  }

  public function logout(){
    $userdata=array('membername','memberpass');
    $this->session->unset_userdata($userdata);
    redirect('shop');
  }
}
?>
