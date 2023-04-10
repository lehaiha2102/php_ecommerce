<?php 
require_once('../../../config/database.php');
$user_id = $_SESSION['user']['id'];
$sql2 = "SELECT * FROM orders WHERE user_id = '$user_id'";
$result = $connection->query($sql2);
$ordersid = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ordersid[] = $row;
    }
}


?>
