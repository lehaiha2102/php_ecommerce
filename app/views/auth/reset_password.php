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
    <h2>Reset Password</h2>
        <div class="form-container sign-in-container">
            <form action="../../process/reset_password.php" method="POST" id="forgot">
            <input type="hidden" name="email" value="<?php echo $_GET['email'];?>"/>
                <h1>Reset Password</h1>
                <input type="password" name="password" id="passwordregister" placeholder="Password" />
                <span style="color:red;" id="passwordregisterError"></span>

                <input type="password" name="repassword" id="repasswordregister" placeholder="Re-Password" />
                <span style="color:red;" id="repasswordregisterError"></span>

                <button type="submit" name="setpass" value="token">Submit</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Please enter your new password</p>
                    <!-- <button class="ghost" id="signUp">Sign Up</button> -->
                </div>
            </div>
        </div>
    </div>
    <script src="../../../public/auth/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        const formLogin = document.querySelector('#forgot');
        const passwordregister = document.querySelector('#passwordregister');
        const passwordregisterError = document.querySelector('#passwordregisterError');
        const repasswordregister = document.querySelector('#repasswordregister');
        const repasswordregisterError = document.querySelector('#repasswordregisterError');
        formLogin.addEventListener('submit', function(event) {
        event.preventDefault();

        passwordregister.textContent = '';
        passwordregisterError.textContent = '';
        repasswordregister.textContent = '';
        repasswordregisterError.textContent = '';

        if(passwordregister.value == ''){
            passwordregisterError.textContent = 'Your password is required';
            passwordregister.forcus();
        }
         if (passwordregister.value.length < 8) {
            passwordregisterError.textContent = 'Password must be at least 8 characters long';
            passwordregister.forcus();
            return false;

        }

        if(repasswordregister.value != passwordregister.value){
            repasswordregisterError.textContent = 'Password does not match password above';
            repasswordregister.forcus();
            return false;
        }
        this.submit();
        this.submit();
    })
    </script>
</body>

</html>