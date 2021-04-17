<?php

if (isset($_POST["createEvent"]))
{
    $ename = $_POST['event_name'];
    $ecategory = $_POST['event_category'];
    $edescription = $_POST['event_description'];
    $etime = $_POST['event_time'];
    $edate = $_POST['event_date'];
    $ecnumber = $_POST['event_cont_num'];
    $ecemail = $_POST['event_cont_email'];
    $etype = $_POST['event_type'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $admin = checkIfAdmin($conn, $_SESSION["email"]);

    if ($admin === false)
    {
        header("location: index.php?error=notadminuser");
        exit();
    }

    if (emptyInputsRegister($ename, $ecategory, $edescription, $etime, $edate, $ecnumber, $ecemail, $etype) !== false )
    {
        header("location: createEvent.php?error=emptyinput");
        exit();
    }


    // if no errors are found create user 
    createEvent($conn, $ename, $ecategory, $edescription, $etime, $edate, $ecnumber, $ecemail, $etype);



}
else
{
    header("location: index.php");
    exit();
}
