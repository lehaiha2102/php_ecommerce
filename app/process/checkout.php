<?php
require_once('../../config/database.php');
session_start();

    if (isset($_POST['payment_method'])) {
        $payment_method = $_POST['payment_method'];
    }
    $ship_address = $_GET['address'];
    $_SESSION['address'] = $ship_address;

    if ($payment_method == 3) {
        header('Location: ../../vnpay_php/vnpay_pay.php');
    } else if (isset($_POST['Payondelivery'])) {
    $user_id = $_SESSION['user']['id'];
    $payment_method_id = 1;
    $ship_address = htmlspecialchars($_POST['address']);
    $phone = $_POST['phone'];
    $_SESSION['address'] = $ship_address;
    $order_id = time() ."";
    $_SESSION['order_id'] = $order_id;
    $order_id = $_SESSION['order_id'];
    if (!empty($user_id) && !empty($payment_method_id) && !empty(($ship_address))) {
        
       if ($payment_method_id == 1) {
            $sql_order = 'INSERT INTO orders(order_id, user_id, payment_method_id, ship_address, recipient_phone) VALUES(?, ?, ?, ?, ?)';
            $stmt_order = $connection->prepare($sql_order);
            $stmt_order->bind_param('iiisi', $order_id, $user_id, $payment_method_id, $ship_address, $phone);
            if ($stmt_order->execute()) {
                $sql_order_detail = 'INSERT INTO order_detail(order_id, product_id, product_price, product_quantity) VALUES (?, ?, ?, ?)';
                $stmt_order_detail = $connection->prepare($sql_order_detail);
                foreach ($_SESSION['cart'] as $cart_item) {
                    $product_id = $cart_item['id'];
                    $price = $cart_item['price'];
                    $quantity = $cart_item['quantity'];
                    $stmt_order_detail->bind_param('iiii', $order_id, $product_id, $price, $quantity);
                    $stmt_order_detail->execute();
                }
                unset($_SESSION["cart"]);
                unset($_SESSION['order_id']);
                unset($_SESSION['address']);
                header('Location: ../views/user_views/index.php?message="Success!!!"');
                exit;
            } else {
                echo "Error: " . $stmt_order->error;
            }
            
        }
    } else {
        echo '<script>
            alert("You need to enter all information to proceed with the order.");
            window.location.replace("../views/user_views/checkout.php");
            </script>';
    }
}
?>