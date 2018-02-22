<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/20/2018
 * Time: 09:03
 */
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>ชำระหนี้จากการสั่งซื้อสินค้า
                                    <a href="<?php echo base_url() ?>/order_debtor" class=" btn btn-success"
                                       style=" float: right;">
                                        กลับ </a>

                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" style="min-height: 600px;">
                        <table class="table table-responsive table-bordered table-hover">
                            <thead class="bg-primary">
                            <tr>
                                <th width="10%" class="text-center">ลำดับ</th>
                                <th class="text-center">งวดที่</th>
                                <th class="text-center">สถานะการชำระ</th>
                                <th class="text-center">จำนวนเงิน</th>
                                <th class="text-center">วันที่ชำระ</th>

                                <th class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                           <?php
                            $i=1;
                            $total_pay = 0 ;
                            $total_all_pay = 0;
                            foreach ($creditor_detail as $list){
                                if($list->creditor_detail_status == 'ยังไม่ได้ชำระเงิน') {
                                    $total_pay += $list->creditor_detail_total;
                                }
                                $total_all_pay +=$list->creditor_detail_total;

                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $list->creditor_detail_num; ?></td>
                                        <td class="text-center"> <?php echo $list->creditor_detail_status; ?> </td>
                                        <td class="text-center"><?php echo number_format($list->creditor_detail_total,2); ?></td>
                                        <td class="text-center"><?php if($list->creditor_detail_date_pay != '' ){echo $list->creditor_detail_date_pay; }else{ echo "-"; } ?></td>
                                        <td width="25%" class="text-center">
                                            <a href="<?php echo base_url()."order_debtor/pay_order_debtor_list/".$list->creditor_id.'/'.$list->creditor_detail_id.'/'.$list->creditor_detail_num.'/'.$list->creditor_detail_total; ?>" class="btn btn-success  "> ชำระเงิน</a>
                                        </td>
                                    </tr>
                                    <?php $i++;  }?>

                            <tr>
                                <td colspan="3" class="text-center"> <b>ยอดค้างชำระ</b> </td>
                                <td class="text-center"> <?php echo  number_format($total_pay,2); ?> </td>
                                <td  class="text-center"><b>ชำระเเล้ว</b> </td>
                                <td class="text-center">
                                    <?php

                                    echo  number_format(($total_all_pay - $total_pay),2); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.categories.js"></script>-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/morris.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-select.js"></script>

</body>

</html>

