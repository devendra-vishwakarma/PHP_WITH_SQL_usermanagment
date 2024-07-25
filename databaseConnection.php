<?php
$servername = "localhost";
$dbname = "usermanagments";
$dbusername = "Devendra";
$dbpassword = "root";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
