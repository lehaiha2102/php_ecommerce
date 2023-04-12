<?php
    require_once('../../app/classes/user.php');
    
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    
    $query = "UPDATE users SET role_id = $role_id WHERE user_id = $user_id";
    if (mysqli_query($connection, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
    
    mysqli_close($connection);
?>
