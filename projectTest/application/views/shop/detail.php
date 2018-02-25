<!DOCTYPE HTML>
<html>
<head>
<title>ร้าน สถิตพรอะไหล่</title>
<link href="<?php echo base_url(); ?>Frontend/css/shop/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/shop/style.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/shop/fwslider.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
@import url('https://fonts.googleapis.com/css?family=Kanit');
body{
  font-family: 'Kanit', sans-serif;
}
}
.block_img {
    position: relative;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.block_img:hover .image {
  opacity: 0.3;
}

.block_img:hover .middle {
  opacity: 1;
}

.text {
  background-color: white;
  color: black;
  font-size: 16px;
  padding: 16px 32px;
  width: 100%;
  border-radius: 15px
}
.add:hover{
  background-color: #ff6a00;
  color:white;
  border-radius: 15px
}
</style>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/jquery.min.js"></script>
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
     <!----details-product-slider--->
				<!-- Include the Etalage files -->
					<link rel="stylesheet" href="css/etalage.css">
					<script src="js/jquery.etalage.min.js"></script>
				<!-- Include the Etalage files -->
				<script>
						jQuery(document).ready(function($){

							$('#etalage').etalage({
								thumb_image_width: 300,
								thumb_image_height: 400,

								show_hint: true,
								click_callback: function(image_anchor, instance_id){
									alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
								}
							});
							// This is for the dropdown list example:
							$('.dropdownlist').change(function(){
								etalage_show( $(this).find('option:selected').attr('class') );
							});

					});
				</script>
				<!----//details-product-slider--->
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
						  <a class="toggleMenu" href="#"><img src="<?php echo base_url(); ?>Frontend/images/shop/nav.png" alt=""/></a>
						    <ul class="nav" id="nav">
						    	<li><a href="<?php echo base_url(); ?>shop">HomePage</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop/product">Product</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop/contact">Contact</a></li>
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
                 $member_name=$this->session->userdata('membername');
                 if($member_name !=null){
                  echo "<strong>ยินดีต้อนรับคุณ : </strong>",$member_name,"&nbsp;",anchor('shop/logout',' : ออกจากระบบ'),"";
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
			<div class="row">
				<div class="col-md-9 single_left">
				   <div class="single_image">
								<a href="#">
                  <?php
									  echo "<img src=",base_url(),"assets/images/shop/product/",$product['product_picture']," class='img-responsive' style='height:250px;' alt=''/>";
                  ?>
                </a>
					  </div>
				        <!-- end product_slider -->
				        <div class="single_right">
				        	<h3><?php echo $product['product_name']; ?></h3>
				        	<p class="m_10"></p>
                  <h4 class="m_12">จำนวนสินค้า</h4>
                  <p class="m_10"><?php echo $product['product_quantity']; ?> ชิ้น</p>
								  <h4 class="m_12">แบรนด์สินค้า</h4>
                  <p class="m_10"><?php echo $product['band_name']; ?></p>
								<h3>ประเภทสินค้า</h3>
								<p class="m_10"><?php echo $product['cate_name']; ?></p>
								<div class="clear"> </div>
							<div class="btn_form">
							  <br>
							</div>
							<ul class="add-to-links">
    			              <li><img src="images/wish.png" alt=""><a href="#"></a></li>
    			            </ul>
				        </div>
				        <div class="clear"> </div>
				</div>
				<div class="col-md-3">
				  <div class="box-info-product">
					<p class="price2"><?php echo number_format($product['product_price']);?> บาท</p>
              <?php if($product['product_quantity'] < 1){
                echo "<a ><button type='submit' name='Submit' class='exclusive'>
                   <span>Out Of Stock</span>
                </button></a>";
             }else{
               echo "<a href=",base_url(),"shop/add/".$product['product_id'],"><button type='submit' name='Submit' class='exclusive'>
                  <span>Add to cart</span>
               </button></a>";
             } ?>
				   </div>
			   </div>
			</div>
			<div class="desc">
			   	<h4>Description</h4>
			   	<p><?php echo $product['product_detail']; ?></p>
			</div>
			<div class="row">
				<h4 class="m_11">สินค้าอื่น ๆ</h4>
        <?php
        foreach ($allproduct as $_allproduct) {
          echo "<div class='col-md-3 shop_box'>";
            echo "<div class='block_img'>";
              echo "<img src=",base_url(),"assets/images/shop/product/",$_allproduct['product_picture']," class='img-responsive' style='height:250px;' alt=''/>";
              echo "<div class='middle'>";
                echo "<a href=",base_url(),"shop/add/",$_allproduct['product_id']," class='btn bg-pink waves-effect text add'>Add To Cart</a>";
              echo "</div>";
            echo "</div>";
            echo "<div class='shop_desc'>";
            echo "<h3 style='color:#FF3333;'>",$_allproduct['cate_name'],"</h3>";
            echo "<h3><a href=",base_url(),"shop/detail/",$_allproduct['product_id'],">",$_allproduct['product_name'],"</a></h3>";
            echo "<span class='actual'>ราคา ",number_format($_allproduct['product_price'])," บาท</span><br>";
            echo "<ul class='buttons'>";
              //echo "<li class='cart'></li>";
              //echo "<li class='cart'>".anchor('shop/add/'.$_product['product_id'].'','หยิบสินค้าใส่ตะกร้า'),"</li>";
              echo "<div class='clear'> </div>";
            echo "</ul>";
            echo "</div>";
          echo "</div>";
        }
        ?>
			</div>
	     </div>
	   </div>
	  </div>
    <div class="footer" style="height:100px;">
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
