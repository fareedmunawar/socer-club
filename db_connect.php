<?php


// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soccer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
