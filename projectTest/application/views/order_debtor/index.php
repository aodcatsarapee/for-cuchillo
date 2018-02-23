<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/20/2018
 * Time: 09:03
 */
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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

                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" style="min-height: 600px;">
                        <table class="table table-responsive table-bordered table-hover" id="data-table">
                            <thead class="bg-primary">
                            <tr>
                                <th width="10%" class="text-center">ลำดับ</th>
                                <th>เจ้าหนี้</th>
                                <th>ดอกเบี้ยจ่าย</th>
                                <th class="text-center">ยอดสั้งซื้อ <br>( ไม่รวมดอกเบี้ยจ่าย )</th>
                                <th class="text-center">ยอดสั้งซื้อทั้งหมด <br> (คงเหลือ)</th>
                                <th class="text-center">สถานะการชำระ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                            --><?php
                            $i=1;
                            foreach ($creditor as $list){
                                $this->db->where('creditor_detail_date_pay ',NULL);
                                $this->db->where('creditor_id',$list->creditor_id);
                                $check_num = $this->db->get('creditor_detail')->num_rows();
                                if($check_num != 0){
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php if($list->partners_name != '' ){echo $list->partners_name; }else{ echo "-"; } ?></td>
                                        <td><?php echo number_format($list->tax,2); ?></td>
                                        <td class="text-center"> <?php echo number_format($list->price,2); ?> </td>
                                        <td class="text-center"> <?php echo number_format($list->total_all,2); ?> </td>
                                        <td class="text-center"> <?php echo $list->creditor_status; ?> </td>
                                        <td width="25%" class="text-center">
                                            <a href="<?php echo base_url()."order_debtor/pay_order_debtor/".$list->creditor_id; ?>" class="btn btn-success  "> ชำระเงิน</a>
                                            <a target="_blank" href="<?php echo base_url()."order_debtor/print_order_debtor/".$list->creditor_id; ?>" class="btn btn-danger "> พิพม์ใบชำระหนี้</a>
                                        </td>
                                    </tr>
                                    <?php $i++; } }?>
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
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--Frontend/js/index.js"></script>-->
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
    $(function () {
        $('#data-table').DataTable({});
    })
</script>
</body>

</html>

