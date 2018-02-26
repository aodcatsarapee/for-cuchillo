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
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>สั่งซื้อสินค้า
                                    <a href="<?php echo base_url() ?>order/view" class=" btn btn-success" style=" float: right;"> สั่งซื้อสินค้า </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" style="min-height: 600px;">
                        <table class="table table-responsive table-bordered table-hover" id="data-table">
                            <thead>
                            <tr>
                                <th width="10%" class="text-center">ลำดับ</th>
                                <th>รหัสการสั้งซื้อ</th>
                                <th>ราคารวม</th>
                                <th class="text-center">สถานะการดำเนินการ</th>
                                <th class="text-center">สถานะการสั่งซื้อ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach ($stock as $list){
                                if($list->stock_detail_status != 'รับสินค้าเข้าคลังเเล้ว'){
                                ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td><?php echo $list->stock_detail_id; ?></td>
                                <td><?php echo number_format($list->stock_detail_total,2); ?></td>
                                <td class="text-center"> <?php echo $list->stock_detail_status; ?> </td>
                                <td class="text-center"> <?php echo $list->stock_detail_status_buy; ?> </td>
                                <td width="25%" class="text-center">
                                    <a href="<?php echo base_url()."order/insert_amount/".$list->stock_detail_id; ?>" class="btn btn-success "> รับสินค้าเข้าคลัง</a>
                                    <a target="_blank" href="<?php echo base_url()."order/print_order/".$list->stock_detail_id; ?>" class="btn btn-danger "> พิพม์ใบสั่งซื้อ</a>
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
