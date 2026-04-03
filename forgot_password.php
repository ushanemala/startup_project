<?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Kolkata');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$msg = "";

if(isset($_POST['submit'])){
    $email = $_POST['email'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res->num_rows > 0){

        // 🔥 GENERATE OTP
        $otp = rand(1000,9999);
        $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $conn->query("UPDATE users SET otp='$otp', otp_expiry='$expiry' WHERE email='$email'");

        $_SESSION['reset_email'] = $email;

        // 🔥 SEND EMAIL
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            // ✅ YOUR EMAIL (CHANGE THIS)
           $mail->Username = 'startuptracker26@gmail.com';
$mail->Password = 'ziljkwpgfgzqgyzz'; // app password

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // 🔥 FIX SSL ERROR
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('yourgmail@gmail.com', 'Startup Fund Tracker');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP';
            $mail->Body = "
                <h3>Your OTP Code</h3>
                <p>Your OTP is: <b>$otp</b></p>
                <p>This OTP is valid for 5 minutes.</p>
            ";

            $mail->send();

            $msg = "OTP sent successfully to your email!";
            
            header("Refresh:2; url=verify_otp.php");

        } catch (Exception $e) {
            $msg = "Mailer Error: " . $mail->ErrorInfo;
        }

    } else {
        $msg = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-box">
    <h2>Forgot Password</h2>

    <?php if($msg) echo "<div class='success'>$msg</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button name="submit">Send OTP</button>
    </form>

    <p><a href="login.php">Back to Login</a></p>
</div>

</body>
</html>