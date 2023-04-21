<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: ../../views/auth/index.php');
    exit;
}
require_once('../../process/show_user.php');

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
                                <div>Customer
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
                                            <div class="form-check dropdown-item" for="fullname"
                                                onclick="document.getElementById('fullname').click();">
                                                <input type="radio" name="value" id="fullname"
                                                    class="form-check-input value" value="fullname">
                                                <label class="form-check-label" for="fullname">
                                                    Name
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="address"
                                                onclick="document.getElementById('address').click();">
                                                <input type="radio" name="value" id="address"
                                                    class="form-check-input value" value="address">
                                                <label class="form-check-label" for="address">
                                                    Address
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="phone"
                                                onclick="document.getElementById('phone').click();">
                                                <input type="radio" name="value" id="phone"
                                                    class="form-check-input value" value="phone">
                                                <label class="form-check-label" for="phone">
                                                    Phone
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="email"
                                                onclick="document.getElementById('email').click();">
                                                <input type="radio" name="value" id="email"
                                                    class="form-check-input value" value="email">
                                                <label class="form-check-label" for="email">
                                                    Email
                                                </label>

                                            </div>
                                            <!-- <div class="form-check dropdown-item" for="role"
                                                onclick="document.getElementById('role').click();">
                                                <input type="radio" name="value" id="role"
                                                    class="form-check-input value" value="role">
                                                <label class="form-check-label" for="role">
                                                    Role
                                                </label>

                                            </div> -->
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
                                <h5 class="card-title">Customer list</h5>
                                <table class="mb-0 table" id="customer-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer name</th>
                                            <th>Date of birth</th>
                                            <th>Customer address</th>
                                            <th>Customer phone</th>
                                            <th>Customer email</th>
                                            <th>Customer role</th>
                                            <!-- <th>Product status</th> -->
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($users as $index => $product) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo ++$index; ?>
                                                </th>
                                                <td>
                                                    <?php echo $product['fullname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['date_of_birth']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['address']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['phone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product['email']; ?>
                                                </td>
                                                <td>
                                                    <div class="position-relative form-group">
                                                        <select id="<?php echo $product['user_id']; ?>"
                                                            name="<?php echo $product['role_id']; ?>"
                                                            class="form-control order-status">
                                                            <option value="4" <?php if ($product['role_id'] == '4') {
                                                                echo 'selected';
                                                            } ?>><?php echo 'User'; ?></option>
                                                            <option value="3" <?php if ($product['role_id'] == '3') {
                                                                echo 'selected';
                                                            } ?>> <?php echo 'Admin'; ?></option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <!-- <td>  <button type="button" class="btn mr-2 mb-2 btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal<?php echo $product['user_id'] ?>"><i
                                                            class="pe-7s-trash"> </i></button></td> -->
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
    <?php require_once('../../../app/views/admin/components/footer.php') ?>
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
            $('.order-status').change(function () {
                var user_id = $(this).attr('id');
                var role_id = $(this).val();
                console.log(user_id)
                console.log(role_id)
                $.ajax({
                    url: '../../process/update_role.php',
                    type: 'POST',
                    data: { user_id: user_id, role_id: role_id },
                    success: function (response) {
                        var select = $('#' + user_id);
                        select.val(role_id);
                        alertify.success('Update success!');
                    },
                    error: function () {
                        alert('Error !')
                    }
                });
            });
        })
    </script>
    <script>
        $(document).ready(function () {
            $('#search-customer').submit(function (e) {
                e.preventDefault();
                keyword = $('#keyword').val();
                index = 2;
                $.ajax({
                    url: '../../process/admin_customer_search.php',
                    type: 'POST',
                    data: { keyword: keyword },
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            console.log(response)
                            $('#customer-table tbody').empty();
                            $.each(response.data, function (index, customer) {
                                var row = $('<tr>');
                                $('<td>').text(index++).appendTo(row);
                                $('<td>').text(customer.fullname).appendTo(row);
                                $('<td>').text(customer.date_of_birth).appendTo(row);
                                $('<td>').text(customer.address).appendTo(row);
                                $('<td>').text(customer.phone).appendTo(row);
                                $('<td>').text(customer.email).appendTo(row);
                                $('<td>').text(customer.role_name).appendTo(row);
                                $('#customer-table tbody').append(row);
                            });
                            $('#customer-table').show();
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
                url: '../../process/customer_filter.php',
                type: 'POST',
                data: {
                    value: value,
                    arrangement: arrangement
                },

                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                        console.log(response.data);
                        $('#customer-table tbody').empty();
                        $.each(response.data, function (index, customer) {
                                var row = $('<tr>');
                                $('<td>').text(index++).appendTo(row);
                                $('<td>').text(customer.fullname).appendTo(row);
                                $('<td>').text(customer.date_of_birth).appendTo(row);
                                $('<td>').text(customer.address).appendTo(row);
                                $('<td>').text(customer.phone).appendTo(row);
                                $('<td>').text(customer.email).appendTo(row);
                                $('<td>').text(customer.role_name).appendTo(row);
                                $('#customer-table tbody').append(row);
                            });
                        $('#customer-table').show();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (response) {
                    // alert(response.message);
                    console.log(response.responseText)
                }
            })
        });
    });
</script>
</body>

</html>