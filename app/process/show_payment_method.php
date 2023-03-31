<?php 
 require_once('../../../config/database.php');

 $sql = "SELECT * FROM payment_methods";
 $result = $connection->query($sql);

 $payment_methods = array();
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $payment_methods[] = $row;
     }
 }
?>