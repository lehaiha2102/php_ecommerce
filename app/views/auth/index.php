<?php 
session_start();
if(!empty($_SESSION['user'])){
    if($_SESSION['user']['role_id'] == 3){
        header('Location: ../../views/admin/index.php');
        exit;
    } else if($_SESSION['user']['role_id'] == 4){
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
    if
    <h2>Sign in/up Form</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../../process/register.php" method="POST" id="register">
                <h1>Create Account</h1>
                <input type="text" name="fullname" id="fullname" placeholder="Name" />
                <span style="color:red;" id="fullnameError"></span>

                <input type="text" name="email" id="emailregister" placeholder="Email" />
                <span style="color:red;" id="emailregisterError"></span>

                <input type="text" name="phone" id="phone" placeholder="Phone">
                <span style="color:red;" id="phoneError"></span>

                <input type="text" name="address" id="address" placeholder="Address">
                <span style="color:red;" id="addressError"></span>

                <input type="password" name="password" id="passwordregister" placeholder="Password" />
                <span style="color:red;" id="passwordregisterError"></span>

                <input type="password" name="repassword" id="repasswordregister" placeholder="Re-Password" />
                <span style="color:red;" id="repasswordregisterError"></span>

                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../../process/login.php" method="POST" id="login">
                <h1>Sign in</h1>
                <input type="email" name="email" id="email" placeholder="Email" />
                <span style="color:red;" id="emailError"></span>

                <input type="password" name="password" id="password" placeholder="Password" required minlength="8" />
                <span style="color:red;" id="passwordError"></span>

                <a href="../../views/auth/forgot_password.php">Forgot your password?</a>
                <button type="submit" name="login" value="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="error-message"></div>
    <script src="../../../public/auth/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <script>
        const formRegister = document.querySelector('#register');
        const fullname = document.querySelector('#fullname');
        const fullnameError = document.querySelector('#fullnameError');
        const emailregister = document.querySelector('#emailregister');
        const emailregisterError = document.querySelector('#emailregisterError');
        const phone = document.querySelector('#phone');
        const phoneError = document.querySelector('#phoneError');
        const address = document.querySelector('#address');
        const addressError = document.querySelector('#addressError');
        const passwordregister = document.querySelector('#passwordregister');
        const passwordregisterError = document.querySelector('#passwordregisterError');
        const repasswordregister = document.querySelector('#repasswordregister');
        const repasswordregisterError = document.querySelector('#repasswordregisterError');

        fullname.textContent = '';
        fullnameError.textContent = '';
        emailregister.textContent = '';
        emailregisterError.textContent = '';
        phone.textContent = '';
        phoneError.textContent = '';
        address.textContent = '';
        addressError.textContent = '';
        passwordregister.textContent = '';
        passwordregisterError.textContent = '';
        repasswordregister.textContent = '';
        repasswordregisterError.textContent = '';

        formRegister.addEventListener('submit', function(event) {
        event.preventDefault();

        if(fullname.value == ''){
            fullnameError.textContent = 'Your name is required';
            fullnameError.forcus();
        }
        

        if(emailregister.value == ''){
            emailregisterError.textContent = 'Email name is required';
            emailregister.forcus();
        }
        
        if (!emailregister.value.includes('@')) {
            emailregisterError.textContent = 'Email must be valid';
            emailregister.focus();
            return false;
        }

        if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(emailregister.value)) {
        emailregisterError.textContent = 'Please enter a valid email address';
        emailError.focus();
        return false;
}

        
        if(phone.value == ''){
            phoneError.textContent = 'Your phone is required';
            phoneError.forcus();
        }
        
        if (!/^(0|\+84)[3|5|7|8|9][0-9]{8}$/g.test(phone.value)) {
            phoneError.textContent = 'Please enter a valid phone number';
            phoneError.forcus();
            return false;
        }


        if(address.value == ''){
            addressError.textContent = 'Your address is required';
            address.forcus();
        }

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
    })
    </script>
    <script>
        const formLogin = document.querySelector('#login');
        const email = document.querySelector('#email');
        const password = document.querySelector('#password');
        const emailError = document.querySelector('#emailError');
        const passwordError = document.querySelector('#passwordError');
        formLogin.addEventListener('submit', function(event) {
        event.preventDefault();

        emailError.textContent = '';
        passwordError.textContent = '';

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


        if (password.value === '') {
            passwordError.textContent = 'Password is required';
            password.focus();
            return false;
        }

        this.submit();
    })
    </script>

<script>
$(document).ready(function() {
  var error = "<?php echo isset($_SESSION['error']) ? $_SESSION['error'] : '' ?>";
  
  // Nếu có giá trị error thì hiển thị lên màn hình
  if (error) {
    alertify.alert(error);
  }
});
<?php unset($_SESSION['error'])?>
</script>


</body>

</html>