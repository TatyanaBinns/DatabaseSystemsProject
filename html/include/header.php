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
	<style>
		.sea-nav-link{
			padding: .5rem;
			font-weight: 700;
			background-color: transparent;
			border-bottom: .25rem solid transparent;
			color: #808080;
		}
		.sea-nav-link:hover{
			border-bottom-color: rgba(100, 100, 100, .25);
			color: #555;
			text-decoration: none;
		}
		.sea-nav-active{
			color: #000;
			border-bottom-color: rgba(255, 255, 255, .75);
		}
		.sea-nav-active:hover{
			color: #555;
			border-bottom-color: rgba(100, 100, 100, .25);
		}
	</style>
    <title><?php echo $title ?></title>
  </head>
  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-light border-bottom shadow-sm">
      <nav class="my-0 mr-md-auto font-weight-normal">
        <a class="sea-nav-link <?php if ($navitem == "homepage") echo "active";?>" href="index.php">Home Page</a>
        <a class="sea-nav-link <?php if ($navitem == "faq") echo "active";?>" href="faq.php">FAQ</a>
      </nav>
	  <div class="btn-group mr-2">
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
    </div>