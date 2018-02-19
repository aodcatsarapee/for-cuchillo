<?php
  if($this->session->userdata['username'] == null){
    redirect('admin');
  }else{
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ระบบจัดการร้าน สถิตพรอะไหล่</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">

</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#"><strong>SATITPORN SHOP</strong></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">


                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url();?>Frontend/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><h4>Welcome : <?php echo $this->session->userdata['name']; ?></h4></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url(); ?>employee/detail/<?php echo $employee['user_id']; ?>"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo base_url();?>user/logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php
                    $type=$this->session->userdata['type'];
                    if($type == '2'){
                      echo "<li class='active'>";
                          echo "<a href=",base_url(),"owner/home>";
                              echo "<i class='material-icons'>home</i>";
                              echo "<span>Home</span>";
                          echo "</a>";
                      echo "</li>";
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>swap_calls</i>";
                              echo "<span>ประวัติรายการสินค้าที่ลูกค้าสั่ง</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"sell/history>";
                                    echo "<span>ประวัติรายการสินค้าที่ลูกค้าสั่ง (หลังร้าน)</span>";
                                  echo "</a>";
                              echo "</li>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"sell/history_website>";
                                    echo "<span>ประวัติรายการสินค้าที่ลูกค้าสั่ง (ออนไลน์)</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>map</i>";
                              echo "<span>ข้อมูลจัดอันดับสินค้าขายดี</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"sell/ranking>";
                                    echo "<span>ข้อมูลจัดอันดับสินค้าขายดี</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>map</i>";
                              echo "<span>จัดการข้อมูลการซ่อม</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"repair>";
                                    echo "<span>ข้อมูลการซ่อม</span>";
                                  echo "</a>";
                              echo "</li>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"repair/history>";
                                    echo "<span>ข้อมูลรถยอดนิยมที่เข้ามาซ่อม</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      /*echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>map</i>";
                              echo "<span>ข้อมูลยอดขายสินค้า</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"repair/history>";
                                    echo "<span>ข้อมูลยอดขายสินค้า (เงินสด)</span>";
                                  echo "</a>";
                              echo "</li>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"repair/history>";
                                    echo "<span>ข้อมูลยอดขายสินค้า (เงินเชื่อ)</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>map</i>";
                              echo "<span>ข้อมูลยอดจ่ายค่างวด</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"repair/history>";
                                    echo "<span>ข้อมูลยอดจ่ายค่างวด</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";*/
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>map</i>";
                              echo "<span>ข้อมูลการส่งสินค้า</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"delivery/history>";
                                    echo "<span>บันทึกข้อมูลการส่งของ</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      /*echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>map</i>";
                              echo "<span>ข้อมูลรายรับรายจ่ายและกำไร</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"sell/conclude_sell>";
                                    echo "<span>ข้อมูลรายรับรายจ่ายและกำไร</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";*/
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>content_copy</i>";
                              echo "<span>จัดการข้อมูลสินค้า</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"product>";
                                    echo "<span>ข้อมูลสินค้า</span>";
                                  echo "</a>";
                              echo "</li>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"product/categories>";
                                    echo "<span>ข้อมูลประเภทสินค้า</span>";
                                  echo "</a>";
                              echo "</li>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"product/band>";
                                    echo "<span>ข้อมูลแบรนด์สินค้า</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>assignment</i>";
                              echo "<span>จัดการข้อมูลพนักงาน</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"employee>";
                                    echo "<span>จัดการข้อมูลพนักงาน</span>";
                                  echo "</a>";
                              echo "</li>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"employee/salary>";
                                    echo "<span>จัดการข้อมูลเงินเดือน</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                      echo "<li>";
                          echo "<a href='javascript:void(0);' class='menu-toggle'>";
                              echo "<i class='material-icons'>assignment</i>";
                              echo "<span>ข้อมูลสมาชิก</span>";
                          echo "</a>";
                          echo "<ul class='ml-menu'>";
                              echo "<li>";
                                  echo "<a href=",base_url(),"member>";
                                    echo "<span>ข้อมูลสมาชิก</span>";
                                  echo "</a>";
                              echo "</li>";
                          echo "</ul>";
                      echo "</li>";
                    }else if($type == '3'){
                    echo "<li class='active'>";
                        echo "<a href=",base_url(),"sell>";
                            echo "<i class='material-icons'>home</i>";
                            echo "<span>Home</span>";
                        echo "</a>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>content_copy</i>";
                            echo "<span>จัดการข้อมูลสินค้า</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"product>";
                                  echo "<span>ข้อมูลสินค้า</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"product/categories>";
                                  echo "<span>ข้อมูลประเภทสินค้า</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"product/band>";
                                  echo "<span>ข้อมูลแบรนด์สินค้า</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>map</i>";
                            echo "<span>ข้อมูลจัดอันดับสินค้าขายดี</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"sell/ranking>";
                                  echo "<span>ข้อมูลอันดับสินค้าขายดี</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>swap_calls</i>";
                            echo "<span>ประวัติรายการสินค้าที่ลูกค้าสั่ง</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"sell/history>";
                                  echo "<span>ประวัติรายการสินค้าที่ลูกค้าสั่ง (หลังร้าน)</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"sell/history_website>";
                                  echo "<span>ประวัติรายการสินค้าที่ลูกค้าสั่ง (ออนไลน์)</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>widgets</i>";
                            echo "<span>ขายสินค้า</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"sell>";
                                    echo "<span>ขายสินค้า (เงินสด)</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"sell/debtor>";
                                    echo "<span>ขายสินค้า (เงินเชื่อ)</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>perm_media</i>";
                            echo "<span>จัดการข้อมูลลูกค้าขายเชื่อ</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"debtor>";
                                  echo "<span>ข้อมูลลูกค้าขายเชื่อ</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                  }else if($type == '4'){
                    echo "<li class='active'>";
                        echo "<a href=",base_url(),"delivery>";
                            echo "<i class='material-icons'>home</i>";
                            echo "<span>Home</span>";
                        echo "</a>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>trending_down</i>";
                            echo "<span>จัดการข้อมูลการส่งของ</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"delivery>";
                                  echo "<span>ข้อมูลการส่งของ</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"delivery/history>";
                                  echo "<span>บันทึกข้อมูลการส่งของ</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                  }else if($type == '5'){
                    echo "<li class='active'>";
                        echo "<a href=",base_url(),"repair>";
                            echo "<i class='material-icons'>home</i>";
                            echo "<span>Home</span>";
                        echo "</a>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>pie_chart</i>";
                            echo "<span>จัดการข้อมูลการซ่อม</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                            echo "<li>";
                                echo "<a href=",base_url(),"repair>";
                                  echo "<span>ข้อมูลการซ่อม</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"repair/conclude>";
                                  echo "<span>ข้อมูลสรุปการซ่อม</span>";
                                echo "</a>";
                            echo "</li>";
                            echo "<li>";
                                echo "<a href=",base_url(),"repair/history>";
                                  echo "<span>ข้อมูลรถยอดนิยมที่เข้ามาซ่อม</span>";
                                echo "</a>";
                            echo "</li>";
                        echo "</ul>";
                    echo "</li>";
                  }else if($type == '1'){
                    echo "<li class='active'>";
                        echo "<a href=",base_url(),"customer>";
                            echo "<i class='material-icons'>home</i>";
                            echo "<span>Home</span>";
                        echo "</a>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a href='javascript:void(0);' class='menu-toggle'>";
                            echo "<i class='material-icons'>view_list</i>";
                            echo "<span>จัดการข้อมูลผู้ใช้</span>";
                        echo "</a>";
                        echo "<ul class='ml-menu'>";
                          echo "<li>";
                              echo "<a href=",base_url(),"user>";
                                echo "<span>จัดการข้อมูลผู้ใช้</span>";
                              echo "</a>";
                          echo "</li>";
                          /*echo "<li>";
                              echo "<a href=",base_url(),"customer/permission>";
                                echo "<span>จัดการข้อมูลสิทธิ์การเข้าใช้งาน</span>";
                              echo "</a>";
                          echo "</li>";
                        echo "</ul>";
                    echo "</li>";*/
                  }
                    ?>
                    <!--<li class="header">LABELS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li>-->
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 - 2018 <a href="javascript:void(0);">By Sorawit & Patcharapan</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0 Beta
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
<?php

}
?>
