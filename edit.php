<?php
include 'db.php';

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM investments WHERE id='$id'");
$row = $res->fetch_assoc();
?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="text" name="investor" value="<?php echo $row['investor_name']; ?>">
    <input type="number" name="amount" value="<?php echo $row['amount']; ?>">
    <input type="text" name="round" value="<?php echo $row['funding_round']; ?>">
    <input type="date" name="date" value="<?php echo $row['date']; ?>">
    <button>Update</button>
</form>