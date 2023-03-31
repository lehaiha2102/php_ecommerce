<?php 
 require_once('../../../config/database.php');

 $sql = "SELECT * FROM users";
 $result = $connection->query($sql);

 $users = array();
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $users[] = $row;
     }
 }
?>