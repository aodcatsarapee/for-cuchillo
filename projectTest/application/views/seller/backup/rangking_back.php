<html>
<head>
<title>อันดับสินค้าขายดีของ ร้านสถิตพรอะไหล่</title>
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
</head>
<body>
<?php
$num=1;
echo "<div class='col-md-10'>";
?>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th>อันดับ</th>
          <th>ชื่อสินค้า</th>
          <th>จำนวนที่ขายได้</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($ranking as $rking) {
        echo "<tr align='center'>";
            echo "<td>$num</td>";
            echo "<td>",$rking['sell_detail_name'],"</td>";
            echo "<td>",$rking['sell_detail_amount'],"</td>";
        echo "</tr>";
        $num++;
      }
      ?>
    </tbody>
</table>
<?php
  /*echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr class='thcenter'>";
    echo "<th colspan='3'>ข้อมูลจัดอันดับสินค้าขายดี</th>";
  echo "</tr>";
  echo "<tr class='thcenter'>";
      echo "<th>อันดับ</th>";
      echo "<th>ชื่อ</th>";
      echo "<th>จำนวนที่ขายได้</th>";
  echo "</tr>";
  echo "</thead>";

foreach ($ranking as $rking) {
  echo "<tbody>";
  echo "<tr align='center'>";
      echo "<td>$num</td>";
      echo "<td>",$rking['sell_detail_name'],"</td>";
      echo "<td>",$rking['sell_detail_amount'],"</td>";
  echo "</tr>";
  echo "</tbody>";
  $num++;
}

  echo "</table>";*/
echo "</div>";
?>


</body>
</html>

<script>
$(document).ready(function(){
    $('#example').DataTable();


});
</script>
