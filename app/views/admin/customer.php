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
                        <!-- <div class="col-md-6 col-xl-4">
                            <a class="btn btn-primary" href="../../views/admin/addproduct.php">Add product</a>
                        </div> -->
                        <!-- <div class="col-md-3">
                            <div class="dropdown">
                                <button class="dropbtn btn">Filter with product</button>
                                <div class="dropdown-content">
                                    <button id="sort-az" type="button" tabindex="0" class="dropdown-item">A-Z</button>
                                    <button type="button" tabindex="0" class="dropdown-item" id="sort-za">Z-A</button>

                                    <button type="button" tabindex="0" class="dropdown-item"
                                        id="sort-default">Default</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dropdown">
                                <button class="dropbtn btn">Filter with category</button>
                                <div class="dropdown-content">
                                    <button id="sort-category-az" type="button" tabindex="0"
                                        class="dropdown-item">A-Z</button>
                                    <button type="button" tabindex="0" class="dropdown-item"
                                        id="sort-category-za">Z-A</button>

                                    <button type="button" tabindex="0" class="dropdown-item"
                                        id="sort-category-default">Default</button>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                            <div class="card-body">
                                <h5 class="card-title">Customer list</h5>
                                <input type="text" id="search-input" name="searchValue" placeholder="Type to search">
                                <table class="mb-0 table" id="product-table">
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
                                                            } ?>><?php  echo 'User';?></option>
                                                            <option value="3" <?php if ($product['role_id'] == '3') {
                                                                echo 'selected';
                                                            } ?>> <?php  echo 'Admin';?></option>                                    
                                                        </select>
                                                    </div>
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
        $(document).ready(function(){
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