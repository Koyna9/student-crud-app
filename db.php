<?php
$host = "localhost";        // or "127.0.0.1"
$user = "root";              // your MySQL username
$password = "";  // YOUR MySQL password (important!)
$database = "studentdb";

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully"; // Remove this after testing
?>
