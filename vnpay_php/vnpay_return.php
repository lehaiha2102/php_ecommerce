<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="../vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="../vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php
    require_once("./config.php");
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label>
                    <?php echo $_GET['vnp_TxnRef'] ?>
                </label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label>
                    <?php echo $_GET['vnp_Amount'] ?>
                </label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label>
                    <?php echo $_GET['vnp_OrderInfo'] ?>
                </label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label>
                    <?php echo $_GET['vnp_TransactionNo'] ?>
                </label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label>
                    <?php echo $_GET['vnp_BankCode'] ?>
                </label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label>
                    <?php echo $_GET['vnp_PayDate'] ?>
                </label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {

                        if ($_GET['vnp_ResponseCode'] == '00') {
                            session_start();
                            require('../config/database.php');
                            $sql = "SELECT * FROM users";
                            $result = $connection->query($sql);

                            $users = array();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $users[] = $row;
                                }
                            }
                            foreach ($users as $index => $user) {
                                if (!empty($_SESSION['email'])) {
                                    if ($user['email'] == $_SESSION['email']) {
                                        $user_id = $user['user_id'];
                                        $payment_method_id = 3;
                                        $sql_order = 'INSERT INTO orders(user_id, payment_method_id) VALUES(?, ?)';
                                        $stmt_order = $connection->prepare($sql_order);
                                        $stmt_order->bind_param('ii', $user_id, $payment_method_id);
                                        if ($stmt_order->execute()) {
                                            $order_id = mysqli_insert_id($connection);
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
                                            }

                                        } else {
                                            echo "Error: " . $stmt_order->error;
                                        }
                                    }
                                }
                            }

                            echo "<span style='color:blue'>GD Thanh cong</span>";
                            header('Location: ../app/views/user_views/index.php');
                            $order_id = $_GET['vnp_TxnRef']; // assume vnp_TxnRef is the order ID
                            $sql = "UPDATE orders SET is_paid = TRUE WHERE order_id = $order_id";
                            exit();
                            // execute the SQL statement to update the 'is_paid' column of the order with ID = $order_id
                        } else {
                            echo "<span style='color:red'>GD Khong thanh cong</span>";
                        }
                    } else {
                        echo "<span style='color:red'>Chu ky khong hop le</span>";
                    }
                    ?>

                </label>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY
                <?php echo date('Y') ?>
            </p>
        </footer>
    </div>
</body>

</html>