<?php 
    require_once('../../app/classes/user.php');
    if(!empty($_GET['user_id']) && !empty($_POST['email'])){
        $user_id = htmlspecialchars($_GET['user_id']);
        $email = htmlspecialchars($_POST['email']);
        $sql = 'UPDATE users SET email = ? WHERE user_id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('si', $email, $user_id);
        $stmt->execute();
        header('Location: ../views/user_views/confidentiality.php');
        exit;
    }
?>