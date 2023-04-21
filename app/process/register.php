<?php
    require_once('../classes/user.php');

    $fullname = !empty($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = !empty($_POST['email']) ? $_POST['email'] : '';
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
    $password = !empty($_POST['password']) ? $_POST['password'] : '';
    $address = !empty($_POST['address']) ? $_POST['address'] : '';
    $sql_check_email = 'SELECT user_id FROM users WHERE email = ?';
    $stmt_check_email = $connection->prepare($sql_check_email);
    $stmt_check_email->bind_param('s', $email);
    $stmt_check_email->execute();
    $result_check_mail = $stmt_check_email->get_result();
    if($result_check_mail->num_rows  > 0){
       header("Location: ../views/auth/index.php?error=" . urlencode("Email already exists! Please enter another email"));
        exit;
    } else{
        $sql_check_phone = 'SELECT user_id FROM users WHERE phone = ?';
        $stmt_check_phone = $connection->prepare($sql_check_phone);
        $stmt_check_phone->bind_param('s', $phone);
        $stmt_check_phone->execute();
        $result_check_phone = $stmt_check_phone->get_result();
        if($result_check_phone->num_rows  > 0){
            header("Location: ../views/auth/index.php?error=" . urlencode("Phone already exists! Please enter another email."));
           exit;
        } else{
            $password = sha1($password);
            $sql_register = 'INSERT INTO users(fullname, email, phone, password, address) VALUES(?, ?, ?, ?, ?)';
            $stmt_register = $connection->prepare($sql_register);
            $stmt_register->bind_param('sssss', $fullname, $email, $phone, $password, $address);
            if($stmt_register->execute()){
                header('Location: ../process/email_confirm.php?email='.$email);
                exit;
            } else{
            //     echo '<script>
            // alert("There was an error during the account registration process, please try again.");
            // window.location.replace("../views/auth/index.php");
            // </script>';
            if (!$stmt_register->execute()) {
                printf("Error: %s.\n", $stmt_register->error);
             }
            }
        }
    }
?>