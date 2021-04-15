<?php
$title="Events - Register Account";
$descr="School Event Application User Registration Page";
include $_SERVER['DOCUMENT_ROOT'].'/include/header.php';
?>

		<form class="form-signin" action="register.form.php" method= "post">
		  <h1 class="h3 mb-3 font-weight-normal">School Event App</h1>
		  <h1 class="h3 mb-3 font-weight-normal">Register an Account</h1>
  <?php 
    // id must be unique
	// placeholder is what will be displayed
	// name is what is passed to the target form
	// type is what the input type will be set as
    function writeInput($id, $placeholder, $name, $type){
		echo '
		    <label for="$id" class="sr-only">$placeholder</label>
			<input type="$type" id="$id" class="form-control" placeholder="$placeholder" name="$name" required autofocus>';
	}
	writeInput("firstName", "First Name", "fname", "text");
	writeInput("lastName", "Last Name", "lname", "text");
	writeInput("inputEmail", "Email Address", "email", "email");
	writeInput("inputPhone", "Phone Number", "phone", "text");
	writeInput("password", "Password", "password_1", "password");
	writeInput("password_2", "Confirm Password", "password_2", "password");
	//TO DO: Confirm the passwords are the same

	);
  ?>
		  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		  <p class="mt-5 mb-3">Already a user? <a href="login.php">Login!</a></p>
		</form>

        <div class="col-md-6">
            <input type = "text" name = "phone" class="form-control" placeholder="Phone Number" aria-label="Phone Number" required>
        </div>

        </div>


        <div class="row mb-3">

        <div class="col">
            <input type="password" class="form-control" placeholder="Password" aria-label="Email" name = "password_1" required>   
        </div>

        <div class="col">
            <input type = "password" name = "password_2" class="form-control" placeholder="Comfirm Password" aria-label="Comfirm Password" required>
        </div>

        </div>


        <div class="row mb-3 text-center">

        <div class="col-6">
            <input type="number" class="form-control" placeholder="University ID" aria-label="University ID" name = "universityID" required>   
        </div>

        </div>


        <div class="row mb-3 text-center">
        <div class="col">
            <button type="submit" name="registerUser" class="btn btn-danger col-6 mt-3"> Register </button>
        </div>
        </div>
        

        <div class="row mb-3 text-center">
        <p class="text-light">Already a user?<a href= "login.php"><b>     Log in</b></a></p>
        </div>

        

    </form>

</div>

<style>
#err {
    align: center;
    color: red;
    font-size: 150%;
    text-align: center;

}

#ok {
    align: center;
    color: green;
    font-size: 150%;
    text-align: center;

}
</style>

<?php 
    //$_GET[]  something you can see in the url
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "emptyinput")
            echo "<p id='err'>Fill in all fields!</p>";
        else if ($_GET["error"] == "invalidemail")
            echo "<p id='err'>Choose a proper email!</p>";
        else if ($_GET["error"] == "pwdsdontmatch")
            echo "<p id='err'>Passwords doesn't match!</p>";
        else if ($_GET["error"] == "emailexists")
            echo "<p id='err'>Email already exists!</p>";
        else if ($_GET["error"] == "stmtfailed")
            echo "<p id='err'>Something went wrong, try again!</p>";
        else if ($_GET["error"] == "none")
            echo "<p id='ok'>Registration complete!</p>";
    }
?>


<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php';
?>

