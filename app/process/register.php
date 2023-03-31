<?php
    require_once('../classes/user.php');

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $address = $_POST['address'];

        $user = new User();
        $result = $user->register($fullname, $email, $phone, $password, $address);
        if($result == true){
            header('Location: ../views/auth/index.php');
            exit;
        } else{
            echo ' có đăng ký được đâu :)';
        }
?>