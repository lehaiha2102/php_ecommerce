<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
    session_start();
    if (empty($_SESSION['user'])) {
        header('Location: ../../views/auth/index.php');
        exit;
    }

    require_once('../../process/show_category.php');
    require_once('../../process/show_product.php');

    $sql = "SELECT * FROM users";
    $result = $connection->query($sql);
    $user_profile = array();
    $email = $_SESSION['user']['email'];

    $sql = "SELECT * FROM users WHERE email = '$email'";

    if ($result->num_rows > 0) {
        if ($user = $result->fetch_assoc()) {
            $user_profile = $user;
        }
    }


    $user_id = $user_profile['user_id'];
    $sql2 = "SELECT * FROM orders WHERE user_id = '$user_id'";
    $result2 = $connection->query($sql2);
    if ($result2->num_rows > 0) {
        if ($order = $result2->fetch_assoc()) {
            $orders = $order;
        }
    }
?>
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="SemiColonWeb" />

<!-- Stylesheets
============================================= -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../../public/user_public/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../../../public/user_public/style.css" type="text/css" />
<link rel="stylesheet" href="../../../public/user_public/css/dark.css" type="text/css" />
<link rel="stylesheet" href="../../../public/user_public/css/font-icons.css" type="text/css" />
<link rel="stylesheet" href="../../../public/user_public/css/animate.css" type="text/css" />
<link rel="stylesheet" href="../../../public/user_public/css/magnific-popup.css" type="text/css" />

<link rel="stylesheet" href="../../../public/user_public/css/custom.css" type="text/css" />

<!-- Document Title
============================================= -->
<title>Profile | Canvas</title>

</head>
<body class="stretched">

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
                                    <a class="dropdown-toggle ms-2 d-none d-sm-inline-block" href="#"
                                        role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="icon-line2-user me-1 position-relative" style="top: 1px;"></i>
                                <span class="d-none d-sm-inline-block font-primary fw-medium">
                                    <?php echo $_SESSION['user']['name'] ?>
                                </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="../../views/user_views/profile.php">Profile</a>
                                        </li>
                                        <li><div class="dropdown-divider"></div></li>
                                        <li><a class="dropdown-item" href="../../process/logout.php">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- #top-search end -->

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
                                <?php foreach ($categories as $category) { ?>
                                                <li class="menu-item current"><a class="menu-link"
                                                        href="../../views/user_views/product.php?category_id=<?php echo $category['category_id'] ?>">
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

        <!-- Content
        ============================================= -->
        <section id="content">
            <div class="content-wrap">
                <div class="container clearfix">

                    <div class="row clearfix">
                        <div class="col-md-12">

                            <img src="../../../public/image/avata.jpg" class="alignleft img-circle img-thumbnail my-0" alt="Avatar" style="max-width: 84px;">

                            <div class="heading-block border-0">
                                <h3><?php echo $user_profile['fullname'] ?></h3>
                                <span><?php echo $user_profile['bio'] ?></span>
                            </div>

                            <div class="clear"></div>

                            <div class="row clearfix">

                                <div class="col-lg-12">

                                    <div class="tabs tabs-alt clearfix" id="tabs-profile">

                                        <ul class="tab-nav clearfix">
    
                                            <li><a href="#tab-posts"><i class="icon-shopping-cart1"></i> Order detail</a></li>
                                        
                                        </ul>

                                        
                                            <div class="tab-content clearfix" id="tab-posts">

                                                <!-- Posts
                                                ============================================= -->
                                                <div class="row gutter-40 posts-md mt-4">

                                                    <div class="entry col-12">
                                                        <div class="grid-inner row align-items-center g-0">
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                    <th>Time</th>
                                                                    <th>Order ID</th>
                                                                    <th>Payment</th>
                                                                    <th>Shipping address</th>
                                                                    <th>Product</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                    <td>
                                                                        <code><?php echo $orders['create_at'] ?></code>
                                                                    </td>
                                                                    <td><?php echo $orders['order_id'] ?></td>

                                                                    <td><?php if($orders['payment_method_id'] == 1){
                                                                        echo 'Pay on delivery';
                                                                    } else if($orders['payment_method_id'] == 2){
                                                                        echo 'Paypal';
                                                                    }  else if($orders['payment_method_id'] == 3){
                                                                        echo 'VnPay';
                                                                    } ?></td>
                                                                    <td><?php echo $orders['ship_address'] ?></td>
                                                                    <td>
                                                                        <?php
                                                                        
                                                                        $order_id = $orders['order_id'];
                                                                        $sql3 = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
                                                                        $result3 = $connection->query($sql3);
                                                                        if ($result3->num_rows > 0) {
                                                                            if ($detail = $result3->fetch_assoc()) {
                                                                                $details = $detail;
                                                                            }
                                                                        }

                                                                        foreach($products as $product){
                                                                            if($product['product_id'] == $details['product_id']){
                                                                                echo $product['product_name'];
                                                                            }
                                                                        } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $details['product_quantity']?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $details['product_price']?>
                                                                    </td>
                                                                    <td>
                                                                        <?php $total = 0;
                                                                        if(!empty($details['product_quantity']) && !empty($details['product_price'])){
                                                                            $total = $details['product_quantity'] * $details['product_price'];
                                                                            echo $total;
                                                                        }else{
                                                                            echo $total = 0;
                                                                        }?>
                                                                    </td>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="w-100 line d-block d-md-none"></div>

                    </div>

                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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

    <script src="../../../public/user_public/js/jquery.js"></script>
    <script src="../../../public/user_public/js/plugins.min.js"></script>

    <!-- Footer Scripts
    ============================================= -->
    <script src="../../../public/user_public/js/functions.js"></script>
    <script src="../../../public/user_public/js/components/datepicker.js"></script>

    <!-- <script>
        jQuery( "#tabs-profile" ).on( "tabsactivate", function( event, ui ) {
            jQuery( '.flexslider .slide' ).resize();
        });
    </script> -->

</body>
</html>