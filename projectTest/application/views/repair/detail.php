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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<style type='text/css'>
  .warring{background-color:#FFFF99;color:red;}
  .thcenter th{
    text-align:center;
  }

  .textcolor a:visited{color:white !important;}
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
                                <h2>ข้อมูลการซ่อม</h2>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                          <?php
                            $back=image_asset('icon/back.png');
                            echo "<button type='button' class='btn btn-primary btn-lg textcolor'>".anchor("repair","Back")."</button>";
                          ?>
                        </ul>
                    </div>
                    <div class="body" style="height:600px;">
                      <div class="col-6 col-sm-6 col-md-8">
                        <div class="w3-card-4" style="width:50%;margin:0 auto;">
                          <img src="<?php echo base_url(); ?>assets/images/shop/repair/<?php echo $result['repair_picture']; ?>" style="width:100%" height='200'>
                          <div class="w3-container w3-center">
                            <h2><?php echo  "รถ : ",$result['repair_type_name']."<br> ยี่ห้อ : ".$result['repair_band_name']."<br> ป้ายทะเบียน : ".$result['repair_label']; ?></h2>
                          </div>
                        </div>
                      </div>

                      <div class="col-6 col-md-4">
                          <?php
                          echo form_open();
                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>ชื่อลูกค้า : </label> <input type='text' name='cus_name' value=",$result['customer_name']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' name='cus_tel' class='form-control' value=",$result['customer_tel']," disabled maxlength='10'>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label for='comment'>สาเหตุที่ต้องการซ่อม:</label>";
                                echo "<textarea class='form-control' rows='5' name='repair_cause' disabled>",$result['repair_cause'],"</textarea>";
                              echo "</div>";
                            echo "</div>";

                            $newDetail = str_replace("+","\n",$detail_pro);
                            //$newDetailAmount = str_replace("+","\n",$detail_amount);
                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>อะไหล่ที่ใช้ : </label> <textarea name='repair_product' rows=5 disabled class='form-control'>",$newDetail,"</textarea>";
                              echo "</div>";
                            echo "</div>";

                            echo "</div>";
                            echo form_close();
                          ?>
                      </div>
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
