<?php 
 $servername = 'localhost';
 $username = 'root';
 $password = '';
 $database = 'php_ecommerce';

 $connection = new mysqli($servername, $username, $password, $database);

 if($connection->connect_error){
     die('Connect error'.$connection->connect_error);
 }
    // $order_id=$_GET['order_id'];
    $sql = "SELECT * FROM order_detail";
    $result = $connection->query($sql);

    $order_detail = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_detail[] = $row;
        }
    }
?>