<!DOCTYPE html>
<html>
<head>
	<title>ใบเสร็จรับเงิน</title>
<meta charset="utf-8">
<script type="text/javascript">
	window.print()
</script>
<style type="text/css" media="print">
input{
    display:none;
}
</style>
</head>
<body>
	<?php
	echo anchor('sell','ขายใหม่');
	?>
	<!--
  <input type="button" name="button" id="button" value="ขายใหม่" style="font-size:25px; margin-left:10px; margin-top:10px;"></button>
-->

<div style="font-size:28px; text-align: center;">
<?php echo "ร้าน สถิสถิตพรอะไหล่"; ?>
</div>

<br>
<div align="center" style="font-size:20;">ใบเสร็จรับเงิน</div>
<div align="center">
    <table style="font-size:18px;">
        <tr>
            <td>เลขกำกับภาษี : </td>
            <td style="text-align:center;"><?php echo "1-46349501-3" ?></td>
        </tr>
        <tr>
            <td>วันที่ : </td>
            <td style="padding-left:2px;"><?php echo  date('Y-m-d'); ?></td>
        </tr>
    </table>
    <hr style="text-align:center;width:350px;">
</div>

<br>
<div>
    <table style="font-size:14px;" align="center">
        <tr>
        <td style="text-align:center;">qty</td>
        <td style="text-align:left;">ชื่อ</td>
        <td style="text-align:center;">ราคา</td>
        <td style="text-align:center;">รวม</td>
      </tr>
<?php
    foreach($product_sell as $pro_sell){
        $product_price=$pro_sell['sell_detail_price'];
        $total=$pro_sell['sell_detail_amount']*$pro_sell['sell_detail_price'];
?>
        <tr>
            <td style="text-align:left;"><?php echo $pro_sell['sell_detail_amount']; ?></td>
            <td><?php echo $pro_sell['sell_detail_name']; ?></td>
            <td style="text-align:center;"><?php echo number_format($product_price); ?></td>
            <td style="text-align:right;"><?php echo number_format($total); ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
        </tr>
<?php
}
?>
    </table>
</div>
<br>
<div align="center">
    <table style="font-size:15px;">
        <tr>
            <td>รวมราคา</td>
            <td><?php echo number_format($product['sell_total'], 2, '.', ',') ?></td>
            <td>บาท</td>
        </tr>
        <tr>
            <td>เงินสดรับ</td>
            <td><?php echo number_format($product['sell_receive'], 2, '.', ',') ?></td>
            <td>บาท</td>
        </tr>
        <tr>
            <td>เงินถอน</td>
            <td><?php echo number_format($product['sell_change'], 2, '.', ',')  ?></td>
            <td>บาท</td>
        </tr>
    </table>
</div>
<hr style="text-align:center;width:350px;">
<p style="text-align:center;font-size:24px;">ขอบคุณที่มาอุดหนุน</p>
<?php
	//echo "<script>window.location='sales_management.php'</script>";
?>
</body>
</html>
