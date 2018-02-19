<html>
<head>
<title>ร้าน สถิตย์พรอะไหล่</title>
<?php echo css_asset('bootstrap.min.css'); ?>
<?php echo css_asset('well_welcom.css'); ?>
</head>
<body>
<?php

if(empty($this->session->userdata('username'))){
    redirect('home/index  ','refresh');
}else{
    echo "<div class='container-fluid'>";
      echo "<div class='well'>";
          echo "<h2 align='center'>ระบบจัดการร้าน สถิตย์อะไหล่ เชียงใหม่</h2>";
      echo "</div>"; //ปิด well

      echo "<div class='row'>";
        echo "<div class='col-md-3'>";
          echo "<table>";
          echo "<tr>";
            echo "<th>";
                  foreach($position as $session_name){
                    $name=$session_name['emp_name'];
                  }
                  if($session_name['user_position']==1){ //ผู้ดูแลระบบ
                      echo "<p class='well_welcom well_welcom-sm'>ยินดีต้อนรับคุณ : ",$name,"</p>";
                  }else if($session_name['user_position']==2){ //เจ้าของร้าน
                      echo "<p class='well_welcom well_welcom-sm'>ยินดีต้อนรับคุณ : ",$name,"</p>";
                      echo "<p>".anchor("employee","จัดการข้อมูลพนักงาน")."</p>";
                      echo "<p>".anchor("product","จัดการข้อมูลสินค้า")."</p>";
                  }else if($session_name['user_position']==3){ //พนักงานขาย
                      echo "<p class='well_welcom well_welcom-sm'>ยินดีต้อนรับคุณ : ",$name,"</p>";
                      echo "<ul>";
                      echo "<li>".anchor("product","จัดการข้อมูลสินค้า")."</li>";
                      echo "<li>".anchor("sell","ขายสินค้า"),"</li>";
                      echo "<li>".anchor("debtor/form_insert","เพิ่มข้อมูลลูกค้าขายเชื่อ"),"</li>";
                      echo "<li>".anchor("sell/ranking","อันดับสินค้าขายดี"),"</li>";
                      echo "<li>".anchor("sell/history","ประวัติการขายสินค้า"),"</li>";
                      echo "<li>".anchor("sell/history","ประวัติรายการสินค้าที่ลูกค้าสั่ง (ออนไลน์)"),"</li>";
                      echo "</ul>";
                      echo "<hr>";
                      echo "<center><button type='button' class='btn btn-danger btn-lg'>".anchor("user/logout","Logout"),"</button></center>";
                  }else if($session_name['user_position']==4){ //พนักงานส่งของ
                    echo "<p class='well_welcom well_welcom-sm'>ยินดีต้อนรับคุณ : ",$name,"</p>";
                    echo "<ul>";
                    echo "<li>".anchor("delivery","ข้อมูลการส่งของ"),"</li>";
                    echo "<li>".anchor("delivery/record","บันทึกการส่งสินค้า")."</li>";
                    echo "</ul>";
                    echo "<hr>";
                    echo "<center><button type='button' class='btn btn-danger btn-lg'>".anchor("user/logout","Logout"),"</button></center>";
                  }else if($this->session->userdata('username')==null){
                    echo "ไม่มีการเข้าใช้งาน";
                  }
            echo "</th>";
          echo "</tr>";
          echo "</table>";
      echo "</div>"; //ปิด col-md-3

      echo "<div class='col-md-9'>";
    }
      ?>
