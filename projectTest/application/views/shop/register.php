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
.text-danger{
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid red !important;
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
						<?php echo form_open('shop/add_register');?>
								<div class="register-top-grid" style="float:left;width:600px;">
										<h3>สำหรับผู้ใช้ที่ยังไม่ได้เป็นสมาชิก</h3>
                    <div>
											<span>Username<label>*</label></span>
											<input type="text" name='re_username' id='re_username' maxlength="15" required>
                      <span id='availability'></span>

											<span>Password<label>*</label></span>
											<input type="text" name='re_pass' id='re_pass' required maxlength="10">

											<span>First Name<label>*</label></span>
											<input type="text" name='re_first' id='re_first' required maxlength="50">

											<span>Last Name<label>*</label></span>
											<input type="text" name='re_last' id='re_last' required maxlength="50">

											<span>Email<label>*</label></span>
											<input type="email" class='text-email' name='re_email' id='re_email' maxlength="50" required>

											<span>Telephone<label>*</label></span>
											<input type="text" class='_number' name='re_tel' id='re_tel' required maxlength="10">

                      <span>Address<label>*</label></span>
											<input type="text" name='re_add' id='re_add' maxlength="100" required>

                      <span><label></label></span>
                      <input type="submit" name='register' id='register' value="สมัครสมาชิก">
										</div>

								</div>
            </form>
            <?php echo form_open('shop/login'); ?>
								<div class="register-bottom-grid" style="float:right;">
										<h3>สำหรับสมาชิก</h3>
										<div>
											<span>Username<label>*</label></span>
											<input type="text" name='username'>
										</div>
										<div>
											<span>Password<label>*</label></span>
											<input type="text" name='password'>
										</div>
										<div>
                      <input type="submit" value="เข้าสู่ระบบ">
                    </div>
								</div>
            <?php echo form_close(); ?>
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
  $("#re_username").blur(function(){
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

/*$("#register").click(function(){
  var re_username = $("#re_username").val();
  var re_pass = $("#re_pass").val();
  var re_first = $("#re_first").val();
  var re_last = $("#re_last").val();
  var re_email = $("#re_email").val();
  var re_tel = $("#re_tel").val();
  var re_add = $("#re_add").val();

  $.ajax({
    url: "<?php echo base_url() ?>shop/add_register",
    type: "POST",
    data: {
      "re_username" : re_username,
      "re_pass" : re_pass,
      "re_first":re_first,
      "re_last":re_last,
      "re_email":re_email,
      "re_tel":re_tel,
      "re_add":re_add
    },
    dataType: 'json',
    success: function(data){
      window.location = "<?php echo base_url(); ?>shop/product";
    },
    error: function(){
      alert('Error....');
    }
  });

});*/
</script>
