<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM investments WHERE id='$id'");

header("Location: view.php");
?>