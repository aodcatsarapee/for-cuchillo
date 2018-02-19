<?php
class user extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $data['result']=$this->db->where('emp_status','1')->get('employee')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("user/index",$data);
  }

  public function check_login(){
    //if($post=$this->input->post()){
      //extract($post);
      $username=$this->input->post('user_name');
      $password=$this->input->post('user_password');
      $data=$this->sale_model->check_login($username,$password);

        $session=array(
            "username"=>$data['user_name'],
            "password"=>$data['user_password'],
            "type"=>$data['user_position'],
            "name"=>$data['emp_name']
        );
        $this->session->set_userdata($session);

        $result_login=array(
          "login_user"=>$this->session->userdata['username'],
          "login_start"=>date('Y-m-d H:i:s'),
          "login_end"=>'null',
          "login_IsInactive"=>0
        );

        $old_login = $this->sale_model->get_login($this->session->userdata['username']);

        if(empty($old_login)){
          $this->db->insert('login_time',$result_login);
        }
        echo json_encode($data);
    //}
    //$this->load->view("home/check_login",$data);
  }

  public function login(){
    $this->load->view("home/index");
  }

  public function logout(){
    $data=$this->sale_model->get_login($this->session->userdata['username']);
    $result_login=array(
      "login_end"=>date('Y-m-d H:i:s')
    );
    $this->db->where('login_id',$data['login_id'])->update('login_time',$result_login);
    $userdata=array('username','password');
    $this->session->unset_userdata($userdata);
    redirect('user/login');
  }

  public function signup(){
    $this->load->view("home/signup");
  }

  public function register(){
    $data=array(
      "user_name"=>$this->input->post('user_name'),
      "user_password"=>$this->input->post('user_password'),
      "user_position"=>'0',
      "emp_status"=>'1',
      "emp_name"=>$this->input->post('emp_name'),
      "emp_lastname"=>$this->input->post('emp_lastname')
    );

    $this->db->insert('employee',$data);
    redirect('user/login');
  }

  public function permission(){
    $data['result']=$this->db->where('emp_status','1')->get('employee')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("user/permission",$data);
  }

  




}
?>
