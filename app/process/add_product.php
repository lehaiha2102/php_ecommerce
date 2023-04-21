<?php 
    require_once('../../app/classes/product.php');
    require_once('../../app/helpers/helpers.php');

        if(isset($_POST['product_add']) && !empty($_POST['product_name'])&& !empty($_POST['product_supplier']) && !empty($_POST['product_import_price']) && !empty($_POST['product_price']) && !empty($_POST['product_quantity'] ) && !empty($_POST['product_description'] )  && !empty($_POST['product_specifications'] ) && !empty($_FILES['product_image_1'])  && !empty($_FILES['product_image_2'])  && !empty($_FILES['product_image_3'])  && !empty($_FILES['product_image_4'])){
        $product_name = $_POST['product_name'];
        $product_slug = create_slug($product_name);

        $product_supplier = $_POST['product_supplier'];
        $product_import_price = $_POST['product_import_price'];
        $product_price = $_POST['product_price'];
        $product_promotion_price = 0;
        $product_quantity = $_POST['product_quantity'];
        $product_image_1 = $_FILES["product_image_1"]["name"];
        $product_image_2 = $_FILES["product_image_2"]["name"];
        $product_image_3 = $_FILES["product_image_3"]["name"];
        $product_image_4 = $_FILES["product_image_4"]["name"];
        $target_dir = "../../public/image/";
        $target_file1 = $target_dir . basename($product_image_1);
    
        if (move_uploaded_file($_FILES["product_image_1"]["tmp_name"], $target_file1)) {
        } else {
            $product_image_error = "Error uploading image.";
        }
        $target_file2 = $target_dir . basename($product_image_2);
    
        if (move_uploaded_file($_FILES["product_image_2"]["tmp_name"], $target_file2)) {
        } else {
            $product_image_error = "Error uploading image.";
        }

        $target_file3 = $target_dir . basename($product_image_3);
    
        if (move_uploaded_file($_FILES["product_image_3"]["tmp_name"], $target_file3)) {
        } else {
            $product_image_error = "Error uploading image.";
        }

        $target_file4 = $target_dir . basename($product_image_4);
    
        if (move_uploaded_file($_FILES["product_image_4"]["tmp_name"], $target_file4)) {
        } else {
            $product_image_error = "Error uploading image.";
        }
        $product_description = $_POST['product_description'];
        $product_specifications = $_POST['product_specifications'];
        $category_id = $_POST['category_id'];
        $product = new Product();
        $result = $product->addProduct( $product_name, $product_supplier, $product_import_price, $product_price, $product_promotion_price, $product_quantity, $product_image_1, $product_image_2, $product_image_3, $product_image_4, $product_description, $product_specifications, $category_id, $product_slug ) ;
        if($result == 'add product success'){
            header('Location: ../views/admin/product.php');
            exit;
        }
    }else{
        header('Location: ../views/admin/addproduct.php?message=failed');
            exit;
    }
?>