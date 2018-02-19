<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href=".<?php echo base_url();?>Frontend/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>Frontend/css/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url();?>Frontend/css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url();?>Frontend/css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Satitporn<b>Shop</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
                <?php echo form_open('user/register'); ?>
                    <div class="msg">Register a new member</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="emp_name" placeholder="FullName" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="emp_lastname" placeholder="LastName" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user_name" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="user_password" maxlength="10" placeholder="Password ไม่เกิน 10 ตัว" required>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" style="width:100%;height:40px;" type="submit">สมัครสมาชิก</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <span>มีบัญชีผู้ใช้อยู่แล้ว ? </span><a href="<?php echo base_url(); ?>admin">เข้าสู่ระบบ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
