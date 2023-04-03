<?php 
    require_once('../classes/user.php');
        if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
       $sql = "UPDATE users SET password = ? WHERE email = ?";
       $stmt = $connection->prepare($sql);
       $stmt->bind_param('ss', $password, $email);
       if($stmt->execute()){
        header('Location: ../views/auth/index.php');
        exit;
       } else{
        echo 'error';
       }
    } else{
        echo 'no data';
    }

?>