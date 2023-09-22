<?php include('admin-head.php');?>
    <title>Add Product Form</title>
    <style>
        body {
            
            font-family: Arial, sans-serif;
        }
        
        .container-products {
            
            max-width: 500px;
            margin: auto;
            color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .container h2 {
            text-align: center;
        }

       
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
        }

        .form-group button {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
<div class="container-products">
        <h2>Add Product</h2>
        <?php
        include_once('db_connect.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $category = $_POST["category"];
            $price = $_POST["price"];

            // Handle uploaded image
            $imageDirectory = "../assests/images/";
            $uploadedImage = $_FILES["image"]["name"];
            $targetPath = $imageDirectory . $uploadedImage;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                $sql = "INSERT INTO products (name, category, image, price) VALUES ('$name', '$category', '$uploadedImage', $price)";

                if ($conn->query($sql) === TRUE) {
                    echo "Product added successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading image.";
            }
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit">Add Product</button>
        </form>
    </div>
    <?php include('admin-foot.php');?>