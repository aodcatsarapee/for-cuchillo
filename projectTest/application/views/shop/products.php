<!DOCTYPE HTML>
<html>
<head>
<title>ร้าน สถิตพรอะไหล่</title>
<link href="<?php echo base_url(); ?>Frontend/css/shop/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/shop/style.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
@import url('https://fonts.googleapis.com/css?family=Kanit');
body{
  font-family: 'Kanit', sans-serif;
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
            <?php
             if($member_name !=null){
              echo "<div class='header_right' style='width:450px;'>";
   				    echo "<ul class='icon1 sub-icon1 profile_img'>";
              echo "<li style='color:white;'>ยินดีต้อนรับคุณ : ",$member_name,"&nbsp;",anchor('shop/logout',' ออกจากระบบ '),"</li>";
              echo "<li><a class='active-icon c1' href='#'> </a>";
            }else{
              echo "<div class='header_right'>";
   				    echo "<ul class='icon1 sub-icon1 profile_img'>";
              echo "<li><a class='active-icon c1' href='#'> </a>";
            }
            ?>
						<ul class="sub-icon1 list">
						   <div class="clear"></div>
               <?php
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
      <div class="row clearfix">
        <div class="col-md-3">
            <p>
                <strong>Categories</strong>
            </p>
            <br>
            <div style="-webkit-flex-basis: 0;float:left;">
              <?php echo form_open('shop/product'); ?>
              <input type='hidden' id='Sel_cate' value='<?php echo $Sel_cate['cate']; ?>'>
              <select class="form-control show-tick" name="num_cate" id='num_cate' style="width:120px;">
                <option value='all'>Show All</option>
                <?php
                foreach ($cate as $_cate) {
                  echo "<option value=",$_cate['cate_id'],">",$_cate['cate_name'],"</option>";
                }
              echo "</select>";
                ?>
              </div>
            </div>
            <div class="col-md-3">
                <p>
                    <strong>Band</strong>
                </p>
                <br>
                <div style="-webkit-flex-basis: 0;float:left;">
                <input type='hidden' id='Sel_band' value='<?php echo $Sel_cate['band']; ?>'>
                <select class="form-control show-tick" name="num_band" id='num_band' style="width:120px;">
                  <option value='all'>Show All</option>
                  <?php
                  foreach ($band as $_band) {
                    echo "<option value=",$_band['band_id'],">",$_band['band_name'],"</option>";
                  }
                echo "</select>";

                  ?>
                </div>

                <div style="-webkit-flex-basis: 0;float:left;">
                  <?php
                  echo "<input style='margin-left:20px;' type='submit' value=Search>";
                  echo form_close();
                  ?>
                </div>

            </div>

    </div>
    <br>
			<div class="row shop_box-top" id='DataProduct'>
            <?php
            foreach ($product as $_product) { //image_asset('shop/product/'.$_product['product_picture'])
              echo "<div class='col-md-3 shop_box'>";
                echo "<div class='block_img'>";
                  echo "<img src=",base_url(),"assets/images/shop/product/",$_product['product_picture']," class='img-responsive' style='height:250px;' alt=''/>";
                      echo "<div class='middle'>";
                        if($_product['product_quantity'] < 1){
                          echo "<a class='btn bg-pink waves-effect text add'>Out Of Stock</a>";
                        }else{
                          echo "<a href=",base_url(),"shop/add/",$_product['product_id']," class='btn bg-pink waves-effect text add'>Add To Cart</a>";
                        }
                      echo "</div>";
                echo "</div>";
                echo "<span class='new-box'>";
                  echo "<span class='new-label' style='background-color:#E92546;'>New</span>";
                echo "</span>";
                echo "<div class='shop_desc'>";
                echo "<h3 id='cate_nameajax' style='color:#FF3333;'>",$_product['cate_name'],"</h3>";
                echo "<h3><a href=",base_url(),"shop/detail/",$_product['product_id'],">",$_product['product_name'],"</a></h3>";
    						echo "<span class='actual'>ราคา ",number_format($_product['product_price'])," บาท</span><br>";
    						echo "<ul class='buttons'>";
    							echo "<div class='clear'> </div>";
    					  echo "</ul>";
    				    echo "</div>";
              echo "</div>";
              echo $this->pagination->create_links();
            }
            ?>

			</div>
		 </div>
	   </div>
	  </div>
    <div class="footer" style="height:100px;position: absolute;width:100%;">
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
<script>
  var baseurl = '<?php echo base_url();?>';
  function base_url(string){
    return baseurl + string;
  }

  $(document).ready(function(){
    $(window).on('load', function(){
      var get_selCate = $("#Sel_cate").val();
      var get_selBand = $("#Sel_band").val();

      if(get_selCate != null){
        $('#num_cate option[value=' + get_selCate + ']').attr('selected','selected');
      }

      if(get_selBand != null){
        $('#num_band option[value=' + get_selBand + ']').attr('selected','selected');
      }
    });
  });
</script>
