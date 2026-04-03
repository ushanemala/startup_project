<?php
session_start();
include 'db.php';

$id = $_SESSION['user_id'];
$res = $conn->query("SELECT * FROM investments WHERE user_id='$id'");
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
    <h2>Investment Records</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Startup</th>
            <th>Investor</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>

        <?php while($row=$res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['startup_name']; ?></td>
            <td><?php echo $row['investor_name']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['date']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>