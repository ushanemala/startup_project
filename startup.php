<?php
session_start();
include 'db.php';

$id = $_SESSION['user_id'];

// get total funding for this startup
$res = $conn->query("
SELECT startup_name, SUM(amount) as total 
FROM investments 
WHERE user_id='$id'
GROUP BY startup_name
");
?>

<link rel="stylesheet" href="style.css">

<?php include 'sidebar.php'; ?>

<div class="main">
    <h2>Startup Details</h2>

    <table>
        <tr>
            <th>Startup</th>
            <th>Total Funding</th>
        </tr>

        <?php while($row = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['startup_name']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>