<?php
session_start();
if (empty($_SESSION['user'])) {
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
                                <input type="text" id="search-input" name="searchValue" placeholder="Type to search">
                                <table class="mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Total price</th>
                                            <th>Payment method</th>
                                            <th>Payment status</th>
                                            <th>Status</th>
                                            <th>Address</th>
                                            <th>Phone</th>
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
                                                <td>
                                                    <?php echo $order['order_id']; ?>
                                                </td>
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
                                                    <?php
                                                    if ($order['payment_status'] == 1) {
                                                        echo 'Unpaid';
                                                    } else {
                                                        echo 'Paid';
                                                    }
                                                    ?>
                                                </td>
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
                                                    <?php echo $order['ship_address']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $order['recipient_phone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $order['create_at']; ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success"
                                                        href="../../views/admin/order_detail.php?order_id=<?php echo $order['order_id']; ?>">Detail</a>
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
    <?php require_once('../../../app/views/admin/components/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <script>
        $(document).ready(function () {
            $('.post-order-id').click(function () {
                var order_id = $(this).val();
                console.log(order_id);
                $('#order_id_hidden').val(order_id);
                $.ajax({
                    url: '../../process/show_order_detail.php',
                    type: 'GET',
                    data: { order_id: order_id }
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
                        alertify.success('Update success!');
                    },
                    error: function () {
                        alert('Error !')
                    }
                });
            });
        });
    </script>

<script>
    const searchInput = document.getElementById('search-input');
    const tableBody = document.querySelector('.table tbody');
    const rows = tableBody.querySelectorAll('tr');

    searchInput.addEventListener('keyup', function(event) {
        const searchTerm = event.target.value.toLowerCase();

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let found = false;

            cells.forEach(cell => {
                const cellValue = cell.textContent.toLowerCase();

                if (cellValue.includes(searchTerm)) {
                    found = true;
                }
            });

            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</body>

</html>