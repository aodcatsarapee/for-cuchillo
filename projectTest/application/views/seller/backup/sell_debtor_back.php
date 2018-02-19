<?php //echo js_asset('jquery-3.2.1.min.js');?>
<?php //echo css_asset('sweetalert.css');?>
<?php //echo js_asset('sweetalert.min.js');?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<?php
    $add=image_asset('icon/add.png');
    //echo css_asset('bootstrap.min.css');
    //echo css_asset('testdiv.css');
    //echo css_asset('well_welcom.css');

    echo "<div class='col-md-10'>";
        echo "<div class='center-side'>";
            /*echo "ชื่อลูกค้า : <select name='cus_name'>";
                foreach($customer as $cus){
                    echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
                }
            echo "</select>";*/
            $addnewcus = "<button type='button' class='btn btn-sm btn-danger'>เพิ่มข้อมูลลูกค้า</button>";
            //echo "<p>สถานะ : ",$cus['cus_type'],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".anchor("test",$addnewcus)."</p><hr>";

            $newsale = "<button type='button' style='margin:20 0 20 410px;' class='btn btn-sm btn-danger' >ขายใหม่</button>";
            echo anchor("sell/del_all_debtor",$newsale);

            if(count($product)>0){
                echo form_open('sell/add_debtor');
                echo "<div class='barcode'>";
                    echo "<input list='browsers' name='barcode' id='barcode' style='margin-left:250px;width:400px; height:30px; font-size:18px; font-weight:20px;text-align:center;' placeholder='กรุณากรอกรหัสบาร์โค้ด'>";
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
                    echo "<td colspan = '2' align='center'>Action</td>";
                    //echo "<td align='center'>ลบ</td>";
                echo "</tr>";

                $update = "<button type='button' class='btn btn-sm btn-danger'>อัพเดท</button>";
                $del = "<button type='button' class='btn btn-sm btn-danger'>ลบ</button>";

                echo form_open('sell/update_debtor');

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
                        echo "<td>".anchor("sell/del_debtor/".$item['rowid'],$del),"<td>";
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
                      echo "<td>",number_format($this->cart->total()),"<td>";
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
              echo form_open('sell/sell_product_debtor');
                echo "<p>ชื่อลูกค้า : <select name='cus_name'>";
                    foreach($customer as $cus){
                        echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
                    }
                echo "</select></p>";
                echo "<table class='table'>";
                  echo "<thead class='thead-dark'>";
                    echo "<tr class='thcenter'>";
                      echo "<th colspan='9'>เพิ่มข้อมูลลูกค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addCus'>",$add,"</button></th>";
                    echo "</tr>";
                  echo "</thead>";
                echo "</table>";
                //echo "<p>".anchor("customer/insert_customer",$addnewcus)."</p><hr>";
                //echo "<h1>ราคารวม</h1>";"<p>สถานะ : ",$cus['cus_type'],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                //echo "<p>",$this->cart->total()," บาท</p>";
            echo "</div>";

                $totalprice=$this->cart->total();
                //echo $check;
                echo "<input type='hidden' name='total' id='total' value=",$this->cart->total(),">";
                echo "<input type='hidden' name='sell_id' value=",$sell['sell_id'],">";
                echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";
                echo "<input type='hidden' id='totalsellbeforecomma' name='totalsellbeforecomma'>";
                echo "<input type='hidden' name='type_debtor' value='debtor'>";
                echo "<input type='hidden' name='debtor_change' id='debtor_change'>";
                echo "<label>ระยะเวลาผ่อนชำระ &nbsp;&nbsp;<input type='text' id='timetopay' size='5' style='text-align:center;' value='6' disabled>  &nbsp;&nbsp; เดือน  &nbsp;&nbsp;<input type='text' id='timetopay_per' size='2' style='text-align:center;' value='0.10' disabled> &nbsp;&nbsp; %</label>";
                echo "<label>ส่วนลด &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='discount' id='discount' size='10' style='text-align:center;' value=0> %</label>";
                echo "<label align=center>ราคาหักส่วนลด &nbsp;&nbsp;&nbsp;<input type='text' name='newtotal' size='10' style='text-align:center; height:100px; font-size:36px;' id='totalsell' value=",$totalprice," disabled></label>";
                echo "<label>ผ่อนชำระต่อเดือน &nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='paytomonth' size='10' style='text-align:center; height:40px; font-size:20px;' id='paytomonth' disabled> บาท</label>";
                echo "<label>รับเงินมา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='receive' size='10' style='text-align:center; height:40px; font-size:20px;' id='receive' required > บาท</label>";
                echo "<label>เงินถอน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='change' id='change' size='10' style='text-align:center; height:40px; font-size:20px;' disabled> บาท</label>";
                //echo "<label>สถานะการขาย <select name='sell_status'><option value='ขายสด'>ขายสด</option><option value='ขายเชื่อ'>ขายเชื่อ</option></select></label>"; ?>

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

<!-- Start Add Cus -->
<div class="modal fade" id="addCus" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มข้อมูลผู้ใช้</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseCus' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
                  echo "<label>รหัสบัตรประชาชน : </label> <input type='text' maxlength='13' id='addCus_cardid' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>ชื่อ - นามสกุล : </label> <input type='text' id='addCus_name' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>ที่อยู่ : </label> <input type='text' id='addCus_address' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='addCus_tel' class='form-control' maxlength='10'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<input type='hidden' id='addCus_type' class='form-control' value='สมาชิก'>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='saveCus'>SAVE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Cus -->

</body>
</html>

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


  $("#barcode").focus();

  var dis=0;
  $("totaldis").val(dis.toFixed(0));
  var total = $("#total").val();
  var discount = $("#totaldis").val();
  var per = $("#timetopay_per").val();
  var newtotal = total-dis;
  var paymonth = newtotal*per;
  var newresult = newtotal + paymonth;
  var paytomonth = newresult /6;
  $("#totalsellbeforecomma").val(newresult.toFixed(2));
  $("#totalsell").val(addCommas(newresult.toFixed(2)));
  $("#paytomonth").val(addCommas(paytomonth.toFixed(2)));

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
          $("#debtor_change").val(change.toFixed(2));
          $("#change").val(addCommas(change.toFixed(2)));

          /*if(change<0){
            alert("รับเงินมาไม่ครบตามจำนวน");
          }*/
        //}
  })

})
</script>
