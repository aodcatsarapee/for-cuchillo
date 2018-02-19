<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!-- bootstrap -->
		<?php
				//CSS
				echo css_asset('shop/css/bootstrap.min.css');
				echo css_asset('shop/css/bootstrap-responsive.min.css');
				echo css_asset('shop/css/bootstrappage.css');
				echo css_asset('shop/css/flexslider.css');
				echo css_asset('shop/css/main.css');

				//scripts
				echo js_asset('shop/js/jquery-1.7.2.min.js');
				echo js_asset('shop/js/bootstrap.min.js');
				echo js_asset('shop/js/superfish.js');
				echo js_asset('shop/js/jquery.scrolltotop.js');
		?>
	</head>
    <body>
		<?php $cart=$this->cart->contents(); ?>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							<li><?php echo anchor('shop','Home Page'); ?></li>
							<li><?php echo anchor('shop/checkout','Checkout'); ?></li>
							<?php
									$member_name=$this->session->userdata('membername');
									if($member_name !=null){
										echo "<li>ยินดีต้อนรับคุณ : ",$member_name,"</li>";
									}else{
										echo "<li>".anchor('shop/register','Login')."</li>";
									}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<a href="index.html" class="logo pull-left"><img src="themes/images//logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><?php echo anchor("shop/product","Product");?></li>
							<li><a href="#">Best Seller</a></li>
							<li><?php echo anchor('shop/cart','Your Cart'." [ ".count($cart)." ] "); ?></li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
				<h4><span>Login or Regsiter</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span5">
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<?php
								echo form_open('shop/login');
									echo "<input type='hidden' name='next' value='/'>";
									echo "<fieldset>";
										echo "<div class='control-group'>";
											echo "<label class='control-label'>Username</label>";
											echo "<div class='controls'>";
												echo "<input type='text' placeholder='Enter your username' name='username' id='username' class='input-xlarge'>";
											echo "</div>";
										echo "</div>";
										echo "<div class='control-group'>";
											echo "<label class='control-label'>Password</label>";
											echo "<div class='controls'>";
												echo "<input type='password' placeholder='Enter your password' name='password' id='password' class='input-xlarge'>";
											echo "</div>";
										echo "</div>";
										echo "<div class='control-group'>";
											echo "<input tabindex='3' class='btn btn-inverse large' type='submit' id='signin' value='Sign into your account'>";
											echo "<hr>";
										echo "</div>";
									echo "</fieldset>";
								echo form_close();
						?>
					</div>
					<div class="span7">
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<form action="#" method="post" class="form-stacked" id="frm-create">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Username :</label>
									<div class="controls">
										<input type="text" placeholder="Enter your username" class="input-xlarge" id='reg_username'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Email address :</label>
									<div class="controls">
										<input type="text" placeholder="Enter your email" class="input-xlarge" id='reg_email'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password :</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" class="input-xlarge" id='reg_password'>
									</div>
								</div>
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" id='submit' value="Create your account"></div>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="./index.html">Homepage</a></li>
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="./register.html">Login</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script>

				$('#submit').on('click', function(){
					var username = $('#reg_username').val();
					var password = $('#reg_password').val();
					var email = $('#reg_email').val();

					$.ajax({
						url: "<?php echo base_url() ?>shop/add_register",
						type: "POST",
						data: {"username" : username, "password" : password,"email":email},
						dataType: 'json',
						success: function(data){
								alert("สมัครสมาชิกสำเร็จ");
						},
						error: function(){
							alert('Error....');
						}
					});
				});


		</script>
    </body>
</html>
