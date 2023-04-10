<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_ecommerce';

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die('Connect error'.$connection->connect_error);
    }

    $order_id = $_GET['order_id'];
    $sql_cancel = 'UPDATE orders SET order_status = 5 WHERE order_id = ?';
    $stmt = $connection->prepare($sql_cancel);
    $stmt->bind_param('i', $order_id);
    if($stmt->execute()){
        echo "<script>window.location.href = '../views/user_views/profile.php#tab-posts';</script>";

    } else{
        echo 'error '.$stmt->error;
    }
?>