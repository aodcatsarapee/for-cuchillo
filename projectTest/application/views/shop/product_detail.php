
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
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
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<?php
								echo "<a href=",base_url(),"assets/images/shop/product/",$product['product_picture']," class='thumbnail' data-fancybox-group='group1' title='Description 1'>";?><?php echo "<img alt='' src=",base_url(),"assets/images/shop/product/",$product['product_picture']," style='width:300px;'>"; ?></a>
								<ul class="thumbnails small">
									<!--<li class="span1">
										<a href="themes/images/ladies/2.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 2"><img src="themes/images/ladies/2.jpg" alt=""></a>
									</li>
									<li class="span1">
										<a href="themes/images/ladies/3.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 3"><img src="themes/images/ladies/3.jpg" alt=""></a>
									</li>
									<li class="span1">
										<a href="themes/images/ladies/4.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 4"><img src="themes/images/ladies/4.jpg" alt=""></a>
									</li>
									<li class="span1">
										<a href="themes/images/ladies/5.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 5"><img src="themes/images/ladies/5.jpg" alt=""></a>
									</li>-->
								</ul>
							</div>
							<div class="span5">
								<address>
									<strong>Brand:</strong> <span><?php echo $product['band_name']; ?></span><br>
									<strong>Quantity:</strong> <span><?php echo $product['product_quantity']; ?> ชิ้น</span><br>
								</address>
								<h4><strong>Price: <?php echo $product['product_price']; ?> ฿</strong></h4>
							</div>
							<div class="span5">
								<form class="form-inline" action="<?php echo base_url();?>shop/add/<?php echo $product['product_id']; ?>">
									<p>&nbsp;</p>
									<label>Qty:</label>
									<input type="text" class="span1" placeholder="1" disabled>
									<?php
										if($product['product_quantity'] < '1'){
											echo "<button class='btn btn-inverse' type='submit' disabled>(สินค้าไม่พอจำหน่าย)</button>";
										}else{
											echo "<button class='btn btn-inverse' type='submit'>หยิบใส่ตะกร้า</button>";
										}
									?>

								</form>
							</div>
						</div>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Description</a></li>
									<!--<li class=""><a href="#profile">Additional Information</a></li>-->
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home"><?php echo $product['product_detail']; ?></div>
									<div class="tab-pane" id="profile">
										<table class="table table-striped shop_attributes">
											<tbody>
												<tr class="">
													<th>Size</th>
													<td>Large, Medium, Small, X-Large</td>
												</tr>
												<tr class="alt">
													<th>Colour</th>
													<td>Orange, Yellow</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<div class="span9">
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-1" class="carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails listing-products">
												<?php
												foreach ($allproduct as $_allproduct) {
													echo "<li class='span3'>";
														echo "<div class='product-box'>";
															echo "<span class='sale_tag'></span>";
															echo "<a href=",base_url(),"shop/detail/",$_allproduct['product_id'],">",image_asset('shop/product/'.$_allproduct['product_picture']),"</a>";
															echo "<a href='product_detail.html' class='title'>",$_allproduct['product_name'],"</a><br/>";
															echo "<a href='#' class='category'>",$_allproduct['cate_name'],"</a>";
															echo "<p class='price'>",$_allproduct['product_price']," ฿</p>";
														echo "</div>";
													echo "</li>";
													}
												?>
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails listing-products">
												<?php
												foreach ($allproduct as $_allproduct) {
													echo "<li class='span3'>";
														echo "<div class='product-box'>";
															echo "<span class='sale_tag'></span>";
															echo "<a href=",base_url(),"shop/detail/",$_allproduct['product_id'],">",image_asset('shop/product/'.$_allproduct['product_picture']),"</a>";
															echo "<a href='product_detail.html' class='title'>",$_allproduct['product_name'],"</a><br/>";
															echo "<a href='#' class='category'>",$_allproduct['cate_name'],"</a>";
															echo "<p class='price'>",$_allproduct['product_price']," ฿</p>";
														echo "</div>";
													echo "</li>";
													}
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>





														<?php

																/*echo "<div class='span9'>";
																	echo "<br>";
																	echo "<h4 class='title'>";
																		echo "<span class='pull-left'><span class='text'><strong>Related</strong> Products</span></span>";
																		echo "<span class='pull-right'>";
																			echo "<a class='left button' href='#myCarousel-1' data-slide='prev'></a><a class='right button' href='#myCarousel-1' data-slide='next'></a>";
																		echo "</span>";
																	echo "</h4>";
																	echo "<div id='myCarousel-1' class='carousel slide'>";
																		echo "<div class='carousel-inner'>";
																			echo "<div class='active item'>";

																				echo "<ul class='thumbnails listing-products'>";

																					echo "<li class='span3'>";

																						echo "<div class='product-box'>";
																						foreach ($allproduct as $_allproduct) {
																							echo "<span class='sale_tag'></span>";
																							echo "<a href=",base_url(),"shop/detail/",$_allproduct['product_id'],">",image_asset('shop/product/'.$_allproduct['product_picture']),"</a>";
																							echo "<a href='product_detail.html' class='title'>",$_allproduct['product_name'],"</a><br/>";
																							echo "<a href='#' class='category'>",$_allproduct['cate_name'],"</a>";
																							echo "<p class='price'>",$_allproduct['product_price']," ฿</p>";
																							}
																						echo "</div>";
																					echo "</li>";

																				echo "</ul>";

																			echo "</div>";

																			echo "<div class='item'>";
																				echo "<ul class='thumbnails listing-products'>";
																					echo "<li class='span3'>";
																						echo "<div class='product-box'>";
																							echo "<span class='sale_tag'></span>";
																							echo "<a href='product_detail.html'><img alt='' src='themes/images/ladies/1.jpg'></a><br/>";
																							echo "<a href='product_detail.html' class='title'>Fusce id molestie massa</a><br/>";
																							echo "<a href='#' class='category'>Phasellus consequat</a>";
																							echo "<p class='price'>$341</p>";
																						echo "</div>";
																					echo "</li>";
																					echo "</ul>";
																				echo "</div>";
																			echo "</div>";
																		echo "</div>";
																	echo "</div>";*/

														?>

														<!--<a href="product_detail.html"><img alt="" src="themes/images/ladies/6.jpg"></a><br/>

														<a href="#" class="category">Suspendisse aliquet</a>
														<p class="price">$341</p>

												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<a href="product_detail.html"><img alt="" src="themes/images/ladies/5.jpg"></a><br/>
														<a href="product_detail.html" class="title">Fusce id molestie massa</a><br/>
														<a href="#" class="category">Phasellus consequat</a>
														<p class="price">$341</p>
													</div>
												</li>
												<li class="span3">
													<div class="product-box">
														<a href="product_detail.html"><img alt="" src="themes/images/ladies/4.jpg"></a><br/>
														<a href="product_detail.html" class="title">Praesent tempor sem</a><br/>
														<a href="#" class="category">Erat gravida</a>
														<p class="price">$28</p>
													</div>
												</li>-->
												</div>
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
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});

				$('#myCarousel-2').carousel({
                    interval: 2500
                });
			});
		</script>
    </body>
</html>
