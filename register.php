<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db.php';

$msg = "";

if(isset($_POST['register'])){

    $company = $_POST['company'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // 🔒 VALIDATION
    if($password != $confirm){
        $msg = "<div class='error'>Passwords do not match!</div>";
    } else {

        $pass = password_hash($password, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO users(company_name,email,password)
        VALUES('$company','$email','$pass')");

        // 🔥 REDIRECT
        header("Location: login.php?success=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-box">
    <h2>Register</h2>

    <?php if(!empty($msg)) echo $msg; ?>

    <form method="POST">

        <input type="text" name="company" placeholder="Company Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="password" name="confirm" placeholder="Confirm Password" required>

        <button name="register">Register</button>

    </form>

    <p>Already a user? <a href="login.php">Login here</a></p>

</div>

</body>
</html>