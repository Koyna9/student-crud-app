<?php
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : die("No ID provided");

$query = "DELETE FROM student WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting: " . mysqli_error($conn);
}
?>