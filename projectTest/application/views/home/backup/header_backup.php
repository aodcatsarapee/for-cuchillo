<html>
<head>
<meta charset="utf-8">
<title>ขายสินค้าของ ร้านสถิตพรอะไหล่</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
@import url('https://fonts.googleapis.com/css?family=Athiti');
</style>
</head>
<body style="font-family: 'Athiti', sans-serif;">
<?php
    //echo css_asset('bootstrap.min.css');
    echo css_asset('testdiv.css');
    echo css_asset('well_welcom.css');

echo "<div class='container-fuild'>";
echo "<div class='well' style='background-color:#87CEEB;'>";
    echo "<h1 align='center'>ระบบจัดการร้าน สถิตพรอะไหล่</h1>";
echo "</div>";

echo "<div class='row'>";
    echo "<div class='col-md-2'>";

        echo "<div>";
            echo "<table>";
            echo "<tr>";
              echo "<th>";
                    $name=$employee['emp_name'];
                    echo "<p class='well_welcom well_welcom-sm' style>ยินดีต้อนรับคุณ : ",$name,"</p>";

                    if($employee['user_position']==1){ //ผู้ดูแลระบบ

                    }else if($employee['user_position']==2){ //เจ้าของร้าน
                        echo "<ul id='nav' class='dropdown'>";
                        echo "<li>".anchor("employee","จัดการข้อมูลพนักงาน")."</li>";
                        echo "<li>".anchor("customer","จัดการข้อมูลผู้ใช้")."</li>";
                        echo "<li class='link'><a class='link' href='#'>จัดการข้อมูลสินค้า</a></li>";
                          echo "<ul class='second' style='display:none;'>";
                              echo "<li>".anchor("product","ข้อมูลสินค้า")."</li>";
                              echo "<li>".anchor("product/categories","ข้อมูลประเภทสินค้า")."</li>";
                              echo "<li>".anchor("product/band","ข้อมูลแบรนด์สินค้า")."</li>";
                          echo "</ul>";
                        echo "<li class='linkhistory'><a class='linkhistory' href='#'>ประวัติรายการสินค้าที่ลูกค้าสั่ง</a></li>";
                          echo "<ul class='secondhistory' style='display:none;'>";
                              echo "<li>".anchor("sell/history","ประวัติรายการสินค้าที่ลูกค้าสั่ง"),"</li>";
                              echo "<li>".anchor("sell/history_website","ประวัติรายการสินค้าที่ลูกค้าสั่ง (ออนไลน์)"),"</li>";
                          echo "</ul>";
                        echo "<li>".anchor("debtor","ข้อมูลลูกค้าขายเชื่อ"),"</li>";
                        echo "<li>".anchor("sell/ranking","ข้อมูลจัดอันดับสินค้าขายดี"),"</li>";
                        echo "<li class='linksell'><a class='linksell' href='#'>ขายสินค้า</a></li>";
                          echo "<ul class='secondsell' style='display:none;'>";
                              echo "<li>".anchor("sell","ขายสินค้า (เงินสด)"),"</li>";
                              echo "<li>".anchor("sell/debtor","ขายสินค้า (เงินเชื่อ)")."</li>";
                          echo "</ul>";
                        echo "<li>".anchor("sell/income","รายการสรุปข้อมูลรายรับ/รายจ่าย"),"</li>"; //ลบออกด้วย
                        echo "<li>".anchor("delivery","ข้อมูลการส่งของ"),"</li>"; //ลบออกด้วย
                        echo "<li class='linkrepair'><a class='linkrepair' href='#'>ข้อมูลการซ่อม</a></li>";
                          echo "<ul class='secondrepair' style='display:none;'>";
                              echo "<li>".anchor("repair","ข้อมูลการซ่อม"),"</li>";
                              //echo "<li>".anchor("sell/debtor","ขายสินค้า (เงินเชื่อ)")."</li>";
                          echo "</ul>";
                        echo "</ul>";
                        echo "<hr>";
                    }else if($employee['user_position']==3){ //พนักงานขาย
                        echo "<ul>";
                        echo "<li>".anchor("product","จัดการข้อมูลสินค้า")."</li>";
                        echo "<li>".anchor("sell","ขายสินค้า"),"</li>";
                        echo "<li>".anchor("debtor","ข้อมูลลูกค้าขายเชื่อ"),"</li>";
                        echo "<li>".anchor("sell/income","รายการสรุปข้อมูลรายรับ/รายจ่าย"),"</li>";
                        echo "<li>".anchor("sell/ranking","ข้อมูลจัดอันดับสินค้าขายดี"),"</li>";
                        echo "<li>".anchor("sell/history","ประวัติการขายสินค้า"),"</li>";
                        echo "<li>".anchor("sell/history","ประวัติรายการสินค้าที่ลูกค้าสั่ง (ออนไลน์)"),"</li>";
                        echo "</ul>";
                        echo "<hr>";
                    }else if($employee['user_position']==4){ //พนักงานส่งของ
                        echo "<ul>";
                        echo "<li>".anchor("delivery","ข้อมูลการส่งของ"),"</li>";
                        echo "<li>".anchor("delivery/record","บันทึกการส่งสินค้า")."</li>";
                        echo "</ul>";
                        echo "<hr>";
                    }else if($employee['user_position']==5){ //พนักงานซ่อม
                        echo "<ul>";
                        echo "<li>".anchor("repair","จัดการข้อมูลการซ่อม"),"</li>";
                        echo "<li>".anchor("repair/conclude","สรุปข้อมูลการซ่อมสินค้า")."</li>";
                        echo "</ul>";
                        echo "<hr>";
                    }else if($this->session->userdata('username')==null){
                      echo "ไม่มีการเข้าใช้งาน";
                    }

                    echo "<center><button type='button' class='btn' style='a:visited {color: black;}'>".anchor("user/logout","Logout"),"</button></center>";
              echo "</th>";
            echo "</tr>";
            echo "</table>";
        echo "</div>"; //ปิด left-side

    echo "</div>"; //ปิด col-md-3
    ?>

<script>
  $(document).ready(function(){
    $('ul#nav').each(function() {
        var $dropdown = $(this);

        $("a.link").click(function(e) {
            e.preventDefault();
            $("a.link").addClass('active');
            $("ul.second", "ul#nav.dropdown").toggle();
            return false;
        });

        $("a.linksell").click(function(e) {
            e.preventDefault();
            $("a.linksell").addClass('active');
            $("ul.secondsell", "ul#nav.dropdown").toggle();
            return false;
        });

        $("a.linkhistory").click(function(e) {
            e.preventDefault();
            $("a.linkhistory").addClass('active');
            $("ul.secondhistory", "ul#nav.dropdown").toggle();
            return false;
        });

        $("a.linkrepair").click(function(e) {
            e.preventDefault();
            $("a.linkrepair").addClass('active');
            $("ul.secondrepair", "ul#nav.dropdown").toggle();
            return false;
        });
    });
});
</script>
