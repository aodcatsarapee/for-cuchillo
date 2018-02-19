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
        var total = $("#total").val();
        var receive = $("#receive").val();
        var newtotal = $("#totalsellbeforecomma").val();

        if(receive<newtotal){
          var change = receive - newtotal;
          $("#change").val(addCommas(change.toFixed(2)));
          $("#submit_sale").prop('disabled', true);
          if(receive = newtotal){
            var change = receive - newtotal;
            $("#change").val(addCommas(change.toFixed(2)));
            $("#submit_sale").prop('disabled', false);
          }
        }else{
          var change = receive - newtotal;
          $("#change").val(addCommas(change.toFixed(2)));
          $("#submit_sale").prop('disabled', false);
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
                                <h2>Sell Product</h2>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                      <?php
                      $addnewcus = "<button type='button' class='btn btn-sm btn-danger'>เพิ่มข้อมูลลูกค้า</button>";
                      $newsale = "<button type='button' style='margin:20 0 20 410px;' class='btn btn-lg btn-danger' >ขายใหม่</button>";
                      echo "<div class='col-xs-8 col-sm-8'>";

                        echo "<div style='text-align:center;margin-bottom:10px;'>";
                          echo anchor("sell/del_all",$newsale);
                        echo "</div>";

                        if(count($product)>0){
                            echo form_open('sell/add');
                            echo "<div class='barcode' style='text-align:center;'>";
                                echo "<input list='browsers' class='form-control' name='barcode' id='barcode' style=' font-size:18px; font-weight:20px;text-align:center;' placeholder='กรุณากรอกรหัสบาร์โค้ด'>";
                                    echo "<datalist id='browsers'>";
                                        foreach($product as $pro){
                                          echo "<option value=",$pro['product_barcode'],"<label>",$pro['product_name'],"</label>>";
                                        }
                                    echo "</datalist>";
                            echo "</div>";
                            echo form_close();
                        }

                          echo "<table class='table table-hover'>";
                            echo "<tr>";
                                echo "<td align='center'>รหัสบาร์โค้ด</td>";
                                echo "<td align='center'>ชื่อสินค้า</td>";
                                echo "<td align='center'>ราคา/ชิ้น</td>";
                                echo "<td align='center'>จำนวน</td>";
                                echo "<td align='center'>รวมราคาสินค้า</td>";
                            echo "</tr>";

                            if($cart=$this->cart->contents()){
                            $update = "<button type='button' class='btn btn-sm btn-danger'>อัพเดท</button>";
                            $del = "<button type='button' class='btn btn-sm btn-danger'>ลบ</button>";

                            echo form_open('sell/update');
                              foreach($cart as $item){
                                $sumprice=$item['price']*$item['qty'];
                                $sumcost=$item['cost']*$item['qty'];
                                echo "<tr align='center'>";
                                  echo "<td>",$item['barcode'],"</td>";
                                  echo "<td>",$item['name'],"</td>";
                                  echo "<td>",number_format($item['price']),"</td>";
                                  echo "<td><input type='number' name='addtotal'style='width: 40px; text-align:right;' min='1'  value=",$item['qty'],"></td>";
                                  echo "<td>",number_format($sumprice),"</td>";
                                  echo "<td><input type='submit' name='add' class='btn btn-sm btn-danger' value='อัพเดท'></td>";
                                  echo "<td>".anchor("sell/del/".$item['rowid'],$del),"<td>";
                                  echo "<input type='hidden' name='rowid' value=",$item['rowid'],">";
                                  echo "<input type='hidden' name='quantity' value=",$item['qty'],">";
                                  echo "<input type='hidden' name='product_quantity' value=",$item['quantity'],">";
                                  echo "<input type='hidden' name='product_id' value=",$item['id'],">";
                                  echo "<input type='hidden' name='product_cost' value=",$sumcost,">";
                                echo "</tr>";
                                }
                            echo form_close();
                                echo "<tr>";
                                  echo "<td colspan='6' align='right'>ราคารวม :</td>";
                                  echo "<td>",number_format($this->cart->total()),"<td>";
                                echo "</tr>";

                                echo "<tr>";
                                  echo "<td colspan='6' align='right'></td>";
                                  echo "<td><td>";
                                echo "</tr>";
                        }else{
                            for($i=0; $i<7; $i++){
                              echo "<tr>";
                                  echo "<td><br></td>";
                                  echo "<td></td>";
                                  echo "<td></td>";
                                  echo "<td></td>";
                                  echo "<td></td>";
                              echo "</tr>";
                            }
                        }
                        echo "</table>";
                      echo "</div>"; // Close col-xs-12 col-sm-6

                      //echo "<div class='col-xs-6 col-sm-6'>";
                        //echo "<div style='text-align:center;'>";
                          echo form_open('sell/sell_product');
                            //echo "<p>ชื่อลูกค้า : <select name='cus_name' class='form-control'>";
                                //foreach($customer as $cus){
                                    //echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
                                //}
                            //echo "</select></p>";
                            //echo "<p style='text-align:center;'>".anchor("customer/insert_customer",$addnewcus)."</p><hr>";
                            $totalprice=$this->cart->total();
                            echo "<input type='hidden' name='total' id='total' value=",$this->cart->total(),">";
                            echo "<input type='hidden' name='sell_id' value=",$sell['sell_id'],">";
                            echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";
                            echo "<input type='hidden' id='totalsellbeforecomma' name='totalsellbeforecomma'>";
                            echo "<label style='margin-right:120px;'>ส่วนลด % </label><input type='text' class='form-control' name='discount' id='discount' size='10' style='text-align:center;width:300px;' value=0>";
                            echo "<label>ราคาหักส่วนลด <span><input type='text' name='newtotal' size='10' class='form-control' style='text-align:center; height:100px; width:300px; font-size:36px;' id='totalsell' value=",$totalprice," readonly></span></label>";
                            echo "<label style='margin-right:85px;'>รับเงินมา </label><input type='text' class='form-control' name='receive' size='10' style='text-align:center; height:40px; font-size:20px; width:300px;' id='receive' required >";
                            echo "<label style='margin-right:90px;'>เงินถอน </label><input type='text' name='change' id='change' class='form-control' size='10'  style='text-align:center; width:300px; height:40px; font-size:20px;' readonly>";
                            echo "<label></label><input type='submit' id='submit_sale' name='submit_sale' style='font-size:30px;width:27%;height50px;margin-top:20px;' value='ขายสินค้า' class='btn btn-primary waves-effect'>";
                            ?>


                      <?php
                      //onClick="return confirm('ยืนยันการขายสินค้า ?')
                          //<label align='center'><input type='submit' name='submit_sale' value='ขายสินค้า' style='font-size:30px;width:100%;height50px;margin-top:20px;' class='btn btn-success' onClick="return confirm('ยืนยันการขายสินค้า ?')"></label>
                          echo form_close();
                        //echo "</div>";
                      //echo "</div>";



                            echo "</div>";
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
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</body>
</html>
