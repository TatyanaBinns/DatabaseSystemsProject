<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/include/sql.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/lib/bootstrap.min.css">
    <meta name="Description" content="<?php echo $descr ?>">

    <title><?php echo $title ?></title>
  </head>
  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <nav class="my-0 mr-md-auto font-weight-normal">
        <a class="p-2 text-dark" href="#">Home Page</a>
        <a class="p-2 text-dark" href="#">Events</a>
      </nav>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">My Dashboard</a>
        <a class="p-2 text-dark" href="#">My Profile</a>
      </nav>
	  <?php
          if (isset($_SESSION["fname"]))
          {
            echo "<a class='btn btn-outline-primary' href='profile.php'>Profile</a>";
            echo "<a class='btn btn-outline-primary' href='logout.form.php'>Logout</a>";
          }
          else 
          {
            echo "<a class='btn btn-outline-primary' href='register.php'>Register</a>";
            echo "<a class='btn btn-outline-primary' href='login.php'>Log in</a>";
          }
        ?>
    </div>