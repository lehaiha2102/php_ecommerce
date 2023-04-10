<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: ../../views/auth/index.php');
    exit;
}
require_once('../../../config/database.php');
$sql = "SELECT * FROM categories";
$result = $connection->query($sql);
$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
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
                                <div>Products
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <a class="btn btn-primary" href="../../views/admin/addproduct.php">Add product</a>
                        </div>
                        <div class="col-md-3">
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
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                            <div class="card-body">
                                <h5 class="card-title">Products list</h5>
                                <table class="mb-0 table" id="product-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product name</th>
                                            <th>Product image</th>
                                            <th>Product supplier</th>
                                            <th>Product category</th>
                                            <th>Product status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require('../../process/show_product.php');

                                        foreach ($products as $index => $product) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo ++$index; ?>
                                                </th>
                                                <td>
                                                    <?php echo $product['product_name']; ?>
                                                </td>
                                                <td>
                                                    <img src="../../../public/image/<?php echo $product['product_image_1']; ?>"
                                                        alt="<?php echo $product['product_image_1']; ?>"
                                                        style="width:100px; height:50px;">
                                                </td>
                                                <td>
                                                    <?php echo $product['product_supplier']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        if ($category['category_id'] == $product['category_id']) {
                                                            echo $category['category_name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="position-relative form-group">
                                                        <select id="<?php echo $product['product_id']; ?>"
                                                            name="<?php echo $product['product_status']; ?>"
                                                            class="form-control order-status">
                                                            <option value="1" <?php if ($product['product_status'] == '1') {
                                                                echo 'selected';
                                                            } ?>>In operation</option>
                                                            <option value="2" <?php if ($product['product_status'] == '2') {
                                                                echo 'selected';
                                                            } ?>>Suspension of operations</option>
                                                            <option value="3" <?php if ($product['product_status'] == '3') {
                                                                echo 'selected';
                                                            } ?>>Decommissioning</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn mr-2 mb-2 btn-success"
                                                        href="../../views/admin/productdetail.php?product_slug=<?php echo $product['product_slug'] ?>"><i
                                                            class="pe-7s-info"></i></a>
                                                    <a type="button" class="btn mr-2 mb-2 btn-warning"
                                                        href="../../views/admin/updateproduct.php?product_slug=<?php echo $product['product_slug'] ?>"><i
                                                            class="pe-7s-pen"> </i></a>
                                                    <button type="button" class="btn mr-2 mb-2 btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal<?php echo $product['product_id'] ?>"><i
                                                            class="pe-7s-trash"> </i></button>
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
</body>

<!-- delete modal -->
<?php foreach ($products as $product) { ?>
    <div class="modal fade" id="exampleModal<?php echo $product['product_id'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <h6>
                        <?php echo $product['product_name'] ?>
                    </h6>
                    <form action="../../process/delete_product.php" method="POST">
                        <div class="position-relative form-group">
                            <input name="product_id" value="<?php echo $product['product_id'] ?>"
                                placeholder="Enter product name" type="hidden" class="form-control">
                        </div>

                        <button name="product_delete" type="submit" class="mt-1 btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    // Get the dropdown button
    var dropdownBtn = document.querySelector(".dropbtn");

    // Add an event listener to the button
    dropdownBtn.addEventListener("click", function () {
        // Toggle the dropdown content
        var dropdownContent = this.nextElementSibling;
        dropdownContent.classList.toggle("show");
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (!event.target.matches(".dropbtn")) {
            var dropdowns = document.querySelectorAll(".dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var dropdown = dropdowns[i];
                if (dropdown.classList.contains("show")) {
                    dropdown.classList.remove("show");
                }
            }
        }
    });

</script>
<!-- end delete modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var rows = $('#product-table tbody tr').toArray();

        rows.sort(function (a, b) {
            var nameA = $(a).find('td:nth-child(2)').text().toUpperCase();
            var nameB = $(b).find('td:nth-child(2)').text().toUpperCase();
            if (nameA < nameB) return -1;
            if (nameA > nameB) return 1;
            return 0;
        });

        $.each(rows, function (index, row) {
            $('#product-table tbody').append(row);
        });

        $('#sort-az').click(function () {
            rows.sort(function (a, b) {
                var nameA = $(a).find('td:nth-child(2)').text().toUpperCase();
                var nameB = $(b).find('td:nth-child(2)').text().toUpperCase();
                if (nameA < nameB) return -1;
                if (nameA > nameB) return 1;
                return 0;
            });

            $.each(rows, function (index, row) {
                $('#product-table tbody').append(row);
            });
        });

        $('#sort-za').click(function () {
            rows.sort(function (a, b) {
                var nameA = $(a).find('td:nth-child(2)').text().toUpperCase();
                var nameB = $(b).find('td:nth-child(2)').text().toUpperCase();
                if (nameA > nameB) return -1;
                if (nameA < nameB) return 1;
                return 0;
            });

            $.each(rows, function (index, row) {
                $('#product-table tbody').append(row);
            });
        });

        $('#sort-default').click(function () {
            rows = $('#product-table tbody tr').toArray();

            rows.sort(function (a, b) {
                var nameA = $(a).find('td:nth-child(2)').text().toUpperCase();
                var nameB = $(b).find('td:nth-child(2)').text().toUpperCase();
                if (nameA < nameB) return -1;
                if (nameA > nameB) return 1;
                return 0;
            });

            $.each(rows, function (index, row) {
                $('#product-table tbody').append(row);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        var rows = $('#product-table tbody tr').toArray();

        rows.sort(function (a, b) {
            var nameA = $(a).find('td:nth-child(5)').text().toUpperCase();
            var nameB = $(b).find('td:nth-child(5)').text().toUpperCase();
            if (nameA < nameB) return -1;
            if (nameA > nameB) return 1;
            return 0;
        });

        $.each(rows, function (index, row) {
            $('#product-table tbody').append(row);
        });

        $('#sort-category-az').click(function () {
            rows.sort(function (a, b) {
                var nameA = $(a).find('td:nth-child(5)').text().toUpperCase();
                var nameB = $(b).find('td:nth-child(5)').text().toUpperCase();
                if (nameA < nameB) return -1;
                if (nameA > nameB) return 1;
                return 0;
            });

            $.each(rows, function (index, row) {
                $('#product-table tbody').append(row);
            });
        });

        $('#sort-category-za').click(function () {
            rows.sort(function (a, b) {
                var nameA = $(a).find('td:nth-child(5)').text().toUpperCase();
                var nameB = $(b).find('td:nth-child(5)').text().toUpperCase();
                if (nameA > nameB) return -1;
                if (nameA < nameB) return 1;
                return 0;
            });

            $.each(rows, function (index, row) {
                $('#product-table tbody').append(row);
            });
        });

        $('#sort-category-default').click(function () {
            rows = $('#product-table tbody tr').toArray();

            rows.sort(function (a, b) {
                var nameA = $(a).find('td:nth-child(5)').text().toUpperCase();
                var nameB = $(b).find('td:nth-child(5)').text().toUpperCase();
                if (nameA < nameB) return -1;
                if (nameA > nameB) return 1;
                return 0;
            });

            $.each(rows, function (index, row) {
                $('#product-table tbody').append(row);
            });
        });
    });
</script>

</html>