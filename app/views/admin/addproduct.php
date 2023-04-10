<?php
session_start();
if (empty($_SESSION['user'])) {
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
                                <div>Products
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Create Product</h5>
                                    <form class="" action="../../process/add_product.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                <label for="exampleEmail"
                                                    class="">Product name</label>
                                                    <input name="product_name" id="exampleEmail"
                                                    placeholder="Enter product name..." type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                <label for="examplePassword"
                                                    class="">Product supplier</label>
                                                    <input name="product_supplier" id="examplePassword"
                                                    placeholder="Enter product supplier" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="exampleSelect"
                                                        class="">Category</label>
                                                        <select name="category_id" id="exampleSelect"
                                                        class="form-control">
                                                        <?php foreach($categories as $index => $category){?>
                                                        <option value="<?php echo $category['category_id']?>"><?php echo $category['category_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword"
                                                    class="">Product quantity</label>
                                                    <input name="product_quantity" id="examplePassword"
                                                    placeholder="Enter product quantity" type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword"
                                                    class="">Product import price</label>
                                                    <input name="product_import_price" id="examplePassword"
                                                    placeholder="Enter product import_price" type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword"
                                                    class="">Product price</label>
                                                    <input name="product_price" id="examplePassword"
                                                    placeholder="Enter product price" type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleFile"
                                                    class="">Image</label><input name="product_image_1" id="exampleFile" type="file"
                                                    class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleFile"
                                                    class="">Image</label><input name="product_image_2" id="exampleFile" type="file"
                                                    class="form-control-file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleFile"
                                                    class="">Image</label><input name="product_image_3" id="exampleFile" type="file"
                                                    class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleFile"
                                                    class="">Image</label><input name="product_image_4" id="exampleFile" type="file"
                                                    class="form-control-file">
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="exampleText" class="">Product description</label>
                                                <textarea name="product_description" id="exampleText"
                                                class="form-control"></textarea></div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleText" class="">Product specifications</label>
                                                <textarea name="product_specifications" id="exampleText"
                                                class="form-control"></textarea></div>
                                            </div>
                                            </div>
                                        </div>
                                        <button class="mt-1 btn btn-primary" name="product_add" type="submit">Submit</button>
                                    </form>
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
        <script src="../../../ckeditor/ckeditor.js"></script>
        
        <script>
             CKEDITOR.replace( 'product_description' );
        CKEDITOR.replace( 'product_specifications' );
    </script>
</body> 
</html>