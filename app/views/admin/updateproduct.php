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
                                <div>Products
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Update Product</h5>
                                    <form class=""
                                        action="../../process/update_product.php?product_slug=<?php echo $product['product_slug']; ?>"
                                        method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="">Product name</label>
                                                    <input name="product_name" id="exampleEmail"
                                                        placeholder="Enter product name..." type="text"
                                                        value="<?php echo $product['product_name']; ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword" class="">Product supplier</label>
                                                    <input name="product_supplier" id="examplePassword"
                                                        placeholder="Enter product supplier"
                                                        value="<?php echo $product['product_supplier']; ?>" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="exampleSelect" class="">Category</label>
                                                    <select name="category_id" id="exampleSelect"
                                                        value="<?php echo $product['category_id'] ?>"
                                                        class="form-control">
                                                        <?php foreach ($categories as $index => $category) { ?>
                                                            <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword" class="">Product quantity</label>
                                                    <input name="product_quantity" id="examplePassword"
                                                        placeholder="Enter product quantity"
                                                        value="<?php echo $product['product_quantity']; ?>"
                                                        type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword" class="">Product import price</label>
                                                    <input name="product_import_price" id="examplePassword"
                                                        placeholder="Enter product import_price"
                                                        value="<?php echo $product['product_import_price']; ?>"
                                                        type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword" class="">Product price</label>
                                                    <input name="product_price" id="examplePassword"
                                                        placeholder="Enter product price"
                                                        value="<?php echo $product['product_price']; ?>" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                                    <div class="row">
                                                        <input type="hidden" name="existing_image_1"
                                                    value="<?php echo $product['product_image_1'] ?>">
                                                <input type="hidden" name="existing_image_2"
                                                    value="<?php echo $product['product_image_2'] ?>">
                                                <input type="hidden" name="existing_image_3"
                                                    value="<?php echo $product['product_image_3'] ?>">
                                                <input type="hidden" name="existing_image_4"
                                                    value="<?php echo $product['product_image_4'] ?>">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="product_image_1" class="">Image</label>
                                                    <input name="product_image_1" id="product_image_1" type="file" class="form-control-file">
                                                    <img id="preview_1" src="../../../public/image/<?php echo $product['product_image_1']?>" alt="Preview" style=" max-width:100%; height:auto;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="product_image_2" class="">Image</label>
                                                    <input name="product_image_2" id="product_image_2" type="file" class="form-control-file">
                                                    <img id="preview_2" src="../../../public/image/<?php echo $product['product_image_2']?>" alt="Preview" style=" max-width:100%; height:auto;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="product_image_3" class="">Image</label>
                                                    <input name="product_image_3" id="product_image_3" type="file" class="form-control-file">
                                                    <img id="preview_3" src="../../../public/image/<?php echo $product['product_image_3']?>" alt="Preview" style=" max-width:100%; height:auto;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="product_image_4" class="">Image</label>
                                                    <input name="product_image_4" id="product_image_4" type="file" class="form-control-file">
                                                    <img id="preview_4" src="../../../public/image/<?php echo $product['product_image_4']?>" alt="Preview" style=" max-width:100%; height:auto;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="exampleText"
                                                        class="">Product description</label>
                                                    <textarea name="product_description" id="exampleText"
                                                        class="form-control" cols="60"
                                                        rows="5"><?php echo $product['product_description'] ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="position-relative form-group"><label for="exampleText"
                                                        class="">Product specifications</label>
                                                    <textarea name="product_specifications" id="exampleText"
                                                        class="form-control" cols="60"
                                                        rows="5"><?php echo $product['product_specifications'] ?></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <button class="mt-1 btn btn-primary" name="product_add"
                                            type="submit">Submit</button>
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
            CKEDITOR.replace('product_description');
            CKEDITOR.replace('product_specifications');
        </script>
         <script>
    // lấy các input file
    const input_1 = document.getElementById("product_image_1");
    const input_2 = document.getElementById("product_image_2");
    const input_3 = document.getElementById("product_image_3");
	const input_4 = document.getElementById("product_image_4");
    
    // lấy các thẻ img
    const preview_1 = document.getElementById("preview_1");
    const preview_2 = document.getElementById("preview_2");
    const preview_3 = document.getElementById("preview_3");
	const preview_4 = document.getElementById("preview_4");
    // khi một hình ảnh được chọn, hiển thị nó lên thẻ img tương ứng
    input_1.addEventListener("change", function() {
        const reader = new FileReader();
        reader.onload = function() {
            preview_1.src = reader.result;
            preview_1.style.display = "block";
        };
        reader.readAsDataURL(input_1.files[0]);
    });

    input_2.addEventListener("change", function() {
        const reader = new FileReader();
        reader.onload = function() {
            preview_2.src = reader.result;
            preview_2.style.display = "block";
        };
        reader.readAsDataURL(input_2.files[0]);
    });
    
    input_3.addEventListener("change", function() {
        const reader = new FileReader();
        reader.onload = function() {
            preview_3.src = reader.result;
            preview_3.style.display = "block";
        };
        reader.readAsDataURL(input_3.files[0]);
    });
	input_4.addEventListener("change", function() {
        const reader = new FileReader();
        reader.onload = function() {
            preview_4.src = reader.result;
            preview_4.style.display = "block";
        };
        reader.readAsDataURL(input_4.files[0]);
    });
</script>
</body>

</html>