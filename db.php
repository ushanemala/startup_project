<?php
$conn = new mysqli("localhost", "root", "", "startup_project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>