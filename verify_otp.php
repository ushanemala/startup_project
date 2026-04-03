<?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Kolkata');
$msg = "";

if(!isset($_SESSION['reset_email'])){
    header("Location: forgot_password.php");
    exit;
}

if(isset($_POST['verify'])){
    $otp = $_POST['otp'];
    $email = $_SESSION['reset_email'];

    // 🔥 OTP + EXPIRY CHECK
    $res = $conn->query("
SELECT * FROM users 
WHERE email='$email' 
AND otp='$otp'
");

    if($res->num_rows > 0){
        header("Location: reset_password.php");
        exit;
    } else {
        $msg = "OTP expired or invalid!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-box">
    <h2>Verify OTP</h2>

    <?php if($msg) echo "<div class='error'>$msg</div>"; ?>

    <form method="POST">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button name="verify">Verify OTP</button>
    </form>

    <p><a href="login.php">Back to Login</a></p>
</div>

</body>
</html>