<?php 
    require_once('../../app/classes/user.php');
    if(!empty($_GET['user_id']) && !empty($_POST['address'])){
        $user_id = htmlspecialchars($_GET['user_id']);
        $address = htmlspecialchars($_POST['address']);
        $sql = 'UPDATE users SET address = ? WHERE user_id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('si', $address, $user_id);
        $stmt->execute();
        header('Location: ../views/user_views/profile.php');
        exit;
    }
?>