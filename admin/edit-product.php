<?php include_once('admin-head.php'); ?>
<style>
    body {
        background-color: #4e657a;
        font-family: Arial, sans-serif;
        color: #fff; /* Text color for the card content */
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .product-card {
        width: 300px;
        height: 450px;
        max-width: 300px;
        max-height: 450px;
        background-color: #fff; /* Background color for the card */
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 10px;
        display: flex;
        flex-direction: column;
    }

    .product-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product-title {
        color:black !important;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 14px;
        color: #d9534f; /* Price color */
        margin-bottom: 10px;
    }

    .product-actions {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
    }

    .btn {
        justify-content:center;
        align-content: center;
        text-align: center;
        background-color: #4e657a;
        color: black;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn:hover {
        background-color: #4e657c;
        color: white;
    }
    /* Your styling for the edit page goes here */
</style>

<div class="container">
    <?php
    include_once('db_connect.php');

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $productId = $_GET['id'];

        // Fetch product data from the database
        $query = "SELECT * FROM products WHERE id = '$productId'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productName = $row["name"];
            $productImage = $row["image"];
            $productPrice = $row["price"];
            ?>
            <div class="product-card">
                <form action="update-product.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" value="<?php echo $productName; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price:</label>
                        <input type="number" id="product_price" name="product_price" value="<?php echo $productPrice; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_image">Product Image:</label>
                        <img class="product-image" src="../assests/images/<?php echo $productImage; ?>" alt="Product Image">
                        <input type="file" id="product_image" name="product_image">
                    </div>
                    <button type="submit" class="btn" name="update_product">Save Changes</button>
                </form>
            </div>
        <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid product ID.";
    }
    ?>
</div>

<?php include('admin-foot.php'); ?>