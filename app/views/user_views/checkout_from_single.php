<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: ../../views/auth/index.php');
    exit;
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
                                <a href="../../views/user_views/profile.php#tab-replies"><i class="icon-line-heart me-1 position-relative" style="top: 1px;"></i></a>
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
                                <?php foreach ($categories as $category) { ?>
                                        <li class="menu-item current"><a class="menu-link"
                                                href="../../views/user_views/product.php?category_slug=<?php echo $category['category_slug'] ?>">
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
                                    <?php
                                        foreach ($products as $product) {
                                            if ($product['product_id'] == $_GET['product_id']) {
                                                ?>
                                        
                                                                            <tr class="cart_item">
                                                                                <td class="cart-product-thumbnail">
                                                                                    <a href="#"><img width="64" height="64"
                                                                                            src="../../../public/image/<?php echo $product['product_image_1'] ?>"
                                                                                            alt="Pink Printed Dress"></a>
                                                                                </td>

                                                                                <td class="cart-product-name">
                                                                                    <a href="#"><?php echo $product['product_name'] ?></a>
                                                                                </td>

                                                                                <td class="cart-product-quantity">
                                                                                    <div class="quantity clearfix">
                                                                                    1
                                                                                    </div>
                                                                                </td>

                                                                                <td class="cart-product-subtotal">
                                                                                   <?php echo number_format($product['product_price'], 0, '.', ',') . ' đ'; ?></span>
                                                                                </td>
                                                                            </tr>
                                                        <?php }
                                        }
                                     ?>
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
                                    <?php foreach ($products as $product) {
                                            if ($product['product_id'] == $_GET['product_id']) { ?>
                                                    <tr class="cart_item">
                                                        <td class="border-top-0 cart-product-name">
                                                            <strong>Cart Subtotal</strong>
                                                        </td>

                                                        <td class="border-top-0 cart-product-name">
                                                            <span class="amount">  <?php echo number_format($product['product_price'], 0, '.', ',') . ' đ'; ?></span></span>
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
                                                            <span class="amount color lead"><strong>  <?php echo number_format($product['product_price'], 0, '.', ',') . ' đ'; ?></span></strong></span>
                                                        </td>
                                                    </tr>
                                    <?php }} ?>
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

                                <?php if (!empty($_SESSION['user']))
                                foreach ($users as $user) {
                                    if ($_SESSION['user']['email'] == $user['email']) { ?>
                                            <input type="radio" onclick="updateAddress('<?php echo $user['address']; ?>')" id="addresscheckbox<?php echo $user['address']; ?>" name="address" value="<?php echo $user['address']; ?>"/><?php echo $user['address']; ?><br/>
                                <?php }} ?>
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