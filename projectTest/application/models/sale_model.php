<?php
class sale_model extends CI_Model{

  public function getuser($data){
      $where=array('member_username'=>$data['username'],'member_password'=>$data['password']);
      $result=$this->db->where($where)->get('member')->row_array();

      return $result;
  }

  public function getuserNew($data){
      $result=$this->db->where('member_username',$data)->get('member')->row_array();

      return $result;
  }

  public function get_customer($data){
      $result=$this->db->where('cus_id',$data)->get('customer')->row_array();

      return $result;
  }

  public function getLastIDrepair(){
      $rs=$this->db->order_by('repair_id','DESC')->get('repair')->row_array();
      return $rs;
  }

  public function get_product(){
      $rs=$this->db->get('product')->result_array();
      return $rs;
  }

  public function get_product_id($product_id){
      $rs=$this->db->where("product_id",$product_id)->get('product')->row_array();
      return $rs;
  }

  public function get_product_id_count($product_id){
      $rs=$this->db->select('product_name,COUNT(product_name) as total_name')->group_by('product_name')->where("product_id",$product_id)->get('product')->row_array();
      return $rs;
  }

  public function get_product_barcode($barcode){
      //$array=array('product_barcode'=>$barcode);
      $rs=$this->db->where("product_barcode",$barcode)->get('product')->row_array();
      //$rs=$this->db->where("product_barcode",$barcode)->get('product')->row_array();
      return $rs;
  }

  public function get_product_row($id){
      $rs=$this->db->where("product_id",$id)->get('product')->row_array();
      return $rs;
  }

  public function get_payment(){
    $total=$this->input->post("total");
    $receive=$this->input->post("receive");
    $change=$total-$receive;
    return $change;
  }

  public function get_order_id(){
    $rs=$this->db->select_max('sell_order_id')->get('product_sell_detail')->row_array();
    return $rs;
  }

  public function get_sell_debtor($id){
    $rs=$this->db->where('sell_id',$id)->get('product_sell')->row_array();
    return $rs;
  }

  public function check_login($username,$password){
    $rs=$this->db->where("user_name",$username)->where("user_password",$password)->get('employee')->row_array();
    return $rs;
  }

  public function get_login($username){
    $rs=$this->db->where("login_user",$username)->where("login_IsInactive",'0')->get('login_time')->row_array();
    return $rs;
  }

  public function get_login_same($username){
    $rs=$this->db->where("user_name",$username)->get('employee')->row_array();
    return $rs;
  }

  public function get_cate($cate){
    $rs=$this->db->where("cate_id",$cate)->get('categories')->row_array();
    return $rs;
  }

  public function get_band($band){
    $rs=$this->db->where("band_id",$band)->get('band')->row_array();
    return $rs;
  }

  public function get_Topsell_id(){
    $rs=$this->db->get('product_sell')->row_array();
    return $rs;
  }

  public function get_repair($id){
    $rs=$this->db->where("repair_id",$id)->get('repair')->row_array();
    return $rs;
  }

}




?>
