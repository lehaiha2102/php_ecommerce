<?php 
    session_start();

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_ecommerce';

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die('Connect error'.$connection->connect_error);
    }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password);
        $sql_check_email = 'SELECT * FROM users WHERE email = ? AND password = ?';
        $stmt_check_email = $connection->prepare($sql_check_email);
        $stmt_check_email->bind_param('ss', $email, $password);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->get_result();
        if($result_check_email->num_rows === 1){
            $row = $result_check_email->fetch_assoc();
            $_SESSION['user'] = array(
                'id' => $row['user_id'],
                'name'=>$row['fullname'],
                'email' => $email,
                'role_id' => $row['role_id']
            );
            if($_SESSION['user']['role_id'] == 3){
                $_SESSION['user']['email'] = $email;
                header('Location: ../views/admin/index.php');
                exit;
            } else if($_SESSION['user']['role_id'] == 4){
                $_SESSION['user']['email'] = $email;
                header('Location: ../views/user_views/index.php');
                exit;
            }
        }else{
            $_SESSION['error'] = "Email or password is incorect!";
            header('Location: ../views/auth/index.php');
            exit;
            // $response = array('success' => false, 'message' => '');
            // header('Content-Type: application/json');
            // echo json_encode($response);
        }
       
?>