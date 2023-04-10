<?php 
    session_start();
    require_once('../../app/classes/product.php');

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $user_id = $_SESSION['user']['id'];
        $sql_delete_product = 'DELETE FROM favourite_product WHERE product_id = ? AND user_id = ?';
        $stmt_delete_product = $connection->prepare($sql_delete_product);
        $stmt_delete_product->bind_param('ii', $product_id, $user_id);
        if($stmt_delete_product->execute()){
            header('Location: ../views/user_views/profile.php#tab-replies');
            exit;
        } else{
            echo '<script>
            alert("There was an error during the process of removing the product from the list, please try again later!");
            window.location.replace("../views/user_views/profile.php#tab-replies");
            </script>';
        }
    }
?>