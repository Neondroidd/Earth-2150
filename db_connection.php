<?php
$servername = "localhost";
$username = "Orville";
$password = "Orville610";
$dbname = "login";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
