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
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>จัดการข้อมูลเงินเดือนพนักงาน</h2>
                            </div>
                        </div>
                        <!--<ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>-->
                    </div>
                    <div class="body" style="height:600px;">
                    <?php
                      $add=image_asset('icon/add.png');
                      $edit=image_asset('icon/edit.png');
                      $del=image_asset('icon/del.png');
                      $show=image_asset('icon/show.png');
                      $reload=image_asset('icon/reload.png');
                      echo "<table class='table'>";
                        echo "<thead class='thead-dark'>";
                          echo "<tr class='thcenter'>";
                            echo "<th colspan='9'>ข้อมูลเงินเดือนพนักงาน</th>";
                          echo "</tr>";
                        echo "</thead>";
                      echo "</table>";
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>รหัสพนักงาน</th>
                                <th>ยูสเซอร์พนักงาน</th>
                                <th>ชื่อพนักงาน</th>
                                <th>ค่าแรง/วัน</th>
                                <th>จำนวนวันเข้าทำงาน</th>
                                <th>จำนวนวันหยุดของร้าน</th>
                                <th>รวมจำนวนเงิน</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach($result as $detail){
                                echo "<tr>";
                                  echo "<td>".$detail['user_id']."</td>";
                                  echo "<td>".$detail['user_name']."</td>";
                                  echo "<td>",$detail['emp_name']."</td>";
                                  echo "<td>".number_format($detail['emp_baseSalary'])."</td>";
                                  echo "<td>".$detail['emp_workDay']."</td>";
                                  echo "<td>".$detail['emp_workHoliday']."</td>";
                                  echo "<td>".number_format($detail['emp_baseSalary'] * ($detail['emp_workDay'] + $detail['emp_workHoliday']))."</td>";
                                  echo "<td>".anchor("employee/salary_detail/".$detail['user_name'],$show).anchor("employee/get_workDay/".$detail['user_name'],$reload)."</td>";
                                  //.anchor("employee/delete/".$detail['user_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))
                                echo "</tr>";
                            }
                            ?>
                          </tbody>
                      </table>
                    </div>
              </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>



<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>

<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.categories.js"></script>-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/morris.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</head>
</body>
</html>
<script>
$(document).ready(function(){
    $('#example').DataTable();

});

</script>
