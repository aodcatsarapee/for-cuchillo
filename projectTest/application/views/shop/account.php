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
.text-email{
  border: 1px solid #EEE;
  outline-color: #00BFF0;
  width: 96%;
  font-size: 1em;
  padding: 0.5em;
  font-family: 'Open Sans', sans-serif;
}
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/shop/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
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
						<?php echo form_open('shop/editPersonal/'.$detail['member_id']);?>
								<div class="register-top-grid">
										<h3>แก้ไขข้อมูลส่วนตัวของสมาชิก</h3>
                    <div>
                      <input type="hidden" name='up_id' value="<?php echo $detail['member_id']; ?>" id='re_id' disabled>
											<span>Username<label>*</label></span>
											<input type="text" name='up_username' value="<?php echo $detail['member_username']; ?>" id='re_username' disabled>

											<span>Password<label>*</label></span>
											<input type="text" name='up_pass' value="<?php echo $detail['member_password']; ?>" id='re_pass' disabled>

											<span>First Name<label>*</label></span>
											<input type="text" name='up_first' value="<?php echo $detail['member_firstname']; ?>" id='re_first' maxlength="50" required>

											<span>Last Name<label>*</label></span>
											<input type="text" name='up_last' value="<?php echo $detail['member_lastname']; ?>" id='re_last' maxlength="50" required>

											<span>Email<label>*</label></span>
											<input type="email" name='up_email' class='text-email' value="<?php echo $detail['member_email']; ?>" id='re_email' maxlength="50" required>

											<span>Telephone<label>*</label></span>
											<input type="text" name='up_tel' class='_number' value="<?php echo $detail['member_tel']; ?>" id='re_tel' maxlength="10" required>

                      <span>Address<label>*</label></span>
											<input type="text" name='up_add' value="<?php echo $detail['member_address']; ?>" id='re_tel' maxlength="100" required>

                      <span><label></label></span>
                      <input type="submit" name='up_submit' value="แก้ไขข้อมูล">
										</div>

								</div>
            </form>
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
<script>
$(document).ready(function(){
  $("#up_email").blur(function(){
    var username = $(this).val();
    $.ajax({
      url: "<?php echo base_url() ?>shop/checkuser",
      type: "POST",
      data: {"user_name":username},
      dataType:"json",
      success:function(html)
      {
        if(!html == false){
          $("#re_username").addClass('text-danger');
          $("#register").prop('disabled','true');
        }else{
          $("#re_username").removeClass('text-danger');
        }
      }
    });
  });
});
</script>
