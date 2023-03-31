<?php
 require_once('../../../config/database.php');

 $sql = "SELECT * FROM categories";
 $result = $connection->query($sql);

 $categories = array();
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $categories[] = $row;
     }
 }
?>