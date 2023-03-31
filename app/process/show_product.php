<?php 
 require_once('../../../config/database.php');

 $sql = "SELECT * FROM products";
 $result = $connection->query($sql);

 $products = array();
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $products[] = $row;
     }
 }
?>