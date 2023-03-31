<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="../vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="../vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php require_once("./config.php"); ?>
    <div class="container">
        <h3>Thanh toán </h3>
        <div class="table-responsive">
            <form action="../vnpay_php/vnpay_create_payment.php" id="frmCreateOrder" method="post">
                <div class="form-group">
                    <label for="amount">Số tiền</label>
                    <?php
                    if(!empty($_SESSION['cart'])){
                    $total_price = 0;

                    foreach ($_SESSION['cart'] as $product) {
                        if (isset($product['price']) && isset($product['quantity'])) {
                            $total = $product['price'] * $product['quantity'];
                            $total_price += $total;
                        }
                    }
                }
                    ?>
                    <input type="hidden" class="form-control" data-val="true" data-val-number="The field Amount must be a number."
                        data-val-required="The Amount field is required." id="amount" name="amount" type="number"
                        value="<?php echo  $total_price; ?>" disabled/>
                        <span> <?php echo number_format($total_price).'đ' ; ?> </span>

                </div>
                <!-- <h4>Chọn phương thức thanh toán</h4>
                <div class="form-group">
                    <h5>Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h5>
                    <input type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                    <label for="bankCode">Cổng thanh toán VNPAYQR</label><br>

                    <h5>Cách 2: Tách phương thức tại site của đơn vị kết nối</h5>
                    <input type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
                    <label for="bankCode">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label><br>

                    <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
                    <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>

                    <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
                    <label for="bankCode">Thanh toán qua thẻ quốc tế</label><br>

                </div> -->
                <div class="form-group">
                    <h5>Chọn ngôn ngữ giao diện thanh toán:</h5>
                    <input type="radio" id="language" Checked="True" name="language" value="vn">
                    <label for="language">Tiếng việt</label><br>
                    <input type="radio" id="language" name="language" value="en">
                    <label for="language">Tiếng anh</label><br>

                </div>
                <button type="submit" class="btn btn-default" href>Thanh toán</button>
            </form>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY 2020</p>
        </footer>
    </div>
</body>

</html>