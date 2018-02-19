<html>
<head>
<title>ข้อมูลการส่งสินค้าของ ร้านสถิตพรอะไหล่</title>
<style type='text/css'>
  .thcenter th{
    text-align:center;
  }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
<?php //echo css_asset('bootstrap.min.css'); ?>
<body>
<?php
$add=image_asset('icon/add.png');
$show=image_asset('icon/show.png');
$change=image_asset('icon/change.png');
$print=image_asset('icon/print.png');
echo "<div class='col-md-10'>";
      echo "<table class='table'>";
      echo "<thead class='thead-dark'>";
       echo "<tr class='thcenter'>";
         echo "<th colspan='7'>ข้อมูลการส่งสินค้า</th>";
       echo "</tr>";
       echo "</thead>";
       echo "</table>";
?>

<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th>รหัส Order</th>
          <th>ชื่อ - นามสกุล ผู้รับสินค้า</th>
          <th>ที่อยู่ผู้รับสินค้า</th>
          <th>เบอร์โทรศัพท์ผู้รับสินค้า</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach($delivery as $_delivery){
          echo "<tr>";
            echo "<td>".$_delivery['sell_order_id']."</td>";
            echo "<td>".$_delivery['member_firstname']." ".$_delivery['member_lastname']."</td>";
            echo "<td>".$_delivery['member_address']."</td>";
            echo "<td>".$_delivery['member_tel']."</td>";
            echo "<td><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#showHis' id='idShowHistory' onclick='showHistoryAjax(",$_delivery['sell_order_id'],")'>",$show,"</button><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#changeDelivery' id='idEdit' onclick='editEmpAjax(",$detail['user_id'],")'>",$change,"</button>".anchor("delivery/print/".$_delivery['sell_order_id'],$print),"</td>";
          echo "</tr>";
      }
      ?>
    </tbody>
</table>

<?php
echo "</div>";
 ?>
 <!-- Start change Delivery -->
 <div class="modal fade" id="changeDelivery" role="dialog">
     <div class="modal-dialog">

       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">สถานะการส่งสินค้า</h4>
         </div>
         <div class="modal-body">

           <?php
           echo form_open('delivery/change_status/'.$_delivery['sell_order_id']);  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
           echo "<div class='form-group'>";
             echo "<label for='position'>สถานะ : </label>";
             echo "<select class='form-control' id='Status' name='Status' style='height:34px;'>";
               echo "<option value='2'>จัดส่งเรียบร้อย</option>";
             echo "</select>";
           echo "</div>";
           ?>

           <span style='padding-left:400px;'></span>
         </div>
         <div class="modal-footer">
           <?php
           echo "<input type='submit' class='btn btn-success' value='Change' name='saveProduct1' id='saveProduct1'>";
           echo form_close();
           ?>
         </div>
       </div>

     </div>
   </div>
 <!-- End change Delivery -->

 <!-- Start Edit Cus -->
 <div class="modal fade" id="showHis" role="dialog">
     <div class="modal-dialog">

       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header" style="background-color:skyblue;">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">ข้อมูลการส่งสินค้าสินค้า</h4>
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
      url: "<?php echo base_url() ?>delivery/detail/",
      type: "POST",
      data: {
        "idShow" : idShow
      },
      dataType: 'json',
      success: function(data){
        $.each(data,function( key, value ){
          $("#data").append("ชื่อสินค้า : ",value.sell_detail_name," : ");
          $("#data").append(" จำนวน ",(addCommas(value.sell_detail_amount))," อัน </p> ");
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

});
</script>
