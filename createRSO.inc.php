<?php



    if (isset($_POST["createRSO"]))
    {
        $rsoname = $_POST['rso_name'];
        $adminemail = $_POST['admin_email'];
        $mem1 = $_POST['email_1'];
        $mem2 = $_POST['email_2'];
        $mem3 = $_POST['email_3'];
        $mem4 = $_POST['email_4'];
        $mem5 = $_POST['email_5'];
        $uniID = $_POST['university_id'];


        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';


        if (emptyInputsRSO($rsoname, $adminemail, $mem1, $mem2, $mem3, $mem4, $mem5, $uniID) !== false )
        {
            header("location: createRSO.php?error=emptyinput");
            exit();
        }

        // if (invalidEmailDomain($email) !== false)
        // {
        //     header("location: createRSO.php?error=invalidemaildomain");
        //     exit();
        // }

        createRSO($conn, $rsoname, $adminemail, $mem1, $mem2, $mem3, $mem4, $mem5, $uniID);
    }
    else
    {
        header("location: createRSO.php");
        exit();
    }


