<?php 
    require_once('../../config/database.php');
    session_start();

    if (isset($_POST['submit'])) {
   
        $user_id = htmlspecialchars($_POST['user_id']);
        $payment_method_id = $_POST['payment_method_id'];
        if($payment_method_id == 3){
            header('Location: ../../vnpay_php/vnpay_pay.php');
        } else if($payment_method_id == 1 || $payment_method_id == 2){
            $sql_order = 'INSERT INTO orders(user_id, payment_method_id) VALUES(?, ?)';
            $stmt_order = $connection->prepare($sql_order);
            $stmt_order->bind_param('ii', $user_id, $payment_method_id);
            if ($stmt_order->execute()) {
                $order_id = mysqli_insert_id($connection);
                $sql_order_detail = 'INSERT INTO order_detail(order_id, product_id, product_price, product_quantity) VALUES (?, ?, ?, ?)';
                $stmt_order_detail = $connection->prepare($sql_order_detail);;
                foreach ($_SESSION['cart'] as $cart_item) {
                    $product_id = $cart_item['id'];
                    $price = $cart_item['price'];
                    $quantity = $cart_item['quantity'];
                    $stmt_order_detail->bind_param('iiii', $order_id, $product_id, $price, $quantity);
                    $stmt_order_detail->execute();
                }
                unset ($_SESSION["cart"]);
                header('Location: ../views/user_views/index.php');
                exit;
            } else {
                echo "Error: " . $stmt_order->error;
            }
        } 
    }
?>