<?php
session_start();
if (empty($_SESSION['user'])) {
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
require_once('../../process/show_category.php');
require_once('../../process/show_product.php');
require_once('../../process/showaddress.php');
?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<?php
require_once('../../views/user_views/components/head.php'); ?>


<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="index.html" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="Canvas Logo"></a>
							<a href="index.html" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="images/logo@2x.png" alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div><!-- #top-search end -->

							<!-- Top Cart
							============================================= -->
							<div id="top-cart" class="header-misc-icon d-none d-sm-block">
								<a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">5</span></a>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">
										<div class="top-cart-item">
											<div class="top-cart-item-image">
												<a href="#"><img src="images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
											</div>
											<div class="top-cart-item-desc">
												<div class="top-cart-item-desc-title">
													<a href="#">Blue Round-Neck Tshirt with a Button</a>
													<span class="top-cart-item-price d-block">$19.99</span>
												</div>
												<div class="top-cart-item-quantity">x 2</div>
											</div>
										</div>
										<div class="top-cart-item">
											<div class="top-cart-item-image">
												<a href="#"><img src="images/shop/small/6.jpg" alt="Light Blue Denim Dress" /></a>
											</div>
											<div class="top-cart-item-desc">
												<div class="top-cart-item-desc-title">
													<a href="#">Light Blue Denim Dress</a>
													<span class="top-cart-item-price d-block">$24.99</span>
												</div>
												<div class="top-cart-item-quantity">x 3</div>
											</div>
										</div>
									</div>
									<div class="top-cart-action">
										<span class="top-checkout-price">$114.95</span>
										<a href="#" class="button button-3d button-small m-0">View Cart</a>
									</div>
								</div>
							</div><!-- #top-cart end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container">
								<li class="menu-item">
									<a class="menu-link" href="index.html"><div>Home</div></a>
									<ul class="sub-menu-container">
										<li class="menu-item">
											<a class="menu-link" href="intro.html#section-niche"><div>Niche Demos</div></a>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="intro.html#section-onepage"><div>One-Page Demos</div></a>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-corporate.html"><div>Home - Corporate</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-corporate.html"><div>Corporate - Layout 1</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-corporate-2.html"><div>Corporate - Layout 2</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-corporate-3.html"><div>Corporate - Layout 3</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-corporate-4.html"><div>Corporate - Layout 4</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-portfolio.html"><div>Home - Portfolio</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-portfolio.html"><div>Portfolio - Layout 1</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-portfolio-2.html"><div>Portfolio - Layout 2</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-portfolio-3.html"><div>Portfolio - Masonry</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-portfolio-4.html"><div>Portfolio - AJAX</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-blog.html"><div>Home - Blog</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-blog.html"><div>Blog - Layout 1</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-blog-2.html"><div>Blog - Layout 2</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-blog-3.html"><div>Blog - Layout 3</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-shop.html"><div>Home - Shop</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-shop.html"><div>Shop - Layout 1</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-shop-2.html"><div>Shop - Layout 2</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-magazine.html"><div>Home - Magazine</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-magazine.html"><div>Magazine - Layout 1</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-magazine-2.html"><div>Magazine - Layout 2</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-magazine-3.html"><div>Magazine - Layout 3</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="landing.html"><div>Home - Landing Page</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="landing.html"><div>Landing Page - Layout 1</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="landing-2.html"><div>Landing Page - Layout 2</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="landing-3.html"><div>Landing Page - Layout 3</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="landing-4.html"><div>Landing Page - Layout 4</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="landing-5.html"><div>Landing Page - Layout 5</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-fullscreen-image.html"><div>Home - Full Screen</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-fullscreen-image.html"><div>Full Screen - Image</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-fullscreen-slider.html"><div>Full Screen - Slider</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-fullscreen-video.html"><div>Full Screen - Video</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="index-onepage.html"><div>Home - One Page</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="index-onepage.html"><div>One Page - Default</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-onepage-2.html"><div>One Page - Submenu</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="index-onepage-3.html"><div>One Page - Dots Style</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item mega-menu mega-menu-small">
											<a class="menu-link" href="#"><div>Extras</div></a>
											<div class="mega-menu-content">
												<div class="row mx-0">
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="index-wedding.html"><div>Wedding</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="index-restaurant.html"><div>Restaurant</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="index-events.html"><div>Events</div></a>
														</li>
													</ul>
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="index-parallax.html"><div>Parallax</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="index-app-showcase.html"><div>App Showcase</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="index-boxed.html"><div>Boxed Layout</div></a>
														</li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="#"><div>Features</div></a>
									<ul class="sub-menu-container">
										<li class="menu-item">
											<a class="menu-link" href="#"><div><i class="icon-stack"></i>Sliders</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="slider-revolution.html"><div>Revolution Slider</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="rs-demos.html"><div>Premium Templates</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-revolution.html"><div>Full Screen</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-revolution-fullwidth.html"><div>Full Width</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-revolution-kenburns.html"><div>Kenburns Effect</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-revolution-html5-videos.html"><div>HTML5 Video</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="slider-canvas.html"><div>Canvas Slider</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas.html"><div>Full Width</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-fade.html"><div>Fade Transition</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-autoplay.html"><div>Autoplay Feature</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-video-event.html"><div>Custom Video Event</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-pagination.html"><div>Pagination Navigation</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-3.html"><div>3 Columns</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-4.html"><div>4 Columns</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-canvas-5.html"><div>5 Columns</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="slider-flex.html"><div>Flex Slider</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="slider-flex.html"><div>Default Layout</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-flex-thumbs.html"><div>with Thumbs</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="slider-owl.html"><div>Owl Slider</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="slider-owl-full.html"><div>Full Width</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-owl.html"><div>Boxed Width</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="slider-owl-videos.html"><div>Video Slider</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="static-parallax.html"><div>Static Media</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="static-parallax.html"><div>Static - Parallax</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="static-image.html"><div>Static - Image</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="static-thumbs-grid.html"><div>Static - Thumb Gallery</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="static-html5-video.html"><div>Static - HTML5 Video</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="static-embed-video.html"><div>Static - Embedded Video</div></a>
														</li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="#"><div><i class="icon-umbrella"></i>Headers</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="header-light.html"><div>Light Version</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="header-dark.html"><div>Dark Version</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="header-transparent.html"><div>Transparent</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="header-semi-transparent.html"><div>Semi Transparent</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="header-semi-transparent.html"><div>Light Version</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="header-semi-transparent-dark.html"><div>Dark Version</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="header-side-left.html"><div>Left Side Header</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="header-side-left.html"><div>Fixed Position</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="header-side-left-open.html"><div>OnClick Open</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="header-side-left-open-push.html"><div>Push Content</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="header-side-right.html"><div>Right Side Header</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item">
															<a class="menu-link" href="header-side-right.html"><div>Fixed Position</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="header-side-right-open.html"><div>OnClick Open</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="header-side-right-open-push.html"><div>Push Content</div></a>
														</li>
													</ul>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="header-floating.html"><div>Floating Version</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="static-sticky.html"><div>Static Sticky</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="responsive-sticky.html"><div>Responsive Sticky</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="logo-changer.html"><div>Alternate Logos</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="alternate-mobile-menu.html"><div>Alternate Mobile Menu</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item mega-menu mega-menu-small">
											<a class="menu-link" href="#"><div><i class="icon-align-justify2"></i>Menu Styles</div></a>
											<div class="mega-menu-content">
												<div class="row mx-0">
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="header-light.html"><div>Default Layout</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-2.html"><div>Alternate Layout</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-3.html"><div>Pill Style</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-4.html"><div>Border Style</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-5.html"><div>Large Icon Menu</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="split-menu.html"><div>Split Layout</div></a>
														</li>
													</ul>
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="menu-6.html"><div>Scaling Border</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-subtitle.html"><div>Sub-Title Menu</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-7.html"><div>Extended Menu 1</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-8.html"><div>Extended Menu 2</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-9.html"><div>Extended Menu 3</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="menu-10.html"><div>Overlay Menu</div></a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="mega-menu.html"><div><i class="icon-line-columns"></i>Mega Menu</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="mega-menu.html"><div>Widgetized</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="mega-menu-full.html"><div>Full-Width</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="mega-menu-tab.html"><div>Tabbed</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="mega-menu-side-tab.html"><div>Side-Tabs (onClick)</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="forms.html"><div><i class="icon-wpforms"></i>Forms</div></a>
										</li>
										<li class="menu-item mega-menu mega-menu-small">
											<a class="menu-link" href="widgets.html"><div><i class="icon-gift"></i>Widgets</div></a>
											<div class="mega-menu-content">
												<div class="row mx-0">
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Links</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Flickr Photostream</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Dribbble Shots</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Subscribers</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Posts List</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Twitter Feed</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Tabbed Widgets</div></a>
														</li>
													</ul>
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Carousel</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Social Icons</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Testimonials</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Quick Contact</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Tags Cloud</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Video Embeds</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="widgets.html"><div>Raw HTML</div></a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li class="menu-item mega-menu mega-menu-small">
											<a class="menu-link" href="#"><div><i class="icon-ok-sign"></i>Page Titles</div></a>
											<div class="mega-menu-content">
												<div class="row mx-0">
													<ul class="sub-menu-container mega-menu-column col-5">
														<li class="menu-item">
															<a class="menu-link" href="page.html"><div>Left Align</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-right.html"><div>Right Align</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-center.html"><div>Center Align</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-dark.html"><div>Dark Style</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-pattern.html"><div>BG Pattern</div></a>
														</li>
													</ul>
													<ul class="sub-menu-container mega-menu-column col-7">
														<li class="menu-item">
															<a class="menu-link" href="page-title-parallax.html"><div>Parallax - Default</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-parallax-header.html"><div>Parallax - Transparent</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-video.html"><div>HTML5 Video</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-nobg.html"><div>No Background</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="page-title-mini.html"><div>Mini Version</div></a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="side-panel.html"><div><i class="icon-line-layout"></i>Side Panel</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="side-panel-left-overlay.html"><div>Left Overlay</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="side-panel-left-push.html"><div>Left Push</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="side-panel-right-overlay.html"><div>Right Overlay</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="side-panel.html"><div>Right Push</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="side-panel-light.html"><div>Light Background</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="modal-onload.html"><div><i class="icon-line-expand"></i>Modal OnLoad</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="modal-onload.html"><div>Default Layout</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="modal-onload-iframe.html"><div>Video iFrame</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="modal-onload-subscribe.html"><div>Subscription Form</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="modal-onload-common-height.html"><div>Common Height</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="modal-onload-cookie.html"><div>Cookies Enabled</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item mega-menu mega-menu-small">
											<a class="menu-link" href="#footer" data-scrollto="#footer"><div><i class="icon-th"></i>Footers</div></a>
											<div class="mega-menu-content">
												<div class="row mx-0">
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="sticky-footer.html"><div>Sticky</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="#footer" data-scrollto="#footer"><div>Layout 1</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="footer-2.html#footer"><div>Layout 2</div></a>
														</li>
													</ul>
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="footer-3.html#footer"><div>Layout 3</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="footer-4.html#footer"><div>Layout 4</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="footer-5.html#footer"><div>Layout 5</div></a>
														</li>
													</ul>
													<ul class="sub-menu-container mega-menu-column col">
														<li class="menu-item">
															<a class="menu-link" href="footer-6.html#footer"><div>Layout 6</div></a>
														</li>
														<li class="menu-item">
															<a class="menu-link" href="footer-7.html#footer"><div>Layout 7</div></a>
														</li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li class="menu-item mega-menu">
									<a class="menu-link" href="#"><div>Pages</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Introductory</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="about.html"><div>About Us</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="about.html"><div>Main Layout</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="about-2.html"><div>Alternate Layout</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="about-me.html"><div>About Me</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="team.html"><div>Team Members</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="gdpr.html"><div>GDPR Compliance</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="gdpr.html"><div>Default</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="gdpr-small.html"><div>Small</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="jobs.html"><div>Careers</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="profile.html"><div>User Profile</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Utility &amp; Specials</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="services.html"><div><i class="icon-star-of-life"></i>Services Pages</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="services.html"><div>Layout 1</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="services-2.html"><div>Layout 2</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="services-3.html"><div>Layout 3</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="#"><div><i class="icon-calendar3"></i>Events</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="events-list.html"><div>Events List</div></a>
																		<ul class="sub-menu-container mega-menu-dropdown">
																			<li class="menu-item">
																				<a class="menu-link" href="events-list.html"><div>Right Sidebar</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="events-list-left-sidebar.html"><div>Left Sidebar</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="events-list-both-sidebar.html"><div>Both Sidebar</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="events-list-fullwidth.html"><div>Full Width</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="events-list-parallax.html"><div>Parallax List</div></a>
																			</li>
																		</ul>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="event-single.html"><div>Single Event</div></a>
																		<ul class="sub-menu-container mega-menu-dropdown">
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-right-sidebar.html"><div>Right Sidebar</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-left-sidebar.html"><div>Left Sidebar</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-both-sidebar.html"><div>Both Sidebar</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="event-single.html"><div>Full Width</div></a>
																			</li>
																		</ul>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="event-single-full-width-image.html"><div>Single Event - Full</div></a>
																		<ul class="sub-menu-container mega-menu-dropdown">
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-full-width-image.html"><div>Parallax Image</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-full-width-map.html"><div>Google Map</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-full-width-slider.html"><div>Slider Gallery</div></a>
																			</li>
																			<li class="menu-item">
																				<a class="menu-link" href="event-single-full-width-video.html"><div>HTML5 Video</div></a>
																			</li>
																		</ul>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="events-calendar.html"><div>Full Width Calendar</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="contact.html"><div><i class="icon-envelope"></i>Contact Pages</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="contact.html">Main Layout</a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="contact-2.html">Grid Layout</a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="contact-3.html">Right Sidebar</a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="contact-4.html">Both Sidebars</a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="contact-5.html">Modal Form</a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="contact-6.html">Form Overlay</a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="contact-7.html">Form Overlay Mini</a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="faqs.html"><div><i class="icon-question-circle"></i>FAQs Pages</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="faqs.html"><div>Layout 1</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="faqs-2.html"><div>Layout 2</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="faqs-3.html"><div>Layout 3</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="faqs-4.html"><div>Layout 4</div></a>
																	</li>
																</ul>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Layouts &amp; PageNavs</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="full-width.html"><div>Full Width</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="full-width.html"><div>Default Width</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="full-width-wide.html"><div>Wide Width</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="#"><div>Sidebars</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="right-sidebar.html"><div>Right Sidebar</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="left-sidebar.html"><div>Left Sidebar</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="both-sidebar.html"><div>Both Sidebar</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="both-right-sidebar.html"><div>Both Right Sidebar</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="both-left-sidebar.html"><div>Both Left Sidebar</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="page-submenu.html"><div>Page Submenu</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="side-navigation.html"><div>Side Navigation</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Miscellaneous</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="login-register.html"><div>Login/Register</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="login-register.html"><div>Default Layout</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="login-register-2.html"><div>Tabbed Login</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="login-register-3.html"><div>Login Accordion</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="login-1.html"><div>Dark BG Login</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="login-2.html"><div>Image BG Login</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="coming-soon.html"><div>Coming Soon</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="coming-soon.html"><div>Default Layout</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="coming-soon-2.html"><div>Parallax Image</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="coming-soon-3.html"><div>HTML5 Video</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="404.html"><div>404 Pages</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="404.html"><div>Default Layout</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="404-2.html"><div>Parallax Image</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="404-3.html"><div>HTML5 Video</div></a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="#"><div>Extras</div></a>
																<ul class="sub-menu-container mega-menu-dropdown">
																	<li class="menu-item">
																		<a class="menu-link" href="blank-page.html"><div>Blank Page</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="maintenance.html"><div>Maintenance Page</div></a>
																	</li>
																	<li class="menu-item">
																		<a class="menu-link" href="sitemap.html"><div>Sitemap</div></a>
																	</li>
																</ul>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
								<li class="menu-item mega-menu">
									<a class="menu-link" href="#"><div>Portfolio</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Grids</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="portfolio-1.html"><div>1 Column</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-2.html"><div>2 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-3.html"><div>3 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio.html"><div>4 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-5.html"><div>5 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-6.html"><div>6 Columns</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Masonry</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="portfolio-mixed-masonry.html"><div>Mixed Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-2-masonry.html"><div>2 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-3-masonry.html"><div>3 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-masonry.html"><div>4 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-5-masonry.html"><div>5 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-6-masonry.html"><div>6 Columns</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Loading Styles</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="portfolio.html"><div>jQuery Filter</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-jpagination.html"><div>jQuery Pagination</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-infinity-scroll.html"><div>Infinity Scroll</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-ajax.html"><div>AJAX In Page</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-ajax-in-modal.html"><div>AJAX In Modal</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-filter-styles.html"><div>Filter Styles</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Single Project</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="portfolio-single-extended.html"><div>Extended Item</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-single-fullwidth.html"><div>Parallax Image</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-single-gallery-full.html"><div>Slider Gallery</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-single-video-fullwidth-left-sidebar.html"><div>HTML5 Video</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-single-thumbs-right-sidebar.html"><div>Masonry Thumbs</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-single-video-both-sidebar.html"><div>Embed Video</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Layouts</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="portfolio-nomargin.html"><div>Default</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-1-alt-right-sidebar.html"><div>Right Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-3-left-sidebar.html"><div>Left Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-2-both-sidebar.html"><div>Both Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-fullwidth-notitle.html"><div>100% Width</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="portfolio-parallax.html"><div>Parallax</div></a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
								<li class="menu-item mega-menu">
									<a class="menu-link" href="#"><div>Blog</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Default</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog.html"><div>Right Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-left-sidebar.html"><div>Left Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-both-sidebar.html"><div>Both Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-full-width.html"><div>Full Width</div></a>
															</li>
														</ul>
													</li>
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Timeline</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-timeline-right-sidebar.html"><div>Right Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-timeline-left-sidebar.html"><div>Left Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-timeline.html"><div>Full Width</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Masonry</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-masonry.html"><div>4 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-masonry-3.html"><div>3 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-masonry-2.html"><div>2 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-masonry-full.html"><div>100% Width</div></a>
															</li>
														</ul>
													</li>
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Grid</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-grid.html"><div>4 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-grid-3.html"><div>3 Columns</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-grid-2.html"><div>2 Columns</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Small Thumbs</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-small-left-sidebar.html"><div>Left Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-small.html"><div>Right Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-small-both-sidebar.html"><div>Both Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-small-full-width.html"><div>Full Width</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-small-alt.html"><div>Alternate Layout</div></a>
															</li>
														</ul>
													</li>
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Item Splitting</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-grid.html"><div>Pagination</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-masonry.html"><div>Infinite Scroll</div></a>
															</li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Single</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-single.html"><div>Default Layout</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-single-left-sidebar.html"><div>Left Sidebar</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-single-full.html"><div>Full Width</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-single-small.html"><div>Small Image</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-single-split-right-sidebar.html"><div>Split Layout</div></a>
															</li>
														</ul>
													</li>
													<li class="menu-item mega-menu-title">
														<a class="menu-link" href="#"><div>Comments Module</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item">
																<a class="menu-link" href="blog-single-left-sidebar.html#comments"><div>Facebook Comments</div></a>
															</li>
															<li class="menu-item">
																<a class="menu-link" href="blog-single-small.html#comments"><div>Disqus Comments</div></a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="shop.html"><div>Shop</div></a>
									<ul class="sub-menu-container">
										<li class="menu-item">
											<a class="menu-link" href="shop.html"><div>4 Columns</div></a>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="shop-3.html"><div>3 Columns</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="shop-3.html"><div>Full Width</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-3-right-sidebar.html"><div>Right Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-3-left-sidebar.html"><div>Left Sidebar</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="shop-2.html"><div>2 Columns</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="shop-2-right-sidebar.html"><div>Right Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-2-left-sidebar.html"><div>Left Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-2-both-sidebar.html"><div>Both Sidebar</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="shop-1.html"><div>1 Columns</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="shop-1.html"><div>Full Width</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-1-right-sidebar.html"><div>Right Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-1-left-sidebar.html"><div>Left Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-1-both-sidebar.html"><div>Both Sidebar</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="shop-category-parallax.html"><div>Categories - Parallax</div></a>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="shop-combination-filter.html"><div>Combination Filter</div></a>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="shop-single.html"><div>Single Product</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item">
													<a class="menu-link" href="shop-single.html"><div>Full Width</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-single-right-sidebar.html"><div>Right Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-single-left-sidebar.html"><div>Left Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-single-both-sidebar.html"><div>Both Sidebar</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-single-color.html"><div>Color Options</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-single-sticky.html"><div>Sticky Aside</div></a>
												</li>
												<li class="menu-item">
													<a class="menu-link" href="shop-single-list.html"><div>Feature List</div></a>
												</li>
											</ul>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="cart.html"><div>Cart</div></a>
										</li>
										<li class="menu-item">
											<a class="menu-link" href="checkout.html"><div>Checkout</div></a>
										</li>
									</ul>
								</li>
								<li class="menu-item mega-menu">
									<a class="menu-link" href="#"><div>Shortcodes</div></a>
									<div class="mega-menu-content">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item">
														<a class="menu-link" href="animations.html"><div><i class="icon-magic"></i>Animations</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="buttons.html"><div><i class="icon-link"></i>Buttons</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="carousel.html"><div><i class="icon-heart3"></i>Carousel</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="charts.html"><div><i class="icon-bar-chart"></i>Charts</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="clients.html"><div><i class="icon-apple"></i>Clients</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="columns-grids.html"><div><i class="icon-th-large"></i>Columns</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="counters.html"><div><i class="icon-time"></i>Counters</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="read-more.html"><div><i class="icon-ellipsis-h"></i>Read More</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-datatable.html"><div><i class="icon-table"></i>Data Tables</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-datepicker.html"><div><i class="icon-calendar3"></i>Date &amp; Time Pickers</div></a>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item">
														<a class="menu-link" href="dividers.html"><div><i class="icon-indent-right"></i>Dividers</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="featured-boxes.html"><div><i class="icon-lightbulb"></i>Icon Boxes</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="gallery.html"><div><i class="icon-picture"></i>Galleries</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="headings-dropcaps.html"><div><i class="icon-pencil2"></i>Heading Styles</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="icon-lists.html"><div><i class="icon-list-alt"></i>Icon Lists</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="gradients.html"><div><i class="icon-tint"></i>Gradients</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="lightbox.html"><div><i class="icon-resize-full"></i>Lightbox</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="item-overlays.html"><div><i class="icon-line-marquee-plus"></i>Item Overlays</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="form-elements.html"><div><i class="icon-edit"></i>Form Elements</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-uploads.html"><div><i class="icon-line-upload"></i>File Uploads</div></a>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item">
														<a class="menu-link" href="lists-cards.html"><div><i class="icon-th-list"></i>Lists &amp; Cards</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="maps.html"><div><i class="icon-map-marker2"></i>Maps</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="media-embeds.html"><div><i class="icon-play"></i>Media Embeds</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="modal-popovers.html"><div><i class="icon-move"></i>Modal Boxes</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="navigation.html"><div><i class="icon-align-justify2"></i>Navigations</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="pagination-progress.html"><div><i class="icon-cogs"></i>Pagination</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="pie-skills.html"><div><i class="icon-tasks"></i>Pies &amp; Skills</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="shape-dividers.html"><div><i class="icon-shapes"></i>Shape Dividers</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-range-slider.html"><div><i class="icon-line-move"></i>Range Slider</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-ratings.html"><div><i class="icon-star3"></i>Star Ratings</div></a>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item">
														<a class="menu-link" href="pricing.html"><div><i class="icon-dollar"></i>Pricing Boxes</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="process-steps.html"><div><i class="icon-thumbs-up"></i>Process Steps</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="promo-boxes.html"><div><i class="icon-rocket"></i>Promo Boxes</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="quotes-blockquotes.html"><div><i class="icon-quote-left"></i>Blockquotes</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="responsive.html"><div><i class="icon-laptop2"></i>Responsive</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="sections.html"><div><i class="icon-folder-open"></i>Sections</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="social-icons.html"><div><i class="icon-facebook2"></i>Social Icons</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="hover-animations.html"><div><i class="icon-hand-pointer"></i>Hover Animations</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-select-picker.html"><div><i class="icon-select"></i>Select Picker</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-select-box.html"><div><i class="icon-line-columns"></i>Select Boxes</div></a>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col">
													<li class="menu-item">
														<a class="menu-link" href="style-boxes.html"><div><i class="icon-exclamation-sign"></i>Alert Boxes</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="styled-icons.html"><div><i class="icon-flag2"></i>Styled Icons</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="tables.html"><div><i class="icon-table"></i>Tables</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="tabs.html"><div><i class="icon-star3"></i>Tabs</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="testimonials-twitter.html"><div><i class="icon-user4"></i>Testimonials</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="thumbnails-slider.html"><div><i class="icon-camera3"></i>Thumbnails</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="toggles-accordions.html"><div><i class="icon-ok-circle"></i>Toggles</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="lazy-loading.html"><div><i class="icon-line-loader"></i>Lazy Loading</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="component-radios-switches.html"><div><i class="icon-line-square-check"></i>Radios &amp; Switches</div></a>
													</li>
													<li class="menu-item">
														<a class="menu-link" href="flip-cards.html"><div><i class="icon-refresh"></i>Flip Cards</div></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
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
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Shop</a></li>
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
						
					<div class="w-100"></div>

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
																		<span class="amount"><?php $product_total_price = $cart['quantity'] * $cart['price'];
																		echo number_format($product_total_price, 0, '.', ',') . ' đ'; ?></span>
																	</td>
																</tr>
												<?php }
									} ?>
									</tbody>

								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<h3>Billing Address</h3>
							<?php
							if (!empty($_SESSION['user']))
								foreach ($users as $user) {
									if ($_SESSION['user']['email'] == $user['email']) {
										?>
										<form id="billing-form" name="billing-form" class="row mb-0">

											<div class="col-md-12 form-group">
												<label for="billing-form-name">Name:<?php echo $user['fullname']; ?></label>
											</div>


											<div class="w-100"></div>


											<div class="col-12 form-group">
												<label for="billing-form-address">Address:<?php echo $user['address']; ?></label>
									
											</div>


											<div class="col-md-12 form-group">
												<label for="billing-form-email">Email Address:<?php echo $user['email']; ?></label>
											</div>

											<div class="col-md-12 form-group">
												<label for="billing-form-phone">Phone:<?php echo $user['phone']; ?></label>
											</div>
										</form>
							
										<?php
									}

								}

							?>
						</div>


						<div class="col-lg-6">
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
														<span class="amount"> <?php
														echo number_format($total_price, 2, '.', ',') . ' đ'; ?></span>
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
														<span class="amount color lead"><strong> <?php
														echo number_format($total_price, 2, '.', ',') . ' đ'; ?></strong></span>
													</td>
												</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>

						
						<div class="col-lg-6">
							<h3>Shipping Address</h3>
							<form id="shipping-form" name="shipping-form" class="row mb-0" action="../../process/checkout.php" method="post">

								<div class="col-md-12 form-group">
									<label for="shipping-form-name">Name:</label>
									<input type="text" id="shipping-form-name" name="shipping-form-name" value="" class="sm-form-control" />
								</div>

								<div class="w-100"></div>

								<div class="col-12 form-group">
								<label for="shipping-form-address">Address:</label><br>
								<?php if (isset($address_user)) {
									foreach ($address_user as $index => $address) { ?>
												<input type="radio" onclick="updateAddress('<?php echo $address['address'] ?>')" id="addresscheckbox<?php echo $address['id'] ?>" name="address" value="<?php echo $address['address'] ?>"/><?php echo $address['address'] ?><br/>
										<?php } ?>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
											Add new address
										</button>
								<?php } else { ?>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
											Add new address
										</button>
								<?php } ?>


								</div>

								<div class="col-12 form-group">
									<label for="shipping-form-address">Phone:</label>
									<input type="text" id="shipping-form-address" name="phone" value="" class="sm-form-control" />
								</div>
								<input type="hidden" name="payment_method_id" value="1" ><br>
								<button type="submit" style=" border: none;" type="submit" name="Payondelivery" ><img src="../../../public/image/Blue Modern Game Button Twitch Panel3.png" alt=""></button>
							</form>
							<br>
								<!-- <form action="../../process/checkout.php" method="POST">
									<input type="hidden" id="address-input" name="address" value="">
									<input type="hidden" id="address-input" name="payment_method" value="3">
									<button type="submit" style="border:none"><img src="../../../public/image/vnpaycheckoutbtn.jpg" alt=""></button>
								</form> -->
							<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
									action="../../views/user_views/momoprocess.php">
									<input type="hidden" name="total" value="<?php echo $total_price; ?>" id="">
									<button style=" border: none;" type="submit" name="momoqr" ><img src="../../../public/image/Blue Modern Game Button Twitch Panel1.png" alt=""></button>
							</form>


							<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
									action="../../views/user_views/momoATMprocess.php">
									<input type="hidden" name="total" value="<?php echo $total_price; ?>" id="">
									<input type="hidden" id="address-input" name="address" value="">
									<button style=" border: none;" type="submit" name="momoatm" ><img src="../../../public/image/Blue Modern Game Button Twitch Panel2.png" alt=""></button>
							</form>
							
							<?php
							$total_usd = 0;
							$total_usd = round($total_price / 23445);
							?>
							<div id="app">
								<input type="hidden" value="<?php echo $total_usd; ?>" id="total_usd">
								<div id="paypal-button-container"></div>
							</div>
	
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
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
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

							<i class="icon-envelope2"></i> info@canvas.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> +1-11-6541-6369 <span class="middot">&middot;</span> <i class="icon-skype2"></i> CanvasOnSkype
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add address</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="../../process/add_address.php">
				<label for="shipping-form-address">Address:</label><br>
				<input type="text" name="add_address_user">	
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" name="add_new_address">Save changes</button>
				</form>
			</div>
			</div>
		</div>
	</div>
 <!-- JavaScripts
	============================================= -->
	<script src="../../../public/user_public/js/jquery.js"></script>
	<script src="../../../public/user_public/js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="../../../public/user_public/js/functions.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<script
	src="https://www.paypal.com/sdk/js?client-id=AWoFVlh8jO7M4-ggsapz4_xnZqXyjiNLX7U9Vcwgasj75WdbQthHopHw84dOKauboKl6nu0sqI16PmYi"></script>
	<script>
	let selectedAddress = '';

	function updateAddress(address) {
	selectedAddress = address;
	document.getElementById("address-input").value = selectedAddress;
	}

</script> 
  <script>
	paypal.Buttons({
	  createOrder: function (data, actions) {
		var address = document.getElementById("address-input").value;
		var total_usd = document.getElementById('total_usd').value;
		return actions.order.create({
		  purchase_units: [{
			amount: {
			  value: total_usd
			}
		  }]
		});
	  },
	  onApprove: function (data, actions) {
		return actions.order.capture().then(function (details) {
		  window.location.href = "http://127.0.0.1:8080/php_ecommerce/app/process/camon.php?payment=paypal";
		});
	  },
	  onError: function (err) {
		window.location.replace = "http://127.0.0.1:8080/php_ecommerce/app/views/user_views/checkout.php";
	  }
	}).render('#paypal-button-container'); 
  </script>
</body>
</html>