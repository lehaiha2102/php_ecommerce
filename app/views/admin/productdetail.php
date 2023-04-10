<?php
session_start();
if (empty($_SESSION['user']['email'])) {

    header('Location: ../../views/auth/index.php');
    exit;
}
require_once('../../../config/database.php');
$sql = "SELECT * FROM categories";
$result = $connection->query($sql);
$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$product_slug = $_GET['product_slug'];
$sqlproduct = "SELECT * FROM products WHERE product_slug = '$product_slug'";
$productresult = $connection->query($sqlproduct);
$product = array();
if ($productresult->num_rows === 1) {
    while ($productrow = $productresult->fetch_assoc()) {
        $product = $productrow;
    }
}
?>

<!doctype html>
<html lang="en">

<?php require_once('../../../app/views/admin/components/head.php') ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once('../../../app/views/admin/components/pageHead.php') ?>
        <div class="app-main">
            <?php require_once('../../../app/views/admin/components/sidebar.php') ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Product Details
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header-tab-animation card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                        Product Info
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tabs-eg-77">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <table class="mb-0 table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price</th>
                                                                <th>
                                                                    Suplier
                                                                </th>
                                                                <th>Category</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $product['product_name'] ?>
                                                                </td>
                                                                <td>
                                                                    <span>Import price:
                                                                        <?php echo number_format($product['product_import_price']) . ' đ' ?>
                                                                    </span><br>
                                                                    <span>Price:
                                                                        <?php echo number_format($product['product_price']) . ' đ' ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <?php echo $product['product_supplier'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    foreach($categories as $category){
                                                                        if ($category['category_id'] == $product['category_id']) {
                                                                            echo $category['category_name'];
                                                                        } 
                                                                    }
                                                                   ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                        Product Image
                                    </div>

                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-eg-55">
                                        <div class="pt-2 card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <img src="../../../public/image/<?php echo $product['product_image_1'] ?>"
                                                                    alt="<?php echo $product['product_image_1'] ?>"
                                                                    width="100px" height="70px">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <img src="../../../public/image/<?php echo $product['product_image_2'] ?>"
                                                                    alt="<?php echo $product['product_image_2'] ?>"
                                                                    width="100px" height="70px">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <img src="../../../public/image/<?php echo $product['product_image_3'] ?>"
                                                                    alt="<?php echo $product['product_image_3'] ?>"
                                                                    width="100px" height="70px">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <img src="../../../public/image/<?php echo $product['product_image_4'] ?>"
                                                                    alt="<?php echo $product['product_image_4'] ?>"
                                                                    width="100px" height="70px">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Specifications
                                </div>
                                <div class="table-responsive">
                                    <?php
                                    $product_specifications = $product['product_specifications'];
                                    $segments = explode('*', $product_specifications);
                                    $segments = array_filter($segments, 'trim');
                                    foreach ($segments as $segment) {
                                        echo $segment . "<br>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Description
                                </div>
                                <div class="table-responsive">
                                    <?php

                                    echo $product['product_description']
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('../../../app/views/admin/components/footer.php') ?>
</body>

</html>