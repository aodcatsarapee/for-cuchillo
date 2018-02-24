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
                                    <a href="<?php echo base_url() ?>order_debtor" class=" btn btn-success"
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
                                <th class="text-center">วันที่ต้องชำระ</th>
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
                                        <td class="text-center"><?php if($list->creditor_detail_date_at_pay != '' ){  $date=date_create($list->creditor_detail_date_at_pay); echo date_format($date,"d/m/Y ") ; }else{ echo "-"; } ?></td>
                                        <td class="text-center"> <?php echo $list->creditor_detail_status; ?> </td>
                                        <td class="text-center"><?php echo number_format($list->creditor_detail_total,2); ?></td>
                                        <td class="text-center"><?php if($list->creditor_detail_date_pay != '' ){  $date=date_create($list->creditor_detail_date_pay); echo date_format($date,"d/m/Y ") ; }else{ echo "-"; } ?></td>
                                        <td width="25%" class="text-center">
                                            <?php
                                            if($list->creditor_detail_date_pay == NULL){
                                                $dis="";
                                            }else{
                                                $dis="disabled";
                                            }
                                            ?>
                                            <a href="<?php echo base_url()."order_debtor/pay_order_debtor_list/".$list->creditor_id.'/'.$list->creditor_detail_id.'/'.$list->creditor_detail_num.'/'.$list->creditor_detail_total; ?>" class="btn btn-success <?php echo  $dis; ?>"> ชำระเงิน</a>
                                            <button class="btn btn-warning" onclick="update(<?php echo $list->creditor_id;?> , <?php echo $list->creditor_detail_id ;?>)" <?php echo  $dis; ?>>เพิ่มวันที่ต้องชำระ</button>

                                        </td>
                                    </tr>
                                    <?php $i++;  }?>

                            <tr>
                                <td colspan="4" class="text-center"> <b>ยอดค้างชำระ</b> </td>
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

<div class="modal fade" id="update_debtor" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#FF9600;">
                <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                <h4 class="modal-title" style="text-align:center;color:white;">วันที่ต้องขำระเงิน</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo base_url() . 'order_debtor/edit' ?>"
                      enctype="multipart/form-data">
                    <input type="hidden" name="creditor_id" id="creditor_id">
                    <input type="hidden" name="creditor_detail_id" id="creditor_detail_id">
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">วันที่ต้องขำระเงิน :</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="date" name="creditor_detail_date_at_pay" id="creditor_detail_date_at_pay"
                                   placeholder="เช่น  100 200 300  " required="required"
                                   style="background-color: #E9E9E9;">
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-warning" value=" บันทึกข้อมูล "
                           style="float: right;font-size: 15px;">
                </form>
                <br>
                <br>

            </div>
        </div>
    </div>
</div>

<input type="hidden" id="base_url" value="<?php echo base_url();?>">


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
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--Frontend/js/jquery.flot.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-select.js"></script>
<script>
    $(function () {
    })

    var base_url = $('#base_url').val();
    function update(creditor_id,creditor_detail_id) {
        $.ajax({
            url: base_url+"/order_debtor/update_debtor/" +creditor_id+'/'+creditor_detail_id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#update_debtor').modal('show');

                $("#creditor_detail_date_at_pay").attr('value', data.creditor_detail.creditor_detail_date_at_pay);
                $("#creditor_id").attr('value', data.creditor_detail.creditor_id);
                $("#creditor_detail_id").attr('value', data.creditor_detail.creditor_detail_id);

                creditor_detail_date_at_pay


            }
        });

    }

</script>
</body>

</html>

