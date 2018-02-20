<?php
/**
 * Created by PhpStorm.
 * User: aodca
 * Date: 2/20/2018
 * Time: 22:19
 */
?>

<div style="text-align: center;">
    <span style="font-size: 25px; font-weight: bold;">ใบสั่งซื้อสินค้า</span><br>
    <span style="font-size: 20px; font-weight: bold;">ประจำวันที่
        <?php

        $date=date_create($stock_detail->stock_detail_date);
        echo date_format($date,"d/m/Y ");  ?>

    </span>
</div>

<span style="font-size: 20px; font-weight: bold;">สั่งซื้อสินค้าจาก : </span> <span style="font-size: 20px;"><?php echo $stock_detail->partners_name; ?> </span>
<span style="font-size: 20px; font-weight: bold;">สถานะการสั่งซื้อ :</span> <span style="font-size: 20px;"><?php echo $stock_detail->stock_detail_status_buy; ?>  </span>

<table width="100%">
    <thead>
    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>ราคารวม</th>
    </tr>
    <tbody>
    <?php foreach ($stock as $s){?>
    <tr>
        <td><?php echo $s->product_id ?></td>
        <td><?php echo $s->stock_product_name ?></td>
        <td style="text-align: center;"><?php echo $s->stock_product_type ?></td>
        <td style="text-align: center;"><?php echo $s->stock_amount ?></td>
        <td style="text-align: center;"><?php echo $s->stock_price_total ?></td>

    </tr>
    <?php }?>
    <tr>
        <td colspan="4" style="text-align: center">รวม</td>
        <td style="text-align: center;"><?php echo $stock_detail->stock_detail_total; ?></td>
    </tr>
    </tbody>
    </thead>
</table>

<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
        font-size: 20px;
        font-weight: bold;
    }
</style>