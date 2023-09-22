<?php
include_once('db_connect.php'); // Include your database connection file

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the database
    $deleteQuery = "DELETE FROM users WHERE id = '$userId'";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: index.php"); // Redirect to the index page
        exit(); // Stop script execution
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>
