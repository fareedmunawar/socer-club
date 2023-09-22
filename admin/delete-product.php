<?php
include_once('db_connect.php');

if (isset($_POST['delete_product'])) {
    $productId = $_POST['product_id'];

    // Delete the product from the database
    $deleteQuery = "DELETE FROM products WHERE id = '$productId'";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: products.php"); // Redirect to the product listing page
        exit(); // Stop script execution
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();
?>
