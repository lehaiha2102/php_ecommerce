<?php 
 require_once('../../../config/database.php');

//  $sql = 'SELECT orders.*, users.user_name, payment_methods.payment_method
//         FROM orders
//         INNER JOIN users ON orders.user_id = users.user_id
//         INNER JOIN payment_methods ON orders.payment_method_id = payment_methods.method_id;';
//  $result = $connection->query($sql);

//  $orders = array();
//  if ($result->num_rows > 0) {
//      while ($row = $result->fetch_assoc()) {
//          $orders[] = $row;
//      }
//  }

$sql = "SELECT * FROM orders ORDER BY order_id DESC";
$result = $connection->query($sql);

$orders = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>
