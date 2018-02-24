<html>
<head>
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<style type="text/css">
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}
.selectbox{-webkit-box-sizing: border-box; !important}

#myImg:hover {opacity: 0.7;}
</style>
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
    var paytomonth = (newtotal*0.10);
    var sumPay = newtotal + paytomonth;
    var TotalPay = (sumPay/6);
    $("#paytomonth").val(addCommas(Math.ceil(TotalPay).toFixed(2)));
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
        var total = $("#total").val();
        var receive = $("#receive").val();
        var newtotal = $("#totalsellbeforecomma").val();

        if(receive<newtotal){
          var change = receive - newtotal;
          $("#debtor_change").val(change.toFixed(2));
          $("#change").val(addCommas(change.toFixed(2)));
          $("#submit_sale").prop('disabled', true);
          if(receive = newtotal){
            var change = receive - newtotal;
            $("#debtor_change").val(change.toFixed(2));
            $("#change").val(addCommas(change.toFixed(2)));
            $("#submit_sale").prop('disabled', false);
          }
        }else{
          var change = receive - newtotal;
          $("#debtor_change").val(change.toFixed(2));
          $("#change").val(addCommas(change.toFixed(2)));
          $("#submit_sale").prop('disabled', false);
        }
    })

    $("#myImg").click(function (){
      $("#addCus").modal('show');
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
                                <h2>ขายสินค้า (เงินเชื่อ)</h2>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                          <?php
                            echo "<img id='myImg' class='data-toggle='modal' data-target='#addCus' src=",base_url('Frontend/images/icon/add.png'),">";
                          ?>
                        </ul>
                    </div>
                    <?php
                    $QtyPro = "";
                    if($QtyPro == "Fail"){
                      echo "<div class='alert alert-danger'>";
                        echo "<strong>ไม่สามารถดำเนินการได้ สินค้าไม่พอจำหน่าย</strong> จำนวนคงเหลือ ",$Qtybalance," ชิ้น ";
                      echo "</div>";
                    }else{
                      echo "<div class='alert alert-danger hide'>";
                        echo "<strong>ไม่สามารถดำเนินการได้</strong> สินค้าในคลังไม่พอจำหน่ายกรุณาเลือกสินค้าใหม่";
                      echo "</div>";
                    }

                    foreach ($product as $_product) {
                      $Checkcart = $this->cart->contents();
                      $id = $_product['product_id'];
                      $amount = $_product['product_quantity'];
                      foreach ($Checkcart as $item){
                        if ($id==$item['id']) {
                            if ($amount >=$item['qty']) {
                            }else{
                              $disabled='disabled';
                              $text='สินค้าไม่เพียงพอ!';
                            }
                        }
                      }
                    }

                    ?>



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
                        $add = base_url('Frontend/images/icon/add.png');
                        echo "<div style='text-align:center;margin-bottom:10px;'>";
                          echo anchor("sell/del_all",$newsale);
                        echo "</div>";

                        if(count($product)>0){
                            echo form_open('sell/add_debtor');
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

                          /*echo "<table >";
                            echo "<tr>";
                                echo "<td align='center'>รหัสบาร์โค้ด</td>";
                                echo "<td align='center'>ชื่อสินค้า</td>";
                                echo "<td align='center'>ราคา/ชิ้น</td>";
                                echo "<td align='center'>จำนวน</td>";
                                echo "<td align='center'>รวมราคาสินค้า</td>";
                            echo "</tr>";*/

                            if($cart=$this->cart->contents()){
                            $update = "<button type='button' class='btn btn-sm btn-danger'>อัพเดท</button>";
                            $del = "<button type='button' class='btn btn-sm btn-danger'>ลบ</button>";
                            $ExUp = "<button type='button' style='width:40px;' class='btn bg-green btn-block btn-xs waves-effect'>อัพเดท</button>";
                            $ExDel = "<button type='button' style='width:40px;' class='btn bg-red btn-block btn-xs waves-effect'>ลบ</button>";
                              /*echo form_open('sell/update_debtor');
                                foreach($cart as $item){
                                  $sumprice=$item['price']*$item['qty'];
                                  $sumcost=$item['cost']*$item['qty'];
                                  echo "<tr id='cart' align='center'>";
                                    echo "<td>",$item['barcode'],"</td>";
                                    echo "<td>",$item['name'],"</td>";
                                    echo "<td>",number_format($item['price']),"</td>";
                                    echo "<td><input type='number' id='addtotal' name='addtotal'style='width: 50px; text-align:right;' min='1' max='100'  value=",$item['qty'],"></td>";
                                    echo "<td>",number_format($sumprice),"</td>";
                                    echo "<td><input type='hidden' name='product_id' value=",$item['id'],"><input type='submit' name='add' class='btn btn-sm btn-danger' value='อัพเดท'></td>";
                                    echo "<td>".anchor("sell/del_debtor/".$item['rowid'],$del),"<td>";
                                    echo "<input type='hidden' id='rowid' name='rowid' value=",$item['rowid'],">";
                                    echo "<input type='hidden' name='quantity' value=",$item['qty'],">";
                                    echo "<input type='hidden' name='product_quantity' value=",$item['quantity'],">";
                                    echo "";
                                    echo "<input type='hidden' name='product_cost' value=",$sumcost,">";
                                  echo "</tr>";
                                }
                              echo form_close();*/
                              ?>



                              <?php echo form_open('sell/update_debtor'); ?>

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
                                  <td><?php echo anchor("sell/del_debtor/".$items['rowid'],$ExDel); ?> &nbsp;</td>
                                  <td>
                                    <input type="number" name="<?php echo 'cart[' . $items['id'] . '][qty]', $items['qty'] ?>" min="1" max='100' style="width: 60px; text-align: right;"  value="<?php echo $items['qty']; ?>" >
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
                              <?php echo form_close(); ?>

                        <?php
                        }
                      echo "</div>"; // Close col-8 col-sm-8 col-md-8

                      echo "<div class='col-4 col-sm-4 col-md-4'>";

                        echo form_open('sell/add_cusDebtor');
                          echo "<div class='row clearfix'>";
                            echo "<div class='col-sm-8'>";
                              echo "<label>ค้นหาลูกค้า </label>";
                              echo "<select class='selectpicker form-control' name='cus_name' title='กรุณาเลือกลูกค้า' data-live-search='true'>";
                                foreach ($customer as $cus) {
                                  echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
                                }
                              echo "</select>";
                            echo "</div>";
                            echo "<div class='col-sm-2' style='padding-top:15px;'>";
                              echo "<button type='submit' class='btn btn-primary btn-xs waves-effect waves-light'>";
                                  echo "<i class='material-icons'>search</i>";
                                  echo "<span>SEARCH</span>";
                              echo "</button>";
                            echo "</div>";
                          echo "</div>";
                        echo form_close();

                          if(empty($this->session->userdata['cusname'])){
                            $cusName = "กรุณาเลือกลูกค้า";
                            $cusid="";
                          }else{
                            $cusName = $this->session->userdata['cusname'];
                            $cusid = $this->session->userdata['cusid'];
                          }

                        echo form_open('sell/sell_product_debtor');
                          echo "<div class='col-sm-12'>";
                          echo "<div class='row clearfix'>";
                            echo "<div class='col-sm-8'>";
                              echo "<input type='text' class='form-control' name='cus_name' value='$cusName' readonly>";
                            echo "</div>";
                            /*echo "<label>ชื่อลูกค้า </label>";
                            echo "<table class='table table-hover'>";
                              echo "<tr>";
                                  echo "<td align='center'>",$cusName,"</td>";*/
                                  if(empty($cusName)){
                                    echo "กรุณาเลือกลูกค้า";
                                  }else{
                                    echo "<td><a href=",base_url(),"sell/del_cusDebtor style='margin-top:5px;' class='btn btn-primary btn-xs waves-effect waves-light'>DELETE </a></td>";
                                  }
                              /*echo "</tr>";
                            echo "</table>";*/
                          echo "</div>";
                          echo "</div>";

                            $totalprice=$this->cart->total();
                            echo "<input type='hidden' name='cus_id' id='cus_id' value=",$cusid,">";
                            echo "<input type='hidden' name='total' id='total' value=",$this->cart->total(),">";
                            echo "<input type='hidden' name='sell_id' value=",$sell['sell_id'],">";
                            echo "<input type='hidden' name='emp_name' value=",$this->session->userdata['name'],">";
                            echo "<input type='hidden' id='totalsellbeforecomma' name='totalsellbeforecomma'>";
                            echo "<input type='hidden' name='type_debtor' value='debtor'>";
                            echo "<input type='hidden' name='debtor_change' id='debtor_change'>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='col-sm-6'>";
                                echo "<label>ระยะเวลา (เดือน) <input type='text' id='timetopay' size='5' class='form-control' style='text-align:center;' value='6' disabled></label>";
                              echo "</div>";

                              echo "<div class='col-sm-5'>";
                                echo "<label>ดอกเบี้ย (%) <input type='text' class='form-control' id='timetopay_per' size='2' style='text-align:center;' value='0.10' disabled></label>";
                              echo "</div>";
                            echo "</div>";

                            echo "<label>ราคาหักส่วนลด <span><input type='text' name='newtotal' size='10' class='form-control' style='text-align:center; height:100px; width:300px; font-size:36px;' id='totalsell' value=",$totalprice," disabled></span></label>";

                            echo "<label>ผ่อนชำระต่อเดือน </label><input type='text' name='paytomonth' size='10' class='form-control' style='text-align:center; height:40px; width:300px; font-size:20px;' id='paytomonth' disabled>";
                            if(empty($totalprice)){
                              echo "<label></label><input type='submit' id='submit_sale' name='submit_sale' style='font-size:30px;width:100%;height50px;margin-top:20px;' value='ขายสินค้า' class='btn btn-primary waves-effect' disabled>";
                            }else{
                                if(!empty($this->session->userdata['cusname'])){ ?>
                                  <input type="submit" name='submit_sale' class="btn btn-primary waves-effect" value='ขายสินค้า' style='font-size:30px;width:100%;height50px;margin-top:20px;' <?php echo @$disabled; ?>>
                                  <!--<label></label><input type='submit' id='submit_sale' name='submit_sale' style='font-size:30px;width:100%;height50px;margin-top:20px;' value='ขายสินค้า' <?php echo @$disabled; ?> class='btn btn-primary waves-effect'>-->
                        <?php  }else{  ?>
                                  <!--<label></label><input type='submit' id='submit_sale' name='submit_sale' style='font-size:30px;width:100%;height50px;margin-top:20px;' <?php echo @$disabled; ?> value='ขายสินค้า' class='btn btn-primary waves-effect'>-->
                                  <button type="submit" class="btn btn-primary waves-effect" style='font-size:30px;width:100%;height50px;margin-top:20px;' disabled >ขายสินค้า</button>
                    <?php      }
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

<!-- Start Add Cus -->
<div class="modal fade !Important" id="addCus" role="dialog">
    <div class="modal-dialog modal-sm !Important">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#FFFF99;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">เพิ่มข้อมูลผู้ใช้</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='row clearfix'>";
              echo "<div class='col-sm-12'>";
                echo "<label class='form-label'>รหัสบัตรประชาชน :</label>";
                echo "<input type='text' maxlength='13' id='addCus_cardid' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='row clearfix'>";
              echo "<div class='col-sm-12'>";
                echo "<label>ชื่อ - นามสกุล : </label> <input type='text' id='addCus_name' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='row clearfix'>";
              echo "<div class='col-sm-12'>";
                echo "<label>ที่อยู่ : </label><textarea id='addCus_address' class='form-control'> </textarea>";
              echo "</div>";
            echo "</div>";

            echo "<div class='row clearfix'>";
              echo "<div class='col-sm-12'>";
                echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='addCus_tel' class='form-control' maxlength='10'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<input type='hidden' id='addCus_type' class='form-control' value='สมาชิก'>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer" style="border-top:solid 1px">
          <button type="button" class="btn btn-success" id='saveCus'>SAVE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Cus -->

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
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
<script>
$(document).ready(function(){
  $("#saveCus").click(function (){
      var cardid = $("#addCus_cardid").val();
      var name  = $("#addCus_name").val();
      var address  = $("#addCus_address").val();
      var tel  = $("#addCus_tel").val();
      var type  = $("#addCus_type").val();
      $.ajax({
        url: "<?php echo base_url() ?>customer/insert",
        type: "POST",
        data: {
          "cus_cardid" : cardid,
          "cus_name" : name,
          "cus_address" : address,
          "cus_tel" : tel,
          "cus_type" : type
        },
        dataType: 'json',
        openloading : true,
        success: function(data){
            alert("เพิ่มข้อมูลผู้ใช้สำเร็จ");
            $("#mdCloseCus").click();
            location.reload();
        },
        error: function(){
          alert('Error....');
          $("#mdCloseCus").click();
        }
      });
  })


})
</script>
