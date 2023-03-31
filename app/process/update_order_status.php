<?php
    require_once('../../app/classes/category.php');
    
    $orderId = $_POST['order_id'];
    $orderStatus = $_POST['order_status'];
    
    $query = "UPDATE orders SET order_status = $orderStatus WHERE order_id = $orderId";
    if (mysqli_query($connection, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
    
    mysqli_close($connection);
?>
