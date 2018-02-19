<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Satitporn<b>Shop</b></a>
            <small></small>
        </div>
        <div class="card">
          <div class="alert alert-danger hide">
              <strong> &nbsp;Username & Password</strong> ไม่ถูกต้องโปรดลองอีกครั้ง
          </div>
            <div class="body">
                    <div class="msg"></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user_name" id='user_name' placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="user_password" id='user_password' placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" id='Login' style="height:40px;width:100%;" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="<?php echo base_url(); ?>user/signup">สมัครสมาชิก !</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <!--<a href="forgot-password.html">Forgot Password?</a>-->
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>Frontend/js/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url();?>Frontend/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url();?>Frontend/js/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url();?>Frontend/js/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url();?>Frontend/js/admin.js"></script>
    <script src="<?php echo base_url();?>Frontend/js/sign-in.js"></script>
</body>

</html>
<script>
$(document).ready(function(){
  $("#Login").click(function(){
    var user_name = $("#user_name").val();
    var password = $("#user_password").val();
    $.ajax({
      url: "<?php echo base_url() ?>user/check_login",
      type: "POST",
      data: {
        "user_name" : user_name,
        "user_password" : password
      },
      dataType: 'json',
      success: function(data){
        if(data.user_position == "1"){ //ผู้ดูแลระบบ
          swal("เข้าสู่ระบบสำเร็จ", "", "success")
          .then((value) => {
            window.location = "<?php echo base_url(); ?>user";
          });
        }else if(data.user_position=="2"){ //เจ้าของร้าน
          swal("เข้าสู่ระบบสำเร็จ", "", "success")
          .then((value) => {
            window.location = "<?php echo base_url(); ?>owner/home";
          });

          //alert('OK');
        }else if(data.user_position=="3"){ //พนักงานขาย
          swal("เข้าสู่ระบบสำเร็จ", "", "success")
          .then((value) => {
            window.location = "<?php echo base_url(); ?>sell";
          });
        }else if(data.user_position=="4"){//พนักงานส่งของ
          swal("เข้าสู่ระบบสำเร็จ", "", "success")
          .then((value) => {
            window.location = "<?php echo base_url(); ?>owner/home";
          });
        }else if(data.user_position=="5"){//พนักงานซ่อม
          swal("เข้าสู่ระบบสำเร็จ", "", "success")
          .then((value) => {
            window.location = "<?php echo base_url(); ?>owner/home";
          });
        }else{
          swal("ไม่สามารถเข้าสู่ระบบได้", "กรุณาติดต่อผู้ดูแลระบบ", "warning")
          .then((value) => {
            window.location = "<?php echo base_url(); ?>admin";
          });
        }
      },
      error: function(){
        swal({
          title: "ไม่สามารถเข้าใช้งานได้",
          text: "Username หรือ Password ไม่ถูกต้องกรุณาลองอีกครั้ง",
          icon: "error",
          button: "Ok !",
        })
        .then((value) => {
          window.location = "<?php echo base_url(); ?>admin";
        });
      }
    });
  });
});
</script>
