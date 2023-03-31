<?php

require_once('../classes/cart.php');
$sql = "SELECT * FROM products";
$result = $connection->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
if (isset($_GET['id']) && isset($_GET['quantity'])) {
    $product_id = htmlspecialchars($_GET['id']);
    $quantity = htmlspecialchars($_GET['quantity']);
    if (filter_var($quantity, FILTER_VALIDATE_INT)) {
        if( $quantity > 0 && $quantity <= 20){
            $cart = new Cart();
                $cart->updateCart($product_id, $quantity);
                $total_price = 0;
                foreach ($_SESSION['cart'] as $index => $cart) {
                    $product_total_price = $cart['price'] * $quantity;
                    $total_price += $product_total_price;
                }
                $_SESSION['product_total_price'] = $product_total_price;
                $_SESSION['total_price'] = $total_price;
                header('Location: ../views/user_views/cart_ajax.php');
        } else{
            echo '<script>
            alert("The minimum number of products is 1 product and the maximum is 20 products");
            window.location.replace("../../views/user_views/cart.php");
            </script>';
        }
                
    } else{
        echo '<script>
        alert("Quantity is not a number");
        window.location.replace("../../views/user_views/cart.php");
        </script>';
    }
}
?>