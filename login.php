<?php
session_start();
include 'db.php';

// ✅ SUCCESS MESSAGE (after register)
$msg = "";
if(isset($_GET['success'])){
    $msg = "<div class='success'>Registration successful! Please login.</div>";
}

// ❌ ERROR MESSAGE
$error = "";

// 🔹 HANDLE LOGIN
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $row = $res->fetch_assoc();

    if($row && password_verify($pass, $row['password'])){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['company_name'] = $row['company_name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="center-box">
    <h2>Startup Fund Tracker</h2>

    <!-- ✅ SUCCESS MESSAGE -->
    <?php if(!empty($msg)) echo $msg; ?>

    <!-- ❌ ERROR MESSAGE -->
    <?php if(!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        
        <input type="email" name="email" placeholder="Email" required>

        <!-- PASSWORD FIELD WITH EYE ICON -->
        <div class="password-box">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span onclick="togglePassword()" class="eye">👁️</span>
        </div>

        <button name="login">Login</button>
    </form>

    <!-- LINKS -->
    <p>
        <a href="forgot_password.php">Forgot Password?</a>
    </p>

    <p>
        Not a user? <a href="register.php">Register here</a>
    </p>

</div>

<!-- ✅ SINGLE JAVASCRIPT -->
<script>
function togglePassword() {
    var pass = document.getElementById("password");

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</body>
</html>