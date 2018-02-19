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
<?php
$add=image_asset('icon/add.png');


echo "<div class='col-md-10'>";
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


  <?php
  echo "</div>";



  ?>
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
