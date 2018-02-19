<html>
<head>
<title>แก้ไขข้อมูลพนักงานในร้าน สถิตย์พรอะไหล่</title>
</head>
<body>
<?php


echo "<h2>ฟอร์มแก้ไขข้อมูลพนักงาน</h2>";

//segmentไปดูจาก url นับตั้งแต่ตัว controllers
echo form_open_multipart('employee/update',$result['user_id'],$result['emp_picture']);  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป 2.ไฟล์ที่จะให้วิ่งไป;
echo "<input type='hidden' name='id_user' value=",$result['user_id'],">";
echo "<p>Username : <input type='text' name='user_name' value=",$result['user_name'],">&nbsp;&nbsp;";
echo "Password : <input type='pasword' name='user_password' value=",$result['user_password'],"></p>";
echo "ตำแหน่ง : <select name='position_employee'>";
        foreach($position as $position_id){
            if($result['user_position'] == $position_id['$position_id']){
              $check="selected";
            }else{
              $check="";
            }
            echo "<option value=",$position_id['position_id'],$check,">",$position_id['position_name'],"</option>";
        }


echo "</select>";



echo "<p>รหัสบัตรประชาชน : <input type='text' name='idcard_employee' size='10' value=",$result['emp_idcard'],"></p>";
?>
<p>คำนำหน้า : <input type='radio' name='prename_employee' value='ชาย' <?php echo $result['emp_prename']=='นาย'?'checked':'' ?>>นาย
                   <input type='radio' name='prename_employee' value='นาง' <?php echo $result['emp_prename']=='นาง'?'checked':'' ?>>นาง
                   <input type='radio' name='prename_employee' value='นางสาว' <?php echo $result['emp_prename']=='นางสาว'?'checked':'' ?>>นางสาว
</p>
<?php
echo "<p>ชื่อ : <input type='text' name='name_employee' value=",$result['emp_name'],">&nbsp;&nbsp;";
echo "นาสกุล : <input type='text' name='lastname_employee' value=",$result['emp_lastname'],"></p>";
echo "<p>อายุ : <input type='text' name='age_employee' size='1' value=",$result['emp_age'],"></p>";
echo "<p>ที่อยู่ :</p> <textarea cols='50' rows='5' name='address_employee'>",$result['emp_address'],"</textarea>";
echo "<p>เบอร์โทรศัพท์ : <input type='text' name='tel_employee' value=",$result['emp_tel'],"></p>";
echo "<p>รูปภาพ : <input type='file' name='picture_employee'></p>";
echo "<p><input type='submit' name='insert_employee' value='เพิ่มข้อมูล'>&nbsp;&nbsp;";
echo anchor("employee","ยกเลิก"); //anchor ให้วิ่งกลับไปที่ไฟล์ employee ใน views
echo form_close();
?>
</body>
</html>
