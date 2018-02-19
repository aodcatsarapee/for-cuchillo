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
  .textcolor a:visited{color:white !important;}
</style>
</head>
<body>
<section class="content">
    <div class="container-fluid">
      <div class="alert alert-success hide">
        <strong>Save success</strong>
      </div>
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>ข้อมูลสินค้า</h2>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                          <a href='javascript:void(0);' onclick="EditEmp(<?php echo $result['product_id']; ?>)" style='margin-right:20px;' class="btn btn-default btn-lg waves-effect waves-light-blue">แก้ไข </a>
                          <?php
                            $back=image_asset('icon/back.png');
                            echo "<a href=",base_url(),"product class='btn btn-primary btn-lg waves-effect waves-light'>BACK </a>";
                          ?>
                        </ul>
                    </div>
                    <div class="body"  style="height:600px;">

                      <div class="col-1 col-sm-1 col-md-1">
                      </div>

                      <div class="col-4 col-sm-4 col-md-4">
                        <div class="card">
                          <div class="header">
                              <h2 align=center><?php echo $result['product_name']; ?></h2>
                          </div>
                          <div class="body">
                              <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                                  <!-- Wrapper for slides -->
                                  <div class="carousel-inner" role="listbox">
                                      <div class="item active">
                                           <img src="<?php echo base_url(); ?>assets/images/shop/product/<?php echo $result['product_picture']; ?>" style="width:300px;height:300px;">
                                          <div class="carousel-caption">
                                              <h2></h2>
                                              <p></p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>

                      <div class="col-1 col-sm-1 col-md-1">
                      </div>

                      <div class="col-6 col-md-4">
                          <?php
                          echo form_open();
                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>Barcode : </label> <input type='text' value=",$result['product_barcode']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>ต้นทุนสินค้า : </label> <input type='text' value=",$result['product_cost']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>ราคาสินค้า : </label> <input type='text' value=",$result['product_price']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>จำนวนสินค้า : </label> <input type='text' value=",$result['product_quantity']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>ประเภทสินค้า : </label> <input type='text' value=",$result['cate_name']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>แบนด์สินค้า : </label> <input type='text' value=",$result['band_name']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>Detail : </label> <textarea rows=4 class='form-control' disabled>",$result['product_detail'],"</textarea>";
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
