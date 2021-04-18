<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
function printError($message, $type){
	echo '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
			'.$message.'
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/lib/bootstrap.min.css">
    <link rel="stylesheet" href="/shared/sea.css">
    <meta name="Description" content="<?php echo $descr ?>">
    <title><?php echo $title ?></title>
  </head>
  <body class='sea-body'>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 sea-nav border-bottom shadow-sm">
      <nav class="my-0 mr-md-auto font-weight-normal">
        <a class="sea-nav-link <?php if ($navitem == "homepage") echo "active";?>" href="index.php">Home Page</a>
        <a class="sea-nav-link <?php if ($navitem == "faq") echo "active";?>" href="faq.php">FAQ</a>
      </nav>
	  <div class="btn-group mr-2">
	  <?php
          if (isset($_SESSION["fname"]))
          {
            echo "<a class='btn btn-outline-secondary sea-enboldener' href='profile.php'>Profile</a>";
            echo "<a class='btn btn-outline-secondary sea-enboldener' href='logout.form.php'>Logout</a>";
          }
          else 
          {
            echo "<a class='btn btn-outline-secondary sea-enboldener ' href='register.php'>Register</a>";
            echo "<a class='btn btn-outline-secondary sea-enboldener' href='login.php'>Login</a>";
          }
        ?>
	  </div>
    </div>