<?php
session_start();
if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['role_id'] == 1) {
        header('Location: ../../views/admin/index.php');
        exit;
    } else if ($_SESSION['user']['role_id'] == 2) {
        header('Location: ../../views/user_views/index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP Course</title>
    <link rel="stylesheet" href="../../../public/auth/style.css">
</head>

<body>
    <h2>Email confirm</h2>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form>
                <h1>Email confirm</h1>
                <span>A confirmation email has been sent to you, check and confirm the email</span><br>
                <span>Or</span>
                <span><a href="../../views/auth/index.php" style="color:red;">Later verification</a></span>
            </form> 

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your login email to proceed with obtaining the code</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../public/auth/script.js"></script>
</body>

</html>