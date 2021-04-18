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
function getName($conn){
	if(!isset($_SESSION["userid"]))
		return "";
	$sql = "SELECT FirstName,LastName FROM Users WHERE UserID = ?;";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: register.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // if theres is info in the data base with this email grab data 
    // assigns data to var row
	$row = mysqli_fetch_assoc($resultData);
	
    mysqli_stmt_close($stmt);
    
	return $row["FirstName"]." ".$row["LastName"];
}
function hasRole($conn, $role){
	$stmt = mysqli_stmt_init($conn); // this makes code more secure
	// check for any mistakes before running sql code 
	if (mysqli_stmt_prepare($stmt, 
	       "SELECT IF(COUNT(RoleType) > 0, 'true', 'false') AS hasRole
			FROM Roles r
			WHERE r.UserID = ?
			AND r.RoleType = ?;")){
		mysqli_stmt_bind_param($stmt, "is", $_SESSION["userid"], $role);
		mysqli_stmt_execute($stmt);
		$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
		mysqli_stmt_close($stmt);
		return $row["hasRole"] == "true";
	}
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
	  <?php
		if(isset($_SESSION["fname"])){
			echo '<div class="sea-username">'.getName($dbconn)."</div>";
		}
	  ?>
	  <?php
          if (isset($_SESSION["fname"]))
          {
			echo '<div class="btn-group mr-2">';
			if(hasRole($dbconn, "Admin"))
				echo "<a class='btn btn-outline-secondary sea-enboldener' href='create_event.php'>Create Event</a>";
			if(hasRole($dbconn, "SuperAdmin"))
				echo "<a class='btn btn-outline-secondary sea-enboldener' href='create_university.php'>Create University</a>";
			if(hasRole($dbconn, "Student"))
				echo "<a class='btn btn-outline-secondary sea-enboldener' href='create_rso.php'>Create Student Org</a>";
			echo '</div>';
			
			echo '<div class="btn-group mr-2">';
			if(hasRole($dbconn, "ApplicationAdmin"))
				echo "<a class='btn btn-outline-secondary sea-enboldener' href='manage_users.php'>Manage Users</a>";
            echo "<a class='btn btn-outline-secondary sea-enboldener' href='logout.form.php'>Logout</a>";
			echo '</div>';
          }
          else 
          {
			echo '<div class="btn-group mr-2">';
            echo "<a class='btn btn-outline-secondary sea-enboldener ' href='register.php'>Register</a>";
            echo "<a class='btn btn-outline-secondary sea-enboldener' href='login.php'>Login</a>";
			echo '</div>';
          }
        ?>
    </div>