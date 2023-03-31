<?php 
session_start();
if(empty($_SESSION['user'])){
	header('Location: ../../views/auth/index.php');
	exit;
}
?>
<!doctype html>
<html lang="en">

<?php require_once('../../../app/views/admin/components/head.php') ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once('../../../app/views/admin/components/pageHead.php') ?>
        <div class="app-main">
            <?php require_once('../../../app/views/admin/components/sidebar.php') ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Orders
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                            <div class="card-body">
                                <h5 class="card-title">Orders list</h5>
                                <table class="mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Total price</th>
                                            <th>Payment method</th>
                                            <th>Status</th>
                                            <th>Time</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require('../../process/show_order.php');
                                        require('../../process/show_order_detail.php');
                                        require('../../process/show_user.php');
                                        require('../../process/show_payment_method.php');
                                        foreach ($orders as $index => $order) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo ++$index; ?>
                                                </th>
                                                <?php foreach ($users as $user) {
                                                    if ($user['user_id'] == $order['user_id']) {
                                                        ?>
                                                        <td>
                                                            <?php echo $user['fullname']; ?>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                <?php } ?>
                                                <td>
                                                    <?php $total_price = 0;
                                                    foreach ($order_detail as $detail) {
                                                        if ($order['order_id'] == $detail['order_id']) {
                                                            $total_price += $detail['product_quantity'] * $detail['product_price'];
                                                        }
                                                    }
                                                    ?>
                                                    <?php echo $total_price; ?>
                                                </td>
                                                <?php foreach ($payment_methods as $method) {
                                                    if ($method['method_id'] == $order['payment_method_id']) {
                                                        ?>
                                                        <td>
                                                            <?php echo $method['payment_method']; ?>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                <?php } ?>
                                                <td>
                                                    <div class="position-relative form-group">
                                                        <select id="<?php echo $order['order_id']; ?>"
                                                            name="<?php echo $order['order_status']; ?>"
                                                            class="form-control order-status">

                                                            <option value="1" <?php if ($order['order_status'] == '1') {
                                                                echo 'selected';
                                                            } ?>>Unconfimred</option>
                                                            <option value="2" <?php if ($order['order_status'] == '2') {
                                                                echo 'selected';
                                                            } ?>>Confirmed</option>
                                                            <option value="3" <?php if ($order['order_status'] == '3') {
                                                                echo 'selected';
                                                            } ?>>Shipped</option>
                                                            <option value="4" <?php if ($order['order_status'] == '4') {
                                                                echo 'selected';
                                                            } ?>>Delivered</option>
                                                            <option value="5" <?php if ($order['order_status'] == '5') {
                                                                echo 'selected';
                                                            } ?>>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $order['create_at']; ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success" href="../../views/admin/order_detail.php?order_id=<?php echo $order['order_id']; ?>">Detail</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('../../../app/views/admin/components/footer.php');
    require('../../process/show_product.php'); ?>

    <!-- detail_modal -->
    <?php
    require('../../process/show_order_detail.php');
    foreach ($orders as $index => $order) { ?>
        <div class="modal fade bd-example-modal-lg" id="exampleModalUpdate<?php echo $index; ?>" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <h5 class="card-title">Orders Detail</h5>
                    <table class="mb-0 table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($order_detail as $key => $detail) { ?>

                                <tr>
                                    <th scope="row">
                                        <?php echo ++$key; ?>
                                    </th>
                                    <td>
                                        <?php echo $detail['order_id']; ?>
                                    </td>

                                    <?php foreach ($products as $product) {
                                        if ($product['product_id'] == $detail['product_id']) {
                                            ?>
                                            <td>
                                                <?php echo $product['product_name']; ?>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    <?php } ?>
                                    <td>
                                        <?php echo $detail['product_price']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detail['product_quantity']; ?>
                                    </td>
                                    <td>
                                        <?php $total_price = 0;
                                        foreach ($orders as $order) {
                                            if ($order['order_id'] == $detail['order_id']) {
                                                $total_price = $detail['product_quantity'] * $detail['product_price'];
                                            }
                                        }
                                        ?>
                                        <?php echo $total_price; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    <?php } ?>
    <!-- end modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <a href="../../process/show_order_detail.php">click here</a>
    <script>
        $(document).ready(function () {
        $('.post-order-id').click(function(){
        var order_id = $(this).val();
        console.log(order_id);
        $('#order_id_hidden').val(order_id);
        $.ajax({
            url : '../../process/show_order_detail.php',
            type : 'GET',
            data : {order_id : order_id} 
        })
        })
    })
    </script>
    <script>
        $(document).ready(function () {
            $('.order-status').change(function () {
                var order_id = $(this).attr('id');
                var order_status = $(this).val();
                console.log(order_id)
                console.log(order_status)
                $.ajax({
                    url: '../../process/update_order_status.php',
                    type: 'POST',
                    data: { order_id: order_id, order_status: order_status },
                    success: function (response) {
                        var select = $('#' + order_id);
                        select.val(order_status);
                        console.log(response)
                    },
                    error: function () {
                        alert('Error !')
                    }
                });
            });
        });
    </script>


</body>

</html>