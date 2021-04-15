<?php

if (isset($_POST["registerUser"]))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $universityid = $_POST['universityID'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //catch any sort of errors 

    // if its true then there was an error inside the code
    // if false then there was no erros inside the code

    if (emptyInputsRegister($fname, $lname, $email, $phone, $universityid, $password_1, $password_2) !== false )
    {
        header("location: register.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false)
    {
        header("location: register.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($password_1, $password_2) !== false)
    {
        header("location: register.php?error=pwdsdontmatch");
        exit();
    }

    if (emailExists($conn, $email) !== false)
    {
        header("location: register.php?error=emailexists");
        exit();
    }


    // maybe add more errors????????

    

    // if no errors are found create user 
    createUser($conn, $fname, $lname, $email, $phone, $universityid, $password_1);


}
else
{
    header("location: register.php");
    exit();
}