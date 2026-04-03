<?php
session_start();
include 'db.php';

$id = $_SESSION['user_id'];

$total = $conn->query("SELECT SUM(amount) as t FROM investments WHERE user_id='$id'")->fetch_assoc()['t'];
$count = $conn->query("SELECT COUNT(*) as c FROM investments WHERE user_id='$id'")->fetch_assoc()['c'];
?>

<link rel="stylesheet" href="style.css">

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

<div class="main">
    <h2>Dashboard</h2>

    <div class="card-box">
        <div class="card">
            Total Funds <br> <?php echo $total ?? 0; ?>
        </div>
        <div class="card">
            Total Records <br> <?php echo $count; ?>
        </div>
       <div class="card">
    <?php echo $_SESSION['company_name']; ?>
</div>
    </div>
</div>