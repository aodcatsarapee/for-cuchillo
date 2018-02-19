<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sattiporn Shop</title>
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
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
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
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<a href="index.html" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><?php echo anchor("shop/product","Product");?></li>
							<li><?php echo anchor("shop/product","Best Seller");?></li>
							<li><?php echo anchor('shop/cart','Your Cart'." [ ".count($cart)." ] "); ?></li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
				<h4><span>Product</span></h4>
			</section>
			<section class="main-content">

				<div class="row">
					<div class="span9">
						<ul class="thumbnails listing-products">
							<?php
									foreach ($product as $_product) {
										echo "<li class='span3'>";
											echo "<div class='product-box'>";
												echo "<span class='sale_tag'></span>";
														echo "<a href=",base_url(),"shop/detail/",$_product['product_id'],">",image_asset('shop/product/'.$_product['product_picture']),"</a>";
														echo "<a href='' class='title'>",$_product['product_name'],"</a><br/>";
														echo "<a href='#' class='category'>",$_product['band_name'],"</a>";
														echo "<p class='price'>",$_product['product_price']," ฿</p>";
														echo anchor('shop/add/'.$_product['product_id'].'','เลือกสินค้า');
												echo "</div>";
											echo "</li>";
									}
							?>
						</ul>
						<hr>
						<?php
						echo "<div class='pagination pagination-centered'>";

									echo $this->pagination->create_links();

						echo "</div>";
						?>
					</div>
					<div class="span3 col">
						<div class="block">
							<h4 class="title"><strong>หมวด</strong> สินค้า</h4>
							<ul class="nav nav-list">
								<li><a href="#">เกียร์</a></li>
								<li><a href="#">เครื่องยนต์</a></li>
								<li><a href="#">ช่วงล่าง</a></li>
								<li><a href="#">ตัวถัง</a></li>
								<li><a href="#">อื่นๆ</a></li>
							</ul>
						</div>
						<div class="block">
							<h4 class="title">
								<span class="pull-left"><span class="text">Randomize</span></span>
								<span class="pull-right">
									<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
								</span>
							</h4>
							<div id="myCarousel" class="carousel slide">
								<div class="carousel-inner">
									<div class="active item">
										<ul class="thumbnails listing-products">
											<li class="span3">
												<div class="product-box">
													<h3 align='center'>Coming Soon</h3>
													<!--<span class="sale_tag"></span>
													<img alt="" src="themes/images/ladies/1.jpg"><br/>
													<a href="product_detail.html" class="title">Fusce id molestie massa</a><br/>
													<a href="#" class="category">Suspendisse aliquet</a>
													<p class="price">$261</p>-->
												</div>
											</li>
										</ul>
									</div>
									<div class="item">
										<ul class="thumbnails listing-products">
											<li class="span3">
												<div class="product-box">
													<!--<img alt="" src="themes/images/ladies/2.jpg"><br/>
													<a href="product_detail.html" class="title">Tempor sem sodales</a><br/>
													<a href="#" class="category">Urna nec lectus mollis</a>
													<p class="price">$134</p>-->
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="block">
							<h4 class="title"><strong>สินค้า</strong> ขายดี</h4>
							<ul class="small-product">
								<li>
									<h3 align='center'>Coming Soon</h3>
								</li>
								<!--<li>
									<a href="#" title="Luctus quam ultrices rutrum">
										<img src="themes/images/ladies/4.jpg" alt="Luctus quam ultrices rutrum">
									</a>
									<a href="#">Luctus quam ultrices rutrum</a>
								</li>
								<li>
									<a href="#" title="Fusce id molestie massa">
										<img src="themes/images/ladies/5.jpg" alt="Fusce id molestie massa">
									</a>
									<a href="#">Fusce id molestie massa</a>
								</li> -->
							</ul>
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
		<?php echo js_asset('shop/js/common.js');?>
    </body>
</html>
