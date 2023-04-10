<?php 
    session_start();
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_ecommerce';

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die('Connect error'.$connection->connect_error);
    }

    $user_id = $_SESSION['user']['id'];
    $sql_favou = "SELECT * FROM favourite_product WHERE '$user_id'";
    $result_favou = $connection->query($sql_favou);

    $favou = array();
    if ($result_favou->num_rows > 0) {
        while ($fapro = $result_favou->fetch_assoc()) {
            $favou = $fapro;
        }
    }
    
    $sql = "SELECT * FROM products";
    $result = $connection->query($sql);

    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($favou['product_id'] =$row['product_id']){
                $products = $row;
            }
        }
    }
    
?>
<div class="row">
    <div class="col-md-4">
        <p class="dropdown-item top-cart-item-image">
            <img src="../../../public/image/<?php echo $products['product_image_1']?>" alt="">
        </p>
    </div>
    <div class="col-md-6">
        <p class="dropdown-item"> <?php echo $products['product_name']?></p>
        <p class="dropdown-item"> <?php echo number_format($products['product_price']).' đ' ?></p>
    </div>
</div>