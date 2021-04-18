<?php

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "loginUser"))
{
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';

    //catch any sort of errors 

    // if its true then there was an error inside the code
    // if false then there was no erros inside the code

    if (emptyInputsLogin($email, $password_1))
    {
        header("location: login.php?error=emptyinput");
        exit();
    }

    loginUser($dbconn, $email, $password_1);
}
else 
{
    header("location: login.php");
    exit();
}