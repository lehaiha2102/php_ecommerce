<?php 
    require_once('../../app/classes/product.php');
    $sql = "SELECT * FROM products";
        $result = $connection->query($sql);

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
    // if(isset($_POST['update-product']) && isset($_POST['product_name']) && isset($_POST['product_price'])  && isset($_POST['product_quantity']) && isset($_FILES['product_image_1']) && isset($_FILES['product_image_2']) && isset($_FILES['product_image_3']) && isset($_POST['product_description']) && isset($_POST['category_id'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_import_price = $_POST['product_import_price'];
        $product_price = $_POST['product_price'];
        $product_promotion_price = 0;
        $product_quantity = $_POST['product_quantity'];
        $product_image_1 = $_FILES["product_image_1"]["name"] ? $_FILES["product_image_1"]["name"] : $_POST["existing_image_1"];
        $product_image_2 = $_FILES["product_image_2"]["name"] ? $_FILES["product_image_2"]["name"] : $_POST["existing_image_2"];
        $product_image_3 = $_FILES["product_image_3"]["name"] ? $_FILES["product_image_3"]["name"] : $_POST["existing_image_3"];

        $target_dir = "./public/images/";
        $target_file1 = $target_dir . basename($product_image_1);
    
        if (move_uploaded_file($_FILES["product_image_1"]["tmp_name"], $target_file1)) {
            // success
        } else {
            $product_image_error = "Error uploading image.";
        }
        $target_file2 = $target_dir . basename($product_image_2);
    
        if (move_uploaded_file($_FILES["product_image_2"]["tmp_name"], $target_file2)) {
            // success
        } else {
            $product_image_error = "Error uploading image.";
        }

        $target_file3 = $target_dir . basename($product_image_3);
    
        if (move_uploaded_file($_FILES["product_image_3"]["tmp_name"], $target_file3)) {
            // success
        } else {
            $product_image_error = "Error uploading image.";
        }
        $product_description = $_POST['product_description'];
        $category_id = $_POST['category_id'];
        $product = new Product();
        $result = $product->updateProduct($product_id, $product_name, $product_import_price, $product_price, $product_promotion_price, $product_quantity, $product_image_1, $product_image_2, $product_image_3, $product_description, $category_id);
        if($result == 'Upload success'){
            echo 'success';
            header('Location: ../views/admin/product.php');
            exit;
        }else{
            echo 'Update product failed';
        }
    // }
?>
