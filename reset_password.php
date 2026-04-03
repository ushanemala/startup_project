<?php
session_start();
include 'db.php';


date_default_timezone_set('Asia/Kolkata'); // 🔥 ADD HERE
$msg = "";

if(!isset($_SESSION['reset_email'])){
    header("Location: forgot_password.php");
    exit;
}

if(isset($_POST['reset'])){
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $email = $_SESSION['reset_email'];

    // 🔥 CHECK PASSWORD MATCH
    if($password != $confirm){
        $msg = "Passwords do not match!";
    } else {
        $pass = password_hash($password, PASSWORD_DEFAULT);

        // 🔥 UPDATE PASSWORD + CLEAR OTP
        $conn->query("
        UPDATE users 
        SET password='$pass', otp=NULL, otp_expiry=NULL 
        WHERE email='$email'
        ");

        $msg = "Password updated successfully!";

        // redirect after 2 sec
        header("Refresh:2; url=login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-box">
    <h2>Reset Password</h2>

    <?php if($msg) echo "<div class='success'>$msg</div>"; ?>

    <form method="POST">
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <button name="reset">Update Password</button>
    </form>

</div>

</body>
</html>