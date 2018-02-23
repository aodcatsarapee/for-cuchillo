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
                                <h2>สั่งซื้อสินค้า
                                    <a href="<?php echo base_url() ?>order" class=" btn btn-success"
                                       style=" float: right;">
                                        กลับ </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" style="min-height: 600px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10">

                                    <form action="<?php echo base_url('order/add'); ?>" method="POST" role="form">
                                        <p class="error" style="text-align: center;"></p>

                                        <table class="table table-responsive table-bordered  ">
                                            <thead class="bg-primary">
                                            <tr>
                                                <th>รหัสสินค้า</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>ยีห้อ</th>
                                                <th>ราคา</th>
                                                <th style="text-align: center;">จำนวน</th>
                                                <th style="text-align: center;">ราคารวม</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php


                                            $i = 0;
                                            foreach ($rs as $product) { ?>
                                                <tr>
                                                    <td width="10%">
                                                        <input type="text" class="form-control" id="product_id"
                                                               name="product_id[]" class="form-control"
                                                               value="P<?php echo $product['product_id'] ?>" disabled>
                                                        <input type="hidden" class="form-control" id="product_id"
                                                               name="product_id[]" class="form-control"
                                                               value="<?php echo $product['product_id'] ?>">
                                                    </td>

                                                    <td width="30%">
                                                        <input type="text" class="form-control" id="product_name"
                                                               name="product_name[]" placeholder="Input field"
                                                               value="<?php echo $product['product_name']; ?>" disabled>
                                                        <input type="hidden" class="form-control" id="product_name"
                                                               name="product_name[]" placeholder="Input field"
                                                               value="<?php echo $product['product_name']; ?>">

                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" class="form-control"
                                                               value="<?php echo $product['band_name'] ?>" disabled>
                                                        <input type="hidden" class="form-control" id="product_type"
                                                               name="product_type[]" placeholder="Input field"
                                                               value="<?php echo $product['band_name']; ?>">
                                                    </td>
                                                    <td width="10%">
                                                        <input type="text" class="form-control" class="form-control"
                                                               value="<?php echo $product['product_price'] ?>" disabled>
                                                        <input type="hidden" class="form-control"
                                                               id="product_price<?php echo $i; ?>"
                                                               name="product_price[]" placeholder="Input field"
                                                               value="<?php echo $product['product_price']; ?>">
                                                    </td>
                                                    <td width="10%">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <input type="number" class="form-control "
                                                                       name="product_amount[]"
                                                                       id="product_amount<?php echo $i; ?>"
                                                                       placeholder="จำนวน" min="0" value="0"
                                                                       style="text-align: right; width:60px;"
                                                                       onchange="check_amount();total(<?php echo $i; ?>)">
                                                            </div>
                                                            <div class="col-md-5">

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center" id="price_total<?php echo $i; ?>"></td>

                                                </tr>

                                                <input type="hidden" name="number" id='number' class="form-control"
                                                       value="<?php echo count($rs); ?>">
                                                <?php $i++;
                                            } ?>
                                            <tr>
                                                <td colspan="5" class="text-center"><b>รวม</b></td>
                                                <td class="text-center">
                                                    <div id="add"></div>
                                                </td>
                                            </tr>
                                            </tbody>

                                        </table>

                                        <div class="col-md-2 ">
                                            <select name="partners" id="" class="form-control"
                                                    style="width: 150px; margin-right: 10px;">
                                                <option value="">เลือกร้าน</option>
                                                <?php foreach ($partners as $par) { ?>

                                                    <option value="<?php echo $par->partners_id; ?>"><?php echo $par->partners_name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 ">
                                            <select name="order_sell" id="order_sell" class="form-control" onchange="sell_detor()"
                                                    style="width: 200px;  margin-right: 10px;" required>
                                                <option value="">รูปเเบบการสั่งซื้อสินค้า</option>
                                                <option value="1">สั่งซื้อสินค้าเป็นเงินสด</option>
                                                <option value="2">สั่งซื้อสินค้าเป็นเงินเชื่อ</option>
                                            </select>
                                        </div>
                                          <div class="col-md-3" id="payment"></div>
                                            <div class="col-md-4" id="tax"></div>

                                        <div class="col-md-1 ">
                                            <button type="submit" id="submit_dis" class="btn  btn-success "
                                                    style="float: right;font-size: 15px;" disabled> สั่งซื้อสินค้า
                                            </button>
                                        </div>

                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="number_check" id='number_check' class="form-control"
                           value="<?php echo count($rs); ?>">

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
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--Frontend/js/jquery.flot.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--Frontend/js/bootstrap-select.js"></script>-->

</body>

</html>


<script>
    function check_amount() {

        var test = [];
        var amount_count = $("#number_check").val();
        var check_con = 0;
        for (var i = 0; i < amount_count; i++) {
            if ($("#product_amount" + i).val() != 0) {
                $('#submit_dis').removeAttr("disabled");
                check_con++;
            }
        }
        if (check_con == 0) {
            $('#submit_dis').prop("disabled", true);
        }
    }

    function total(list) {
        var total = 0;
        var amount_count = $("#number_check").val();
        for (var i = 0; i < amount_count; i++) {
            total += (Number($('#product_amount' + i).val()) * Number($('#product_price' + i).val()));
        }
        $("#add").text(total);

        $("#price_total" + list).text((Number($('#product_amount' + list).val()) * Number($('#product_price' + list).val())));

    }

    function sell_detor() {
      if($('#order_sell').val() == 2) {
          $('#payment').html('<input type="number" name="payment" class="form-control" style="margin-left: 50px; width: 200px; text-align: right;" min="0" placeholder="จำนวนงวด " required />');
          $('#tax').html('<input type="number" name="tax" class="form-control" style="margin-left: 50px; width: 200px; text-align: right;" min="0" max="100" placeholder="ดอกเบี้ยจ่าย %" required />');
      }else{
          $('#payment').html('');
          $('#tax').html('');
      }
    }
</script>

