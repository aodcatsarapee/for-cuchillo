<html>
<head>
<meta charset="utf-8">
<title>ขายสินค้าของ ร้านสถิตพรอะไหล่</title>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php
if(empty($this->session->userdata('username'))){
    redirect('home/index','refresh');
}else{
  if($this->session->userdata('type')=='3'){
  echo css_asset('sale.css');
  echo css_asset('bootstrap.min.css');

      echo "<div id='left-side'>";
          echo "ชื่อลูกค้า : <select name='cus_name'>";
              foreach($customer as $cus){
                  echo "<option value=",$cus['cus_id'],">",$cus['cus_name'],"</option>";
              }
          echo "</select>";
          echo "<p>สถานะ : ",$cus['cus_type'],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".anchor("test","เพิ่มข้อมูลลูกค้า")."</p>";
      echo "</div>"; //ปืด left-side

      /*echo "<div class='right-side'>";
          echo "<h1>ราคารวม</h1>";
          echo "<p>",$this->cart->total()," บาท</p>";
      echo "</div>";//ปิด right-side*/
      //echo "<div class='clear'></div>";

//  echo "<div id='content'>";

  //echo "<div class='liftside'>";

  if(count($product)>0){
      foreach($product as $_product){
          echo form_open('sell/add');
              echo "<div class='show_product'>";
              echo "<h1>",$_product['product_name'],"</h1>";
              echo "<p>ราคาสินค้า :",$_product['product_price'],"</p>";
              echo "<p><input type='hidden' name='total' value='1'></p>";
              echo "<p><input type='hidden' name='productid' value=",$_product['product_id'],"></p>";
              echo "<p><input type='submit' name='add' value='เลือกสินค้า'></p>";
              echo "</div>";
          echo form_close();
      }//ปิด foreach
  }//ปืด if


  if($cart=$this->cart->contents()){ //ถ้ามีข้อมูล
      echo "<table class='table table-hover'>";
      echo "<tr>";
          echo "<td align='center'>รหัสสินค้า</td>";
          echo "<td align='center'>ชื่อสินค้า</td>";
          echo "<td align='center'>ราคาสินค้า</td>";
          echo "<td align='center'>จำนวนสินค้า</td>";
          //echo "<td align='center'>อัพเดท</td>";
          //echo "<td align='center'>ลบ</td>";
      echo "</tr>";

      $update = "<button type='button' class='btn btn-sm btn-danger'>อัพเดท</button>";
      $del = "<button type='button' class='btn btn-sm btn-danger'>ลบ</button>";

      echo form_open('sell/update');

          foreach($cart as $item){
            echo "<tr align='center'>";
              echo "<td>",$item['id'],"</td>";
              echo "<td>",$item['name'],"</td>";
              echo "<td>",$item['price'],"</td>";
              echo "<td><input type='number' name='addtotal'style='width: 40px; text-align:right;' min='1'  value=",$item['qty'],"></td>";
              echo "<td><input type='hidden' name='rowid' value=",$item['rowid'],"></td>";
              echo "<td><input type='submit' name='add' class='btn btn-sm btn-danger' value='อัพเดท'></td>";
              echo "<td>".anchor("sell/del/".$item['rowid'],$del),"<td>";
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
          echo "<th>รหัสสินค้า";
          echo "<th>ชื่อสินค้า</th>";
          echo "<th>ราคาสินค้า</th>";
          echo "<th>จำนวนสินค้า</th>";
      echo "</tr>";

      for($i=0; $i<7; $i++){
        echo "<tr>";
            echo "<td><br></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
        echo "</tr>";
      }

      echo "</table>";
  }
  //echo "</div>"; //content-leftside

  //echo "<div class='right-side'>";
    //  echo "<label='test'>รับเงินมา</label><input type='textbox' name='inputmoney' size='10'>";
//  echo "</div>";//content-rightside

  //echo "</div>";//content




/*
  echo "<input list='browsers' id='product' placeholder='เลือกประเภทสินค้า' onkeypress='testinsertbyonkey()'>";
              echo "<datalist id='browsers'>";
                    foreach($product as $pro){
                        echo "<option value=",$pro['product_id'],$pro['product_name'],$pro['product_price'],">";
                    }
                      //echo "<option value=",$product_id,"label=",$product_name $product_price,">";
              echo "</datalist>";


  echo "<select name='prodcut' id='prodcut'>";
        foreach($product as $pro){
          echo "<option value=",$pro['product_id'],">",$pro['product_name'],"</option>";
        }
  echo "<select>&nbsp&nbsp&nbsp";
  //echo "<input type='text' name='sellproduct' placeholder='เลือกสินค้า'>";*/
  }else{
    redirect('home/index','refresh');
  }
}//ปืด if empty
?>
</body>
</html>
