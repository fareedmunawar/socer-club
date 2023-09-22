<?php
session_start();
include('db_connect.php'); // Include your database connection file

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch admin data from the database
    $query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Successful login, set session variables
            $_SESSION['authenticated'] = true;
            $_SESSION['email'] = $email;

            // Redirect to dashboard or any other page
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Admin not found.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Admin - Dashboard HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<div>
    <nav class="navbar navbar-expand-xl">
        <!-- Your navigation code goes here -->
    </nav>
</div>

<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-12 mx-auto tm-login-col">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="tm-block-title mb-4">Welcome to Dashboard, Login</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                       
                        <form action="" method="post" class="tm-login-form">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    name="email"
                                    type="email"
                                    class="form-control validate"
                                    id="email"
                                    value=""
                                    required
                                />
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input
                                    name="password"
                                    type="password"
                                    class="form-control validate"
                                    id="password"
                                    value=""
                                    required
                                />
                            </div>
                            <div class="form-group mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block text-uppercase"
                                    name="login"
                                >
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

