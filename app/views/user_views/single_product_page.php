<?php 
session_start();
if(empty($_SESSION['user'])){
	header('Location: ../../views/auth/index.php');
	exit;
}
require_once('../../process/show_category.php');
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_ecommerce';

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die('Connect error'.$connection->connect_error);
    }

    $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4;";
        $result = $connection->query($sql);

        $products_similar = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products_similar[] = $row;
            }
        }

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $sql = 'SELECT * FROM products WHERE product_id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $products_wid = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products_wid[] = $row;
            }
        }
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<?php require_once('../../views/user_views/components/head.php'); ?>

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
							<div id="top-account">
									<i class="icon-line2-user me-1 position-relative" style="top: 1px;"></i><span
										class="d-none d-sm-inline-block font-primary fw-medium">
										<?php echo $_SESSION['user']['name'] ?>
									</span>
								
							</div><!-- #top-search end -->

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
		<span class="top-cart-number"><?php echo $total_quantity; ?></span>
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
										$<?php echo number_format($cart_item['price'], 0, '.', ',');?>
									</span>
								</div>
								<div class="top-cart-item-quantity">x
									<?php echo $cart_item['quantity'] ?>
								</div>
							</div>
						</div>
					<?php }
				} else{
					echo 'Add new products to cart';
				}
			?>
		</div>
		<div class="top-cart-action">
			<?php 
				if (!empty($_SESSION['cart'])) {
					$total_price = 0;
					foreach ($_SESSION['cart'] as $index => $cart_item) {
						$total_price += $cart_item['quantity'] * $cart_item['price'] ;
					}
				} else{
					$total_price = 0;
				}
			?>
			<span class="top-checkout-price">
				$<?php echo number_format($total_price, 0, '.', ',');?>	
			</span>

										<a href="../user_views/cart.php" class="button button-3d button-small m-0">View Cart</a>
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
								<?php foreach ($categories as $category) { ?>
									<li class="menu-item current"><a class="menu-link" href="../../views/user_views/product.php?category_id=<?php echo $category['category_id']?>">
											<div>
												<?php echo $category['category_name'] ?>
											</div>
										</a></li>
								<?php } ?>
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


		<!-- Slider
		============================================= -->
		<?php require_once('../../views/user_views/components/slider.php'); ?>
		<!-- Content
		============================================= -->
		<section id="page-title" class="page-title-parallax page-title-dark page-title-center" style="background-image: url('demos/store/images/single/page-title.jpg'); background-size: cover; padding: 170px 0 100px;" data-bottom-top="background-position: 50% 200px;" data-top-bottom="background-position: 50% -200px;">

			<div class="container clearfix">
				<h1>Rounded Watch</h1>
				<span>Watches</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Men</a></li>
					<li class="breadcrumb-item"><a href="#">Acessories</a></li>
					<li class="breadcrumb-item active" aria-current="page">Rounded Watch</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">

				<!-- Login/Register Modal -->
				<div class="modal-register mfp-hide" id="modal-register">
					<div class="card mx-auto" style="max-width: 540px;">
						<div class="card-header py-3 bg-transparent center">
							<h3 class="mb-0 fw-normal">Hello, Welcome Back</h3>
						</div>
						<div class="card-body mx-auto py-5" style="max-width: 70%;">

							<a href="#" class="button button-large w-100 si-colored si-facebook nott fw-normal ls0 center m-0"><i class="icon-facebook-sign"></i> Log in with Facebook</a>

							<div class="divider divider-center"><span class="position-relative" style="top: -2px">OR</span></div>

							<form id="login-form" name="login-form" class="mb-0 row" action="#" method="post">

								<div class="col-12">
									<input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" placeholder="Username" />
								</div>

								<div class="col-12 mt-4">
									<input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" placeholder="Password" />
								</div>

								<div class="col-12 text-end">
									<a href="#" class="text-dark fw-light mt-2">Forgot Password?</a>
								</div>

								<div class="col-12 mt-4">
									<button class="button w-100 m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-4 center">
							<p class="mb-0">Don't have an account? <a href="#"><u>Sign up</u></a></p>
						</div>
					</div>
				</div><!-- Login/Register Modal End -->

				<div class="clear"></div>

				<div class="single-product mb-6">
                    <?php foreach($products_wid as $product){?>
					<div class="product">
						<div class="container-fluid">
							<div class="row gutter-50">
								<div class="col-xl-7 col-lg-5 mb-0 sticky-sidebar-wrap">

									<div class="masonry-thumbs grid-container grid-2" data-lightbox="gallery">
										<a class="grid-item" href="" data-lightbox="gallery-item"><img src="../../../public/image/<?php echo $product['product_image_1'];?>" alt="Watch 1"></a>
										<a class="grid-item" href="" data-lightbox="gallery-item"><img src="../../../public/image/<?php echo $product['product_image_2'];?>" alt="Watch 3"></a>
										<a class="grid-item" href="" data-lightbox="gallery-item"><img src="../../../public/image/<?php echo $product['product_image_3'];?>" alt="Watch 2"></a>
										<a class="grid-item" href="" data-lightbox="gallery-item"><img src="../../../public/image/<?php echo $product['product_image_1'];?>" alt="Watch 4"></a>
									</div>

								</div>

								<div class="col-xl-5 col-lg-7 mb-0">
									<div data-readmore="true" data-readmore-size="250px" data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>" data-readmore-trigger-close="false">

										<h3><?php echo $product['product_name'];?></h3>
                                        <div class="d-flex align-items-center justify-content-between">

										<!-- Product Single - Price
										============================================= -->
                                        
                                        <?php if(!empty($product['product_promotion_price'])){?>
										<div class="product-price"><del><?php echo number_format($product['product_price']).' đ';?></del> <ins><?php echo number_format($product['product_promotion_price']).' đ';?></ins><span class="text-warning"> (30% OFF)</span></div><!-- Product Single - Price End -->
                                        <?php } else{?>
                                            <div class="product-price"><ins><?php echo number_format($product['product_price']).' đ';?></ins></div>
                                        <?php }?>
									</div>

									<div class="line line-sm"></div>
                                    <!-- Product Single - Quantity & Cart Button
									============================================= -->
									<form class="cart mb-0 d-flex justify-content-between align-items-center" method="post" enctype='multipart/form-data'>
									
										<button type="submit" class="add-to-cart button button-large m-0">Add to cart</button>
									</form><!-- Product Single - Quantity & Cart Button End -->

									<div class="line line-sm"></div>
										<!-- Product Single - Short Description
										============================================= -->
										<p><?php echo $product['product_description'];?></p>
										<!-- <p>Perspiciatis ad eveniet ea quasi debitis quos laborum eum reprehenderit eaque explicabo assumenda rem modi.</p> -->

										<ul class="iconlist mb-0">
											<li><i class="icon-caret-right"></i> Dynamic Color Options</li>
											<li><i class="icon-caret-right"></i> Lots of Size Options</li>
											<li><i class="icon-caret-right"></i> 30-Day Return Policy</li>
										</ul><!-- Product Single - Short Description End -->

										<a href="#" class="btn btn-dark btn-sm read-more-trigger"></a>
									</div>

									<!-- Product Single - Meta
									============================================= -->
									<!-- <div class="card product-meta mt-4 mb-5 rounded-0">
										<div class="card-body">
											<span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">8465415</span></span>
											<span class="posted_in">Category: <a href="#" rel="tag">Dress</a>.</span>
											<span class="tagged_as">Tags: <a href="#" rel="tag">Pink</a>, <a href="#" rel="tag">Short</a>, <a href="#" rel="tag">Dress</a>, <a href="#" rel="tag">Printed</a>.</span>
										</div>
									</div> -->
                                    <!-- Product Single - Meta End -->

									<!-- <div>
										<h4>Product Details</h4>
										<table class="table table-striped table-bordered mb-5">
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
													<td>Silver-Toned bracelet style, stainless steel strap with a foldover closure</td>
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
										</table>

										<h4>Size & Fit</h4>
										<table class="table table-striped table-bordered">
											<tbody>
												<tr>
													<td>Dial width</td>
													<td>40 mm</td>
												</tr>
												<tr>
													<td>Strap Width</td>
													<td>20 mm</td>
												</tr>
											</tbody>
										</table>
									</div> -->

									<!-- Product Single - Share
									============================================= -->
									<!-- <div class="si-share d-flex justify-content-between align-items-center mt-4 border-0"> -->
										<!-- <h4 class="mb-0">Share:</h4>
										<div>
											<a href="#" class="social-icon si-borderless si-facebook">
												<i class="icon-facebook"></i>
												<i class="icon-facebook"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-twitter">
												<i class="icon-twitter"></i>
												<i class="icon-twitter"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-pinterest">
												<i class="icon-pinterest"></i>
												<i class="icon-pinterest"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-gplus">
												<i class="icon-gplus"></i>
												<i class="icon-gplus"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-rss">
												<i class="icon-rss"></i>
												<i class="icon-rss"></i>
											</a>
											<a href="#" class="social-icon si-borderless si-email3">
												<i class="icon-email3"></i>
												<i class="icon-email3"></i>
											</a>
										</div>
									</div> -->
                                    <!-- Product Single - Share End -->

								</div>

							</div>
						</div>
					</div>
                    <?php } ?>
                </div>

				<div class="section mb-0">

					<div class="container mw-md text-center">
						<h4>Similar Products</h4>

						<div class="row justify-content-center gutter-1">

                        <?php foreach($products_similar as $similar){?>
							<!-- Shop Item 1
							============================================= -->
							<div class="col-md-3 col-6 h-translate-y-sm all-ts">
                            <div class="product">
												<div class="product-image">
													<a href="../../views/user_views/single_product_page.php?product_id=<?php echo $similar['product_id']?>"><img
															src="../../../public/image/<?php echo $similar['product_image_1'] ?>"
															alt="Image 1"></a>
													<a href="../../views/user_views/single_product_page.php?product_id=<?php echo $similar['product_id']?>"><img
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
														<h3><a href="../../views/user_views/single_product_page.php?product_id=<?php echo $similar['product_id']?>">
																<?php echo $similar['product_name'] ?>
															</a></h3>
													</div>
													<?php if (!empty($similar['product_promotion_price'])) { ?>
														<div class="product-price font-primary">
															<del class="me-1">
															
																$<?php echo number_format($similar['product_price'], 0, '.', ',');?>
															</del>
															<ins>
																$<?php echo number_format($similar['product_promotion_price'], 0, '.', ','); ?>
															</ins>
														</div>
													<?php } else { ?>
														<div class="product-price font-primary">

															<ins>
															$<?php echo number_format($similar['product_price'], 0, '.', ',');?>
															</ins>
														</div>
													<?php } ?>
												</div>
											</div>
							</div>

<?php } ?>
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
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
						</div>

						<div class="col-md-6 d-md-flex flex-md-column align-items-md-end mt-4 mt-md-0">
							<ul class="list-unstyled d-flex flex-row mb-2 clearfix">
								<li class="me-2"><img src="demos/xmas/images/cards/visa.svg" alt="Visa" width="34"></li>
								<li class="me-2"><img src="demos/xmas/images/cards/mc.svg" alt="Master Card" width="34"></li>
								<li class="me-2"><img src="demos/xmas/images/cards/ae.svg" alt="American Express" width="34"></li>
								<li class="me-2"><img src="demos/xmas/images/cards/pp.svg" alt="PayPal" width="34"></li>
								<li class="me-2"><img src="demos/xmas/images/cards/sk.svg" alt="Skrill" width="34"></li>
								<li class="me-2"><img src="demos/xmas/images/cards/2co.svg" alt="2CheckOut" width="34"></li>
								<li class="me-2"><img src="demos/xmas/images/cards/wu.svg" alt="Western Union" width="34"></li>
							</ul>
							<div class="copyrights-menu copyright-links clearfix">
								<a href="#">About</a>/<a href="#">Features</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>
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
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

	<script>
		$(document).ready(changeHeaderColor);
		$(window).on('resize',changeHeaderColor);

		function changeHeaderColor(){
			if (jQuery(window).width() > 991.98) {
				jQuery( "#header" ).hover(
					function() {
						if (!$(this).hasClass("sticky-header")) {
							$( this ).addClass( "hover-light" ).removeClass( "dark" );
							SEMICOLON.header.logo();
						}
						$( "#wrapper" ).addClass( "header-overlay" );
					}, function() {
						if (!$(this).hasClass("sticky-header")) {
							$( this ).removeClass( "hover-light" ).addClass( "dark" );
							SEMICOLON.header.logo();
						}
						$( "#wrapper" ).removeClass( "header-overlay" );
					}
				);
			}
		};

		$(window).scroll(function() {
			if ($(document).scrollTop() > 2000 && $("#modal-subscribe").attr("displayed") === "false") {
				$('#modal-subscribe').modal('show');
				$("#modal-subscribe").attr("displayed", "true");
			}
		});

		jQuery('#modal-subscribe-form').on( 'formSubmitSuccess', function(){
			$("#modal-subscribe").addClass("fadeOutDown");
			setTimeout(function() { $('#modal-subscribe').modal('hide'); }, 400);
			$("#modal-subscribe").attr("displayed", "false");
		});


	</script>

</body>
</html>