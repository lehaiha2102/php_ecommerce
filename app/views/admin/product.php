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

$per_page = isset($_GET['limit']) ? $_GET['limit'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

if (!is_numeric($page) || $page < 1) {
    $page = 1;
}

$result = $connection->query("SELECT COUNT('product_id') AS id FROM products");
$countProduct = $result->fetch_all(MYSQLI_ASSOC);

$total_product = $countProduct[0]['id'];
$get_total_page = ceil($total_product / $per_page);

if ($page > $get_total_page) {
    $page = $get_total_page;
}

$start = ($page - 1) * $per_page;
if ($start < 0) {
    $start = 0;
}

$result_product = $connection->query("SELECT * FROM products LIMIT $start, $per_page");
$products = array();
if ($result_product->num_rows > 0) {
    while ($row = $result_product->fetch_assoc()) {
        $products[] = $row;
    }
}

if ($page == 1) {
    $PrevPage = $page;
} else {
    $PrevPage = $page - 1;
}
if ($page == $get_total_page) {
    $NextPage = $page;
} else {
    $NextPage = $page + 1;
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
                    <div class="row text-nowrap">
                        <div class="col-md-3 col-xl-4">
                            <a class="btn btn-primary" href="../../views/admin/addproduct.php">Add product</a>
                        </div>
                        <div class="col-md-3">
                            <div class="dropdown d-inline-block">
                                <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                    class="mb-2 mr-2 dropdown-toggle btn btn-outline-primary">Filter
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check dropdown-item" for="category"
                                                onclick="document.getElementById('category').click();">
                                                <input type="radio" name="value" id="category"
                                                    class="form-check-input value" value="category">
                                                <label class="form-check-label" for="category">
                                                    Category
                                                </label>

                                            </div>
                                            <div class="form-check dropdown-item" for="product"
                                                onclick="document.getElementById('product').click();">

                                                <input type="radio" name="value" id="product"
                                                    class="form-check-input value" value="product">
                                                <label class="form-check-label" for="product">
                                                    Product
                                                </label>
                                            </div>
                                            <div class="form-check dropdown-item" for="supplier"
                                                onclick="document.getElementById('supplier').click();">

                                                <input type="radio" name="value" id="supplier"
                                                    class="form-check-input value" value="supplier">
                                                <label class="form-check-label" for="supplier">
                                                    Suplier
                                                </label>
                                            </div>
                                            <div class="form-check dropdown-item" for="price"
                                                onclick="document.getElementById('price').click();">

                                                <input type="radio" name="value" id="price"
                                                    class="form-check-input value" value="price">
                                                <label class="form-check-label" for="price">
                                                    Price
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
                            <form action="" id="search-product">
                                <div class="position-relative form-group">
                                    <input type="text" id="keyword" name="keyword" placeholder="Enter..."
                                        class="form-control" style="display: inline-block;">
                                    <button class="btn btn-primary" type="submit" style="display: inline-block;"> <i
                                            class="pe-7s-search"></i> </button>
                                </div>
                            </form>
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
                                        <th>Product name</th>
                                        <th>Product image</th>
                                        <th>Product supplier</th>
                                        <th>Product category</th>
                                        <th>Product price</th>
                                        <!-- <th>Product status</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // require('../../process/show_product.php');
                                    
                                    foreach ($products as $index => $product) { ?>
                                        <tr>
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
                                                <?php echo $product['product_price'] ?>
                                            </td>
                                            <!-- <td>
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
                                                </td> -->
                                            <td>
                                                <a type="button" class="btn mr-2 mb-2 btn-success"
                                                    href="../../views/admin/productdetail.php?product_slug=<?php echo $product['product_slug'] ?>"><i
                                                        class="pe-7s-info"></i></a>
                                                <a type="button" class="btn mr-2 mb-2 btn-warning"
                                                    href="../../views/admin/updateproduct.php?product_slug=<?php echo $product['product_slug'] ?>"><i
                                                        class="pe-7s-pen"> </i></a>
                                                <button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal<?php echo $product['product_id'] ?>">
                                                    <i class="pe-7s-trash"> </i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="main-card mb-3">
                            <div class="card-body">
                                <nav class="" aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a
                                                href="../../views/admin/product.php?page=<?php echo $PrevPage ?>"
                                                class="page-link" aria-label="Previous"><span
                                                    aria-hidden="true">«</span><span class="sr-only">Previous</span></a>
                                        </li>
                                        <?php
                                        for ($i = 1; $i <= $get_total_page; $i++): ?>
                                            <li class="page-item"><a
                                                    href="../../views/admin/product.php?page=<?php echo $i ?>"
                                                    class="page-link"><?= $i ?></a></li>
                                        <?php endfor ?>
                                        <li class="page-item"><a
                                                href="../../views/admin/product.php?page=<?php echo $NextPage ?>"
                                                class="page-link" aria-label="Next"><span
                                                    aria-hidden="true">»</span><span class="sr-only">Next</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <form action="" id="record_form">
                                <select name="limit" id="limit_record" class="form-control">
                                    <option display="disable" selected="selected">-Limit records-</option>
                                    <?php foreach([10,100,500,1000] as $per_page){?>
                                    <option <?php if(isset($_GET['limit']) && $per_page == $_GET['limit']) echo "selected"; ?> value="<?= $per_page ?>"><?= $per_page ?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="app-wrapper-footer">
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
            </div> -->
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
<!-- <script>
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

</script> -->
<!-- end delete modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search-product').submit(function (e) {
            e.preventDefault();
            keyword = $('#keyword').val();
            index = 1;
            $.ajax({
                url: '../../process/admin_product_search.php',
                type: 'POST',
                data: { keyword: keyword },
                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                        $('#product-table tbody').empty();
                        $.each(response.data, function (index, product) {
                            var row = $('<tr>');
                            $('<td>').text(product.product_name).appendTo(row);
                            $('<td>').html('<img src="../../../public/image/' + product.product_image_1 + '" style="width:100px; height:50px;">').appendTo(row);
                            $('<td>').text(product.product_supplier).appendTo(row);
                            $('<td>').text(product.category_name).appendTo(row);
                            $('<td>').text(product.product_price).appendTo(row);
                            var actionsHtml = '<a type="button" class="btn mr-2 mb-2 btn-success" href="../../views/admin/productdetail.php?product_slug=' + product.product_slug + '"><i class="pe-7s-info"></i></a>' +
                                '<a type="button" class="btn mr-2 mb-2 btn-warning" href="../../views/admin/updateproduct.php?product_slug=' + product.product_slug + '"><i class="pe-7s-pen"> </i></a>' +
                                '<button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal' + product.product_id + '"><i class="pe-7s-trash"> </i></button>';
                            $('<td>').html(actionsHtml).appendTo(row);

                            $('#product-table tbody').append(row);
                        });
                        $('#product-table').show();
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
                url: '../../process/product_filter.php',
                type: 'POST',
                data: {
                    value: value,
                    arrangement: arrangement
                },

                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                        // console.log(response.data);
                        $('#product-table tbody').empty();
                        $.each(response.data, function (index, product) {
                            var row = $('<tr>');
                            $('<td>').text(product.product_name).appendTo(row);
                            $('<td>').html('<img src="../../../public/image/' + product.product_image_1 + '" style="width:100px; height:50px;">').appendTo(row);
                            $('<td>').text(product.product_supplier).appendTo(row);
                            $('<td>').text(product.category_name).appendTo(row);
                            $('<td>').text(product.product_price).appendTo(row);
                            var actionsHtml = '<a type="button" class="btn mr-2 mb-2 btn-success" href="../../views/admin/productdetail.php?product_slug=' + product.product_slug + '"><i class="pe-7s-info"></i></a>' +
                                '<a type="button" class="btn mr-2 mb-2 btn-warning" href="../../views/admin/updateproduct.php?product_slug=' + product.product_slug + '"><i class="pe-7s-pen"> </i></a>' +
                                '<button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal' + product.product_id + '"><i class="pe-7s-trash"> </i></button>';
                            $('<td>').html(actionsHtml).appendTo(row);

                            $('#product-table tbody').append(row);
                        });
                        $('#product-table').show();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (response) {
                    // alert(response.message);
                    console.log(response)
                }
            })
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#limit_record').change(function(e){
            $('#record_form').submit();
        });
    })
</script>
</html>