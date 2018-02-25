<!DOCTYPE HTML>
<html>
<head>
<title>ร้าน สถิตพรอะไหล่</title>
<link href="<?php echo base_url(); ?>Frontend/css/shop/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/shop/style.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
@import url('https://fonts.googleapis.com/css?family=Kanit');
body{
  font-family: 'Kanit', sans-serif;
}
.right{
	text-align:right !important;
}
</style>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.steps.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
 </head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<a href="index.html"><img src="images/logo.png" alt=""/></a>
					 </div>
					 <div class="menu">
						  <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
						    <ul class="nav" id="nav">
                  <li><a href="<?php echo base_url(); ?>shop">HomePage</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop/product">Product</a></li>
                  <li><a href="<?php echo base_url(); ?>shop/product/bestsell">Best Seller</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop">Contact</a></li>
                  <?php
                    $member_name=$this->session->userdata('membername');
                    if($member_name != null){
                      echo "<li><a href=",base_url(),"shop/account/",$member_name,">My Account</a></li>";
                    }
                  ?>
								<div class="clear"></div>
							</ul>
						<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/responsive-nav.js"></script>
				    </div>
	    		    <div class="clear"></div>
	    	    </div>
	            <div class="header_right">
                <ul class="icon1 sub-icon1 profile_img">
    					 <li><a class="active-icon c1" href="#"> </a>
    						<ul class="sub-icon1 list">
                  <div class="clear"></div>
                  <?php

                   if($member_name !=null){
                    echo "<strong>ยินดีต้อนรับคุณ : </strong>",$member_name,"&nbsp;",anchor('shop/logout',': ออกจากระบบ'),"";
                    echo "<hr>";
                   }
                   $cart=$this->cart->contents();
                   foreach($cart as $item){
                     echo "<li class='list_img'><img src=",base_url(),"assets/images/shop/product/",$item['picture']," style='width:50px;' alt=''/></li>";
                     echo "<li class='list_desc'>";
                       echo "<h4>";
                         echo "<a href=",base_url(),"shop/detail/",$Get_product['product_id'],">",$item['name'],"</a>";
                       echo "</h4>";
                       echo "<span class='actual'>",$item['qty']," x ",number_format($item['price']),"฿</span>";
                       echo "<hr>";
                     echo "</li>";

                   }
                  ?>
                 <div class="login_buttons">
                  <div class="check_button"><a href="<?php echo base_url(); ?>shop/checkout">Check out</a></div>
                  <?php
                  if($member_name == null){
                    echo "<div class='login_button'><a href=",base_url(),"shop/register>Login</a></div>";
                  }
                  ?>
                  <div class="clear"></div>
                 </div>
                 <div class="clear"></div>
    						</ul>
    					 </li>
    				   </ul>
		        <div class="clear"></div>
	       </div>
	      </div>
		 </div>
	    </div>
	  </div>
     <div class="main">
      <div class="shop_top">
    		<div class="container">
          <?php
            $cart=$this->cart->contents();
            if(empty($cart)){
              echo "<h4 class='title'>ตระกร้าสินค้าไม่มีสินค้าอยู่</h4>";
              echo "<p class='cart'>กรุณาเลือกหยิบสินค้าใส่ตระกร้าก่อน.<br>Click<a href=",base_url(),"shop/product> here</a> เพื่อกลับไปเลือกซื้อสินค้า</p>";
            }else{
              echo "<p>";
                echo "<div class='span9'>";
                  echo "<h4 class='title'><strong>Your</strong> Cart</h4>";
                  echo "<table class='table table-striped'>";
                    echo "<thead>";
                      echo "<tr>";
                        echo "<th>Remove</th>";
                        echo "<th>Image</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Quantity</th>";
                        echo "<th>Unit Price</th>";
                        echo "<th>Total</th>";
                      echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    $totalprice=$this->cart->total();
                    foreach($cart as $item){
                        echo "<tr>";
                          echo "<td>".anchor('shop/delcart/'.$item['rowid'].'','Remove')."</td>";
                          echo "<td><a href=",base_url(),"shop/detail/",$item['pro_id'],"><img alt='' src=",base_url(),"assets/images/shop/product/",$item['picture']," style='width:50px;'></a></td>";
                          echo "<td>",$item['name'],"</td>";
                          echo "<td>",number_format($item['qty']),"</td>";
                          echo "<td>",number_format($item['price'])," บาท</td>";
                          echo "<td>",number_format($item['subtotal'])," บาท</td>";
                        echo "</tr>";
                    }
                      echo "<tr>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td><strong>",number_format($totalprice)," บาท</strong></td>";
                      echo "</tr>";
                    echo "</tbody>";
                  echo "</table>";
                    echo "<hr>";
                    echo "<p class='cart-total right'>";
                      echo "<strong>Sub-Total</strong> :",number_format($totalprice)," บาท<br>";
                      echo "<strong>Discount (0 %)</strong> : 00.00<br>";
                      echo "<strong>Total</strong> :",number_format($totalprice)," บาท<br>";
                      echo "<br>";
                      echo form_open('shop/confirmorder');?>
                        <input type='hidden' name='sell_id' <?php if($sell['sell_id']==""){$sell_id='1';}else{$sell_id=$sell['sell_id'];}?> value="<?php echo $sell_id;?>">
                        <?php
                        echo "<input type='hidden' name='sell_total' value=",$totalprice,">";
                        echo "<input type='hidden' name='member_id' value=",$member['member_id'],">";
                        echo "<input type='submit' class='btn btn-inverse' style='background-color:#CCFF99;color:black;' value='ยืนยันการสั่งซื้อสินค้า'>";
                      echo form_close();
                    echo "</p>";
                  echo "</div>";
                echo "</p>";
            }
        ?>
    	  </div>
	   </div>
	  </div>
    <div class="footer" style="height:100px;width:100%;bottom:0;">
			<div class="container">
				<div class="row">

				</div>
				<div class="row footer_center">
				    <div class="copy">
			       <p>© 2017 - 2018 By Sorawit & Patcharapan</p>
		        </div>
   				</div>
			</div>
		</div>
</body>
</html>
