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
						    	<li><a href="<?php echo base_url(); ?>shop">HomePage</a></li>
						    	<li><a href="<?php echo base_url(); ?>shop/product">Product</a></li>
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
	    		  <!-- start search-->

						<!----search-scripts---->
            <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/classie.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>
						<!----//search-scripts---->
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


<div class="features">
  <div class="container">
    <h3 class="m_3">สั่งซื้อเสร็จเรียบร้อยแล้ว</h3>
		<h3 class="m_3"><strong>ขอบคุณที่ไว้ใจใช้บริการ ร้านสถิตพรอะไหล่<strong></h3>
    <div class="close_but"><i class="close1"> </i></div>
      <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h2 style="text-align:center;">กรุณาจดจำเลขที่สั่งซื้อ "<?php echo $detail['sell_id']; ?>" นี้ เพื่อประโยชน์ในการแจ้งโอนเงินของท่าน</h2>

				</div>
    </div>
   </div>
    </div>

      <div class="footer" style="height:100px;bottom:0px;position: fixed;width:100%;">
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
