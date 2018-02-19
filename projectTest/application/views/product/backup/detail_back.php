<html>
<head>
<title>รายละเอียดสินค้าของ ร้านสถิตพรอะไหล่</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.leftbox{ width: 450px;height: 200px;float:left;margin-right: 50px;}
.rightbox{width: 500px;float:right;}
.textcolor a:visited{color:white !important;}
</style>
</head>
<body>
  <?php
  $back=image_asset('icon/back.png');
  echo "<div class='leftbox'>";
  echo "<h1 style='padding-left:40px;'>",$result['product_name'],"</h1>";
  ?>
  <p align='center'><img src="<?php echo base_url(); ?>assets/images/shop/product/<?php echo $result['product_picture']; ?>" width='300' height='200'></p>
  <?php
  echo "<button type='button' class='btn btn-primary btn-lg textcolor'>".anchor("product","Back")."</button>";
  echo "</div>";

  echo "<div class='rightbox'>";
    echo "<div class='form-group'>";
      echo form_open();
        echo "<div class='form-group'>";
            echo "<label>Barcode : </label> <input type='text' value=",$result['product_barcode']," class='form-control' disabled>";
        echo "</div>";

        echo "<div class='form-group'>";
            echo "<label>ต้นทุนสินค้า : </label> <input type='text' value=",$result['product_cost']," class='form-control' disabled>";
        echo "</div>";

        echo "<div class='form-group'>";
            echo "<label>ราคาสินค้า : </label> <input type='text' value=",$result['product_price']," class='form-control' disabled>";
        echo "</div>";

        echo "<div class='form-group'>";
          echo "<label>จำนวนสินค้า : </label> <input type='text' value=",$result['product_quantity']," class='form-control' disabled>";
        echo "</div>";

        echo "<div class='form-group'>";
          echo "<label>ประเภทสินค้า : </label> <input type='text' value=",$result['product_cate']," class='form-control' disabled>";
        echo "</div>";

        echo "<div class='form-group'>";
          echo "<label>แบนด์สินค้า : </label> <input type='text' value=",$result['product_band']," class='form-control' disabled>";
        echo "</div>";
      echo "</div>";
    echo form_close();
  echo "</div>"; //ปิด div form-group
echo "</div>"; //center-side
  ?>


<?php

/*echo "<h1 align='center'>",$result['product_name'],"</h1>";?>

<p align='center'><img src="<?php echo base_url(); ?>images/<?php echo $result['product_picture']; ?>" width='500' height='200'></p>

<?php

echo "<table align='center'>";
echo "<tr>";
  echo "<th>ราคาสินค้า : </th>";
  echo "<th>",$result['product_price'],"</th>";
echo "</tr>";

foreach($cate as $product_cate){
    if($result['product_cate'] == $product_cate['cate_id']){
          $new_cate=$product_cate['cate_name'];
    }
}

echo "<tr>";
  echo "<th>ประเภทของสินค้า : </th>";
  echo "<th>",$new_cate,"</th>";
echo "</tr>";

foreach($band as $product_band){
    if($result['product_band'] == $product_band['band_id']){
          $new_band=$product_band['band_name'];
    }
}

echo "<tr>";
  echo "<th>แบนด์ของสินค้า : </th>";
  echo "<th>",$new_band,"</th>";
echo "</tr>";

echo "<tr>";
  echo "<th>รายละเอียดของสินค้า : </th>";
  echo "<th>",$result['product_price'],"</th>";
echo "</tr>";

echo "</table>";
echo "<hr>";
echo "<center>",anchor("product","กลับหน้าแรก"),"</center>";*/


?>
</body>
</html>
