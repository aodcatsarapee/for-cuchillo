<html>
<head>
<title>อันดับสินค้าขายดีของ ร้านสถิตพรอะไหล่</title>
<style type="text/css">
.thcenter th{
  text-align:center;
}
</style>
</head>
<body>
<?php
$num=1;
$profit=$income['sell_detail_price']-$cost['sell_detail_cost'];
echo "<div class='col-md-9'>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr class='thcenter'>";
    echo "<th colspan='4'>รายการสรุปข้อมูลรายรับ / รายจ่าย</th>";
  echo "</tr>";
  echo "<tr class='thcenter'>";
      echo "<th>อันดับ</th>";
      echo "<th>ต้นทุนรวมสินค้าที่ขายในวันนี้</th>";
      echo "<th>จำนวนเงินที่ขายได้ในวันนี้</th>";
      echo "<th>กำไรจากการขายสินค้า</th>";
  echo "</tr>";
  echo "</thead>";

  echo "<tbody>";
  echo "<tr align='center'>";
      echo "<td>$num</td>";
      echo "<td>",number_format($cost['sell_detail_cost']),"</td>";
      echo "<td>",number_format($income['sell_detail_price']),"</td>";
      echo "<td>",number_format($profit),"</td>";
  echo "</tr>";
  echo "</tbody>";

  echo "</table>";
echo "</div>";
?>
</body>
</html>
