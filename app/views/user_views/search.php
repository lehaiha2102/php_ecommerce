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
require_once('../../views/user_views/components/head.php');

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_ecommerce';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die('Connect error' . $connection->connect_error);
}

$keyword = trim(strtolower($_GET['keyword']));

$sql = "SELECT products.*, categories.category_name as category_name
    FROM products
    INNER JOIN categories ON products.category_id = categories.category_id
    WHERE (LOWER(products.product_name) LIKE CONCAT('%', ?, '%')
                                        OR LOWER(products.product_description) LIKE CONCAT('%', ?, '%') 
                                        OR LOWER(categories.category_name) LIKE CONCAT('%', ?, '%'))";

$stmt = $connection->prepare($sql);
if (!$stmt) {
    die('Câu truy vấn không hợp lệ.');
}
$stmt->bind_param('sss', $keyword, $keyword, $keyword);
$stmt->execute();

$result = $stmt->get_result();
$productsearch = array();
while ($row = $result->fetch_assoc()) {
    $productsearch[] = $row;
}


mysqli_stmt_close($stmt);
mysqli_close($connection);

?>


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
                                <?php
                                if (!empty($_SESSION['email'])) { ?>
                                    <i class="icon-line2-user me-1 position-relative" style="top: 1px;"></i><span
                                        class="d-none d-sm-inline-block font-primary fw-medium">
                                        <?php echo $_SESSION['email'] ?>
                                    </span>
                                <?php } else { ?>
                                    <a href="../../views/auth/index.php"><i class="icon-line2-user me-1 position-relative"
                                            style="top: 1px;"></i><span
                                            class="d-none d-sm-inline-block font-primary fw-medium">Login</span></a>
                                <?php } ?>
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
                                        }
                                    } else {
                                        $total_quantity = 0;
                                    } ?>
                                    <span class="top-cart-number">
                                        <?php echo $total_quantity; ?>
                                    </span>
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
                                        } ?>
                                    </div>
                                    <div class="top-cart-action">
                                        <?php if (!empty($_SESSION['cart'])) {
                                            $total_price = 0;
                                            foreach ($_SESSION['cart'] as $index => $cart_item) {
                                                $total_price += $cart_item['quantity'] * $cart_item['price'];
                                            }
                                        } else {
                                            $total_price = 0;
                                        } ?>
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
                                    <li class="menu-item current"><a class="menu-link" href="#">
                                            <div>
                                                <?php echo $category['category_name'] ?>
                                            </div>
                                        </a></li>
                                <?php } ?>
                            </ul>

                        </nav><!-- #primary-menu end -->

                        <form class="top-search-form" action="../../process/search.php" method="get">
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
        <section id="content">
            <div class="content-wrap">
                <div class="container clearfix">
                    <!-- New Arrivals Men
                ============================================= -->
                    <div class="container clearfix">

                        <div class="fancy-title title-border topmargin-sm mb-4 title-center">
                            <h4>
                                KẾT QUẢ TÌM KIẾM CHO TỪ KHÓA:
                                <?php echo $keyword ?>
                            </h4>
                        </div>
                        <div class="row grid-6">
                            <?php
                            foreach ($productsearch as $product) {
                                ?>
                                <div class="col-lg-2 col-md-3 col-6 px-2">
                                    <div class="product">
                                        <div class="product-image">
                                            <a href="#"><img
                                                    src="../../../public/image/<?php echo $product['product_image_1'] ?>"
                                                    alt="Image 1"></a>
                                            <a href="#"><img
                                                    src="../../../public/image/<?php echo $product['product_image_2'] ?>"
                                                    alt="Image 1"></a>
                                            <?php if (!empty($product['product_promotion_price'])) { ?>
                                                <div class="sale-flash badge bg-danger p-2">Sale!</div>
                                            <?php } ?>
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content align-items-end justify-content-between"
                                                    data-hover-animate="fadeIn" data-hover-speed="400">
                                                    <a onclick="AddCart(<?php echo $product['product_id']; ?>)"
                                                        href="javascript:" class="btn btn-dark me-2"><i
                                                            class="icon-shopping-basket"></i></a>
                                                </div>
                                                <div class="bg-overlay-bg bg-transparent"></div>
                                            </div>
                                        </div>
                                        <div class="product-desc">
                                            <div class="product-title mb-1">
                                                <h3><a href="#">
                                                        <?php echo $product['product_name'] ?>
                                                    </a></h3>
                                            </div>
                                            <?php if (!empty($product['product_promotion_price'])) { ?>
                                                <div class="product-price font-primary">
                                                    <del class="me-1">

                                                        $
                                                        <?php echo number_format($product['product_price'], 0, '.', ','); ?>
                                                    </del>
                                                    <ins>
                                                        $
                                                        <?php echo number_format($product['product_promotion_price'], 0, '.', ','); ?>
                                                    </ins>
                                                </div>
                                            <?php } else { ?>
                                                <div class="product-price font-primary">

                                                    <ins>
                                                        $
                                                        <?php echo number_format($product['product_price'], 0, '.', ','); ?>
                                                    </ins>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } ?>
                        </div>

                    </div>
                </div>
        </section><!-- #content end -->

        <!-- Footer
        ============================================= -->
        <?php require_once('../../views/user_views/components/pageFooter.php'); ?>
    </div><!-- #wrapper end -->
</body>

</html>