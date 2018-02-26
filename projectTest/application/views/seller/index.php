<html>
<head>
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">
<script>
  function addCommas(nStr)
  {
  	nStr += '';
  	x = nStr.split('.');
  	x1 = x[0];
  	x2 = x.length > 1 ? '.' + x[1] : '';
  	var rgx = /(\d+)(\d{3})/;
  	while (rgx.test(x1)) {
  		x1 = x1.replace(rgx, '$1' + ',' + '$2');
  	}
  	return x1 + x2;
  }
  $(document).ready(function(){
    $(window).resize(function() {
      var windowWidth = jQuery(window).width();
      if(windowWidth < '975' ){
        $("#mainbody").css('height','1000px');
      }else{
        $("#mainbody").css('height','600px');
      }
    });

    $("#barcode").focus();

    var dis=0;
    $("totaldis").val(dis.toFixed(0));
    var total = $("#total").val();
    var discount = $("#totaldis").val();
    var newtotal = total-dis;
    $("#totalsellbeforecomma").val(newtotal.toFixed(2));
    $("#totalsell").val(addCommas(newtotal.toFixed(2)));

    $("#discount").change(function(){
        var total = $("#total").val();
        var discount = $("#discount").val();
        var dis = (total * discount)/100;
        var newtotal = total-dis;
        $("#totalsell").val(addCommas(newtotal.toFixed(2)));
        $("#totalsellbeforecomma").val(newtotal.toFixed(2));
        // toFixed ทำให้เป็นทศนิยม (2) คือ 2 ตำแหน่ง val เปรียบเสมือนการกำหนดต่าอารมณ์เหมือน = ให้ความคิดกู
    });

    $("#receive").change(function(){
        var total = parseInt($("#total").val());
        var receive = parseInt($("#receive").val());
        $("#GetReceive").val(receive);
        var GetReceive = $("#GetReceive").val();
        var newtotal = $("#totalsellbeforecomma").val();
        var checkQty = $("#checkQty").val();

        if(newtotal != 0){
          if(receive>=total){
            if(receive == total){
              var change = GetReceive - newtotal;
              $("#change").val(addCommas(change.toFixed(2)));
              if(checkQty == "disabled"){
                $("#submit_sale").prop('disabled', true);
              }else{
                $("#submit_sale").prop('disabled', false);
              }
            }else{
              var change = GetReceive - newtotal;
              $("#change").val(addCommas(change.toFixed(2)));
              if(checkQty == "disabled"){
                $("#submit_sale").prop('disabled', true);
              }else{
                $("#submit_sale").prop('disabled', false);
              }
            }
          }else{
            var change = GetReceive - newtotal;
            $("#submit_sale").prop('disabled', true);
            $("#change").val(addCommas(change.toFixed(2)));
          }
        }

    })
  })
</script>
</head>
<body>
<section class="content">
    <div class="container-fluid">
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>ขายสินค้า (เงินสด)</h2>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($product as $_product) {
                      $Checkcart = $this->cart->contents();
                      $id = $_product['product_id'];
                      $amount = $_product['product_quantity'];
                      foreach ($Checkcart as $item){
                        if ($id==$item['id']) {
                            if ($amount >= $item['qty']) {
                            }else{
                              $disabled='disabled';
                              $text='สินค้าไม่เพียงพอ!';
                            }
                        }
                      }
                    }
                    ?>
                    <input type='hidden' name='checkQty' id='checkQty' value='<?php echo $disabled; ?>'>

                    <?php if (@$text) {?>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4 style="text-align: center;"><strong>ไม่สามารถดำเนินการได้ สินค้าไม่พอจำหน่าย</strong>! </h4>
                        </div>
                    <?php $border="1px red solid;"; $table_bg_color="background:#f56954;color:#fff;";}
                    else if(count($this->cart->contents())==0){
                           $border=""; $table_bg_color="";
                    }?>

                    <div class="body" id='mainbody' style="height:600px;">
                      <?php
                      $addnewcus = "<button type='button' class='btn btn-sm btn-danger'>เพิ่มข้อมูลลูกค้า</button>";
                      $newsale = "<button type='button' style='margin:20 0 20 410px;' class='btn btn-lg btn-danger' >ขายใหม่</button>";
                      echo "<div class='col-8 col-sm-8 col-md-8'>";
                        echo "<div style='text-align:center;margin-bottom:10px;'>";
                          echo anchor("sell/del_all",$newsale);
                        echo "</div>";

                        if(count($product)>0){
                            echo form_open('sell/add');
                            echo "<div class='barcode' style='text-align:center;'>";
                                echo "<input list='browsers' class='form-control' name='barcode' id='barcode' style=' font-size:18px; font-weight:20px;text-align:center;' placeholder='กรุณากรอกรหัสบาร์โค้ด'>";
                                    echo "<datalist id='browsers'>";
                                        foreach($product as $pro){ ?>
                                          <option value="<?php echo $pro['product_barcode']; ?>"><label><?php echo $pro['product_name']," มีจำนวน ",$pro['product_quantity']," ชิ้น"; ?></label><option>
                                        <?php
                                        }
                                    echo "</datalist>";
                            echo "</div>";
                            echo form_close();
                        }

                            if($cart=$this->cart->contents()){
                            $update = "<button type='button' class='btn btn-sm btn-danger'>อัพเดท</button>";
                            $del = "<button type='button' class='btn btn-sm btn-danger'>ลบ</button>";
                            $ExUp = "<button type='button' style='width:40px;' class='btn bg-green btn-block btn-xs waves-effect'>อัพเดท</button>";
                            $ExDel = "<button type='button' style='width:40px;' class='btn bg-red btn-block btn-xs waves-effect'>ลบ</button>";
                            ?>

                            <?php echo form_open('sell/update'); ?>

                            <table class='table table-hover' cellpadding="6" cellspacing="1" style="width:100%" border="0">

                            <tr>
                              <th>Action</th>
                              <th>จำนวนสินค้า</th>
                              <th>ชื่อสินค้า</th>
                              <th style="text-align:right">ราคา/ชิ้น</th>
                              <th style="text-align:right">รวมราคา</th>
                            </tr>

                            <?php $i = 1; ?>

                            <?php foreach ($this->cart->contents() as $items): ?>

                              <?php //echo form_hidden($i.'[rowid]', $items['rowid']);
                                    echo form_hidden('cart[' . $items['id'] . '][id]', $items['id']);
                                    echo form_hidden('cart[' . $items['id'] . '][rowid]', $items['rowid']);
                                    echo form_hidden('cart[' . $items['id'] . '][name]', $items['name']);
                                    echo form_hidden('cart[' . $items['id'] . '][price]', $items['price']);
                                    echo form_hidden('cart[' . $items['id'] . '][qty]', $items['qty']);
                              ?>

                              <tr>
                                <td><?php echo anchor("sell/del/".$items['rowid'],$ExDel); ?> &nbsp;</td>
                                <td>
                                  <input type="number" name="<?php echo 'cart[' . $items['id'] . '][qty]', $items['qty'] ?>" min="1" max="100" style="width: 60px; text-align: right;"  value="<?php echo $items['qty']; ?>" >
                                </td>
                                <!-- <td><?php //echo form_input(array('name' => 'qty'.$i, 'value' => $items['qty'], 'maxlength' => '100', 'size' => '5')); ?></td> -->
                                <td>
                                <?php echo $items['name']; ?>

                                  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                    <p>
                                      <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                      <?php endforeach; ?>
                                    </p>

                                  <?php endif; ?>

                                </td>
                                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                                <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                              </tr>

                            <?php $i++; ?>

                            <?php endforeach; ?>
                            <tr>
                              <td colspan="3"> </td>
                              <td class="right"><strong></strong></td>
                              <td style="text-align:right"><input type='submit' name='add' style='width:100px;' class='btn bg-green btn-block btn-lg  waves-effect' value='อัพเดท'></td>
                            </tr>


                            </table>

                            <p><?php  //echo form_submit('', 'Update your Cart'); ?></p>
                            <?php echo form_close();

                        }


                      echo "</div>";

                      echo "<div class='col-4 col-sm-4 col-md-4'>";
                        echo form_open('sell/sell_product');
                          $totalprice=$this->cart->total();
                          echo "<input type='hidden' name='total' id='total' value=",$this->cart->total(),">";
                          echo "<input type='hidden' name='sell_id' value=",$sell['sell_id'],">";
                          echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";
                          echo "<input type='hidden' id='totalsellbeforecomma' name='totalsellbeforecomma'>";
                          echo "<input type='hidden' id='GetReceive' name='GetReceive'>";
                          echo "<label style='margin-right:120px;'>ส่วนลด % </label><input type='text' class='form-control' name='discount' id='discount' size='10' style='text-align:center;width:300px;' value=0>";
                          echo "<label>ราคาหักส่วนลด <span><input type='text' name='newtotal' size='10' class='form-control' style='text-align:center; height:100px; width:300px; font-size:36px;' id='totalsell' value=",$totalprice," readonly></span></label>";
                          echo "<label style='margin-right:85px;'>รับเงินมา </label><input type='text' class='form-control _number' name='receive' size='10' style='text-align:center; height:40px; font-size:20px; width:300px;' id='receive' required >";
                          echo "<label style='margin-right:90px;'>เงินทอน </label><input type='text' name='change' id='change' class='form-control' size='10'  style='text-align:center; width:300px; height:40px; font-size:20px;' readonly>";
                          if(empty($cart)){
                            echo "<label></label><input type='submit' id='submit_sale' name='submit_sale' style='font-size:30px;width:100%;height50px;margin-top:20px;' value='ขายสินค้า' class='btn btn-primary waves-effect' disabled>";
                          }else{
                              echo "<label></label><input type='submit' id='submit_sale' name='submit_sale' style='font-size:30px;width:100%;height50px;margin-top:20px;' value='ขายสินค้า' class='btn btn-primary waves-effect' disabled>";
                          }
                        echo form_close();
                      echo "</div>";
                            ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>



<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.categories.js"></script>-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/morris.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</body>
</html>
