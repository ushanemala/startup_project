<?php
session_start();
include 'db.php';

$id = $_SESSION['user_id'];

$res = $conn->query("
SELECT investor_name, SUM(amount) as total 
FROM investments 
WHERE user_id='$id'
GROUP BY investor_name
");
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
    <h2>Investor Details</h2>

    <table>
        <tr>
            <th>Investor</th>
            <th>Total Investment</th>
        </tr>

        <?php while($row=$res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['investor_name']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>