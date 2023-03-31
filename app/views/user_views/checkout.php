<?php
session_start();
if(empty($_SESSION['user'])){
	header('Location: ../../views/auth/index.php');
	exit;
}
if (empty($_SESSION['cart'])) {
    echo '<script>
    alert("You need to add at least one product to your cart so you can view your cart and make checkout");
    window.location.replace("../../views/user_views/index.php");
    </script>';
}
require_once('../../process/show_user.php');
require_once('../../process/show_payment_method.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<?php
require_once('../../process/show_category.php');
require_once('../../process/show_product.php');
require_once('../../views/user_views/components/head.php'); ?>

<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

   	<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="dark" style="background-color: #a3a5a7;">
			<div class="container">

				<div class="row justify-content-between align-items-center">

					<div class="col-12 col-lg-auto">
						<p class="mb-0 d-flex justify-content-center justify-content-lg-start py-3 py-lg-0"><strong>Free
								nationwide shipping on orders over $99</strong></p>
					</div>

					<div class="col-12 col-lg-auto d-none d-lg-flex">

						<!-- Top Links
						============================================= -->
						<div class="top-links">
							<ul class="top-links-container">
								<li class="top-links-item"><a href="#">About</a></li>
								<li class="top-links-item"><a href="#">FAQS</a></li>
								<li class="top-links-item"><a href="#">Blogs</a></li>
							</ul>
						</div><!-- .top-links end -->

						<!-- Top Social
						============================================= -->
						<ul id="top-social">
							<li><a href="#" class="si-facebook"><span class="ts-icon"><i
											class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a>
							</li>
							<li><a href="#" class="si-instagram"><span class="ts-icon"><i
											class="icon-instagram2"></i></span><span
										class="ts-text">Instagram</span></a></li>
							<li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i
											class="icon-call"></i></span><span class="ts-text">+1.11.85412542</span></a>
							</li>
							<li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i
											class="icon-envelope-alt"></i></span><span
										class="ts-text">info@canvas.com</span></a></li>
						</ul><!-- #top-social end -->

					</div>
				</div>

			</div>
		</div>

		<!-- Header
		============================================= -->
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
									<?php if (!empty($_SESSION['cart'])) {
										$total_quantity = 0;
											foreach ($_SESSION['cart'] as $index => $cart_item) {
												$total_quantity += $cart_item['quantity'];
											}} ?>
									<span class="top-cart-number"><?php echo $total_quantity; ?></span>
								</a>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">
										<?php if (!empty($_SESSION['cart'])) {
											foreach ($_SESSION['cart'] as $index => $cart_item) {
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
																<?php echo $cart_item['price'] ?>
															</span>
														</div>
														<div class="top-cart-item-quantity">x
															<?php echo $cart_item['quantity'] ?>
														</div>
													</div>
												</div>
											<?php }
										} ?>
									</div>
									<div class="top-cart-action">
									<?php if (!empty($_SESSION['cart'])) {
										$total_price = 0;
											foreach ($_SESSION['cart'] as $index => $cart_item) {
												$total_price += $cart_item['quantity'] * $cart_item['price'] ;
											}} ?>
										<span class="top-checkout-price"><?php echo $total_price;?></span>
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
									<li class="menu-item current"><a class="menu-link" href="#">
											<div>
												<?php echo $category['category_name'] ?>
											</div>
										</a></li>
								<?php } ?>
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value=""
								placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->

        <!-- Page Title
        ============================================= -->
        <section id="page-title">

            <div class="container clearfix">
                <h1>Checkout</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Shop</li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>

        </section><!-- #page-title end -->

        <!-- Content
        ============================================= -->
        <section id="content">
            <div class="content-wrap">
                <div class="container clearfix">

                    <div class="row col-mb-50 gutter-50">
                        <div class="col-lg-6">
                            <h4>Your Orders</h4>

                            <div class="table-responsive">
                                <table class="table cart">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-thumbnail">&nbsp;</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-quantity">Quantity</th>
                                            <th class="cart-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($_SESSION['cart'])) {
                                        $total_price = 0; // Khởi tạo biến tổng tiền toàn giỏ hàng
                                        foreach ($_SESSION['cart'] as $index => $cart) {
                                            $subtotal = $cart['quantity'] * $cart['price'];
                                            $total_price += $subtotal; ?>
                                        
                                                <tr class="cart_item">
                                                    <td class="cart-product-thumbnail">
                                                        <a href="#"><img width="64" height="64"
                                                                src="../../../public/image/<?php echo $cart['image'] ?>"
                                                                alt="Pink Printed Dress"></a>
                                                    </td>

                                                    <td class="cart-product-name">
                                                        <a href="#"><?php echo $cart['name'] ?></a>
                                                    </td>

                                                    <td class="cart-product-quantity">
                                                        <div class="quantity clearfix">
                                                        <?php echo $cart['quantity'] ?>
                                                        </div>
                                                    </td>

                                                    <td class="cart-product-subtotal">
                                                        <span class="amount"> $<?php $product_total_price = $cart['quantity'] * $cart['price'];
                                                        echo number_format($product_total_price, 0, '.', ','); ?></span>
                                                    </td>
                                                </tr>
                                        <?php }
                                    } ?>
                                    </tbody>

                                </table>
                            </div>
                            <h4>Cart Totals</h4>

                            <div class="table-responsive">
                                <table class="table cart">
                                    <tbody>
                                    <?php if (!empty($_SESSION['cart'])) { ?>
                                        <tr class="cart_item">
                                            <td class="border-top-0 cart-product-name">
                                                <strong>Cart Subtotal</strong>
                                            </td>

                                            <td class="border-top-0 cart-product-name">
                                                <span class="amount"> $<?php
                                                echo number_format($total_price, 2, '.', ','); ?></span>
                                            </td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <strong>Shipping</strong>
                                            </td>

                                            <td class="cart-product-name">
                                                <span class="amount">Free Delivery</span>
                                            </td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="cart-product-name">
                                                <strong>Total</strong>
                                            </td>

                                            <td class="cart-product-name">
                                                <span class="amount color lead"><strong> $<?php
                                                echo number_format($total_price, 2, '.', ','); ?></strong></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                             
                        </div>

                        <div class="col-lg-6">
                            <h3><span><i class="icon-line2-pointer"></i> </span>Shipping address</h3>
                                        <?php
                                        if (!empty($_SESSION['user']))
                                            foreach ($users as $user) {
                                                if ($_SESSION['user']['email'] == $user['email']) {
                                                    ?>
                                                    <form id="shipping-form" name="shipping-form" class="row mb-0" action="../../process/checkout.php" method="post">
                                                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                        <div class="col-md-12 form-group">
                                                            <label for="shipping-form-name">Name:</label>
                                                            <input type="text" id="shipping-form-name" name="fullname" value="<?php echo $user['fullname']; ?>"
                                                                class="sm-form-control" />
                                                        </div>
                                                        <div class="w-100"></div>
                                                        <div class="col-12 form-group">
                                                            
                                                            <label for="shipping-form-address">Address:</label>
                                                            <input type="text" id="shipping-form-address" name="address" value="<?php echo $user['address']; ?>"
                                                                class="sm-form-control" />
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <label for="shipping-form-address">Phone:</label>
                                                            <input type="text" id="shipping-form-address" name="phone" value="<?php echo $user['phone']; ?>"
                                                                class="sm-form-control" />
                                                        </div>
                                            
                                                        <div class="col-12 form-group">
                                                        <label for="shipping-form-address">Payment:</label><br>
                                                        <?php 
$default_payment_method = 1; // method_id mặc định
foreach ($payment_methods as $method) {
    $checked = ($method['method_id'] == $default_payment_method) ? 'checked' : '';
?>
    <input type="radio" name="payment_method_id" value="<?php echo $method['method_id'] ?>" <?php echo $checked ?>><?php echo $method['payment_method'] ?><br>
<?php } ?>

                                                        </div>
                                                        <div class="col-12 form-group">
                                                        <button type="submit" class="button button-3d float-end" name="submit" >Place Order</button>    
                                                    </form>

                                                    <?php
                                                }
                                           
                                        }

                                        ?>
                             </div>
                    </div>
                </div>
            </div>
        </section><!-- #content end -->

        <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark">

            <!-- Copyrights
            ============================================= -->
            <div id="copyrights">
                <div class="container">

                    <div class="row col-mb-30">

                        <div class="col-md-6 text-center text-md-start">
                            Copyrights &copy; 2020 All Rights Reserved by Canvas Inc.<br>
                            <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a>
                            </div>
                        </div>

                        <div class="col-md-6 text-center text-md-end">
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <a href="#" class="social-icon si-small si-borderless si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-pinterest">
                                    <i class="icon-pinterest"></i>
                                    <i class="icon-pinterest"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-vimeo">
                                    <i class="icon-vimeo"></i>
                                    <i class="icon-vimeo"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-github">
                                    <i class="icon-github"></i>
                                    <i class="icon-github"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-yahoo">
                                    <i class="icon-yahoo"></i>
                                    <i class="icon-yahoo"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>
                            </div>

                            <div class="clear"></div>

                            <i class="icon-envelope2"></i> info@canvas.com <span class="middot">&middot;</span> <i
                                class="icon-headphones"></i> +1-11-6541-6369 <span class="middot">&middot;</span> <i
                                class="icon-skype2"></i> CanvasOnSkype
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

</body>

</html>