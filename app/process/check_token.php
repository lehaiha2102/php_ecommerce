<?php 
    require_once('../classes/user.php');
    $error = '';
    if(!empty($_POST['token']) && !empty($_POST['email'])){
        $email = htmlspecialchars($_POST['email']);
        $token = htmlspecialchars($_POST['token']);
        $sql_check_token = 'SELECT * FROM users WHERE reset_token = ?';
        $stmt_check_token = $connection->prepare($sql_check_token);
        $stmt_check_token->bind_param('s', $token); // thêm dòng này để truyền giá trị tham số
        $stmt_check_token->execute();
        $result_check = $stmt_check_token->get_result();
        if($result_check->num_rows === 1){
            header('Location: ../views/auth/reset_password.php?email='.$email.'');
            exit;
        } else{
            echo $error = 'Token is wrong';
        }
    }
    
?>