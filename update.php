<?php
include 'db.php';

$id = $_POST['id'];
$inv = $_POST['investor'];
$amt = $_POST['amount'];
$round = $_POST['round'];
$date = $_POST['date'];

$conn->query("UPDATE investments SET
investor_name='$inv',
amount='$amt',
funding_round='$round',
date='$date'
WHERE id='$id'");

header("Location: view.php");
?>