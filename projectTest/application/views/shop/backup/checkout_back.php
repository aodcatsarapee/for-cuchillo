<?php
if($this->cart->contents() !=null){

?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<title>Sattiporn Shop</title>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content=''>
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
		<div id='top-bar' class='container'>
			<div class='row'>
				<div class='span4'>
					<form method='POST' class='search_form'>

					</form>
				</div>
				<div class='span8'>
					<div class='account pull-right'>
						<ul class='user-menu'>
							<li><?php echo anchor('shop','Home Page'); ?></li>
							<li><a href="#">My Account (Coming Soon)</a></li>
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
		<div id='wrapper' class='container'>
			<section class='navbar main-menu'>
				<div class='navbar-inner main-menu'>

					<nav id='menu' class='pull-right'>
						<ul>
							<li><?php echo anchor("shop/product","Product");?></li>
							<li><a href="#">Best Seller</a></li>
							<li><?php echo anchor('shop/cart','Your Cart'." [ ".count($cart)." ] "); ?></li>
						</ul>
					</nav>
				</div>
			</section>
			<section class='header_text sub'>
			<?php //echo image_asset('shop/pageBanner.png'); ?>
				<!--<h4><span>Check Out</span></h4>-->
			</section>
			<section class='main-content'>
				<div class='row'>
					<div class='span12'>
						<div class='accordion' id='accordion2'>
							<?php
							$member_name=$this->session->userdata('membername');
							if($member_name == ""){
									echo "<div class='accordion-group'>";
										echo "<div class='accordion-heading'>";
											echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseOne'>กรุณาลงชื่อเข้าสู่ระบบ</a>";
										echo "</div>";
										echo "<div id='collapseOne' class='accordion-body in collapse'>";
											echo "<div class='accordion-inner'>";
												echo "<div class='row-fluid'>";
													echo " <div class='span6'>";
														echo "<h4></h4>";
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
																	echo "<input tabindex='3' class='btn btn-inverse large' type='submit' id='signin' value='เข้าสู่ระบบ'>";
																	echo "<hr>";
																	echo anchor('shop/register','สมัครมาชิก');
																echo "</div>";
															echo "</fieldset>";
														echo form_close();
													echo "</div>";
												echo "</div>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
							}
							$totalprice=$this->cart->total();
							echo form_open('shop/confirmorder');
							?>
							<div class='accordion-group'>
								<div class='accordion-heading'>
									<!--<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseTwo'>Account &amp; Billing Details</a> -->
								</div>
								<?php
								if($member_name != ""){
									echo "<div id='collapseTwo' class='accordion-body in collapse'>";
								}else{
									echo "<div id='collapseTwo' class='accordion-body collapse'>";
								}
								?>
									<div class='accordion-inner'>
										<div class='row-fluid'>
											<div class='span6'>
												<h4>Your Details</h4>
												<div class='control-group'>
													<label class='control-label'>First Name</label>
													<div class='controls'>
														<input type='text' name='firstname' placeholder='' class='input-xlarge' <?php if($member['member_firstname']!=""){$firstname=$member['member_firstname'];}else{$firstname="";}?> value="<?php echo $firstname;?>">
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'>Last Name</label>
													<div class='controls'>
														<input type='text' name='lastname' placeholder='' class='input-xlarge' <?php if($member['member_lastname']!=""){$lastname=$member['member_lastname'];}else{$lastname="";}?> value="<?php echo $lastname;?>">
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'>Email Address</label>
													<div class='controls'>
														<input type='text' name='email' placeholder='' class='input-xlarge' <?php if($member['member_email']!=""){$email=$member['member_email'];}else{$email="";}?> value="<?php echo $email;?>">
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'>Telephone</label>
													<div class='controls'>
														<input type='text' name='tel' placeholder='' class='input-xlarge' <?php if($member['member_tel']!=""){$membertel=$member['member_tel'];}else{$membertel="";}?> value="<?php echo $membertel;?>">
													</div>
												</div>
											</div>
											<div class='span6'>
												<h4>Your Address</h4>
												<div class='control-group'>
													<label class='control-label'>Address</label>
													<div class='controls'>
														<?php if($member['member_address']!=""){$address=$member['member_address'];}else{$address="";}?>
														<textarea name='address' class='input-xlarge' rows='10'><?php echo $address; ?></textarea>
													</div>
												</div>
												<input type='hidden' name='sell_id' <?php if($sell['sell_id']==""){$sell_id='1';}else{$sell_id=$sell['sell_id'];}?> value="<?php echo $sell_id;?>">
												<?php
												echo "<input type='hidden' name='sell_total' value=",$totalprice,">";
												echo "<input type='hidden' name='member_id' value=",$member['member_id'],">";
												 ?>
												<!--
												<div class='control-group'>
													<label class='control-label'>Company ID:</label>
													<div class='controls'>
														<input type='text' placeholder='' class='input-xlarge'>
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'><span class='required'>*</span> Address 1:</label>
													<div class='controls'>
														<input type='text' placeholder='' class='input-xlarge'>
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'>Address 2:</label>
													<div class='controls'>
														<input type='text' placeholder='' class='input-xlarge'>
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'><span class='required'>*</span> City:</label>
													<div class='controls'>
														<input type='text' placeholder='' class='input-xlarge'>
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'><span class='required'>*</span> Post Code:</label>
													<div class='controls'>
														<input type='text' placeholder='' class='input-xlarge'>
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'><span class='required'>*</span> Country:</label>
													<div class='controls'>
														<select class='input-xlarge'>
															<option value='Chaingmai'>เชียงใหม่</option>
															<option value='Lampang'>ลำปาง</option>
														</select>
													</div>
												</div>
												<div class='control-group'>
													<label class='control-label'><span class='required'>*</span> Region / State:</label>
													<div class='controls'>
														<select name='zone_id' class='input-xlarge'>
															<option value=''> --- Please Select --- </option>
															<option value='Thailand'>Thailand</option>
														</select>
													</div>
												</div>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							if($member_name != ""){
								echo "<input type='submit' class='btn btn-inverse pull-right' name='comfirm' value='Confirm Order'>";
							}
							echo form_close();
							?>
						</div>
					</div>
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="<?php echo base_url(); ?>shop">Homepage</a></li>
							<li><a href="<?php echo base_url(); ?>shop/cart">Your Cart</a></li>
							<li><a href="<?php echo base_url(); ?>shop/register">Login</a></li>
						</ul>
					</div>
					<div class="span4">

						<ul class="nav">

						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						<p style="color:white;">ร้านสถิตพรอะไหล่ ตั้งอยู่ที่ 227 หมู่.2 ตำบลตลาดใหญ่ อำเภอดอยสะเก็ด จังหวัดเชียงใหม่ 50220 (สาขาแรก)</p>
						<p style="color:white;">ร้านสถิตพรอะไหล่ ตั้งอยู่ที่ 17/8 หมู่.4 ตำบลสันกำแพง อำเภอสันกำแพง จังหวัดเชียงใหม่ 50130 (สาขาสอง)</p>
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
				<span>Copyright 2017 - 2018 By Sorawit & Patcharapan All right reserved.</span>
			</section>
		</div>
		<script src='themes/js/common.js'></script>
    </body>
</html>
<?php
}else{
	//alert("ไม่มีสินค้าในตระกร้า");
	redirect('shop');
}
?>
