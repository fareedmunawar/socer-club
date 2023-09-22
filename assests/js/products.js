    // Create an array of products with their details
    var products = [
        { category: 'men', name: 'Product Name 1', price: 229, image: 'assests/images/person_1.jpg' },
        { category: 'women', name: 'Product Name 2', price: 199, image: 'assests/images/person_2.jpg' },
        { category: 'kids', name: 'Product Name 3', price: 149, image: 'assests/images/person_3.jpg' },
        // Add more products as needed
    ];
    
    // Function to filter and display product cards based on the selected category
    function filterProducts(category) {
        var productCardContainer = document.getElementById('productCardContainer');
        productCardContainer.innerHTML = ''; // Clear existing product cards
    
        if (category === 'all') {
        // Show all products
        products.forEach(function (product) {
            createProductCard(product);
        });
        } else {
        // Show products based on the selected category
        products.forEach(function (product) {
            if (product.category === category) {
            createProductCard(product);
            }
        });
        }
    }
    
    // Function to create a product card element
    function createProductCard(product) {
        var productCard = document.createElement('div');
        productCard.classList.add('product-card');
        
        // Build the product card HTML content
        var productImage = document.createElement('img');
        productImage.classList.add('product-image');
        productImage.src = product.image;
        productImage.alt = 'Product Image';
        
        var productTitle = document.createElement('h2');
        productTitle.classList.add('product-title');
        productTitle.textContent = product.name;
        
        var productPrice = document.createElement('p');
        productPrice.classList.add('product-price');
        productPrice.textContent = '$' + product.price;
        
        var addToCartButton = document.createElement('button');
        addToCartButton.classList.add('add-to-cart-button');
        addToCartButton.textContent = 'Add to Cart';
        addToCartButton.onclick = function () {
        openModal(product.price);
        };
        
        var wishlistButton = document.createElement('button');
        wishlistButton.classList.add('wishlist-button');
        wishlistButton.innerHTML = '<span class="heart-icon">❤️</span> Add to Wishlist';
        
        // Append elements to the product card
        productCard.appendChild(productImage);
        productCard.appendChild(productTitle);
        productCard.appendChild(productPrice);
        productCard.appendChild(addToCartButton);
        productCard.appendChild(wishlistButton);
        
        // Append the product card to the container
        var productCardContainer = document.getElementById('productCardContainer');
        productCardContainer.appendChild(productCard);
    }
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
    // Function to fetch products from the database API
async function fetchProducts() {
    try {
        const response = await fetch('/api/products'); // Replace with your API endpoint
        const products = await response.json();
        return products;
    } catch (error) {
        console.error('Error fetching products:', error);
        return [];
    }
}

// Call fetchProducts and update product cards accordingly
async function updateProductCards(category) {
    const products = await fetchProducts();

    var productCardContainer = document.getElementById('productCardContainer');
    productCardContainer.innerHTML = ''; // Clear existing product cards

    if (category === 'all') {
        products.forEach(function (product) {
            createProductCard(product);
        });
    } else {
        products.forEach(function (product) {
            if (product.category === category) {
                createProductCard(product);
            }
        });
    }
}

// ... rest of the code remains the same ...
