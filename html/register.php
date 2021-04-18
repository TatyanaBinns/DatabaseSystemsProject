<?php
$title="Events - Register Account";
$descr="School Event Application User Registration Page";
$navitem="";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>
	<div class="container col-md-4 text-center">
		<form class="form-signin" action="register.form.php" method= "post">
		  <h1 class="h2 mb-3 font-weight-normal">School Event App</h1>
		  <h1 class="h4 mb-3 font-weight-normal">Register an Account</h1>
<?php 
    function printError($message){
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			    '.$message.'
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			    </button>
			  </div>';
	}
    //$_GET[]  something you can see in the url
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "emptyinput")
            printError("<p id='err'>Please fill in all the fields!");
        else if ($_GET["error"] == "invalidemail")
            printError("Please supply a proper email!");
        else if ($_GET["error"] == "pwdsdontmatch")
            printError("Error, Passwords doesn't match!");
        else if ($_GET["error"] == "emailexists")
            printError("Email already registered!");
        else if ($_GET["error"] == "stmtfailed")
            printError("Something went wrong, try again!");
        else if ($_GET["error"] == "none")
            printError("Registration complete! Sign in above!");
    }
?>
	<style>
		.sea-square-top{
			border-bottom-left-radius : 0;
			border-bottom-right-radius : 0;
		}
		.sea-square-bot{
			border-top-left-radius : 0;
			border-top-right-radius : 0;
		}
	</style>
  <?php 
    // id must be unique
	// placeholder is what will be displayed
	// name is what is passed to the target form
	// type is what the input type will be set as
    function writeInput($id, $placeholder, $name, $type, $xtraClasses){
		echo '
		  <label for="'.$id.'" class="sr-only">'.$placeholder.'</label>
		  <input type="'.$type.'" id="'.$id.'" class="form-control '.$xtraClasses.'" placeholder="'.$placeholder.'" name="'.$name.'" required autofocus>';
	}
	writeInput("firstName", "First Name", "fname", "text", "sea-square-top");
	writeInput("lastName", "Last Name", "lname", "text", "sea-square-bot");?>
		  <div>Use your university email to access events for that establishment!</div>
<?php
	writeInput("inputEmail", "Email Address", "email", "email", "sea-square-top");
	writeInput("inputPhone", "Phone Number", "phone", "text", "sea-square-top sea-square-bot");
	writeInput("password", "Password", "password_1", "password", "sea-square-top sea-square-bot");
	writeInput("password_2", "Confirm Password", "password_2", "password", "sea-square-bot");
  ?>
		  <input type="hidden" name="actionType" value="registerUser">
		  <button class="btn btn-lg btn-primary btn-block" type="submit">Register Account!</button>
		  <p class="mt-5 mb-3">Already a user? <a href="login.php">Login!</a></p>
		</form>
    </div>


<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>

