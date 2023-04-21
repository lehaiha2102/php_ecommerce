<?php
require_once('../../config/database.php');

if (isset($_POST['value']) && isset($_POST['arrangement'])) {
    $value = $_POST['value'];
    $arrangement = $_POST['arrangement'];
    switch ($value) {
        case 'product':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT * FROM products";
                    break;
                case 'Ascending':
                    $sql = "SELECT * FROM products ORDER BY product_name ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * FROM products ORDER BY product_name DESC";
                    break;
            }
            break;
        case 'category':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT p.*, c.category_name 
                    FROM products p 
                    JOIN categories c ON p.category_id = c.category_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT p.*, c.category_name 
                                FROM products p 
                                JOIN categories c ON p.category_id = c.category_id 
                                ORDER BY c.category_name ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT p.*, c.category_name 
                                FROM products p 
                                JOIN categories c ON p.category_id = c.category_id 
                                ORDER BY c.category_name DESC";
                    break;
            }
            break;
        case 'supplier':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT * FROM products";
                    break;
                case 'Ascending':
                    $sql = "SELECT * FROM products ORDER BY product_supplier ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * FROM products ORDER BY product_supplier DESC";
                    break;
            }
            break;
        case 'price':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT * FROM products";
                    break;
                case 'Ascending':
                    $sql = "SELECT * FROM products ORDER BY product_price ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * FROM products ORDER BY product_price DESC";
                    break;
            }
            break;
    }
    
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $response = array('success' => true, 'data' => $rows);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Product not found');
    }
    $connection->close();
} else {
    $response = array('success' => false, 'message' => 'You need to select objects and sorting to proceed with data filtering');
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>