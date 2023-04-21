<?php
require_once('../classes/user.php');
if (!empty($_GET['token']) && !empty($_GET['email'])) {
    $email = htmlspecialchars($_GET['email']);
    $token = htmlspecialchars($_GET['token']);
    $sql_check_token = 'SELECT * FROM users WHERE reset_token = ?';
    $stmt_check_token = $connection->prepare($sql_check_token);
    $stmt_check_token->bind_param('s', $token);
    $stmt_check_token->execute();
    $result_check = $stmt_check_token->get_result();
    if ($result_check->num_rows === 1) {
        $sql = "UPDATE users SET email_confirm = 1 WHERE email ='$email'";
        $result = $connection->query($sql);
        header('Location: ../views/auth/index.php?message=success');
        exit;
    } else {
        $sql_delete = 'DELETE FROM users WHERE email =?';
        $stmt = $connection->prepare($sql_delete);
        $stmt->bind_param('s', $email);
        if ($stmt->execute()) {

            header('Location: ../views/auth/index.php?message=failed');
            exit;
        }
    }
}

?>