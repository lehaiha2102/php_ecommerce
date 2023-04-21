<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
session_start();
if (empty($_SESSION['user'])) {
	header('Location: ../../views/auth/index.php');
	exit;
}
$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
require_once('../../process/show_category.php');
// require_once('../../process/show_product.php');
require_once('../../process/showfavourite.php');
require_once('../../process/show_product_single.php');
require_once('../../views/user_views/components/head.php'); ?>

<body class="stretched modal-subscribe-bottom">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
		<header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">

						<!-- Logo
						============================================= -->
						<div id="logo" class="me-lg-4">
							<a href="../../views/user_views/index.php" class="standard-logo"><img
									src="../../../public/user_public/demos/shop/images/logo.png" alt="Canvas Logo"></a>
							<a href="../../views/user_views/index.php" class="retina-logo"><img
									src="../../../public/user_public/demos/shop/images/logo@2x.png"
									alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-account" class="position-relative">
								<div class="dropdown">
									<a class="dropdown-toggle ms-2 d-none d-sm-inline-block" href="#" role="button"
										id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="icon-line2-user me-1 position-relative" style="top: 1px;"></i>
										<span class="d-none d-sm-inline-block font-primary fw-medium">
											<?php echo $_SESSION['user']['name'] ?>
										</span>
									</a>
									<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
										<li><a class="dropdown-item"
												href="../../views/user_views/profile.php">Profile</a>
										</li>
										<li>
											<div class="dropdown-divider"></div>
										</li>
										<li><a class="dropdown-item" href="../../process/logout.php">Logout</a>
										</li>
									</ul>
								</div>
							</div>

							<div id="favourite" class="position-relative">
								<a href="../../views/user_views/profile.php#tab-replies"><i
										class="icon-line-heart me-1 position-relative" style="top: 1px;"></i></a>
							</div>

							<div class="header-misc-icon">
								<a href="#" id="notifylink" data-bs-toggle="dropdown" data-bs-offset="0,15"
									aria-haspopup="true" aria-expanded="false" data-offset="12,12" class=""><i
										class="icon-line-bell notification-badge"></i></a>
								<div class="dropdown-menu dropdown-menu-end py-0 m-0 overflow-auto"
									aria-labelledby="notifylink" style="width: 320px; max-height: 300px;">
									<span
										class="dropdown-header border-bottom border-f5 fw-medium text-uppercase ls1">Notifications</span>
									<div class="list-group list-group-flush">
										<a href="#" class="d-flex list-group-item">
											<img src="demos/articles/images/authors/2.jpg" width="35" height="35"
												class="rounded-circle me-3 mt-1" alt="Profile">
											<div class="media-body">
												<h5 class="my-0 fw-normal text-muted"><span
														class="text-dark fw-bold">SemiColonWeb</span> has replied on
													your post <span class="text-dark fw-bold">Package Generator – Approx
														time for a file.</span></h5>
												<small class="text-smaller">10 mins ago</small>
											</div>
										</a>
										<a href="#" class="d-flex list-group-item">
											<i class="icon-line-check badge-icon bg-success text-white me-3 mt-1"></i>
											<div class="media-body">
												<h5 class="my-0 fw-normal text-muted"><span
														class="text-dark fw-bold">SemiColonWeb</span> has marked to your
													post as solved.</h5>
												<small class="text-smaller">2 days ago</small>
											</div>
										</a>
									</div>
								</div>
							</div>

							<!-- Top Cart
							============================================= -->
							<div id="top-cart" class="header-misc-icon d-none d-sm-block">
								<a href="#" id="top-cart-trigger">
									<i class="icon-line-bag"></i>
									<?php
									if (!empty($_SESSION['cart'])) {
										$total_quantity = 0;
										$unique_products = array();
										foreach ($_SESSION['cart'] as $index => $cart_item) {
											$total_quantity += $cart_item['quantity'];
											if (!in_array($cart_item['name'], $unique_products)) {
												array_push($unique_products, $cart_item['name']);
											}
										}
										$num_unique_products = count($unique_products);
										if ($num_unique_products > 3) {
											$num_displayed_products = 3;
										} else {
											$num_displayed_products = $num_unique_products;
										}
									} else {
										$total_quantity = 0;
										$num_displayed_products = 0;
									}
									?>
									<span class="top-cart-number">
										<?php echo $total_quantity; ?>
									</span>
								</a>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">
										<?php
										if (!empty($_SESSION['cart'])) {
											$displayed_products = array();
											foreach ($_SESSION['cart'] as $index => $cart_item) {
												if (in_array($cart_item['name'], $displayed_products)) {
													continue;
												}
												array_push($displayed_products, $cart_item['name']);
												if (count($displayed_products) > $num_displayed_products) {
													break;
												}
												?>
												<div class="top-cart-item">
													<div class="top-cart-item-image">
														<a href="#"><img
																src="../../../public/image/<?php echo $cart_item['image'] ?>"
																alt="<?php echo $cart_item['name'] ?>" /></a>
													</div>
													<div class="top-cart-item-desc">
														<div class="top-cart-item-desc-title">
															<a href="#">
																<?php echo $cart_item['name'] ?>
															</a>
															<span class="top-cart-item-price d-block">
																$
																<?php echo number_format($cart_item['price'], 0, '.', ','); ?>
															</span>
														</div>
														<div class="top-cart-item-quantity">x
															<?php echo $cart_item['quantity'] ?>
														</div>
													</div>
												</div>
											<?php }
										} else {
											echo 'Add new products to cart';
										}
										?>
									</div>
									<div class="top-cart-action">
										<?php
										if (!empty($_SESSION['cart'])) {
											$total_price = 0;
											foreach ($_SESSION['cart'] as $index => $cart_item) {
												$total_price += $cart_item['quantity'] * $cart_item['price'];
											}
										} else {
											$total_price = 0;
										}
										?>
										<span class="top-checkout-price">
											$
											<?php echo number_format($total_price, 0, '.', ','); ?>
										</span>

										<a href="../user_views/cart.php" class="button button-3d button-small m-0">View
											Cart</a>
									</div>
								</div>
							</div><!-- #top-cart end -->

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i
										class="icon-line-cross"></i></a>
							</div><!-- #top-search end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100">
								<path
									d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
								</path>
								<path d="m 30,50 h 40"></path>
								<path
									d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
								</path>
							</svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows me-lg-auto">

							<ul class="menu-container">
								<?php foreach ($categories as $category) {
									if ($category['category_slug'] == 'laptop-04-03-8393') {
										?>
										<li class="menu-item current"><a class="menu-link"
												href="../../views/user_views/product.php?category_slug=<?php echo $category['category_slug'] ?>">
												<div>
													<?php
													echo $category['category_name']
														?>
												</div>
											</a></li>
									<?php }
								} ?>
								<?php foreach ($categories as $category) {
									if ($category['category_slug'] == 'smart-phone-04-03-6291') {
										?>
										<li class="menu-item current"><a class="menu-link"
												href="../../views/user_views/product.php?category_slug=<?php echo $category['category_slug'] ?>">
												<div>
													<?php
													echo $category['category_name']
														?>
												</div>
											</a></li>
									<?php }
								} ?>
								<?php foreach ($categories as $category) {
									if ($category['category_slug'] == 'laptop-04-04-7607') {
										?>
										<li class="menu-item current"><a class="menu-link"
												href="../../views/user_views/product.php?category_slug=<?php echo $category['category_slug'] ?>">
												<div>
													<?php
													echo $category['category_name']
														?>
												</div>
											</a></li>
									<?php }
								} ?>
								<li class="menu-item mega-menu sub-menu"><a class="menu-link" href="#">
										<div>Other<i class="icon-angle-down"></i></div>
									</a>
									<div class="mega-menu-content mega-menu-style-2" style="width: 1196.67px;">
										<div class="container" style="">
											<div class="row">
												<?php foreach ($categories as $category) {
													if ($category['category_slug'] != 'laptop-04-03-8393' && $category['category_slug'] != 'smart-phone-04-03-6291' && $category['category_slug'] != 'laptop-04-04-7607') { ?>

														<ul class="mega-menu-column sub-menu-container col-lg-4 border-start-0"
															style="">

															<li class="mega-menu-title menu-item sub-menu"><a class="menu-link"
																	href="../../views/user_views/product.php?category_slug=<?php echo $category['category_slug'] ?>">
																	<div>
																		<?php
																		echo $category['category_name']
																			?>
																	</div>
																</a></li>
														</ul>
													<?php }
												} ?>
											</div>
										</div>
									</div>
									<button class="sub-menu-trigger icon-chevron-right"></button>
								</li>
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="../../views/user_views/search.php" method="get">
							<input type="text" name="keyword" class="form-control" value=""
								placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->


		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				<?php foreach ($products_wid as $product) { ?>
					<div class="single-product mb-6">
						<div class="product">
							<div class="container-fluid">
								<div class="row gutter-50">
									<div class="col-xl-6  col-lg-8 mb-0 sticky-sidebar-wrap">

										<div class="fslider nav-offset" data-pagi="false" data-slideshow="false">
											<div class="flexslider">

												<div class="flex-viewport"
													style="overflow: hidden; position: relative;">
													<div class="slider-wrap"
														style="width: 1000%; transition-duration: 0s; transform: translate3d(-1032px, 0px, 0px);">
														<div class="slide clone" aria-hidden="true"
															style="width: 516px; margin-right: 0px; float: left; display: block;">
															<img src="../../../public/image/<?php echo $product['product_image_1'] ?>" alt="Slider 3"
																draggable="false"></div>
														<div class="slide"
															style="width: 516px; margin-right: 0px; float: left; display: block;">
															<img src="../../../public/image/<?php echo $product['product_image_2'] ?>" alt="Slider 1"
																draggable="false"></div>
														<div class="slide flex-active-slide"
															style="width: 516px; margin-right: 0px; float: left; display: block;">
															<img src="../../../public/image/<?php echo $product['product_image_3'] ?>" alt="Slider 2"
																draggable="false"></div>
														<div class="slide"
															style="width: 516px; margin-right: 0px; float: left; display: block;">
															<img src="../../../public/image/<?php echo $product['product_image_4'] ?>" alt="Slider 3"
																draggable="false"></div>
														<div class="slide clone"
															style="width: 516px; margin-right: 0px; float: left; display: block;"
															aria-hidden="true"><img src="../../../public/image/<?php echo $product['product_image_1'] ?>"
																alt="Slider 1" draggable="false"></div>
													</div>
												</div>
												<ul class="flex-direction-nav">
													<li class="flex-nav-prev"><a class="flex-prev" href="#"><i
																class="icon-angle-left"></i></a></li>
													<li class="flex-nav-next"><a class="flex-next" href="#"><i
																class="icon-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
									</div>

									<div class="col-xl-6 col-lg-8 mb-0">

										<div class="d-flex align-items-center justify-content-between">
											<div class="product-name" style=" display: block;">
												<h3>
													<?php echo $product['product_name']; ?>
												</h3> <br>
											</div>

											<!-- Product Single - Price
										============================================= -->
											<div class="d-flex align-items-center justify-content-between">

												<!-- Product Single - Price
										============================================= -->

												<?php if (!empty($product['product_promotion_price'])) { ?>
													<div class="product-price"><del>
															<?php echo number_format($product['product_price']) . ' đ'; ?>
														</del> <ins>
															<?php echo number_format($product['product_promotion_price']) . ' đ'; ?>
														</ins><span class="text-warning"> (30% OFF)</span></div>
													<!-- Product Single - Price End -->
												<?php } else { ?>
													<div class="product-price"><ins>
															<?php echo number_format($product['product_price']) . ' đ'; ?>
														</ins></div>
												<?php } ?>
											</div>
										</div>

										<div class="line line-sm"></div>

										<!-- Product Single - Quantity & Cart Button
									============================================= -->
										<a onclick="AddCart(<?php echo $product['product_id']; ?>)" href="javascript:"
											class="add-to-cart button button-large m-0">Add to
											cart</a>
										<a href="../../views/user_views/checkout_from_single.php?product_id=<?php echo $product['product_id']; ?>"
											class="add-to-cart button button-large m-0">Buy now</a>


										<div class="line line-sm"></div>

										<div data-readmore="true" data-readmore-size="250px"
											data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>"
											data-readmore-trigger-close="false">

											<h3>Description</h3>

											<!-- Product Single - Short Description
										============================================= -->
											<p>
												<?php echo $product['product_description']; ?>
											</p>

											<a href="#" class="btn btn-dark btn-sm read-more-trigger"></a>
										</div>

										<!-- Product Single - Meta
									============================================= -->
										<div class="card product-meta mt-4 mb-5 rounded-0">
											<div class="card-body">
												<span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">
														<?php echo $product['product_id']; ?>
													</span></span>
												<span class="posted_in">Category: <a href="#" rel="tag">
														<?php
														foreach ($categories as $category) {
															if ($category['category_id'] == $product['category_id']) {
																echo $category['category_name'];
															}
														}
														?>
													</a>.</span>
												<span class="tagged_as">Tags: <a href="#" rel="tag">
														<?php echo $product['product_name'] ?>
													</a>, <a href="#" rel="tag"><a href="#" rel="tag">
															<?php
															foreach ($categories as $category) {
																if ($category['category_id'] == $product['category_id']) {
																	echo $category['category_name'];
																}
															}
															?>
														</a>.</span>
											</div>
										</div><!-- Product Single - Meta End -->

										<div>
											<h4>Product Specifications</h4>
											<table class="table table-striped table-bordered mb-5">
												<tbody>
													<tr>
														<?php echo $product['product_specifications']; ?>
													</tr>
												</tbody>
											</table>

											<!-- <table class="table table-striped table-bordered mb-5">
												<tbody>
													<tr>
														<th width="150">Item</th>
														<th>Description</th>
													</tr>
													<tr>
														<td>Display</td>
														<td>Analogue</td>
													</tr>
													<tr>
														<td>Movement</td>
														<td>Quartz</td>
													</tr>
													<tr>
														<td>Power source</td>
														<td>Battery</td>
													</tr>
													<tr>
														<td>Dial style</td>
														<td>Solid round stainless steel dial</td>
													</tr>
													<tr>
														<td>Features</td>
														<td>Reset Time</td>
													</tr>
													<tr>
														<td>Strap style</td>
														<td>Silver-Toned bracelet style, stainless steel strap with a
															foldover closure</td>
													</tr>
													<tr>
														<td>Water resistance</td>
														<td>Yes</td>
													</tr>
													<tr>
														<td>Warranty</td>
														<td>3 Months</td>
													</tr>
												</tbody>
											</table> -->
										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="section mb-0">

					<div class="container mw-md text-center">
						<h4>Similar Products</h4>

						<div class="row justify-content-center gutter-1">

							<?php foreach ($products_similar as $similar) {
								if ($product['category_id'] == $similar['category_id'] && $product['product_id'] != $similar['product_id']) { ?>
									<!-- Shop Item 1
		============================================= -->
									<div class="col-md-3 col-6 h-translate-y-sm all-ts">
										<div class="product">
											<div class="product-image">
												<a
													href="../../views/user_views/single_product.php?product_id=<?php echo $similar['product_id'] ?>"><img
														src="../../../public/image/<?php echo $similar['product_image_1'] ?>"
														alt="Image 1"></a>
												<a
													href="../../views/user_views/single_product.php?product_id=<?php echo $similar['product_id'] ?>"><img
														src="../../../public/image/<?php echo $similar['product_image_2'] ?>"
														alt="Image 1"></a>
												<?php if (!empty($similar['product_promotion_price'])) { ?>
													<div class="sale-flash badge bg-danger p-2">Sale!</div>
												<?php } ?>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between"
														data-hover-animate="fadeIn" data-hover-speed="400">
														<a onclick="AddCart(<?php echo $similar['product_id']; ?>)"
															href="javascript:" class="btn btn-dark me-2"><i
																class="icon-shopping-basket"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title mb-1">
													<h3><a
															href="../../views/user_views/single_product.php?product_id=<?php echo $similar['product_id'] ?>">
															<?php echo $similar['product_name'] ?>
														</a></h3>
												</div>
												<?php if (!empty($similar['product_promotion_price'])) { ?>
													<div class="product-price font-primary">
														<del class="me-1">


															<?php echo number_format($similar['product_price'], 0, '.', ',') . ' đ'; ?>
														</del>
														<ins>

															<?php echo number_format($similar['product_promotion_price'], 0, '.', ',') . ' đ'; ?>
														</ins>
													</div>
												<?php } else { ?>
													<div class="product-price font-primary">

														<ins>

															<?php echo number_format($similar['product_price'], 0, '.', ',') . ' đ'; ?>
														</ins>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>

								<?php }
							} ?>
						</div>

					</div>

				</div>


				<div class="section mb-0">

					<div class="container mw-md text-center">
						<h4>Similar Brand Products</h4>

						<div class="row justify-content-center gutter-1">

							<?php foreach ($products_similar as $similar) {
								if ($product['product_supplier'] == $similar['product_supplier'] && $product['product_id'] != $similar['product_id']) { ?>
									<!-- Shop Item 1
============================================= -->
									<div class="col-md-3 col-6 h-translate-y-sm all-ts">
										<div class="product">
											<div class="product-image">
												<a
													href="../../views/user_views/single_product.php?product_id=<?php echo $similar['product_id'] ?>"><img
														src="../../../public/image/<?php echo $similar['product_image_1'] ?>"
														alt="Image 1"></a>
												<a
													href="../../views/user_views/single_product.php?product_id=<?php echo $similar['product_id'] ?>"><img
														src="../../../public/image/<?php echo $similar['product_image_2'] ?>"
														alt="Image 1"></a>
												<?php if (!empty($similar['product_promotion_price'])) { ?>
													<div class="sale-flash badge bg-danger p-2">Sale!</div>
												<?php } ?>
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between"
														data-hover-animate="fadeIn" data-hover-speed="400">
														<a onclick="AddCart(<?php echo $similar['product_id']; ?>)"
															href="javascript:" class="btn btn-dark me-2"><i
																class="icon-shopping-basket"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
											</div>
											<div class="product-desc">
												<div class="product-title mb-1">
													<h3><a
															href="../../views/user_views/single_product.php?product_id=<?php echo $similar['product_id'] ?>">
															<?php echo $similar['product_name'] ?>
														</a></h3>
												</div>
												<?php if (!empty($similar['product_promotion_price'])) { ?>
													<div class="product-price font-primary">
														<del class="me-1">

															$
															<?php echo number_format($similar['product_price'], 0, '.', ','); ?>
														</del>
														<ins>
															$
															<?php echo number_format($similar['product_promotion_price'], 0, '.', ','); ?>
														</ins>
													</div>
												<?php } else { ?>
													<div class="product-price font-primary">

														<ins>
															$
															<?php echo number_format($similar['product_price'], 0, '.', ','); ?>
														</ins>
													</div>
												<?php } ?>
											</div>
										</div>
									</div>

								<?php }
							} ?>
						</div>

					</div>

				</div>

			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="bg-color dark border-0">


			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container-fluid clearfix">

					<div class="row justify-content-between align-items-center">
						<div class="col-md-6">
							Copyrights &copy; 2014 All Rights Reserved by Canvas Inc.<br>
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a>
							</div>
						</div>


					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="../../../public/user_public/js/jquery.js"></script>
	<script src="../../../public/user_public/js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="../../../public/user_public/js/functions.js"></script>
	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

	<script>
		$(document).ready(changeHeaderColor);
		$(window).on('resize', changeHeaderColor);

		function changeHeaderColor() {
			if (jQuery(window).width() > 991.98) {
				jQuery("#header").hover(
					function () {
						if (!$(this).hasClass("sticky-header")) {
							$(this).addClass("hover-light").removeClass("dark");
							SEMICOLON.header.logo();
						}
						$("#wrapper").addClass("header-overlay");
					}, function () {
						if (!$(this).hasClass("sticky-header")) {
							$(this).removeClass("hover-light").addClass("dark");
							SEMICOLON.header.logo();
						}
						$("#wrapper").removeClass("header-overlay");
					}
				);
			}
		};

		$(window).scroll(function () {
			if ($(document).scrollTop() > 2000 && $("#modal-subscribe").attr("displayed") === "false") {
				$('#modal-subscribe').modal('show');
				$("#modal-subscribe").attr("displayed", "true");
			}
		});

		jQuery('#modal-subscribe-form').on('formSubmitSuccess', function () {
			$("#modal-subscribe").addClass("fadeOutDown");
			setTimeout(function () { $('#modal-subscribe').modal('hide'); }, 400);
			$("#modal-subscribe").attr("displayed", "false");
		});


	</script>
	<script>
		function AddCart(product_id) {
			$.ajax({
				url: '../../process/add_items_cart_in_single.php?product_id=' + product_id,
				type: 'GET',
			}).done(function (response) {
				$('#wrapper').empty();
				$('#wrapper').html(response);
				alertify.success('Add products to cart successfully!');
			})
		}
	</script>
</body>

</html>