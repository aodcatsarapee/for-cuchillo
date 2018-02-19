<html>
<head>
<title>รายละเอียดสินค้าของ ร้านสถิตพรอะไหล่</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.leftbox{ width: 450px;height: 200px;float:left;}
.rightbox{width: 500px;float:left;}
.textcolor a:visited{color:white !important;}
.textcolor{margin-left:200px;}
</style>
</head>
<body>
  <?php
  $back=image_asset('icon/back.png');
echo "<div class='col-md-10'>";
  echo "<div class='leftbox'>";
  echo "<h1 style='padding-left:40px;'> รถ : ",$result['repair_type_name']."<br> ยี่ห้อ : ".$result['repair_band_name']."<br> ป้ายทะเบียน : ".$result['repair_label'],"</p></h1>";
  ?>
  <p align='center'><img src="<?php echo base_url(); ?>assets/images/shop/repair/<?php echo $result['repair_picture']; ?>" width='300' height='200'></p>
  <?php
  echo "<button type='button' class='btn btn-primary btn-lg textcolor'>".anchor("repair","Back")."</button>";
  echo "</div>";

  echo "<div class='rightbox'>";
    echo "<div class='form-group'>";
      echo form_open();
      echo "<div class='form-group'>";
            echo "<label>ชื่อลูกค้า : </label> <input type='text' name='cus_name' value=",$result['customer_name']," class='form-control' disabled>";
      echo "</div>";

      echo "<div class='form-group'>";
            echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' name='cus_tel' class='form-control' value=",$result['customer_tel']," disabled maxlength='10'>";
      echo "</div>";

      echo "<div class='form-group'>";
            echo "<label>สาเหตุที่ต้องการซ่อม : </label>";
            echo "<p><textarea name='repair_cause' cols='50' rows='10' disabled>",$result['repair_cause'],"</textarea></p>";
      echo "</div>";

      echo "<div class='form-group'>";
            echo "<label>อะไหล่ที่ใช้ : </label> <input type='text' name='repair_product' disabled class='form-control' value=",$result['repair_product'],">";
      echo "</div>";

      echo "</div>";
    echo form_close();
  echo "</div>"; //ปิด div form-group
echo "</div>"; //center-side
echo "</div>";
  ?>
</body>
</html>
