<?php
include 'db.php';

$name = $_POST['company_name'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$conn->query("INSERT INTO users(company_name,email,password)
VALUES('$name','$email','$pass')");

header("Location: login.php");
?>