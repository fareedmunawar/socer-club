<?php
include_once('db_connect.php');

if (isset($_POST['update_product'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Handle uploaded image
    $imageDirectory = "../assests/images/";
    $uploadedImage = $_FILES["product_image"]["name"];
    $targetPath = $imageDirectory . $uploadedImage;

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetPath)) {
        // Update product details in the database
        $updateQuery = "UPDATE products SET name = '$productName', price = '$productPrice', image = '$uploadedImage' WHERE id = '$productId'";

        if ($conn->query($updateQuery) === TRUE) {
            header("Location: products.php"); // Redirect to your product listing page
        } else {
            echo "Error updating product: " . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}

$conn->close();
?>
