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
    <h2>Forgot Password</h2>
        <div class="form-container sign-in-container">
            <form action="../../process/check_token.php" method="POST" id="forgot">
                <h1>Token Confirm</h1>
                <input type="hidden" name="email" value="<?php echo  $_GET['email']?>">
                <input type="text" name="token" id="token" placeholder="Token" />
                <span style="color:red;" id="tokenError"></span>

                <button type="submit" name="tokenbtn" value="token">Submit</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your token to reset password</p>
                    <!-- <button class="ghost" id="signUp">Sign Up</button> -->
                </div>
            </div>
        </div>
    </div>
    <script src="../../../public/auth/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        const formLogin = document.querySelector('#forgot');
        const token = document.querySelector('#token');
        const tokenError = document.querySelector('#tokenError');
        formLogin.addEventListener('submit', function(event) {
        event.preventDefault();

        tokenError.textContent = '';

        if (token.value === '') {
            tokenError.textContent = 'Token is required';
            token.focus();
            return false;
        }

        this.submit();
    })
    </script>
</body>

</html>