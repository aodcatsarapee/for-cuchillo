<html>
<head>
<title>ประวัติการสั่งซื้อของลูกค้า ร้านสถิตพรอะไหล่</title>
<style type="text/css">
.thcenter th{
  text-align:center;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>
<body>
<?php
$num=1;
echo "<div class='col-md-10'>";
$show=image_asset('icon/show.png');

//<!-- Form code begins -->
echo form_open('sell/history');
?>
  <div class="row">
    <div style="-webkit-flex-basis: 0;float:left;">
      <label class="control-label" for="date">วันที่เริ่มต้น</label>
      <input class="form-control" id="Startdate" name="Startdate"  placeholder="MM/DD/YYY" style="width:200px;" type="text"/>
    </div>
    <div style="-webkit-flex-basis: 0;float:left;">
      <label class="control-label" for="date">วันทีสิ้นสุด</label>
      <input class="form-control" id="Enddate" name="Enddate" placeholder="MM/DD/YYY" style="width:200px;" type="text"/>
    </div>
    <button class="btn btn-primary" style="margin-top:23px;margin-left:10px;" name="submit" id="submit" type="submit">Submit</button>
  </div>
 </form>
 <!-- Form code ends -->
<?php
echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
    echo "<tr class='thcenter'>";
      echo "<th colspan='9'>ประวัติรายการสินค้าที่ลูกค้าสั่ง</th>";
    echo "</tr>";
  echo "</thead>";
echo "</table>";

?>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th>#</th>
          <th>ลูกค้าที่ซื้อ</th>
          <th>ราคาทั้งหมด</th>
          <th>สถานะการชำระเงิน</th>
          <th>พนักงานที่ขาย</th>
          <th>วันที่ขายสินค้า</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
        foreach($product_sell as $pro_sell){
          echo "<tr>";
            echo "<td>",$pro_sell['sell_id'],"</td>";
            echo "<td>",$pro_sell['cus_name'],"</td>";
            echo "<td>",$pro_sell['pay_status'],"</td>";
            echo "<td>",$pro_sell['sell_status'],"</td>";
            echo "<td>",$pro_sell['emp_name'],"</td>";
            echo "<td>",$pro_sell['sell_date'],"</td>";
            echo "<td><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#showHis' id='idShowHistory' onclick='showHistoryAjax(",$pro_sell['sell_order_id'],")'>",$show,"</button></td>";
          echo "</tr>";
        }
      ?>
    </tbody>
</table>
<?php
echo "</div>";
?>
<!-- Start Edit Cus -->
<div class="modal fade" id="showHis" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:skyblue;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ข้อมูลขายสินค้า</h4>
          <!--<button type="button" style="margin-left:500px;" class="btn btn-default" id='mdCloseCus' data-dismiss="modal">Close</button>-->
        </div>
        <div class="modal-body" id='data'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='mdCloseCus' data-dismiss="modal">CLOSE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Cus -->
</body>
</html>

<script>
function addCommas(nStr)
{
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}

function showHistoryAjax (idShow){
    var idShow = idShow;
    $("#showHis").click();
    $.ajax({
      url: "<?php echo base_url() ?>sell/history_detail/",
      type: "POST",
      data: {
        "idShow" : idShow
      },
      dataType: 'json',
      success: function(data){
        $.each(data,function( key, value ){
          $("#data").append("ชื่อสินค้า : ",value.sell_detail_name," : ");
          $("#data").append(" จำนวน ",(addCommas(value.sell_detail_amount)),"  * ");
          $("#data").append(" ",(addCommas(value.sell_detail_price))," :: ");
          $("#data").append(" รวมราคา ",addCommas((value.sell_detail_price * value.sell_detail_amount)),"</p>");
        })
      },
      error: function(){
        alert('Error....');
        $("#mdCloseCus").click();
      }
    });
}

$(document).ready(function(){
    $('#example').DataTable();

    $(".modal").on("hidden.bs.modal", function(){
      $(".modal-body").html("");
    });

    $("#submit").click(function (){
        var StartDate = $("#Startdate").val();
        var EndDate  = $("#Enddate").val();

        $("#Startdate").val(StartDate);
    })

    var date_input=$('input[name="Startdate"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
    date_input.datepicker(options);

    var date_input=$('input[name="Enddate"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
    date_input.datepicker(options);

});
</script>
