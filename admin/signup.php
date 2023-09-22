<?php include('admin-head.php'); ?>
<?php
include_once('db_connect.php'); // Include your database connection file

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $insertQuery = "INSERT INTO admins (email, password) VALUES ('$email', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "User registered successfully.";
        } else {
            echo "Error registering user: " . $conn->error;
        }
    }
}
?>

<!-- Include your HTML and styling for the signup page here -->





<style>
    /* Your existing styling here */
</style>

<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-12 mx-auto tm-login-col">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="tm-block-title mb-4">Sign Up</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <form action="signup.php" method="post" class="tm-login-form">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    name="email"
                                    type="email"
                                    class="form-control validate"
                                    id="email"
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
                                    required
                                />
                            </div>
                            <div class="form-group mt-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input
                                    name="confirm_password"
                                    type="password"
                                    class="form-control validate"
                                    id="confirm_password"
                                    required
                                />
                            </div>
                            <div class="form-group mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block text-uppercase"
                                    name="signup"
                                >
                                    Sign Up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('admin-foot.php'); ?>
