<?php 
    require_once('../../app/classes/product.php');

    if(isset($_POST['product_delete'])){
        $product_id = $_POST['product_id'];
        $product = new Product();
        $result = $product->deleteProduct($product_id);
        if($result == 'Delete product success'){
            header('Location: ../views/admin/product.php');
            exit;
        }else{
            echo 'Delete failed';  
        }
    }
?>