<?php 
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>University Events</title>

    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php">University Events</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="index.php">Home</a>
        <?php
          if (isset($_SESSION["fname"]))
          {
            echo "<a class='nav-link' href='profile.php'>Profile</a>";
            echo "<a class='nav-link' href='logout.inc.php'>Logout</a>";
          }
          else 
          {
            echo "<a class='nav-link' href='register.php'>Register</a>";
            echo "<a class='nav-link' href='login.php'>Log in</a>";
          }
        ?>
        <!--<a class="nav-link" href="register.php">Register</a>
        <a class="nav-link" href="login.php">Log in</a> -->
      </div>
    </div>
  </div>
</nav>