<?php 
session_start();
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_ecommerce';

    $connection = new mysqli($servername, $username, $password, $database);

    if(isset($_POST['add_new_address']) && isset($_POST['add_address_user']) && !empty($_POST['add_address_user'])){
        $user_id = $_SESSION['user']['id'];
        $address = $_POST['add_address_user'];
        
        // Kiểm tra xem user đã có địa chỉ trùng với địa chỉ thêm mới chưa
        $select_sql = 'SELECT * FROM user_address WHERE user_id = ? AND address = ?';
        $select_stmt = $connection->prepare($select_sql);
        $select_stmt->bind_param('is', $user_id, $address);
        $select_stmt->execute();
        $result = $select_stmt->get_result();
        
        if($result->num_rows > 0){
            echo "The address already exists!";
        } else {
            // Thực hiện thêm mới địa chỉ
            $insert_sql = 'INSERT INTO user_address( user_id, address) VALUES(?, ?)';
            $insert_stmt = $connection->prepare($insert_sql);
            $insert_stmt->bind_param('is', $user_id, $address);
            if ($insert_stmt->execute()) {
                header("Location: ../views/user_views/checkout.php");
                exit();
            } else {
                echo 'Adding a new address failed!';
            }
            $insert_stmt->close();
        }
        $select_stmt->close();
        $connection->close(); 
    } else{
        echo 'Please enter the address!';
    }
    
?>
