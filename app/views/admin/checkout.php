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
                        <div class="col-md-3">
                            <div class="dropdown d-inline-block">
                                <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                    class="mb-2 mr-2 dropdown-toggle btn btn-outline-primary">Filter
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check dropdown-item" for="id"
                                                onclick="document.getElementById('id').click();">
                                                <input type="radio" name="value" id="id"
                                                    class="form-check-input value" value="id">
                                                <label class="form-check-label" for="id">
                                                    ID
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="name"
                                                onclick="document.getElementById('name').click();">
                                                <input type="radio" name="value" id="name"
                                                    class="form-check-input value" value="name">
                                                <label class="form-check-label" for="name">
                                                    Name
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="total"
                                                onclick="document.getElementById('total').click();">
                                                <input type="radio" name="value" id="total"
                                                    class="form-check-input value" value="total">
                                                <label class="form-check-label" for="total">
                                                    Total price
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="payment"
                                                onclick="document.getElementById('payment').click();">
                                                <input type="radio" name="value" id="payment"
                                                    class="form-check-input value" value="payment">
                                                <label class="form-check-label" for="payment">
                                                    Payment
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="pay_status"
                                                onclick="document.getElementById('pay_status').click();">
                                                <input type="radio" name="value" id="pay_status"
                                                    class="form-check-input value" value="pay_status">
                                                <label class="form-check-label" for="pay_status">
                                                    Payment status
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="ord_status"
                                                onclick="document.getElementById('ord_status').click();">
                                                <input type="radio" name="value" id="ord_status"
                                                    class="form-check-input value" value="ord_status">
                                                <label class="form-check-label" for="ord_status">
                                                    Order status
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="phone"
                                                onclick="document.getElementById('phone').click();">
                                                <input type="radio" name="value" id="phone"
                                                    class="form-check-input value" value="phone">
                                                <label class="form-check-label" for="phone">
                                                   Recipient phone
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="address"
                                                onclick="document.getElementById('address').click();">
                                                <input type="radio" name="value" id="address"
                                                    class="form-check-input value" value="address">
                                                <label class="form-check-label" for="address">
                                                    Shipping address
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="time"
                                                onclick="document.getElementById('time').click();">
                                                <input type="radio" name="value" id="time"
                                                    class="form-check-input value" value="time">
                                                <label class="form-check-label" for="time">
                                                   Time
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check dropdown-item" for="Default"
                                                onclick="document.getElementById('Default').click();">

                                                <input type="radio" name="arrangement" id="Default"
                                                    class="form-check-input arrangement" value="Default">
                                                <label class="form-check-label" for="Default">
                                                    Default
                                                </label>
                                            </div>
                                            <div class="form-check dropdown-item" for="Ascending"
                                                onclick="document.getElementById('Ascending').click();">

                                                <input type="radio" name="arrangement" id="Ascending"
                                                    class="form-check-input arrangement" value="Ascending">
                                                <label class="form-check-label" for="Ascending">
                                                    Ascending
                                                </label>
                                            </div>
                                            <div class="form-check dropdown-item" for="Decrease"
                                                onclick="document.getElementById('Decrease').click();">

                                                <input type="radio" name="arrangement" id="Decrease"
                                                    class="form-check-input arrangement" value="Decrease">
                                                <label class="form-check-label" for="Decrease">
                                                    Decrease
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="center"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <a class="btn btn-primary" href="#" id="filterBtn">Submit</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <form action="" id="search-customer">
                                <div class="position-relative form-group">
                                    <input type="text" id="keyword" name="keyword" placeholder="Enter..."
                                        class="form-control" style="display: inline-block;">
                                    <button class="btn btn-primary" type="submit" style="display: inline-block;"> <i
                                            class="pe-7s-search"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                            <div class="card-body">
                                <h5 class="card-title">Orders list</h5>
                                <table class="mb-0 table" id="order-table">
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
                                                    <select name="<?php echo $order['payment_status'] ?>"
                                                        id="payment<?php echo $order['order_id']; ?>">
                                                        <option value="1" <?php if ($order['payment_status'] == 1) {
                                                            echo ' selected';
                                                        } ?>>Unpaid</option>
                                                        <option value="2" <?php if ($order['payment_status'] == 2) {
                                                            echo ' selected';
                                                        } ?>>Paid</option>
                                                    </select>

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
        $(document).ready(function () {
            $('#search-customer').submit(function (e) {
                e.preventDefault();
                keyword = $('#keyword').val();
                index = 2;
                $.ajax({
                    url: '../../process/admin_order_search.php',
                    type: 'POST',
                    data: { keyword: keyword },
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            console.log(response)
                            $('#order-table tbody').empty();
                            $.each(response.data, function (index, order) {
                                var row = $('<tr>');
                                $('<th scope="row">').text(index + 1).appendTo(row);
                                $('<td>').text(order.order_id).appendTo(row);
                                $('<td>').text(order.fullname).appendTo(row);
                                $('<td>').text(order.total_price).appendTo(row);
                                $('<td>').text(order.payment_method).appendTo(row);
                                $('<td>').append(
                                    $('<select>', {
                                        'name': order.payment_status,
                                        'id': 'payment' + order.order_id
                                    }).append(
                                        $('<option>', {
                                            'value': '1',
                                            'text': 'Unpaid',
                                            'selected': (order.payment_status == 1)
                                        }),
                                        $('<option>', {
                                            'value': '2',
                                            'text': 'Paid',
                                            'selected': (order.payment_status == 2)
                                        })
                                    )
                                ).appendTo(row);
                                $('<td>').append(
                                    $('<select>', {
                                        'name': order.order_status,
                                        'id': order.order_id,
                                        'class': 'form-control order-status'
                                    }).append(
                                        $('<option>', {
                                            'value': '1',
                                            'text': 'Unconfirmed',
                                            'selected': (order.order_status == 1)
                                        }),
                                        $('<option>', {
                                            'value': '2',
                                            'text': 'Confirmed',
                                            'selected': (order.order_status == 2)
                                        }),
                                        $('<option>', {
                                            'value': '3',
                                            'text': 'Shipped',
                                            'selected': (order.order_status == 3)
                                        }),
                                        $('<option>', {
                                            'value': '4',
                                            'text': 'Delivered',
                                            'selected': (order.order_status == 4)
                                        }),
                                        $('<option>', {
                                            'value': '5',
                                            'text': 'Cancelled',
                                            'selected': (order.order_status == 5)
                                        })
                                    )
                                ).appendTo(row);
                                $('<td>').text(order.ship_address).appendTo(row);
                                $('<td>').text(order.recipient_phone).appendTo(row);
                                $('<td>').text(order.create_at).appendTo(row);
                                $('<td>').append(
                                    $('<a>', {
                                        'class': 'btn btn-success',
                                        'href': '../../views/admin/order_detail.php?order_id=' + order.order_id,
                                        'text': 'Detail'
                                    })
                                ).appendTo(row);
                                $('#order-table tbody').append(row);
                            });
                            $('#order-table').show();
                        } else {
                            alert(response.message);
                            console.log(response.message);
                        }

                    },

                    error: function (response) {
                        console.log(JSON.stringify(response))
                    }

                })
            })
        })

    </script>
<script>
    $(document).ready(function () {
        $('#filterBtn').on('click', function (e) {
            e.preventDefault();
            var value = $('input[name=value]:checked').val();
            var arrangement = $('input[name=arrangement]:checked').val();
            $.ajax({
                url: '../../process/order_filter.php',
                type: 'POST',
                data: {
                    value: value,
                    arrangement: arrangement
                },

                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                            console.log(response.data)
                            $('#order-table tbody').empty();
                            $.each(response.data, function (index, order) {
                                var row = $('<tr>');
                                $('<th scope="row">').text(index + 1).appendTo(row);
                                $('<td>').text(order.order_id).appendTo(row);
                                $('<td>').text(order.fullname).appendTo(row);
                                $('<td>').text(order.total_price).appendTo(row);
                                $('<td>').text(order.payment_method).appendTo(row);
                                $('<td>').append(
                                    $('<select>', {
                                        'name': order.payment_status,
                                        'id': 'payment' + order.order_id
                                    }).append(
                                        $('<option>', {
                                            'value': '1',
                                            'text': 'Unpaid',
                                            'selected': (order.payment_status == 1)
                                        }),
                                        $('<option>', {
                                            'value': '2',
                                            'text': 'Paid',
                                            'selected': (order.payment_status == 2)
                                        })
                                    )
                                ).appendTo(row);
                                $('<td>').append(
                                    $('<select>', {
                                        'name': order.order_status,
                                        'id': order.order_id,
                                        'class': 'form-control order-status'
                                    }).append(
                                        $('<option>', {
                                            'value': '1',
                                            'text': 'Unconfirmed',
                                            'selected': (order.order_status == 1)
                                        }),
                                        $('<option>', {
                                            'value': '2',
                                            'text': 'Confirmed',
                                            'selected': (order.order_status == 2)
                                        }),
                                        $('<option>', {
                                            'value': '3',
                                            'text': 'Shipped',
                                            'selected': (order.order_status == 3)
                                        }),
                                        $('<option>', {
                                            'value': '4',
                                            'text': 'Delivered',
                                            'selected': (order.order_status == 4)
                                        }),
                                        $('<option>', {
                                            'value': '5',
                                            'text': 'Cancelled',
                                            'selected': (order.order_status == 5)
                                        })
                                    )
                                ).appendTo(row);
                                $('<td>').text(order.ship_address).appendTo(row);
                                $('<td>').text(order.recipient_phone).appendTo(row);
                                $('<td>').text(order.create_at).appendTo(row);
                                $('<td>').append(
                                    $('<a>', {
                                        'class': 'btn btn-success',
                                        'href': '../../views/admin/order_detail.php?order_id=' + order.order_id,
                                        'text': 'Detail'
                                    })
                                ).appendTo(row);
                                $('#order-table tbody').append(row);
                            });
                            $('#order-table').show();
                        } else {
                            alert(response.message);
                            console.log(response.message);
                        }

                    },

                error: function (response) {
                    alert('error');
                    console.log(response)
                }
            })
        });
    });
</script>
</body>

</html>