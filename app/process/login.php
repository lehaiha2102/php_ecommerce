<?php 
    session_start();
    require_once('../classes/user.php');
    // if(isset($_POST['login'])){
        $email = $_POST['email'];
        echo $email. '<br>';
        $password = $_POST['password'];
        echo $password. '<br>';

        $user = new User();
        $result = $user->login($email, $password);
        if($result == 'admin'){
            $_SESSION['user']['email'] = $email;
            header('Location: ../views/admin/index.php');
            exit;
        } else{
            $_SESSION['user']['email'] = $email;
            header('Location: ../views/user_views/index.php');
            exit;
        }
?>