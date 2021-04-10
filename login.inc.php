<?php

if (isset($_POST["loginUser"]))
{
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //catch any sort of errors 

    // if its true then there was an error inside the code
    // if false then there was no erros inside the code

    if (emptyInputsLogin($email, $password_1) !== false )
    {
        header("location: login.php?error=emptyinput");
        exit();
    }


    //login user
    loginUser($conn, $email, $password_1);


}
else 
{
    header("location: login.php");
    exit();
}