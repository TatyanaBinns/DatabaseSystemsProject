<?php 
    include_once 'header.php';
?>

<body style="background-color:#adb5bd;">

<style>
body {
  background-image: url('bg3.jpg');

  background-attachment: fixed;
  background-size: cover;
  background-color: transparent;

}
</style>

<div class = "container">
<div class = "header mt-5">
        <h2 class="display-5 text-center text-light">Register</h2>
               
</div>
</div>



<div class = "container mt-5">
    
    <form action= register.inc.php method= "post">

        <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="First name" aria-label="First name" name = "fname" required>   
        </div>

        <div class="col">
            <input type = "text" name = "lname" class="form-control" placeholder="Last name" aria-label="Last name" required>
        </div>

        </div>

        <div class="row mb-3">

        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email" aria-label="Email" name = "email" required>   
        </div>

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
        {
            echo "<p id='err'>Fill in all fields!</p>";
        }
        else if ($_GET["error"] == "invalidemail")
        {
            echo "<p id='err'>Choose a proper email!</p>";
        }
        else if ($_GET["error"] == "pwdsdontmatch")
        {
            echo "<p id='err'>Passwords doesn't match!</p>";
        }
        else if ($_GET["error"] == "emailexists")
        {
            echo "<p id='err'>Email already exists!</p>";
        }
        else if ($_GET["error"] == "stmtfailed")
        {
            echo "<p id='err'>Something went wrong, try again!</p>";
        }
        else if ($_GET["error"] == "none")
        {
            echo "<p id='ok'>Registration complete!</p>";
        }
    }


?>


<?php 
    include_once 'footer.php';
?>

