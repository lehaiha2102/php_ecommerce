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
require_once('../../process/showfavourite.php');
require_once('../../process/showorderwid.php');

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
                                <span><?php echo $user_profile['bio'] ?><i display: inline; class="icon-pencil-alt" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg10"></i></span>
                                
                                            <div class="modal fade bs-example-modal-lg10" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Change Bio</h4>
                                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../process/change_bio.php?user_id=<?php echo $user_profile['user_id'] ?>" method="post">
                                                                        <div class="form-process">
                                                                            <div class="css3-spinner">
                                                                                <div class="css3-spinner-scaler"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 form-group">
                                                                            <label>Bio:</label>
                                                                            <input type="text" name="bio" id="event-registration-bio" class="form-control required valid" value="" placeholder="Enter your bio">
                                                                        </div>
                                                                        <button class="btn btn-warning" type="submit">Change</button>
                                                            </form>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                            <div class="clear"></div>

                            <div class="row clearfix">

                                <div class="col-lg-12">

                                    <div class="tabs tabs-alt clearfix" id="tabs-profile">

                                        <ul class="tab-nav clearfix">
                                            <li><a href="#tab-feeds"><i class="icon-user-check"></i> Abouts</a></li>
                                            <li><a href="#tab-posts"><i class="icon-shopping-cart1"></i> Orders</a></li>
                                            <li><a href="#tab-replies"><i class="icon-heart"></i> Favourites</a></li>
                                            <!-- <li><a href="#tab-connections"><i class="icon-line-align-justify"></i> Activity log</a></li> -->
                                        </ul>

                                        <div class="tab-container">

                                            <div class="tab-content clearfix" id="tab-feeds">

                                            <p>Phone: <?php echo $user_profile['phone'] ?>

                                            <p>Email: <?php echo $user_profile['email'] ?>

                                            <p>Address: <?php echo !empty($user_profile['address']) ? $user_profile['address'] : 'Update Now'; ?> 
                                            <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg1"><i class="icon-pencil-alt"></i></button></p>
                                            <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Change address</h4>
                                                           
                                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../process/change_address.php?user_id=<?php echo $user_profile['user_id'] ?>" method="post">
                                                                        <div class="form-process">
                                                                            <div class="css3-spinner">
                                                                                <div class="css3-spinner-scaler"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 form-group">
                                                                            <label>Address:</label>
                                                                            <input type="text" name="address" id="event-registration-email" class="form-control required valid" value="" placeholder="Enter your address">
                                                                        </div>
                                                                        <button class="btn btn-warning" type="submit">Change</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <p>Date of birth: <?php echo !empty($user_profile['date_of_birth']) ? $user_profile['date_of_birth'] : 'Update Now' ?>
                                            <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg4"><i class="icon-pencil-alt"></i></button></p>
                                            <div class="modal fade bs-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg4">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Change Date of Birth</h4>
                                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="../../process/change_date_of_birth.php?user_id=<?php echo $user_profile['user_id'] ?>" method="post">
                                                                        <div class="form-process">
                                                                            <div class="css3-spinner">
                                                                                <div class="css3-spinner-scaler"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 form-group">
                                                                            <label>Date of Birth:</label>
                                                                            <input type="date" name="date_of_birth" id="datepicker" class="form-control input-datepicker text-start required valid" value="" placeholder="Select Pickup Date">
                                                                        </div>
                                                                        <button class="btn btn-warning" type="submit">Change</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Password: ********
                                            <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg3"><i class="icon-pencil-alt"></i></button></p>
                                            <div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Change password</h4>
                                                           
                                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../process/change_password.php?user_id=<?php echo $user_profile['user_id'] ?>" method="post">
                                                                        <div class="form-process">
                                                                            <div class="css3-spinner">
                                                                                <div class="css3-spinner-scaler"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 form-group">
                                                                            <label>Old password:</label>
                                                                            <input type="text" name="oldpas" id="event-registration-email" class="form-control required valid" value="" placeholder="Enter your password">
                                                                        </div>
                                                                        <div class="col-12 form-group">
                                                                            <label>New password:</label>
                                                                            <input type="text" name="password" id="event-registration-password" class="form-control required valid" value="" placeholder="Enter your password">
                                                                        </div>
                                                                        <div class="col-12 form-group">
                                                                            <label>Re-password:</label>
                                                                            <input type="text" name="repassword" id="event-registration-password" class="form-control required valid" value="" placeholder="Enter your password">
                                                                        </div>
                                                                        <button class="btn btn-warning" type="submit">Change</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
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
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    foreach($ordersid as $item){
                                                                        ?>
                                                                        <tr>
                                                                    <td>
                                                                        <code><?php echo $item['create_at'] ?></code>
                                                                    </td>
                                                                    <td><?php echo $item['order_id'] ?></td>

                                                                    <td><?php if($item['order_status'] == 1){
                                                                        echo 'Unconfimred';
                                                                    } else if($item['order_status'] == 2){
                                                                        echo 'Confirmed';
                                                                    }  else if($item['order_status'] == 3){
                                                                        echo 'Shipped';
                                                                    } else if($item['order_status'] == 4){
                                                                        echo 'Delivered';
                                                                    } else if($item['order_status'] == 5){
                                                                        echo 'Cancelled';
                                                                    }   ?></td>
                                                                    <td>
                                                                        <a href="../../views/user_views/order_detail.php?order_id=<?php echo $item['order_id'] ?>" class="btn btn-success"><i class="icon-info-circle"></i></a>
                                                                        <?php if($item['order_status'] == 1){?>
                                                                            <a href="../../process/cancel_order.php?order_id=<?php echo $item['order_id'] ?>" class="btn btn-danger"><i class="icon-line-circle-cross1"></i></a>
                                                                        <?php }?>
                                                                    </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content clearfix" id="tab-replies">
                                            <div class="row gutter-40 posts-md mt-4">

                                            <div class="entry col-12">
                                                <div class="grid-inner row align-items-center g-0">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                            <th></th>
                                                            <th>Product name</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                             foreach($products as $product){
                                                            foreach($favourites as $favourite){
                                                               
                                                                    if($favourite['product_id'] === $product['product_id']){
                                                                ?>
                                                            <tr>
                                                            <td class="text-center">
                                                                <a href="../../views/user_views/single_product.php?product_id=<?php echo $product['product_id'] ?>"><img width="225" height="125" src="../../../public/image/<?php echo $product['product_image_1'] ?>" alt=""></a>
                                                                
                                                                
                                                            </td>
                                                            <td>
                                                                <a href="../../views/user_views/single_product.php?product_id=<?php echo $product['product_id'] ?>"><?php echo $product['product_name'] ?></a>
                                                            </td>
                                                            <td><?php echo $product['product_price'] ?></td>
                                                            <td>
                                                            <a href="../../views/user_views/checkout_from_single.php?product_id=<?php echo $product['product_id'];?>" class="btn btn-success"><i class="icon-shopping-cart1"></i></a>
                                                                <a href="../../process/delete_favourite.php?product_id=<?php echo $product['product_id'] ?>" class="btn btn-warning"><i class="icon-trash-alt"></i></a>
                                                            </td>
                                                            </tr>
                                                            <?php }}} ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                              
                                            </div>
                                            <div class="tab-content clearfix" id="tab-connections">

                                            <div class="clear topmargin-sm"></div>
                                                <ol class="commentlist border-0 m-0 p-0 clearfix">
                                                    <li class="comment even thread-even depth-1" id="li-comment-1">
                                                        <div id="comment-1" class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                    <img alt='Image' src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' class='avatar avatar-60 photo avatar-default' height='60' width='60' /></span>
                                                                </div>
                                                            </div>
                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author">John Doe<span><a href="#" title="Permalink to this comment">April 24, 2012 at 10:46 am</a></span></div>
                                                                <p>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                                                                <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <ul class='children'>
                                                            <li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">
                                                                <div id="comment-3" class="comment-wrap clearfix">
                                                                    <div class="comment-meta">
                                                                        <div class="comment-author vcard">

                                                                            <span class="comment-avatar clearfix">
                                                                            <img alt='Image' src='https://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=40&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D40&amp;r=G' class='avatar avatar-40 photo' height='40' width='40' /></span>

                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-content clearfix">
                                                                        <div class="comment-author"><a href='#' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                                                                        <p>Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                                                                        <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">
                                                        <div class="comment-wrap clearfix">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <span class="comment-avatar clearfix">
                                                                    <img alt='Image' src='https://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G' class='avatar avatar-60 photo' height='60' width='60' /></span>
                                                                </div>
                                                            </div>
                                                            <div class="comment-content clearfix">
                                                                <div class="comment-author"><a href='https://themeforest.net/user/semicolonweb' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                                                                <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                                                                <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </li>

                                                </ol>

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