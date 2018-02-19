<style type='text/css'>
  .thcenter th{
    text-align:center;
  }
  .thcenterpdd th{
    text-align:center;
    padding-right:20px;
  }
  .pdd{

  }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
//echo css_asset('bootstrap.min.css');
echo "<div class='col-md-9'>";
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
      $avg_price = $numTotal / 6;
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
        echo "<td colspan='5' align='center'>จำนวนเงินที่ค้างชำระ : ",$total['payment_balance'],"</td>";
      echo "</tr>";
      echo "</tbody>";

      if($total['sell_status'] == 'ขายเชื่อ'){$credit='selected';$sell="";}else{$sell='selected';$credit="";}
      echo "<tbody>";
      echo "<tr>";
        echo "<td colspan='4' align='left'>";
          echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>ชำระเงิน</button> <button type='button' class='btn btn-info btn-lg'>".anchor("debtor/report_payment_debtor/".$_detail['sell_order_id'],"Print")."</button>";
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">รายละเอียดการชำระเงิน</h4>
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
                  echo "<td>",number_format($paytotal),"</td>";
                  echo form_open('debtor/payment/'.$id);
                      echo "<input type='hidden' name='total' value=",$_detail['sell_detail_price'],">";
                      echo "<input type='hidden' name='price' value=",$paytotal,">";
                      echo "<input type='hidden' name='payment_no' value=",$_detail['sell_order_id'],">";
                      echo "<td><button type='submit' id='payment",$i,"' class='btn btn-primary active'>ชำระเงิน</button></td>";
                  echo form_close();
                  echo "</tr>";
                }
              ?>
            <tr class='thcenter'>
              <th colspan="3">จำนวนเงินคงเหลือ : <?php echo number_format($_detail['payment_balance']); ?> บาท</th>
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
