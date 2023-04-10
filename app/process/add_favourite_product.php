<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_ecommerce';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $user_id = $_SESSION['user']['id'];
    $product_id = $_GET['product_id'];
    $select_sql = 'SELECT * FROM favourite_product WHERE user_id = ? AND product_id = ?';
    $select_stmt = $connection->prepare($select_sql);
    $select_stmt->bind_param('ii', $user_id, $product_id);
    $select_stmt->execute();
    $result = $select_stmt->get_result();

    if($result->num_rows > 0){
        $response = array('success' => false, 'message' => 'The favourite product already exists!');
    } else {
        $insert_sql = 'INSERT INTO favourite_product(user_id, product_id) VALUES (?, ?)';
        $insert_stmt = $connection->prepare($insert_sql);
        $insert_stmt->bind_param('ii', $user_id, $product_id);
        if ($insert_stmt->execute()) {
            $response = array('success' => true, 'message' => 'Favourite product added successfully!');
        } else {
            $response = array('success' => false, 'message' => 'Adding a new favourite product failed!');
        }
        $insert_stmt->close();
    }
    
    
    $connection->close();
} else {
    $response = array('success' => false, 'message' => 'Please enter the favourite product!!');
}
header('Content-Type: application/json');
    echo json_encode($response);
?>
