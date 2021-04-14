<?php
$title="Events - Login";
$descr="Events Login Page";
include $_SERVER['DOCUMENT_ROOT'].'/include/header.php';
?>

<body style="background-color:#adb5bd;">


<div class = "container">
	<div class = "header mt-5">
			<h2 class="display-5 text-center text-light">Log in</h2>
			<p></p>
			<p></p>   
	</div>
</div>


<div class = "container mt-5">


    <form action="login.inc.php" method= "post">


        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email" aria-label="Email" name = "email" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" name = "password_1" required>   
        </div>
        </div>


        <div class="row mb-3 text-center">
        <div class="col">
            <button type="submit" name="loginUser" class="btn btn-danger col-6 mt-3"> Log in </button>
            </div>
        </div>

        <div class="row mb-3 text-center">
            <p class="text-light">Not a user?<a href= "register.php"><b>  Register Here</b></a></p>
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
        {
            echo "<p id='err'>Fill in all fields!</p>";
        }
        else if ($_GET["error"] == "wrongcredentials")
        {
            echo "<p id='err'>Wrong credentials!</p>";
        }
        else if ($_GET["error"] == "none")
        {
            echo "<p id='ok'>Registration complete!</p>";
        }
    }
?>


<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php';
?>