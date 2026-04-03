<?php
$conn = new mysqli(
    getenv('MYSQLHOST'),
    getenv('MYSQLUSER'),
    getenv('MYSQLPASSWORD'),
    getenv('MYSQLDATABASE')
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
