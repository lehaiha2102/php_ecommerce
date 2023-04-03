<?php 
    require_once('../../app/classes/user.php');
    $oldpass = $_POST['oldpas'];
    $password = $_POST['password'];
    $user_id = $_GET['user_id'];

    $oldpass = sha1($oldpass);
   
        $sql_check_password = 'SELECT password FROM users WHERE user_id = ? ';
        $stmt_check_password = $connection->prepare($sql_check_password);
        $stmt_check_password->bind_param('i', $user_id);
        $stmt_check_password->execute();
        $result_check_password = $stmt_check_password->get_result();
        if($result_check_password->num_rows === 1){
            $password = sha1($password);
            $sql = 'UPDATE users SET password = ? WHERE user_id = ?';
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('si', $password, $user_id);
            if($stmt->execute()){
                header('Location: ../views/user_views/confidentiality.php');
                exit;
            } else{
                echo 'error';
            }
        } else{
            echo 'no user_id';
        }
?>