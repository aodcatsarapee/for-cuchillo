<html>
<head>
<title>รายละเอียดพนักงานของร้าน ร้านสถิตพรอะไหล่</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.leftbox{ width: 320px;height: 200px;float:left;margin-right: 50px;}
.rightbox{width: 500px;float:right;}
.textcolor a:visited{color:white !important;}
</style>
</head>
<body>

<?php
$back=image_asset('icon/back.png');
echo "<div class='leftbox'>";
echo "<h1 style='padding-left:40px;'>",$result['emp_prename']," ",$result['emp_name']," ",$result['emp_lastname'],"</h1>";
?>
<p align='center'><img src="<?php echo base_url(); ?>images/employee/<?php echo $result['emp_picture']; ?>" width='300' height='200'></p>
<?php
echo "<button type='button' class='btn btn-primary btn-lg textcolor'>".anchor("employee","Back")."</button>";
echo "</div>";

echo "<div class='rightbox'>";
  echo "<div class='form-group'>";
    echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
      echo "<div class='form-group'>";
          echo "<label>Username : </label> <input type='text' value=",$result['user_name']," class='form-control' disabled>";
      echo "</div>";

      echo "<div class='form-group'>";
          echo "<label>Password : </label> <input type='text' value=",$result['user_password']," class='form-control' disabled>";
      echo "</div>";

      echo "<div class='form-group'>";
          echo "<label>ตำแหน่ง : </label> <input type='text' value=",$result['position_name']," class='form-control' disabled>";
      echo "</div>";

      echo "<div class='form-group'>";
          echo "<label>รหัสบัตรประชาชน : </label> <input type='text' value=",$result['emp_idcard']," class='form-control' disabled>";
      echo "</div>";

        echo "<div class='form-group'>";
          echo "<label>อายุ : </label> <input type='text' value=",$result['emp_age']," class='form-control' disabled>";
        echo "</div>";


        echo "<div class='form-group'>";
          echo "<label for='comment'>ที่อยู่:</label>";
          echo "<textarea class='form-control' rows='5' id='comment' disabled>",$result['emp_address'],"</textarea>";
        echo "</div>";

        echo "<div class='form-group'>";
          echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' value=",$result['emp_tel']," class='form-control' disabled>";
        echo "</div>";
      echo "</div>";
    echo form_close();
  echo "</div>"; //ปิด div form-group
echo "</div>"; //center-side

?>
</body>
</html>
