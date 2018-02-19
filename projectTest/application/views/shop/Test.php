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
</style>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/fwslider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/bootstrap-select.js"></script>
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
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div class="header">
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<!--<a href="index.html"><img src="<?php echo base_url(); ?>Frontend/images/shop/logo.png" alt=""/></a>-->
					 </div>
					 <div class="menu">
						  <a class="toggleMenu" href="#"><img src="<?php echo base_url(); ?>Frontend/images/shop/nav.png" alt=""/></a>
						    <ul class="nav" id="nav">
                  <?php $member_name=$this->session->userdata('membername'); ?>
						    	<li><a href="<?php echo base_url(); ?>shop">HomePage</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop/product">Product</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop">Contact</a></li>
                  <?php
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

            <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/classie.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>

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

	<div class="banner">
	<!-- start slider -->
       <div id="fwslider">
         <div class="slider_container">
            <div class="slide">
               <img src="<?php echo base_url(); ?>Frontend/images/banner/eayeay.png" class="img-responsive" alt=""/>
                <div class="slide_content">
                    <div class="slide_content_wrap">

                    </div>
                </div>
            </div>

        </div>
       </div>
      </div>

      <div class="features">
  <div class="container">
    <h3 class="m_3">About Us</h3>
    <div class="close_but"><i class="close1"> </i></div>
      <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h2 style="text-align:center;">ร้านสถิตพรอะไหล่ ตั้งอยู่ที่ 227 หมู่.2 ตำบลตลาดใหญ่ อำเภอดอยสะเก็ด จังหวัดเชียงใหม่ 50220</h2>
        </div>
    </div>
   </div>
   <hr>
   <div class="row">
     <div class="col-md-12">
       <h3 class="m_3">แผนที่ / Fanpage</h3>
       <div class="fb-page" data-href="https://web.facebook.com/satitpornautoparts/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
       <right><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.5899189258553!2d99.12025461427235!3d18.81642016497145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da2660ba1e28ad%3A0x82825bbc7e9a9797!2z4Liq4LiW4Li04LiV4Lii4LmM4Lie4LijIOC4reC4sOC5hOC4q-C4peC5iA!5e0!3m2!1sth!2sth!4v1518989010174" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></right>
      </div>
      </div>

      <div class="row">
        <div class="col-md-12">

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
