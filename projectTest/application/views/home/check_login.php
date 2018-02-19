<?php
        $session=array(
            "username"=>$result_user['user_name'],
            "password"=>$result_user['user_password'],
            "type"=>$result_user['user_position']
        );
        $this->session->set_userdata($session);

        //$this->session->set_userdata('username',$result_user['user_username']); //parameter ตัวแรกจะเป็นชื่อ session ตัวที่ 2 เป็นค่าของ session
        //$this->session->set_userdata('password',$result_user['user_password']); //parameter ตัวแรกจะเป็นชื่อ session ตัวที่ 2 เป็นค่าของ session

        if($result_user['user_position']=="1"){ //ผู้ดูแลระบบ
          redirect('admin/manage');
        }else if($result_user['user_position']=="2"){ //เจ้าของร้าน
          redirect('owner/sell');
        }else if($this->session->userdata['type']=="3"){ //พนักงานขาย
          redirect('owner/home');
        }else if($this->session->userdata['type']=="4"){//พนักงานส่งของ
          redirect('owner/home');
        }else if($this->session->userdata['type']=="5"){//พนักงานซ่อม
          redirect('owner/home');
        }else if($result_user['user_position']==""){
          //$error['message']="Username หรือ Password ไม่ถูกต้อง !";
          $this->load->view("home/index",$error);
        }




?>
