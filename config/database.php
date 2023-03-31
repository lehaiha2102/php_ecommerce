<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_ecommerce';

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die('Connect error'.$connection->connect_error);
    }
?>