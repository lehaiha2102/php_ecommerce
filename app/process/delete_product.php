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
            echo '<script>
            alert("It\'s possible that your product is in an order, so you can\'t delete it now. If you want to remove this product, please delete the invoices that contain this product");
            window.location.replace("../views/admin/product.php");
            </script>';
        }
    }
?>