<?php echo js_asset('jquery-3.2.1.min.js');?>
<?php echo css_asset('sweetalert.css');?>
<?php echo js_asset('sweetalert.min.js');?>
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
        // toFixed ทำให้เป็นทศนิยม (2) คือ 2 ตำแหน่ง val เปรียบเสมือนการกำหนดต่าอารมณ์เหมือน = ให้ความคิดกู
    });

    $("#receive").change(function(){
        var total = $("#total").val();
        var receive = $("#receive").val();
        var newtotal = $("#totalsellbeforecomma").val();

          //if(receive<newtotal){
            //alert('คุณกรอกเงินไม่ครบ');
          //  $("#receive").focus();
          //}else{
            var change = receive - newtotal;
            $("#change").val(addCommas(change.toFixed(2)));

            /*if(change<0){
              alert("รับเงินมาไม่ครบตามจำนวน");
            }*/
          //}
    })
})
</script>

<?php
    echo css_asset('bootstrap.min.css');
    echo css_asset('testdiv.css');
    echo css_asset('well_welcom.css');

    echo "<div class='col-md-9'>";
        echo "<div class='center-side'>";
            /*echo "ชื่อลูกค้า : <select name='cus_name'>";
                foreach($customer as $cus){
                    echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
                }
            echo "</select>";*/
            $addnewcus = "<button type='button' class='btn btn-sm btn-danger'>เพิ่มข้อมูลลูกค้า</button>";
            //echo "<p>สถานะ : ",$cus['cus_type'],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".anchor("test",$addnewcus)."</p><hr>";

            $newsale = "<button type='button' style='margin:20 0 20 250px;' class='btn btn-sm btn-danger' >ขายใหม่</button>";
            echo anchor("sell/del_all",$newsale);

            if(count($product)>0){
                echo form_open('sell/add');
                echo "<div class='barcode'>";
                    echo "<input list='browsers' name='barcode' id='barcode' style='margin-left:110px;width:400px; height:30px; font-size:18px; font-weight:20px;text-align:center;' placeholder='กรุณากรอกรหัสบาร์โค้ด'>";
                        echo "<datalist id='browsers'>";
                            foreach($product as $pro){
                              echo "<option value=",$pro['product_barcode'],"<label>",$pro['product_name'],"</label>>";
                            }
                        echo "</datalist>";
                echo "</div>";
                echo form_close();
            }//ปืด if

            if($cart=$this->cart->contents()){ //ถ้ามีข้อมูล
                echo "<table class='table table-hover'>";
                echo "<tr>";
                    echo "<td align='center'>รหัสบาร์โค้ด</td>";
                    echo "<td align='center'>ชื่อสินค้า</td>";
                    echo "<td align='center'>ราคา/ชิ้น</td>";
                    echo "<td align='center'>จำนวน</td>";
                    echo "<td align='center'>รวมราคาสินค้า</td>";
                    //echo "<td align='center'>อัพเดท</td>";
                    //echo "<td align='center'>ลบ</td>";
                echo "</tr>";

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

                    }//ปิด foreach
                echo form_close();

                    echo "<tr>";
                      echo "<td colspan='6' align='right'>ราคารวม :</td>";
                      echo "<td>",$this->cart->total(),"<td>";
                    echo "</tr>";

                    echo "<tr>";
                      echo "<td colspan='6' align='right'></td>";
                      echo "<td><td>";
                    echo "</tr>";
                echo "</table>";
            }else{
                echo "<table class='table table-hover'>";
                echo "<tr>";
                    echo "<th>รหัสบาร์โค้ด";
                    echo "<th>ชื่อสินค้า</th>";
                    echo "<th>ราคา/ชิ้น</th>";
                    echo "<th>จำนวน</th>";
                    echo "<th>รวมราคาสินค้า</th>";
                echo "</tr>";

                for($i=0; $i<7; $i++){
                  echo "<tr>";
                      echo "<td><br></td>";
                      echo "<td></td>";
                      echo "<td></td>";
                      echo "<td></td>";
                      echo "<td></td>";
                  echo "</tr>";
                }

                echo "</table>";
            }
        echo "</div>"; //center-side

        echo "<div class='right-side'>";
            echo "<div class='customer'>";
              echo form_open('sell/sell_product');
                echo "<p>ชื่อลูกค้า : <select name='cus_name'>";
                    foreach($customer as $cus){
                        echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
                    }
                echo "</select></p>";
                echo "<p>".anchor("customer/insert_customer",$addnewcus)."</p><hr>";
                //echo "<h1>ราคารวม</h1>";"<p>สถานะ : ",$cus['cus_type'],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                //echo "<p>",$this->cart->total()," บาท</p>";
            echo "</div>";

                $totalprice=$this->cart->total();
                //echo $check;
                echo "<input type='hidden' name='total' id='total' value=",$this->cart->total(),">";
                echo "<input type='hidden' name='sell_id' value=",$sell['sell_id'],">";
                echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";
                echo "<input type='hidden' id='totalsellbeforecomma'>";
                echo "<label>ส่วนลด &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='discount' id='discount' size='10' style='text-align:center;' value=0> %</label>";
                echo "<label align=center>ราคาหักส่วนลด &nbsp;&nbsp;&nbsp;<input type='text' name='newtotal' size='10' style='text-align:center; height:100px; font-size:36px;' id='totalsell' value=",$totalprice," readonly></label>";
                echo "<label>รับเงินมา &nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='receive' size='10' style='text-align:center; height:40px; font-size:20px;' id='receive' required > บาท</label>";
                echo "<label>เงินถอน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='change' id='change' size='10' style='text-align:center; height:40px; font-size:20px;' readonly> บาท</label>";
                echo "<label>สถานะการขาย <select name='sell_status'><option value='ขายสด'>ขายสด</option><option value='ขายเชื่อ'>ขายเชื่อ</option></select></label>"; ?>

                <p align='center'><input type='submit' name='submit_sale' value='ขายสินค้า' style='font-size:30px;width:90%;height50px;' class='btn btn-success' onClick="return confirm('ยืนยันการขายสินค้า ?')"></p>
      <?php

              echo form_close();

          /*echo "<div class='top'>";
          echo "</div>";

          echo "<div class='left'>";
          echo "</div>";

          echo "<div class='right'>";
          echo "</div>";*/

        echo "</div>";  //ปิด right-side
        echo "<div class='clear'></div>";
    echo "</div>"; //col-md-9

echo "</div>"; //ปิด row

echo "</div>"; //ปิด container

?>
</body>
</html>
