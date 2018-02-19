<html>
<head>
<title>ร้านสถิตย์พรอะไหล่</title>
</head>
<body>
<?php
echo css_asset('bootstrap.min.css');
echo "<div class='col-md-8'>";
    echo "<div class='center'>";

echo "<h2>ฟอร์มเพิ่มข้อมูลการซ่อมรถของลูกค้า</h2>";
echo "<div class='form-group'>";
echo form_open_multipart('repair/insert',$repair['repair_id'],'class="form-horizontal"');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)

echo "<div class='form-group'>";
      echo "<label>ชื่อลูกค้า : <input type='text' name='cus_name' class='form-control' value=",$repair['customer_name'],"></label>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>เบอร์โทรศัพท์ลูกค้า : <input type='text' name='cus_tel' class='form-control' value=",$repair['customer_tel'],"></label>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ชนิดของรถ : <select name='repair_type' class='form-control'>";
          foreach($type as $repair_type){
            if($repair['repair_type']==$repair_type['repair_type_id']){
              $selected="selected";
            }else{
              $selected="";
            }
            echo "<option value=",$repair_type['repair_type_id']," $selected>",$repair_type['repair_type_name'],"</option>";
          }
      echo "</select></label>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>ยี่ห้อของรถ : <select name='repair_band' class='form-control'>";
          foreach($band as $repair_band){
            if($repair['repair_band']==$repair_band['repair_band_id']){
                $selected_band="selected";
            }else{
                $selected_band="";
            }
            echo "<option value=",$repair_band['repair_band_id']," $selected_band>",$repair_band['repair_band_name'],"</option>";
          }
      echo "</select></label>";
echo "</div>";

echo "<div class='form-group'>";
    echo "<label>ป้ายทะเบียนรถ : <input type='text' name='repair_label' class='form-control' value=",$repair['repair_label'],"></label>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>รูปของรถ : </label> <input type='file' name='repair_picture'>";
echo "</div>";

echo "<div class='form-group'>";
      echo "<label>สาเหตุที่ต้องการซ่อม : </label>";
      echo "<p><textarea name='repair_cause' cols='50' rows='10'></textarea></p>";
echo "</div>";

echo "<input type='hidden' name='repair_status' value='1'>"; //รับรถรายการซ่อมเข้าสู่ระบบ


/*echo "<div class='form-group'>";
      echo "<label>สถานะ : <select name='repair_status' class='form-control'>";
          foreach($status as $repair_status){
            echo "<option value=",$repair_status['re_status_id'],">",$repair_status['re_status_name'],"</option>";
          }
      echo "</select></label>";
echo "</div>";*/


      echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";

echo "<div class='form-group'>";
      echo "<input type='submit' value='ส่งข้อมูล' name='update_repair' class='btn btn-primary btn-lg active'>&nbsp;&nbsp;";
      $cancle = "<button type='button' class='btn btn-primary btn-lg active'>ยกเลิก</button>";
      echo anchor("repair",$cancle);
echo "</div>";


echo form_close();
echo "</div>"; //ปิด div form-group
echo "</div>"; //center-side
?>
</body>
</html>
