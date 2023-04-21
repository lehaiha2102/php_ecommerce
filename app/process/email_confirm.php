<?php
require_once('../classes/user.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

// if(isset($_POST['login'])){
if (!empty(($_GET['email']))) {
    $email = htmlspecialchars($_GET['email']);
    $token = bin2hex(random_bytes(50));
    $user = new User();
    $result = $user->sendToken($email, $token);
    if ($result == 'success') {
        $phpmailer = new PHPMailer(true);
        try {
            //Server settings
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '32070f2520aab8';
            $phpmailer->Password = '6506b437cfbef4';
            //Recipients
            $phpmailer->setFrom('lehaiha.dev@gmail.com', 'ViTech');
            $phpmailer->addAddress($email); //Add a recipient
            $phpmailer->isHTML(true); //Set email format to HTML
            $phpmailer->Subject = 'Confirm email';
            $phpmailer->Body = '<p>This is a token to confirm email:</p>' . $token;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $phpmailer->send();
            header('Location: ../views/auth/confirm_email.php?email='.$email.'');
            exit;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    } else{
        echo "Error";
    }

} else{
    echo "Error no data";
}
?>