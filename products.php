  <?php include('header.php'); ?>

  <link rel="stylesheet" href="assests/css/accesories.css">
  <style>
    /* ... your existing CSS rules ... */
  </style>



<div class="hero overlay" style="background-image: url('assests/images/bg_3.jpg'); height:600px!important;">
    <div class="container" style="height:500px!important;">
        <div class="row align-items-center">
            <div class="col-lg-5 ml-auto">
                <h1 class="text-white">World Cup Event</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, molestias repudiandae pariatur.</p>
                <div id="date-countdown"></div>
            </div>
        </div>
    </div>
</div>

<div class="categories">
    <a href="?category=all" class="category-link category-button btn"> <!-- Add the "btn" class -->
        <span></span> <!-- Add the required spans for animation -->
        <span></span>
        <span></span>
        <span></span>
        All
    </a>
    <?php
    include_once('db_connect.php');

    // Fetch distinct categories from the database
    $categoryQuery = "SELECT DISTINCT category FROM products";
    $categoryResult = $conn->query($categoryQuery);

    if ($categoryResult->num_rows > 0) {
        while ($categoryRow = $categoryResult->fetch_assoc()) {
            $categoryName = $categoryRow["category"];
            echo '<a href="?category=' . urlencode($categoryName) . '" class="category-link category-button btn">';
            echo '<span></span>';
            echo '<span></span>';
            echo '<span></span>';
            echo '<span></span>';
            echo $categoryName . '</a>';
        }
    }
    ?>
</div>


</div>


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
                <img class="product-image" src="assests/images/<?php echo $productImage; ?>" alt="Product Image">
                <h2 class="product-title"><?php echo $productName; ?></h2>
                <p class="product-price">$<?php echo $productPrice; ?></p>
                <button class=" add-to-cart-button" onclick="openModal(<?php echo $productPrice; ?>)">Add to Cart</button>
                <button class="wishlist-button"><span class="heart-icon">❤️</span> Add to Wishlist</button>
            </div>
    <?php
        }
    } else {
        echo "No products found.";
    }
    ?>
</div>

  <!-- Modal -->
  <div id="cartModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-product-image" src="assests/images/<?php echo $productImage; ?>" alt="Product Image">
      <p class="modal-product-title"><?php echo $productName; ?></p>
      <p class="modal-product-price">$<?php echo $productPrice; ?></p> 
      <div class="quantity-container">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" value="1" min="1" onchange="updateTotalPrice(229)">
      </div>
      <p class="total-price">Total Price: $XX.XX</p>
      <button class="buy-now-button" onclick="buyNow()">Buy Now</button>
    </div>
  </div>

  <script>
    function openModal(price) {
      var modal = document.getElementById('cartModal');
      modal.style.display = 'block';

      // Set the price in the modal
      document.querySelector('.modal-product-price').textContent = "$" + price.toFixed(2);

      // Reset quantity and total price when modal is opened
      document.getElementById('quantity').value = 1;
      updateTotalPrice(price);
    }

    function closeModal() {
      var modal = document.getElementById('cartModal');
      modal.style.display = 'none';
    }

    function updateTotalPrice(price) {
      var quantity = parseInt(document.getElementById('quantity').value);
      var total = quantity * price;
      document.querySelector('.total-price').textContent = "Total Price: $" + total.toFixed(2);
    }

    function buyNow() {
      var quantity = parseInt(document.getElementById('quantity').value);
      var price = parseFloat("229"); // Use the actual price from the card
      var total = quantity * price;

      // Perform the actual "Buy Now" action here, such as redirecting to a checkout page or performing payment processing

      closeModal(); // Close the modal after performing the action
    }
  </script>

  <?php include ('footer.php');
  $conn->close(); ?>

