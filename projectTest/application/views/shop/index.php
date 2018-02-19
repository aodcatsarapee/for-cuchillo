<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sattiporn Shop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<style>
		body  {
		    background-image: url("paper.gif");
		    background-color: #cccccc;
		}
</style>
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
										echo "<li>ยินดีต้อนรับคุณ : ",$member_name." [ ".anchor('shop/logout','Logout')." ] "."</li>";
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
					<?php //<a href="index.html" class="logo pull-left"> echo image_asset('shop/logo1.png'); ?><?php //<img src="themes/images/logo.png" class="site_logo" alt="">?></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><?php echo anchor("shop/product","Product");?></li>
							<li><?php echo anchor("shop/product","Best Seller");?></li>
							<li><?php echo anchor('shop/cart','Your Cart'." [ ".count($cart)." ] "); ?></li>
						</ul>
					</nav>
				</div>
			</section>
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<?php echo image_asset('shop/banner/eayeay.png'); ?>
							<div class="intro">
								<h1>มี 2 สาขา</h1>
								<p><span>สาขาดอยสะเก็ต และสาขาสันกำแพง</span></p>
								<p><span>Tel : 0884162467,099452645</span></p>
							</div>
						</li>
						<!--<li>
							<?php echo image_asset('shop/banner/ban2.jpg'); ?>
							<div class="intro">
								<h1>สิ้นปีเตรียมพบกับ</h1>
								<p><span>สินค้าลดราคามากสุด 50 %</span></p>
								<p><span>สามารถซื้อได้ทั้งออนไลน์และหน้าร้าน</span></p>
							</div>
						</li>-->
					</ul>
				</div>
			</section>
			<!--<section class="header_text">
				We stand for top quality templates. Our genuine developers always optimized bootstrap commercial templates.
				<br/>Don't miss to use our cheap abd best bootstrap templates.
			</section>  -->
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="row">
							<?php /*<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Promotion <strong>Products</strong></span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.html"><?php echo image_asset('shop/ladies/1.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">Ut wisi enim ad</a><br/>
														<a href="products.html" class="category">Commodo consequat</a>
														<p class="price">$17.25</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.html"><?php echo image_asset('shop/ladies/2.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">Quis nostrud exerci tation</a><br/>
														<a href="products.html" class="category">Quis nostrud</a>
														<p class="price">$32.50</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/ladies/3.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">Know exactly turned</a><br/>
														<a href="products.html" class="category">Quis nostrud</a>
														<p class="price">$14.20</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/ladies/4.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">You think fast</a><br/>
														<a href="products.html" class="category">World once</a>
														<p class="price">$31.45</p>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>  */?>
						</div>
						<br/>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Latest <strong>Products</strong></span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-2" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">
												<?php
														foreach ($product as $_product) {
																$pic = $_product['product_picture'];
																echo "<li class='span3'>";
																	echo "<div class='product-box'>";
																		echo "<span class='sale_tag'></span>";
																		echo "<a href=",base_url(),"shop/detail/",$_product['product_id'],">",image_asset('shop/product/'.$_product['product_picture']),"</a>";
																		echo "<a href='product_detail.html' class='title'>",$_product['product_name'],"</a><br/>";
																		echo "<a href='products.html' class='category'>",$_product['band_name'],"</a>";
																		echo "<p class='price'>",number_format($_product['product_price'])," ฿</p>";
																		echo anchor('shop/add/'.$_product['product_id'].'','เลือกสินค้า');
																	echo "</div>";
																echo "</li>";
														}
												?>

												<?php /*<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/cloth/bootstrap-women-ware1.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">Quis nostrud exerci tation</a><br/>
														<a href="products.html" class="category">Quis nostrud</a>
														<p class="price">$17.55</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/cloth/bootstrap-women-ware6.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">Know exactly turned</a><br/>
														<a href="products.html" class="category">Quis nostrud</a>
														<p class="price">$25.30</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/cloth/bootstrap-women-ware5.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">You think fast</a><br/>
														<a href="products.html" class="category">World once</a>
														<p class="price">$25.60</p>
													</div>
												</li>
											</ul>*/ ?>
										</div>
										<?php /*<div class="item">
											<ul class="thumbnails">
												<li class="span3">
													<div class="product-box">
														<?php
																echo "<p><a href='product_detail.html'>",image_asset('shop/cloth/bootstrap-women-ware4.jpg'),"</a></p>";
																echo "<a href='product_detail.html' class='title'>",$_product['product_name'],"</a><br/>";
																echo "<a href='products.html' class='category'>",$_product['band_name'],"</a>";
																echo "<p class='price'>$45.50</p>";
														 ?>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/cloth/bootstrap-women-ware3.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">Ut wisi enim ad</a><br/>
														<a href="products.html" class="category">Commodo consequat</a>
														<p class="price">$33.50</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><?php echo image_asset('shop/cloth/bootstrap-women-ware2.jpg'); ?></a></p>
														<a href="product_detail.html" class="title">You think water</a><br/>
														<a href="products.html" class="category">World once</a>
														<p class="price">$45.30</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<p><a href="product_detail.html"><img src="themes/images/cloth/bootstrap-women-ware1.jpg" alt="" /></a></p>
														<a href="product_detail.html" class="title">Quis nostrud exerci</a><br/>
														<a href="products.html" class="category">Quis nostrud</a>
														<p class="price">$25.20</p>
													</div>
												</li>
											</ul>
										</div>*/?>
									</div>
								</div>
							</div>
						</div>
						<div class="row feature_box">
							<div class="span4">
								<div class="service">
									<div class="responsive">
										<?php echo image_asset('shop/feature_img_2.png'); ?>
										<h4>สินค้าได้รับฆาตราฐาน <strong>100 %</strong></h4>
										<p>สินค้าดี ราคาถูก บริการแบบคนในครอบครัว</p>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="service">
									<div class="customize">
										<?php echo image_asset('shop/feature_img_1.png'); ?>
										<h4>ฟรี <strong>ค่าขนส่ง</strong></h4>
										<p>เมื่อซื้อสินค้าผ่านทางเว็บไซด์ราคารวม 2500 บาทขึ้นไป ทางร้านจัดส่งสินค้าให้ฟรี</p>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="service">
									<div class="support">
										<?php echo image_asset('shop/feature_img_3.png'); ?>
										<h4>มีช่างมืออาชีพ <strong>ให้บริการ</strong></h4>
										<p>หากรถคุณมีปัญหานึกถึง สถิตย์พร เรามีช่างมืออาชีพช่วยแก้ปัญหาให้กับคุณ</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--<section class="our_client">
				<h4 class="title"><span class="text">Manufactures</span></h4>
				<div class="row">
					<div class="span2">
						<a href="#"><?php echo image_asset('shop/clients/f1.png'); ?></a>
					</div>
					<div class="span2">
						<a href="#"><?php echo image_asset('shop/clients/f2.png'); ?></a>
					</div>
					<div class="span2">
						<a href="#"><?php echo image_asset('shop/clients/f3.png'); ?></a>
					</div>
					<div class="span2">
						<a href="#"><?php echo image_asset('shop/clients/f4.png'); ?></a>
					</div>
					<div class="span2">
						<a href="#"><?php echo image_asset('shop/clients/f5.png'); ?></a>
					</div>
					<div class="span2">
						<a href="#"><?php echo image_asset('shop/clients/f6.png'); ?></a>
					</div>
				</div>
			</section> -->
			<!--
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
		-->
			<section id="copyright">
				<span>Copyright 2017 All right reserved.</span>
			</section>
		</div>
		<?php
			echo js_asset('shop/js/common.js');
			echo js_asset('shop/js/jquery.flexslider-min.js');
		?>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
    </body>
</html>
