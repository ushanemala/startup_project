<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];
$name = $_SESSION['company_name'];

// ADD DATA
if(isset($_POST['add'])){
    $inv = $_POST['investor'];
    $amt = $_POST['amount'];
    $date = $_POST['date'];
    $usage = $_POST['usage'];

    $conn->query("INSERT INTO investments(user_id,startup_name,investor_name,amount,date,usage_type)
    VALUES('$id','$name','$inv','$amt','$date','$usage')");

    header("Location: success.php"); // redirect after insert
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Investment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Menu</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add.php">Add Investment</a>
    <a href="view.php">View</a>
    <a href="investor.php">Investors</a>
    <a href="startup.php">Startups</a>
    <a href="fund_usage.php">Fund Usage</a>
    <a href="logout.php">Logout</a>
</div>

<!-- MAIN -->
<div class="main">
    <h2>Startup Investment Tracking System</h2>

    <div class="form-card">
        <h3>Add Investment</h3>

        <form method="POST">
            
            <input type="text" name="investor" placeholder="Investor Name" required>

            <input type="number" name="amount" placeholder="Amount" required>

            <input type="date" name="date" required>

            <!-- 🔥 USAGE DROPDOWN -->
            <select name="usage" required>
                <option value="">Select Usage</option>
                <option value="Marketing">Marketing</option>
                <option value="Development">Development</option>
                <option value="Operations">Operations</option>
            </select>

            <button name="add">Add Investment</button>

        </form>
    </div>
</div>

</body>
</html>