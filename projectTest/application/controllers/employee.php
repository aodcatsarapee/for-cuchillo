<?php
class employee extends CI_Controller{

  public function _construct(){
    parent_construct();
  }

  public function index(){
    $data['result']=$this->db->get('employee')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("employee/index",$data);
  }

  public function form_insert(){
    $position=$this->db->get('position');
    $position_name=$this->db->get('employee');

    $data['position']=$position->result_array();
    $data['position_name']=$position_name->result_array();

    $this->load->view("employee/form_insert",$data);
  }

  public function insert(){
    $config['upload_path'] = 'images/employee/';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
    $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย
    $this->load->library('upload',$config);

        if($this->upload->do_upload('picture_employee')) //ถ้า upload ไม่มีปัญหา
        {
          $picture_employee=$this->upload->data();
          rename($picture_employee['full_path'],$picture_employee['file_path'].date("YmdHis").$picture_employee['file_ext']);
          $config['image_library']="gd2";
          $config['source_image']=$picture_employee['file_path'].date("YmdHis").$picture_employee['file_ext'];
          $config['width']=600;
          $config['height']=600;
          $this->load->library("image_lib",$config);
          $this->image_lib->resize();
          $picture_employee = date("YmdHis").$picture_employee['file_ext'];
        }
        else
        {
          $picture_employee = "default.jpg";
        }

        $data=array(
            "user_name"=>$this->input->post("username"),
            "user_password"=>$this->input->post("password"),
            "user_position"=>$this->input->post("position"),
            "emp_idcard"=>$this->input->post("id_card"),
            "emp_prename"=>$this->input->post("prename"),
            "emp_name"=>$this->input->post("fristname"),
            "emp_lastname"=>$this->input->post("lastname"),
            "emp_age"=>$this->input->post("age"),
            "emp_address"=>$this->input->post("address"),
            "emp_tel"=>$this->input->post("tel"),
            "emp_picture"=>$picture_employee,
            "emp_status"=>'1',
            "emp_start_work"=>date('Y-m-d H:i:s')
          );

          $this->db->insert("employee",$data); //ทำการ insert ไปยังตาราง employee โดยใช้ข้อมูลในตัวแปร data
          //echo json_encode($data);
          redirect("employee","refesh"); //กลับหน้าเดิม
          exit();

        /*}else{
          $picture_employee="default.jpg";
          $data=array(
              "user_name"=>$this->input->post("user_name"),
              "user_password"=>$this->input->post("user_password"),
              "user_position"=>$this->input->post("position_employee"),
              "emp_idcard"=>$this->input->post("idcard_employee"),
              "emp_prename"=>$this->input->post("prename_employee"),
              "emp_name"=>$this->input->post("name_employee"),
              "emp_lastname"=>$this->input->post("lastname_employee"),
              "emp_age"=>$this->input->post("age_employee"),
              "emp_address"=>$this->input->post("address_employee"),
              "emp_tel"=>$this->input->post("tel_employee"),
              "emp_picture"=>$picture_employee
            );*/

          //$this->db->insert("employee",$data); //ทำการ insert ไปยังตาราง employee โดยใช้ข้อมูลในตัวแปร data
          //redirect("employee","refesh"); //กลับหน้าเดิม
          //exit();
        //}
      //}
  }

  public function detail($user_id){
    $data['result']=$this->db->where("user_id",$user_id)->join('position','employee.user_position = position.position_id')->get('employee')->row_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();

    $this->load->view("home/header",$data);
    $this->load->view("employee/detail",$data);
  }

  public function form_update(){
    $id=$this->input->post("idEdit");
    $data=$this->db->where("user_id",$id)->get("employee")->row_array();
    echo json_encode($data);
  }

  public function update(){
    $config['upload_path'] = 'images/employee/';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
    $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย
    $this->load->library('upload',$config);

        if($this->upload->do_upload('Edit_emp_picture')) //ถ้า upload ไม่มีปัญหา
        {
          $picture_employee=$this->upload->data();
          rename($picture_employee['full_path'],$picture_employee['file_path'].date("YmdHis").$picture_employee['file_ext']);
          $config['image_library']="gd2";
          $config['source_image']=$picture_employee['file_path'].date("YmdHis").$picture_employee['file_ext'];
          $config['width']=600;
          $config['height']=600;
          $this->load->library("image_lib",$config);
          $this->image_lib->resize();
          $picture_employee = date("YmdHis").$picture_employee['file_ext'];
        }
        else
        {
          $picture_employee = $this->input->post("old_emp_picture");
        }

    $user_id=$this->input->post("edit_userid");
    $data=array(
        "user_name"=>$this->input->post("edit_username"),
        "user_password"=>$this->input->post("edit_password"),
        "user_position"=>$this->input->post("position"),
        "emp_idcard"=>$this->input->post("edit_id_card"),
        "emp_prename"=>$this->input->post("edit_prename"),
        "emp_name"=>$this->input->post("edit_fristname"),
        "emp_lastname"=>$this->input->post("edit_lastname"),
        "emp_age"=>$this->input->post("edit_age"),
        "emp_address"=>$this->input->post("edit_address"),
        "emp_tel"=>$this->input->post("edit_tel"),
        "emp_picture"=>$picture_employee,
        "emp_status"=>$this->input->post("status"),
        "emp_baseSalary"=>$this->input->post("edit_baseSalary")
      );
    $this->db->where("user_id",$user_id)->update("employee",$data); //ทำการ insert ไปยังตาราง employee โดยใช้ข้อมูลในตัวแปร data
    //echo json_encode($data);
    redirect("employee","refesh"); //กลับหน้าเดิม
    exit();
  }

  public function delete(){
      $user_id=$this->input->post('Del_id');
      $data=$this->db->delete("employee",array('user_id'=>$user_id));
      echo json_encode($data);
      /*redirect("employee","refesh");
      exit();*/
  }

  public function salary(){
    $data['result']=$this->db->where('emp_status','1')->get('employee')->result_array();
    $data['employee']=$this->db->where('user_name',$this->session->userdata('username'))->get('employee')->row_array();
    $this->load->view("home/header",$data);
    $this->load->view("employee/salary",$data);
  }

  public function get_workDay($username){
    $emp=$this->sale_model->get_login_same($username);
    $data=$this->sale_model->get_login($username);
    $start = substr($data['login_start'],11,2);
    $end = substr($data['login_end'],11,2);

    echo $sum_work = $start - $end;

    if($end != '0'){
      if($sum_work >= '8'){  //|| $sum_work <= '-8'
        $work = '1';
        $IsInactive = '1';
      }else{
        $work = '0';
        $IsInactive = '0';
      }
    }

    $sum = $emp['emp_workDay'] + $work;
    $result=array(
      "emp_workDay"=>$sum
    );

    $login=array(
      "login_IsInactive"=>$IsInactive
    );

    $this->db->where("user_name",$data['login_user'])->update("employee",$result);
    $this->db->where("login_user",$data['login_user'])->where("login_IsInactive !=",'1')->update("login_time",$login);
    redirect("employee/salary","refesh");
    exit();
  }

  public function salary_detail($username){
    $data['salary'] = $this->db->where("login_user",$username)->get('login_time')->result_array();

    $this->load->view("home/header",$data);
    $this->load->view("employee/salary_detail",$data);
  }

  public function update_byEmp($id){
    $config['upload_path'] = 'images/employee/';  //ตำแหน่งโฟร์เดอร์เก็ยไฟล์
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '0'; //ขนาดเป็น kb 0 คือไม่จำกัดขนาด
    $config['remove_spaces'] = TRUE;  //เจอช่องว่าง ติดมาบนชื่อไฟล์จะทำการเปลี่ยนเป็น _  หรือเครื่องหมาย underscore ให้เลย
    $this->load->library('upload',$config);

        if($this->upload->do_upload('Edit_emp_picture')) //ถ้า upload ไม่มีปัญหา
        {
          $picture_employee=$this->upload->data();
          rename($picture_employee['full_path'],$picture_employee['file_path'].date("YmdHis").$picture_employee['file_ext']);
          $config['image_library']="gd2";
          $config['source_image']=$picture_employee['file_path'].date("YmdHis").$picture_employee['file_ext'];
          $config['width']=600;
          $config['height']=600;
          $this->load->library("image_lib",$config);
          $this->image_lib->resize();
          $picture_employee = date("YmdHis").$picture_employee['file_ext'];
        }
        else
        {
          $picture_employee = $this->input->post("old_emp_picture");
        }

    $user_id=$this->input->post("edit_userid");
    $data=array(
        "user_name"=>$this->input->post("edit_username"),
        "user_password"=>$this->input->post("edit_password"),
        "emp_idcard"=>$this->input->post("edit_id_card"),
        "emp_prename"=>$this->input->post("edit_prename"),
        "emp_name"=>$this->input->post("edit_fristname"),
        "emp_lastname"=>$this->input->post("edit_lastname"),
        "emp_age"=>$this->input->post("edit_age"),
        "emp_address"=>$this->input->post("edit_address"),
        "emp_tel"=>$this->input->post("edit_tel"),
        "emp_picture"=>$picture_employee,
      );
    $this->db->where("user_id",$user_id)->update("employee",$data); //ทำการ insert ไปยังตาราง employee โดยใช้ข้อมูลในตัวแปร data
    //echo json_encode($data);
    redirect("employee/detail/$user_id","refesh"); //กลับหน้าเดิม
    exit();
  }

}



?>
