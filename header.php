<?php

if (!isset($_SESSION)) {
  session_start();
}
require_once "classes/customer.php";
if (isset($_SESSION['username'])) {
  $customer = Customer::retrieve_by_username($_SESSION['username']);
  $name = $customer['first_name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Booktive</a>
    <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" type="text" name="searchtext" placeholder="Search.." aria-label="Search">
      <button class="btn" style="display:none;" type="submit">Search...</button>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-home"></i> &nbsp; Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="events.php"><i class="fas fa-glass-martini-alt"></i>&nbsp; Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="books.php"><i class="fas fa-book"></i>&nbsp;Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i>&nbsp;Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="wishlist.php"><i class="fas fa-heart"></i>&nbsp;WishList</a>
        </li>

        <?php
        if (isset($_SESSION['customer'])) {
          echo '
                 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-alt"></i>&nbsp;'
            . $name . '
        </a>
        <div class=" dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="editprofile.php">Edit Profile</a>
          <a class="dropdown-item" href="changepass.php">Change Password</a>
      </li>
       <li class="nav-item">
                 <a class="nav-link" href="signout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Sign Out</a></li>';
        } else {
          echo '<li class="nav-item">
                <a class="nav-link" href="signin.php"><i class="fas fa-sign-in-alt"></i>&nbsp;Sign In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.php"><i class="fas fa-user-plus"></i>&nbsp;Sign Up</a>
              </li>';
        }

        ?>

      </ul>

    </div>
  </nav>