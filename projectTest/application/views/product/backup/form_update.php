<html>
<head>
<title>แก้ไขข้อมูลสินค้าใน ร้านสถิตย์พรอะไหล่</title>
</head>
<body>
<?php
echo "<div class='col-md-8'>";
    echo "<div class='center'>";
echo "<h2>ฟอร์มแก้ไขข้อมูลสินค้า</h2>";
echo "<div class='form-group'>";
echo form_open_multipart('product/update',$result['product_id'],$result['product_picture'],'class="form-horizontal"');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
echo "<input type='hidden' name='id_product' value=",$result['product_id'],">";

echo "<div class='form-group'>";
      echo "<label>บาร์โค้ด : </label> <input type='text' name='barcode_product' class='form-control' value=",$result['product_barcode'],">";
echo "</div>";
echo $result['product_name'];
echo "<div class='form-group'>";
      echo "<label>ชื่อสินค้า : </label> <input type='text' name='name_product' class='form-control' value=",$result['product_name'],">";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' name='cost_product' class='form-control' value=",$result['product_cost'],">";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' name='price_product' class='form-control' value=",$result['product_price'],">";
echo "</div>";

echo "<p>ประเภทของสินค้า : <select name='cate_product'>";

foreach($cate as $product_cate){
    if($result['product_cate'] == $product_cate['cate_id']){
      $check="selected";
    }else{
      $check="";
    }
?>

      <option value="<?php echo $product_cate['cate_id']?>"<?php echo $check ?>><?php echo $product_cate['cate_name']?></option>

<?php
} //ปีกกา foreach

echo "</select></p>";

echo "<div class='form-group'>";
      echo "<label>จำนวนสินค้าคงเหลือ : <input type='text' name='quantity_product' class='form-control' value=",$result['product_quantity'],"></label>";
echo "</div>";

echo "<p>แบนด์ของสินค้า : <select name='band_product'>";

foreach($band as $product_band){
    if($result['product_band']==$product_band['band_id']){
      $check_band="selected";
    }else{
      $check_band="";
    }

?>
            <option value="<?php echo $product_band['band_id']?>"<?php echo $check_band ?>><?php echo $product_band['band_name']?></option>
<?php
}//ปีกกา foreach band
echo "</select></p>";
echo "<p>รูปภาพ : <input type='file' name='product_picture'></p>";
echo "<input type='submit' value='ส่งข้อมูล' name='update_product'>&nbsp;&nbsp;";

echo anchor("product","ยกเลิก"); //anchor ให้วิ่งกลับไปที่ไฟล์ employee ใน views
echo form_close();
?>
</body>
</html>
