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
  #print a:link{color:white;}
  #print a:visited{color:white;}
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
                      $button = "<button type='button' style='margin:20 0 20 250px;' class='btn btn-sm btn-danger' >เปลี่ยนสถานะ</button>";
                      echo "<table class='table'>";
                      echo "<thead class='thead-dark'>";
                      echo "<tr class='thcenter'>";
                        echo "<th colspan='5'>รายละเอียดสินค้าขายเชื่อ</th>";
                      echo "</tr>";
                      echo "<tr class='thcenter'>";
                        echo "<th>จำนวน</th>";
                        echo "<th>สินค้า</th>";
                        echo "<th>ราคา</th>";
                        echo "<th>จำนวนเดือนในการผ่อนชำระ</th>";
                        echo "<th>จำนวนเงินที่ต้องชำระต่อเดือน</th>";
                      echo "</tr>";
                      echo "</thead>";
                        foreach ($detail as $_detail) {
                          $id = $_detail['sell_id'];
                          $vat = ($_detail['sell_detail_price'] * $_detail['sell_detail_amount']) * 0.10;
                          $numTotal = ($_detail['sell_detail_price'] * $_detail['sell_detail_amount']) + $vat;
                          $avg_price = $total['payment_balance'] / 6;
                          $paytotal = $_detail['sell_total'] / 6;
                          echo "<input type='hidden' name='id' id='id' value=",$_detail['sell_id'],">";
                          echo "<input type='hidden' name='price' id='price' value=",number_format($avg_price),">";
                          echo "<input type='hidden' name='month' id='month' value=",$_detail['payment_month'],">";
                          echo "<tbody>";
                          echo "<tr align='center'>";
                            echo "<td>",$_detail['sell_detail_amount'],"</td>";
                            echo "<td>",$_detail['sell_detail_name'],"</td>";
                            echo "<td align='center'>",number_format($numTotal),"</td>";
                            echo "<td align='center'>6 เดือน</td>";
                            echo "<td align='center'>",number_format($avg_price),"</td>";
                          echo "</tr>";
                          echo "</tbody>";
                        }
                          echo "<tbody>";
                          echo "<tr>";
                            echo "<td colspan='5' align='center'>จำนวนเงินที่ค้างชำระ : ",number_format($total['payment_pay']),"</td>";
                          echo "</tr>";
                          echo "</tbody>";

                          if($total['sell_status'] == 'ขายเชื่อ'){$credit='selected';$sell="";}else{$sell='selected';$credit="";}
                          echo "<tbody>";
                          echo "<tr>";
                            echo "<td colspan='4' align='left'>";
                              //echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>ชำระเงิน</button> <button type='button' class='btn btn-info btn-lg' id='print'>".anchor("debtor/report_payment_debtor/".$_detail['sell_order_id'],"ออกใบแจ้งชำระเงิน")."</button>";
                              echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>ชำระเงิน</button>";
                            echo "</td>";
                          echo "</tr>";
                          echo "</tbody>";
                      echo "</table>";
                      //echo "<button type='button' class='btn btn-info btn-lg'>".anchor("debtor/report_payment_debtor/".$_detail['sell_order_id'],"Print")."</button>";
                    echo "</div>";
                      ?>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:gray;">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" style="text-align:center;">รายละเอียดการชำระเงิน</h4>
                            </div>
                            <div class="modal-body">
                              <table align='center'>
                                <tr class='thcenter'>
                                  <th colspan='5'>รายละเอียดสินค้าขายเชื่อ</th>
                                </tr>
                                <tr class='thcenter'>
                                  <!--<th>#</th>-->
                                  <th>งวดที่</th>
                                  <th>จำนวนเงิน</th>
                                  <th>Action</th>
                                </tr>

                                  <?php
                                    for($i=1; $i<=6; $i++){
                                      echo "<td>$i</td>";
                                      echo "<td>",number_format($avg_price),"</td>";
                                      echo form_open('debtor/payment/'.$id);
                                          echo "<input type='hidden' name='total' value=",$_detail['sell_detail_price'],">";
                                          echo "<input type='hidden' name='price' value=",$avg_price,">";
                                          echo "<input type='hidden' name='payment_no' value=",$_detail['sell_order_id'],">";
                                          echo "<td><button type='submit' id='payment",$i,"' class='btn btn-primary active'>ชำระเงิน</button></td>";
                                      echo form_close();
                                      echo "</tr>";
                                    }
                                  ?>
                                <tr class='thcenter'>
                                  <th colspan="3">จำนวนเงินคงเหลือ : <?php echo number_format($_detail['payment_pay']); ?> บาท</th>
                                </tr>
                              </table>
                              <span style='padding-left:400px;'></span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
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
<script>
var month = $("#month").val();
if(month == 1){
  $("#payment1").addClass( "disabled" );
  $("#payment1").prop("type", "button");
}else if(month == 2){
  $("#payment1").addClass( "disabled" );
  $("#payment1").prop("type", "button");
  $("#payment2").addClass( "disabled" );
  $("#payment2").prop("type", "button");
}else if(month == 3){
  $("#payment1").addClass( "disabled" );
  $("#payment1").prop("type", "button");
  $("#payment2").addClass( "disabled" );
  $("#payment2").prop("type", "button");
  $("#payment3").addClass( "disabled" );
  $("#payment3").prop("type", "button");
}else if(month == 4){
  $("#payment1").addClass( "disabled" );
  $("#payment1").prop("type", "button");
  $("#payment2").addClass( "disabled" );
  $("#payment2").prop("type", "button");
  $("#payment3").addClass( "disabled" );
  $("#payment3").prop("type", "button");
  $("#payment4").addClass( "disabled" );
  $("#payment4").prop("type", "button");
}else if(month == 5){
  $("#payment1").addClass( "disabled" );
  $("#payment1").prop("type", "button");
  $("#payment2").addClass( "disabled" );
  $("#payment2").prop("type", "button");
  $("#payment3").addClass( "disabled" );
  $("#payment3").prop("type", "button");
  $("#payment4").addClass( "disabled" );
  $("#payment4").prop("type", "button");
  $("#payment5").addClass( "disabled" );
  $("#payment5").prop("type", "button");
}else if(month == 6){
  $("#payment1").addClass( "disabled" );
  $("#payment1").prop("type", "button");
  $("#payment2").addClass( "disabled" );
  $("#payment2").prop("type", "button");
  $("#payment3").addClass( "disabled" );
  $("#payment3").prop("type", "button");
  $("#payment4").addClass( "disabled" );
  $("#payment4").prop("type", "button");
  $("#payment5").addClass( "disabled" );
  $("#payment5").prop("type", "button");
  $("#payment6").addClass( "disabled" );
  $("#payment6").prop("type", "button");
}


function Paymoney(){
  var idpaymoney = $("#id").val();
  var price = $('#price').val();

  $.ajax({
    url: "<?php echo base_url() ?>debtor/paymoney",
    type: "POST",
    data: {"price" : price,"id":idpaymoney},
    dataType: 'json',
    success: function(data){
        alert("สมัครสมาชิกสำเร็จ");
    },
    error: function(){
      alert('Error....');
    }
  });
}
</script>
