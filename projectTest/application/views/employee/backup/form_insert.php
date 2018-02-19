<html>
<head>
<title>เพิ่มข้อมูลพนักงานใน ร้านสถิตย์พรอะไหล่</title>
</head>
<body>
<?php

echo "<h2>ฟอร์มเพิ่มข้อมูลพนักงาน</h2>";

echo form_open_multipart('employee/insert');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป 2.ไฟล์ที่จะให้วิ่งไป
echo "<p>Username : <input type='text' name='user_name'>&nbsp;&nbsp;";
echo "Password : <input type='pasword' name='user_password'></p>";
echo "ตำแหน่ง : <select name='position_employee'>";
      foreach($position as $product_position){
        echo "<option value=",$product_position['position_id'],">",$product_position['position_name'],"</option>";
      }
echo "</select>";
echo "<p>รหัสบัตรประชาชน : <input type='text' name='idcard_employee' size='10'></p>";
echo "<p>คำนำหน้า : <input type='radio' name='prename_employee' value='นาย'>นาย
                   <input type='radio' name='prename_employee' value='นาง'>นาง
                   <input type='radio' name='prename_employee' value='นางสาว'>นางสาว
</p>";
echo "<p>ชื่อ : <input type='text' name='name_employee'>&nbsp;&nbsp;";
echo "นาสกุล : <input type='text' name='lastname_employee'></p>";
echo "<p>อายุ : <input type='text' name='age_employee' size='1'></p>";
echo "<p>ที่อยู่ :</p> <textarea cols='50' rows='5' name='address_employee'></textarea>";
echo "<p>เบอร์โทรศัพท์ : <input type='text' name='tel_employee'></p>";
echo "<p>รูปภาพ : <input type='file' name='picture_employee'></p>";
//echo "<p>วันที่เริ่มทำงาน : <input type='text' name='startwork_employee' value=",$employee_start_work,"></p>";
echo "<p><input type='submit' name='insert_employee' value='เพิ่มข้อมูล'>&nbsp;&nbsp;";
echo anchor("employee","ยกเลิก"); //anchor ให้วิ่งกลับไปที่ไฟล์ employee ใน views
echo form_close();
?>
</body>
</html>
