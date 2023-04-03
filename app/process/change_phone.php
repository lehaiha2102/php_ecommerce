<?php 
    require_once('../../app/classes/user.php');
    if(!empty($_GET['user_id']) && !empty($_POST['phone'])){
        $user_id = htmlspecialchars($_GET['user_id']);
        $phone = htmlspecialchars($_POST['phone']);
        $sql = 'UPDATE users SET phone = ? WHERE user_id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('si', $phone, $user_id);
        $stmt->execute();
        header('Location: ../views/user_views/confidentiality.php');
        exit;
    }
?>