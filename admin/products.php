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
        width: 200px;
        height: 300px;
        max-width: 200px;
        max-height: 300px;
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
</style>
<div class="card-container container-fluid">
    <?php
    include_once('db_connect.php');

    // Get the selected category from the URL parameter
    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

    // Fetch products from the database based on the selected category
    if ($selectedCategory == 'all') {
        $sql = "SELECT * FROM products";
    } else {
        $sql = "SELECT * FROM products WHERE category = '$selectedCategory'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productId = $row["id"];
            $productName = $row["name"];
            $productImage = $row["image"];
            $productPrice = $row["price"];
    ?>
            <div class="product-card">
                <img class="product-image" src="../assests/images/<?php echo $productImage; ?>" alt="Product Image">
                <h2 class="product-title"><?php echo $productName; ?></h2>
                <p class="product-price">$<?php echo $productPrice; ?></p>
                <form action="delete-product.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <button type="submit" class="btn" name="delete_product">Delete</button>
                </form>
                <a class="btn" href="edit-product.php?id=<?php echo $productId; ?>">Edit</a>
            </div>
    <?php
        }
    } else {
        echo "No products found.";
    }
    ?>
</div>
<?php include('admin-foot.php'); ?>