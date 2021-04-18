<?php
if (isset($_POST["actionType"]) && ($_POST["actionType"] == "registerUser"))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';
	
    //catch any sort of errors 

    // if its true then there was an error inside the code
    // if false then there was no erros inside the code

    if (emptyInputsRegister($fname, $lname, $email, $phone, $password_1, $password_2))
    {
        header("location: register.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email))
    {
        header("location: register.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($password_1, $password_2))
    {
        header("location: register.php?error=pwdsdontmatch");
        exit();
    }

    if (emailExists($dbconn, $email))
    {
        header("location: register.php?error=emailexists");
        exit();
    }


    // maybe add more errors????????

    

    // if no errors are found create user 
    createUser($dbconn, $fname, $lname, $email, $phone, $password_1);


}
else
{
    //header("location: register.php");
    //exit();
}