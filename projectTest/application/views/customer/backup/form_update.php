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
echo form_open_multipart('customer/update/'.$customer['cus_id'],'class="form-horizontal"');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)

echo "<div class='form-group'>";
      echo "<label>รหัสบัตรประชาชน : </label> <input type='text' name='cus_cardid' class='form-control' value=",$customer['cus_cardid'],">";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ชื่อ - นามสกุล : </label> <input type='text' name='cus_name' class='form-control' value=",$customer['cus_name'],">";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ที่อยู่ : </label> <input type='text' name='cus_address' class='form-control' value=",$customer['cus_address'],">";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' name='cus_tel' class='form-control' maxlength='10' value=",$customer['cus_tel'],">";
echo "</div>";

echo "<div class='form-group'>";
      echo "<input type='hidden' name='cus_type' class='form-control' value='สมาชิก'>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<input type='submit' value='ส่งข้อมูล' name='insert_customer' class='btn btn-primary btn-lg active'>&nbsp;&nbsp;";
      echo "<span class='btn btn-primary btn-lg active'>".anchor("customer","ยกเลิก"),"</span>"; //anchor ให้วิ่งกลับไปที่ไฟล์ employee ใน views
echo "</div>";


echo form_close();
echo "</div>"; //ปิด div form-group
echo "</div>"; //center-side
?>
</body>
</html>
