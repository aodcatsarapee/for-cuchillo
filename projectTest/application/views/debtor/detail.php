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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

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
                        <ul class="header-dropdown m-r--5">
                          <?php
                            $back=image_asset('icon/back.png');
                              echo "<a href=",base_url(),"debtor class='btn btn-primary btn-lg waves-effect waves-light'>BACK </a>";
                          ?>
                        </ul>
                    </div>
                    <div class="body">
                      <?php
                      $button = "<button type='button' style='margin:20 0 20 250px;' class='btn btn-sm btn-danger' >เปลี่ยนสถานะ</button>";
                      echo "<table class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                      echo "<thead class='thead-dark'>";
                      echo "<tr class='thcenter'>";
                        echo "<th colspan='6'>รายละเอียดสินค้าขายเชื่อ</th>";
                      echo "</tr>";
                      echo "<tr>";
                        echo "<th>วันที่ทำการซื้อเชื่อ</th>";
                        echo "<th>สินค้า</th>";
                        echo "<th>จำนวน</th>";
                        echo "<th>ราคา</th>";
                        echo "<th>เดือนในการผ่อนชำระ</th>";
                        echo "<th>ชำระต่อเดือน</th>";
                      echo "</tr>";
                      echo "</thead>";
                        foreach ($detail as $_detail) {
                          $id = $_detail['sell_id'];
                          $vat = ($_detail['sell_detail_price'] * $_detail['sell_detail_amount']) * 0.10;
                          $numTotal = ($_detail['sell_detail_price'] * $_detail['sell_detail_amount']) + $vat;
                          $avg_price = $total['payment_balance'] / 6;
                          $paytotal = $_detail['sell_total'] / 6;
                          $payMonth = $numTotal/6;
                          echo "<input type='hidden' name='id' id='id' value=",$_detail['sell_id'],">";
                          echo "<input type='hidden' name='price' id='price' value=",number_format($avg_price),">";
                          echo "<input type='hidden' name='month' id='month' value=",$_detail['payment_month'],">";
                          echo "<tbody>";
                          echo "<tr>";
                            echo "<td>",$_detail['sell_date'],"</td>";
                            echo "<td>",$_detail['sell_detail_name'],"</td>";
                            echo "<td>",number_format($_detail['sell_detail_amount'])," ชิ้น</td>";
                            echo "<td>",number_format($numTotal)," บาท</td>";
                            echo "<td align='center'>6 เดือน</td>";
                            echo "<td align='center'>",number_format($payMonth)," บาท</td>";
                          echo "</tr>";
                          echo "</tbody>";
                        }
                        $day = substr($date=$_detail['sell_date'],8,2);
                        $month = substr($date=$_detail['sell_date'],5,2);
                        echo "<input type='hidden' id='PayTomonth' value=",$month,">";
                        echo "<input type='hidden' id='PayToday' value=",$day,">";
                          echo "<tbody>";
                          echo "<tr>";
                            echo "<td colspan='5' align='center'>จำนวนเงินที่ค้างชำระ : ",number_format($total['payment_pay']),"</td>";
                          echo "</tr>";
                          echo "</tbody>";

                          if($total['sell_status'] == 'ขายเชื่อ'){$credit='selected';$sell="";}else{$sell='selected';$credit="";}
                          echo "<tbody>";
                          echo "<tr>";
                            echo "<td colspan='6' align='left'>";
                              //echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>ชำระเงิน</button> <button type='button' class='btn btn-info btn-lg' id='print'>".anchor("debtor/report_payment_debtor/".$_detail['sell_order_id'],"ออกใบแจ้งชำระเงิน")."</button>";
                              echo "<button type='button' id='pay' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>ชำระเงิน</button>";
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
                            <div class="modal-header" style="background-color:#336699;">
                              <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                              <h4 class="modal-title" style="text-align:center;color:white;">รายละเอียดการชำระเงิน</h4>
                            </div>
                            <div class="modal-body">
                              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                      <th>งวดที่</th>
                                      <th>วันที่่ต้องชำระ</th>
                                      <th>จำนวนเงิน</th>
                                      <th>Action</th>
                                      <th>ชำระเมื่อ</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                  <tr align='right'>
                                    <td colspan="7"><strong>จำนวนเงินคงเหลือที่ต้องชำระ : <?php echo number_format($_detail['payment_pay']); ?> บาท</strong></td>
                                  </tr>
                                </tfoot>
                                <tbody>
                                  <?php
                                  for($i=1; $i<=6; $i++){
                                    echo "<tr>";
                                    echo "<td>$i</td>";
                                    echo "<td id='pMonth",$i,"'></td>";
                                    echo "<td>",number_format($avg_price)," บาท</td>";
                                    echo form_open('debtor/payment/'.$id);
                                        echo "<input type='hidden' name='total' value=",$_detail['sell_detail_price'],">";
                                        echo "<input type='hidden' name='price' value=",$avg_price,">";
                                        echo "<input type='hidden' name='payment_no' value=",$_detail['sell_order_id'],">";
                                        echo "<td><button type='submit' id='payment",$i,"' class='btn btn-primary active'>ชำระเงิน</button></td>";
                                    echo form_close();
                                    foreach ($payment as $_payment) {
                                      if($i == $_payment['product_payment_month']){
                                        echo "<td>",$_payment['product_payment_date'],"</td>";
                                      }
                                    }
                                    echo "</tr>";
                                  }
                                ?>
                                </tbody>
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

$(document).ready(function(){

  $('#example').DataTable();

  $("#pay").click(function(){
    var monthtoPay = $("#PayTomonth").val();
    var daytoPay = $("#PayToday").val();
    var d = new Date();
    //var n = d.getMonth();
    var n = 10
    var Realmonth = n +1;
    var totalMonth = parseInt(monthtoPay) + 1;
    var checkYear = Realmonth + parseInt(monthtoPay);
    var y = d.getFullYear();
    var NameMonth = "";
    var YearInThai = parseInt(y)+543;

    for(var i=1; i<=6; i++){
      if(totalMonth == 1){
        NameMonth = "มกราคม";
      }else if(totalMonth == 2){
        NameMonth = "กุมภาพันธ์";
      }else if(totalMonth == 3){
        NameMonth = "มีนาคม";
      }else if(totalMonth == 4){
        NameMonth = "เมษายน";
      }else if(totalMonth == 5){
        NameMonth = "พฤษภาคม";
      }else if(totalMonth == 6){
        NameMonth = "มิถุนายน";
      }else if(totalMonth == 7){
        NameMonth = "กรกฏาคม";
      }else if(totalMonth == 8){
        NameMonth = "สิงหาคม";
      }else if(totalMonth == 9){
        NameMonth = "กันยายน";
      }else if(totalMonth == 10){
        NameMonth = "ตุลาคม";
      }else if(totalMonth == 11){
        NameMonth = "พฤศจิกายน";
      }else if(totalMonth == 12){
        NameMonth = "ธันวาคม";
      }
      totalMonth += 1;

      if(totalMonth > 12){
        totalMonth = 1;
        YearInThai += 1
      }

      $('#pMonth' + i).text(daytoPay + '/' + NameMonth + '/' +YearInThai);
      $('#pYear' + i).text(YearInThai);
    }
  });

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

});
</script>
