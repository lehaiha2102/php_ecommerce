<?php
require_once('../../config/database.php');

if (isset($_POST['value']) && isset($_POST['arrangement'])) {
    $value = $_POST['value'];
    $arrangement = $_POST['arrangement'];
    switch ($value) {
        case 'fullname':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT * FROM users";
                    break;
                case 'Ascending':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY fullname ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY fullname DESC";
                    break;
            }
            break; // Thêm break ở đây
        case 'address':
            switch ($arrangement) {
                case 'Default':
                     $sql = "SELECT * 
                             FROM users";
                    break;
                case 'Ascending':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY address ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY address DESC";
                    break;
            }
            break; // Thêm break ở đây
        case 'phone':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT * 
                            FROM users";
                    break;
                case 'Ascending':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY phone ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY phone DESC";
                    break;
            }
            break; // Thêm break ở đây
        case 'email':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT * 
                            FROM users";
                    break;
                case 'Ascending':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY email ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT * 
                            FROM users 
                            ORDER BY email DESC";
                    break;
            }
            break; // Thêm break ở đây
        case 'category':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT u.*, r.role_name 
                            FROM user u
                            JOIN roles r ON u.role_id = r.role_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT u.*, r.role_name 
                            FROM user u
                            JOIN roles r ON u.role_id = r.role_id 
                            ORDER BY r.role_name ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT u.*, r.role_name 
                            FROM user u
                            JOIN roles r ON u.role_id = r.role_id 
                            ORDER BY r.role_name DESC";
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
        $response = array('success' => false, 
                          'message' => 'User not found');
    }
    $connection->close();
} else {
    $response = array('success' => false,
                      'message' => 'You need to select objects and sorting to proceed with data filtering');
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>