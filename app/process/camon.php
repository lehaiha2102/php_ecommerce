<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_ecommerce';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die('Connect error' . $connection->connect_error);
}

$sql = "SELECT * FROM users";
$result = $connection->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$order_id = time() ."";
$_SESSION['order_id'] = $order_id;
$order_id = $_SESSION['order_id'];

if (isset($_GET['payment']) == 'paypal') {
    $phone = $_GET['phone'];
    foreach ($users as $index => $user) {
        if (!empty($_SESSION['user']['email'])) {
            if ($user['email'] == $_SESSION['user']['email']) {
                $user_id = $user['user_id'];
                $payment_method_id = 2;
                $payment_status = 2;
                $ship_address = $user['address'];
                $sql_order = 'INSERT INTO orders(order_id, user_id, payment_method_id, payment_status, ship_address, recipient_phone) VALUES(?,?,?, ?, ?, ?)';
                $stmt_order = $connection->prepare($sql_order);
                $stmt_order->bind_param('iiiiss',$order_id, $user_id, $payment_method_id, $payment_status, $ship_address, $phone);
                if ($stmt_order->execute()) {
                    $sql_order_detail = 'INSERT INTO order_detail(order_id, product_id, product_price, product_quantity) VALUES (?, ?, ?, ?)';
                    $stmt_order_detail = $connection->prepare($sql_order_detail);
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $cart_item) {
                            $product_id = $cart_item['id'];
                            $price = $cart_item['price'];
                            $quantity = $cart_item['quantity'];
                            $stmt_order_detail->bind_param('iiii', $order_id, $product_id, $price, $quantity);
                            $stmt_order_detail->execute();
                        }
                        unset($_SESSION["cart"]);
                        unset($_SESSION['address']);
                    }
                   header('Location: ../views/user_views/index.php?message="Success!!!"');
                   exit;
                } else {
                    echo "Error from paypal payment: " . $stmt_order->error;
                }
            }
        }
    }
} else {
    if (isset($_GET['partnerCode'])) {
        $code_cart = rand(0, 9999);
        $partnerCode = $_GET['partnerCode'];
        $orderId = $_GET['orderId'];
        $requestId = $_GET['requestId'];
        $amount = $_GET['amount'];
        $orderInfo = $_GET['orderInfo'];
        $orderType = $_GET['orderType'];
        $transId = $_GET['transId'];
        $payType = $_GET['payType'];

        $insert_momo = "INSERT INTO momo_payment(partner_code, order_id, amount, order_info, order_type, trans_id, pay_type, code_cart) 
        VALUES('$partnerCode','$orderId', '$amount', '$orderInfo', '$orderType', '$transId', '$payType', '$code_cart')";
        $query_momo = mysqli_query($connection, $insert_momo);

        if ($query_momo) {
            foreach ($users as $index => $user) {
                if (!empty($_SESSION['user']['email'])) {
                    if ($user['email'] == $_SESSION['user']['email']) {
                        $user_id = $user['user_id'];
                        $payment_method_id = 4;
                        $payment_status = 2;
                        $ship_address = $user['address'];
                        $sql_order = 'INSERT INTO orders(order_id, user_id, payment_method_id, payment_status, ship_address) VALUES(?, ?, ?, ?, ?)';
                        $stmt_order = $connection->prepare($sql_order);
                        $stmt_order->bind_param('iiiis', $orderId, $user_id, $payment_method_id, $payment_status, $orderInfo);
                        if ($stmt_order->execute()) {
                            $sql_order_detail = 'INSERT INTO order_detail(order_id, product_id, product_price, product_quantity) VALUES (?, ?, ?, ?)';
                            $stmt_order_detail = $connection->prepare($sql_order_detail);
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $cart_item) {
                                    $product_id = $cart_item['id'];
                                    $price = $cart_item['price'];
                                    $quantity = $cart_item['quantity'];
                                    $stmt_order_detail->bind_param('iiii', $orderId, $product_id, $price, $quantity);
                                    $stmt_order_detail->execute();
                                }
                                unset($_SESSION["cart"]);
                                unset($_SESSION['address']);
                            }
                            header('Location: ../views/user_views/index.php?message="Success!!!"');
                            exit;
                        } else {
                            echo "Error: " . $stmt_order->error;
                        }
                    }
                }
            }


        } else {
            echo '<h3>Payment failed!!!</h3>';
        }

    }
}


?>