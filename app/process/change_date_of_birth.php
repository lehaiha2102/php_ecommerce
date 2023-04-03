<?php 
    require_once('../../app/classes/user.php');
    if(!empty($_GET['user_id']) && !empty($_POST['date_of_birth'])){
        $user_id = htmlspecialchars($_GET['user_id']);
        $date_of_birth = htmlspecialchars($_POST['date_of_birth']);
        $sql = 'UPDATE users SET date_of_birth = ? WHERE user_id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('si', $date_of_birth, $user_id);
        $stmt->execute();
        header('Location: ../views/user_views/profile.php');
        exit;
    }
?>