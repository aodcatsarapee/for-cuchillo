<?php
/**
 * Created by PhpStorm.
 * User: aodca
 * Date: 2/20/2018
 * Time: 22:19
 */
?>

<div style="text-align: center;">
    <span style="font-size: 25px; font-weight: bold;">บันทึกสินค้าขายเชื่อ</span><br>
    <span style="font-size: 20px; font-weight: bold;">วันที่เอกสาร
        <?php

        $date = date_create($stock_detail->stock_detail_date);
        echo date_format($date, "d/m/Y "); ?>

    </span>
</div>

<span style="font-size: 20px; font-weight: bold;">สมาชิกชื่อ : <?php echo $customer['cus_name']; ?> </span> <span
        style="font-size: 20px;"><?php echo $stock_detail->partners_name; ?> </span>

<?php

echo "<table class='table table-striped table-bordered' cellspacing='0' width='100%'>";
echo "<thead class='thead-dark'>";
echo "<tr>";
  echo "<th style='text-align:left;'>เลขที่อ้างอิง</th>";
  echo "<th colspan='4'>วันที่ทำการซื้อเชื่อ</th>";
echo "</tr>";
echo "</thead>";

  foreach ($detail as $_detail) {
    echo "<tbody>";
    echo "<tr>";
      echo "<th style='text-align:left;'>",$_detail['sell_id'],"</th>";
      echo "<th colspan='4'>",$_detail['sell_detail_date'],"</th>";

      echo "<thead>";
      echo "<tr>";
        echo "<th>สินค้า</th>";
        echo "<th>จำนวน</th>";
        echo "<th style='text-align:right;'>ราคา/ชิ้น</th>";
        echo "<th style='text-align:right;'>ราคารวม</th>";
        echo "<th>สถานะ</th>";
      echo "</tr>";
      echo "</thead>";

      if($_detail['payment_month'] != '6'){
        $status = "อยู่ในช่วงผ่อนชำระ";
      }else{
        $status = "ชำระเสร็จสิ้น";
      }

      foreach ($detail_name as $__detail_name) {
        if($_detail['sell_detail_date'] == $__detail_name['sell_detail_date']){
          echo "<tr>";
            echo "<td>",$__detail_name['sell_detail_name'],"</td>";
            echo "<td style='text-align:center;'>",number_format($__detail_name['sell_detail_amount'])," ชิ้น</td>";
            echo "<td  style='text-align:right;'>",number_format($__detail_name['sell_detail_price'])," บาท</td>";
            echo "<td  style='text-align:right;'>",number_format($__detail_name['sell_detail_price']*$__detail_name['sell_detail_amount'])," บาท</td>";
            echo "<td style='text-align:center;'>",$status,"</td>";
          echo "</tr>";
        }
      }
    echo "</tr>";
    echo "<tr>";
      echo "<td colspan='5' style='text-align:right;'>ราคารวมดอกเบี้ย (10%) : ",number_format($_detail['sell_total'])," บาท</td>";
    echo "</tr>";
    echo "</tbody>";
  }
echo "</table>";

?>

<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;


    }
    th{
      font-weight: bold;
      font-size: 20px;
    }
    td{
      font-size: 18px;
    }
</style>
