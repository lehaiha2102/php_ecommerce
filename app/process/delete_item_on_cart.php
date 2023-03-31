<?php
require_once('../classes/cart.php');
if(isset($_GET['id'])){
    global $connection;
    $product_id = htmlspecialchars($_GET['id']);
    $cart = new Cart();
    $cart->deleteCart($product_id);
    header('Location: ../views/user_views/cart.php');
    exit;

}


?>