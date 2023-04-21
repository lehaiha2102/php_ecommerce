<?php
require_once('../../config/database.php');

if (isset($_POST['value']) && isset($_POST['arrangement'])) {
    $value = $_POST['value'];
    $arrangement = $_POST['arrangement'];
    switch ($value) {
        case 'category':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT c.category_name 
                    FROM categories c ";
                    break;
                case 'Ascending':
                    $sql = "SELECT c.category_name 
                                FROM categories c
                                ORDER BY c.category_name ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT c.category_name 
                                FROM  categories c
                                ORDER BY c.category_name DESC";
                    break;
            }
            break; // Thêm break ở đây
    }
    
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $response = array('success' => true, 'data' => $rows);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Category not found');
    }
    $connection->close();
} else {
    $response = array('success' => false, 'message' => 'You need to select objects and sorting to proceed with data filtering');
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>