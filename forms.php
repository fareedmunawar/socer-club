<?php
include('header.php');
include_once('db_connect.php'); // Include database connection here


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["register"])) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

      // Check if the email already exists
      $emailCheckSql = "SELECT * FROM users WHERE email='$email'";
      $emailCheckResult = $conn->query($emailCheckSql);

      if ($emailCheckResult->num_rows > 0) {
          echo "Email already registered.";
          // Set the email exists flag
          echo '<script>document.getElementById("emailExistsFlag").value = "1";</script>';
      } else {
          $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
          
          if ($conn->query($sql) === TRUE) {
              echo "User registered successfully.";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
  }

  elseif (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          if (password_verify($password, $row["password"])) {
              $_SESSION["user_id"] = $row["id"]; // Store user ID in session
              $_SESSION["user_name"] = $row["name"]; // Store user name in session
              header("Location: index.php"); // Redirect to dashboard or another page
          } else {
              echo "Invalid password.";
          }
      } else {
          echo "User not found.";
      }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assests/css/form.css">
</head>
<body >
    <div class="login-page" style="display:flex; align-items:center; justify-content:center;">
        <div class="form">
        <form class="register-form" method="POST" onsubmit="return validateForm()">
              <h2>Register</h2>
              <input type="text" name="name" placeholder="Full Name *" required/>
              <input type="email" name="email" placeholder="Email *" required/>
              <input type="password" id="password" name="password" placeholder="Password *" required/>
              <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password *" required/>
              <input type="hidden" name="email_exists" id="emailExistsFlag" value="0">
              <button type="submit" class="btn" name="register" id="registerButton">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  Create
              </button>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
          </form>

            <form class="login-form" method="POST">
                <h2>Login</h2>
                <input type="text" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required/>
                <button type="submit" class="btn" name="login">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Sign In
                </button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
            </form>
        </div>
    </div>
    <script>
function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assests/js/form.js"></script>

<?php include ('footer.php'); ?>