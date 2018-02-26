<?php
/**
 * Created by PhpStorm.
 * User: aodca
 * Date: 2/20/2018
 * Time: 22:19
 */
?>

<div style="text-align: center;">
		<span style="font-size: 25px; font-weight: bold;">ร้าน สถิตพรอะไหล่</span><br>
    <span style="font-size: 25px; font-weight: bold;">รายงานแสดงรายละเอียดการซื้อเชื่อ</span><br>
    <span style="font-size: 20px; font-weight: bold;">วันที่เอกสาร
        <?php

        $date = date_create($stock_detail->stock_detail_date);
        echo date_format($date, "d/m/Y ");

				$day = substr($date=$total['sell_date'],8,2);
				$month = substr($date=$total['sell_date'],5,2);
				$year = substr($date=$total['sell_date'],0,4);
				$month += 1;
				$avg_price = $total['payment_balance'] / 6;
				 ?>

    </span>
</div>
<span style="font-size: 20px; font-weight: bold;">พนักงานที่ออกเอกสาร : <?php echo $this->session->userdata['name']; ?></span><br>
<span style="font-size: 20px; font-weight: bold;">ชื่อลูกค้า : <?php echo $total['cus_name']; ?> </span> <span
        style="font-size: 20px;"><?php echo $stock_detail->partners_name; ?> </span>

				<table class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
							<tr>
								<th>งวดที่</th>
								<th>วันที่่ต้องชำระ</th>
								<th>จำนวนเงิน</th>
								<th>วันที่ชำระ</th>
							</tr>
					</thead>
					<tfoot>
						<tr align='right'>
							<td colspan="4"  style='text-align:right;'><strong>จำนวนเงินคงเหลือที่ต้องชำระ : <?php echo number_format($detail['payment_pay']); ?> บาท</strong></td>
						</tr>
					</tfoot>
					<tbody>
						<?php
						for($i=1; $i<=6; $i++){
							if($month == 1){
				        $nameMonth = "มกราคม";
				      }else if($month == 2){
				        $nameMonth = "กุมภาพันธ์";
				      }else if($month == 3){
				        $nameMonth = "มีนาคม";
				      }else if($month == 4){
				        $nameMonth = "เมษายน";
				      }else if($month == 5){
				        $nameMonth = "พฤษภาคม";
				      }else if($month == 6){
				        $nameMonth = "มิถุนายน";
				      }else if($month == 7){
				        $nameMonth = "กรกฏาคม";
				      }else if($month == 8){
				        $nameMonth = "สิงหาคม";
				      }else if($month == 9){
				        $nameMonth = "กันยายน";
				      }else if($month == 10){
				        $nameMonth = "ตุลาคม";
				      }else if($month == 11){
				        $nameMonth = "พฤศจิกายน";
				      }else if($month == 12){
				        $nameMonth = "ธันวาคม";
				      }
							$month+=1;
							echo "<tr>";
							echo "<td style='text-align:center;'>$i</td>";
							echo "<td style='text-align:center;' id='pMonth'>",$day,"/",$nameMonth,"/",$year,"</td>";
							echo "<td style='text-align:center;'>",number_format($avg_price)," บาท</td>";
							if(!empty($payment)){
								foreach ($payment as $_payment) {
									if($i == $_payment['product_payment_month']){
										echo "<td style='text-align:center;'>",$_payment['product_payment_date'],"</td>";
									}
								}
							}else{
								echo "<td style='text-align:center;'>-</td>";
							}

							echo "</tr>";
						}
					?>
					</tbody>
				</table>


				<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>

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
</script>
