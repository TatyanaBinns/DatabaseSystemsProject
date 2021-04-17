<?php

if (isset($_POST["loginUser"]))
{

    if (isset($_POST["search_rso"]))
    {
        $rso_name = $_POST['rso_name'];


        require_once 'dbh.inc.php';

        retrieveRSO($conn);


    }
    else
    {
        header("location: joinRSO.php");
        exit();
    }
}
else
{
    header("location: login.php");
    exit();
}