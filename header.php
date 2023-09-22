<?php
include_once('db_connect.php');
session_start(); // Start a session to manage user login

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"]; // Store user ID in session
            header("Location: index.php"); // Redirect to dashboard or another page
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}

if (isset($_POST["logout"])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to homepage after logout
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Soccer &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assests/fonts/icomoon/style.css">

  <link rel="stylesheet" href="assests/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="assests/css/jquery-ui.css">
  <link rel="stylesheet" href="assests/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assests/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assests/css/owl.theme.default.min.css">

  <link rel="stylesheet" href="assests/css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="assests/css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="assests/fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="assests/css/aos.css">

  <link rel="stylesheet" href="assests/css/style.css">



</head>
<body>

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4" role="banner">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="site-logo" style="margin-left: -30px;margin-right: -30px;">
                <a href="index.php" >
                    <img src="assests/images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="ml-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="soccerinfo.php" class="nav-link">Soccer Info</a></li>
                <li><a href="products.php" class="nav-link">Accesories</a></li>
                <li><a href="matches.php" class="nav-link">Matches</a></li>
                <li><a href="players.php" class="nav-link">Players</a></li>
                <li><a href="index#top-scores" class="nav-link">Top Scores</a></li>
                <li><a href="news.php" class="nav-link">News & Updates</a></li>
                <?php if (isset($_SESSION["user_id"])) { ?>
                            <li class="nav-link" style="font-size:10px!important;color:white;">Hi,  <?php echo $_SESSION["user_name"]; ?></li>
                            <li>
                                <form method="post">
                                    <button type="submit" class="btn-sm btn-primary nav-link" style="font-size:10px!important;background-color: transparent; " name="logout">Logout</button>
                                </form>
                            </li>
                        <?php } else { ?>
                            <li><a href="forms.php" class="nav-link">Login / Signup</a></li>
                        <?php } ?>
                    </ul>
                </nav>
                <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white">
                    <span class="icon-menu h3 text-white"></span>
                </a>
            </div>
        </div>
    </div>
</header>
