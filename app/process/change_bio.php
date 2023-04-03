<?php 
    require_once('../../app/classes/user.php');
    if(!empty($_GET['user_id']) && !empty($_POST['bio'])){
        $user_id = htmlspecialchars($_GET['user_id']);
        $bio = htmlspecialchars($_POST['bio']);
        $sql = 'UPDATE users SET bio = ? WHERE user_id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('si', $bio, $user_id);
        $stmt->execute();
        header('Location: ../views/user_views/profile.php');
        exit;
    }
?>