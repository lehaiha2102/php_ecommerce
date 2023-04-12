<?php 
session_start();
if(empty($_SESSION['user'])){
	header('Location: ../../views/auth/index.php');
	exit;
}

    if(isset($_GET['order_id'])){
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'php_ecommerce';
       
        $connection = new mysqli($servername, $username, $password, $database);
       
        if($connection->connect_error){
            die('Connect error'.$connection->connect_error);
        }

        $sql = "SELECT * FROM orders ORDER BY order_id DESC";
$result = $connection->query($sql);

$orders = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}


           $order_id=$_GET['order_id'];
           $sql = "SELECT * FROM order_detail WHERE order_id = $order_id";
           $result = $connection->query($sql);
       
           $order_detail = array();
           if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                   $order_detail[] = $row;
               }
           }
    }
?>

<!doctype html>
<html lang="en">

<?php
require_once('../../../app/views/admin/components/head.php');
require('../../process/show_product.php');
?>

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
                                <h5 class="card-title">Orders Detail</h5>
                                <input type="text" id="search-input" name="searchValue" placeholder="Type to search">


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

    ?>

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