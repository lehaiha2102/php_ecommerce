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
            <form action="../../process/forgot_password.php" method="POST" id="forgot">
                <h1>Forgot Password</h1>
                <input type="email" name="email" id="email" placeholder="Email" />
                <span style="color:red;" id="emailError"></span>

                <button type="submit" name="forgot" value="forgot">Submit</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your login email to proceed with obtaining the code</p>
                    <!-- <button class="ghost" id="signUp">Sign Up</button> -->
                </div>
            </div>
        </div>
    </div>
    <script src="../../../public/auth/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        const formLogin = document.querySelector('#forgot');
        const email = document.querySelector('#email');
        const emailError = document.querySelector('#emailError');
        formLogin.addEventListener('submit', function(event) {
        event.preventDefault();

        emailError.textContent = '';

        if (email.value === '') {
            emailError.textContent = 'Email is required';
            email.focus();
            return false;
        }
        if (!email.value.includes('@')) {
            emailError.textContent = 'Email must be valid';
            email.focus();
            return false;
        }
        if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(email.value)) {
                emailError.textContent = 'Please enter a valid email address';
                emailError.focus();
                return false;
        }

        this.submit();
    })
    </script>
</body>

</html>