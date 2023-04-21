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
    <div class="form-container sign-in-container">
        <form action="../../process/check_email.php?email=<?php echo $_GET['email'] ?>" method="POST" id="forgot">
            <h1>Email confirm</h1>
            <!-- <input type="hidden" name="email" id="email" placeholder="Email" /> -->
            <!-- <span style="color:red;" id="emailError"></span> -->
            <input type="text" name="token" placeholder="Enter token">
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
</body>
</html>