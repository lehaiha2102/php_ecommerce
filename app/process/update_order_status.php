<?php
    require_once('../../app/classes/category.php');
    
    $orderId = $_POST['order_id'];
    $orderStatus = $_POST['order_status'];
    
    $query = "UPDATE orders SET order_status = $orderStatus WHERE order_id = $orderId";
    if (mysqli_query($connection, $query)) {
        echo 'success';
        if($orderStatus = 4){
            $query = "UPDATE orders SET payment_status = 2 WHERE order_status = 4";
            if (mysqli_query($connection, $query)) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else{
            $query = "UPDATE orders SET payment_status = 1";
            if (mysqli_query($connection, $query)) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    } else {
        echo 'error';
    }
    
    mysqli_close($connection);
?>
