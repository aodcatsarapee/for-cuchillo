<?php
  if($this->session->userdata['type'] == '1' OR $this->session->userdata['type'] == '2'){
 ?>
<html>
<head>
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<style type='text/css'>
  .warring{background-color:#FFFF99;color:red;}
  .thcenter th{
    text-align:center;
  }
</style>
</head>
<body>
<section class="content">
    <div class="container-fluid">
      <div class="alert alert-success hide">
        <strong>Save Success</strong>
      </div>
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>จัดการสิทธิ์การเข้าใช้งาน</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                      
                    </div>
              </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</head>
</body>
</html>
<script>
$(document).ready(function(){

});
</script>
<?php
}else{
  redirect('admin');
}
?>
