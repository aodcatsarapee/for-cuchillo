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
        <strong>Save success</strong>
      </div>
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>จัดการข้อมูลลูกค้าขายเชื่อ</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                      <?php
                        echo "<table class='table'>";
                          echo "<thead class='thead-dark'>";
                            echo "<tr class='thcenter'>";
                              echo "<th colspan='9'>ข้อมูลลูกค้าขายเชื่อ</th>";
                            echo "</tr>";
                          echo "</thead>";
                        echo "</table>";
                        ?>

                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>รหัสลูกค้า</th>
                                  <th>รหัสการขาย</th>
                                  <th>รหัสบัตรประชาชน</th>
                                  <th>ชื่อ - นามสกุล</th>
                                  <th>ที่อยู่</th>
                                  <th>เบอร์โทร</th>
                                  <th>รายละเอียด</th>
                                  <th>วันที่ทำการซื้อ</th>
                                  <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              foreach($result as $data){
                                  echo "<tr>";
                                    echo "<td>".$data['cus_id']."</td>";
                                    echo "<td>".$data['sell_id']."</td>";
                                    echo "<td>".$data['cus_cardid']."</td>";
                                    echo "<td>".$data['cus_name']."</td>";
                                    echo "<td>".$data['cus_address']."</td>";
                                    echo "<td>".$data['cus_tel']."</td>";
                                    echo "<td>".anchor("debtor/detail/".$data['sell_order_id'],'<img src="'.base_url().'assets/images/icon/show.png" alt="Delete" width="30"/>'),"</td>";
                                    echo "<td>".$data['sell_date']."</td>";
                                    echo "<td align='center'>",$data['pay_status'],"</td>";
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
$('#example').DataTable();
$(document).ready(function(){
  $('#show_debtor').on('click',function(){
    var sellorder_id =  $("#sell_order_id").val();

    $.ajax({
        type : "POST",
        datatype : "json",
        url : "<?php base_url(); ?>".debetor/'74',
        success : function(data){
          console.log(data.sell_detail_name);
        },
        error : function(){
          alert("No Data");
        }
      });
    });
});
</script>
