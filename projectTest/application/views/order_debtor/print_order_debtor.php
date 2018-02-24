<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/23/2018
 * Time: 10:46
 */
?>


<div style="text-align: center;">
    <span style="font-size: 25px; font-weight: bold;">ใบชำระหนี้จากการสั่งซื้อสินค้า</span><br>
</div>

<span style="font-size: 20px; font-weight: bold;">สั่งซื้อสินค้าจาก : </span> <span
    style="font-size: 20px;">
    <?php
        $this->db->join('partners', 'partners.partners_id = creditor.partners_id','left');
        $this->db->where('creditor_id',$creditor_id);
        $partner=$this->db->get('creditor')->row();

        if($partner->partners_name != ''){
            echo $partner->partners_name;
        }else{
            echo '-';
        }
    ?>
</span>
<table class="table table-responsive table-bordered table-hover" width="100%">
    <thead class="bg-primary">
    <tr>
        <th width="10%" class="text-center">ลำดับ</th>
        <th class="text-center">งวดที่</th>
        <th class="text-center">วันที่ต้องชำระ</th>
        <th class="text-center">สถานะการชำระ</th>
        <th class="text-center">จำนวนเงิน</th>
        <th class="text-center">วันที่ชำระ</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    $total_pay = 0 ;
    $total_all_pay = 0;

    $this->db->where('creditor_id' ,$creditor_id);
    $creditor_detail = $this->db->get('creditor_detail')->result();
    foreach ($creditor_detail as $list){
        if($list->creditor_detail_status == 'ยังไม่ได้ชำระเงิน') {
            $total_pay += $list->creditor_detail_total;
        }
        $total_all_pay +=$list->creditor_detail_total;

        ?>
        <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo $list->creditor_detail_num; ?></td>
            <td class="text-center" style="text-align: center"><?php if($list->creditor_detail_date_at_pay != '' ){  $date=date_create($list->creditor_detail_date_at_pay); echo date_format($date,"d/m/Y ") ; }else{ echo "-"; } ?></td>
            <td style="text-align: center" > <?php echo $list->creditor_detail_status; ?> </td>
            <td style="text-align: center" class="text-center"><?php echo number_format($list->creditor_detail_total,2); ?></td>
            <td style="text-align: center" class="text-center"><?php if($list->creditor_detail_date_pay != '' ){  $date=date_create($list->creditor_detail_date_pay); echo date_format($date,"d/m/Y ") ; }else{ echo "-"; } ?></td>

        </tr>
        <?php $i++;  }?>

    <tr>
        <td colspan="4" style="text-align: center";> <b>ยอดค้างชำระ</b> </td>
        <td style="text-align: center;"> <?php echo  number_format($total_pay,2); ?> </td>
        <td style="text-align: center">-</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center";><b>ชำระเเล้ว</b> </td>
        <td style="text-align: center";>

            <?php

            echo  number_format(($total_all_pay - $total_pay),2); ?>
        </td>
        <td style="text-align: center">-</td>
    </tr>
    </tbody>
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
