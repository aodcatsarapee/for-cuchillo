<html>
<head>
<title>เพิ่มข้อมูลสินค้าใน ร้านสถิตย์พรอะไหล่</title>
</head>
<body>
<?php
echo "<div class='col-md-8'>";
    echo "<div class='center'>";

echo "<h2>ฟอร์มเพิ่มข้อมูลสินค้า</h2>";
echo "<div class='form-group'>";
echo form_open_multipart('product/insert','class="form-horizontal"');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)

echo "<div class='form-group'>";
      echo "<label>รหัสบาร์โค้ด : </label> <input type='text' name='barcode_product' class='form-control'>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ชื่อสินค้า : </label> <input type='text' name='name_product' class='form-control'>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' name='cost_product' class='form-control'>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' name='price_product' class='form-control'>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ประเภทของสินค้า : <select name='cate_product' class='form-control'>";

          foreach($cate as $product_cate){
            echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
          }

      echo "</select>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>แบนด์ของสินค้า : </label> <select name='band_product' class='form-control'>";

          foreach($band as $band_cate){
            echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
          }
      echo "</select>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<p><input type='file' name='product_picture'></p>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<input type='submit' value='ส่งข้อมูล' name='insert_product' class='btn btn-primary btn-lg active'>&nbsp;&nbsp;";
      echo "<span class='btn btn-primary btn-lg active'>".anchor("product","ยกเลิก"),"</span>"; //anchor ให้วิ่งกลับไปที่ไฟล์ employee ใน views
echo "</div>";


echo form_close();
echo "</div>"; //ปิด div form-group
echo "</div>"; //center-side
?>
</body>
</html>
