<?php
$title="Events - Login";
$descr="Events Login Page";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>
<div class="container col-md-4 text-center">
		<form class="form-signin" action="login.form.php" method= "post">
		  <h1 class="h2 mb-3 font-weight-normal">School Event App</h1>
<?php
    //$_GET[]  something you can see in the url
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "emptyinput")
            printError("<p id='err'>Please fill in all the fields!", "secondary");
        else if ($_GET["error"] == "wrongcredentials")
            printError("Invalid credentials!", "warning");
        else if ($_GET["error"] == "none")
            printError("Log-in Complete!", "success");
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
	writeInput("inputEmail", "Email Address", "email", "email", "sea-square-top");
	writeInput("password", "Password", "password_1", "password", "sea-square-bot");
  ?>
		  <input type="hidden" name="actionType" value="registerUser">
		  <button class="btn btn-lg btn-primary btn-block" type="submit">Login!</button>
		  <p class="mt-5 mb-3">Need an account? <a href="register.php">Register!</a></p>
		</form>
    </div>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>