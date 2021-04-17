<?php 

function emptyInputsRegister($fname, $lname, $email, $phone, $universityid, $password_1, $password_2)
{
    $result;

    if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($universityid) || empty($password_1) || empty($password_2))
    {
        $result = true;
    }

    else 
    {
        $result = false;
    }

    return $result;
}



function invalidEmail($email)
{
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }

    else 
    {
        $result = false;
    }

    return $result;
}


function pwdMatch($password_1, $password_2)
{
    $result;

    if ($password_1 !== $password_2)
    {
        $result = true;
    }

    else 
    {
        $result = false;
    }

    return $result;
}



function emailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE Email = ?;";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: register.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);


    // if theres is info in the data base with this email grab data 
    // assigns data to var row
    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else 
    {
        $result = false;

        return $result;
    }

    mysqli_stmt_close($stmt);

}




function createUser($conn, $fname, $lname, $email, $phone, $universityid, $password_1)
{
    $sql = "INSERT INTO users (FirstName, LastName, Email, PasswordHash, PhoneNumber, UniversityID) VALUES (?, ?, ?, ?, ?, ?);";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: register.php?error=stmtfailed");
        exit();
    }

    // hash password
    $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $email, $hashedPwd,  $phone, $universityid);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: register.php?error=none");
    exit();



}


function emptyInputsLogin($email, $password_1)
{
    $result;

    if (empty($email) || empty($password_1))
    {
        $result = true;
    }

    else 
    {
        $result = false;
    }

    return $result;

}



function loginUser($conn, $email, $password_1)
{
    $emailExists = emailExists($conn, $email);

    // if false the email is not in the database 
    if($emailExists === false)
    {
        header("location: login.php?error=wrongcredentials");
        exit();
    }

    // now check the pwd if emai is in databse 
    $pwdHashed = $emailExists["PasswordHash"];

    //if match return true else false
    $checkPwd = password_verify($password_1, $pwdHashed);

    if ($checkPwd === false )
    {
        header("location: login.php?error=wrongcredentials");
        exit();
    }
    else if ($checkPwd === true)
    {
        session_start();

        $_SESSION["userid"] = $emailExists["UserID"];
        $_SESSION["fname"] = $emailExists["FirstName"];
        $_SESSION["email"] = $emailExists["Email"];

        header("location: index.php");
        exit();
        
    }

}

// createRSO
function emptyInputsRSO($rsoname, $adminemail, $mem1, $mem2, $mem3, $mem4, $mem5, $uniID)
{
    $result;

    if (empty($rsoname) || empty($adminemail) || empty($mem1) || empty($mem2) || empty($mem3) || empty($mem4) || empty($mem5) || empty($uniID))
    {
        $result = true;
    }

    else 
    {
        $result = false;
    }

    return $result;
}

function invalidEmailDomain($email)
{
    // idk
    $result;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }

    else 
    {
        $result = false;
    }

    return $result;
}

function createRSO($conn, $rsoname, $adminemail, $mem1, $mem2, $mem3, $mem4, $mem5, $uniID)
{
    $sql = "INSERT INTO rso (rsoName, universityID, adEmail) VALUES (?, ?, ?);";
    $sql_2 = "INSERT INTO rso_members (rsoName, membEmail) VALUES (?, ?);";

    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createRSO.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $rsoname, $uniID, $adminemail);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql_2))
    {
        header("location: createRSO.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $rsoname, $mem1);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_param($stmt, "ss", $rsoname, $mem2);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_param($stmt, "ss", $rsoname, $mem3);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_param($stmt, "ss", $rsoname, $mem4);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_param($stmt, "ss", $rsoname, $mem5);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: createRSO.php?error=none");
    exit();
}

function checkIfAdmin($conn, $email)
{
    $sql = "SELECT * FROM admins WHERE Email = ?;";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: index.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result($stmt);


    // if theres is info in the data base with this email grab data 
    // assigns data to var row
    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else 
    {
        $result = false;

        return $result;
    }

    mysqli_stmt_close($stmt);

}



// create event
function createEvent($conn, $ename, $ecategory, $edescription, $etime, $edate, $ecnumber, $ecemail, $etype)
{
    $sql = "INSERT INTO events (eName, eCategory, eDescription, eTime, eDate, eContctNumber, eContctEmail, eType) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createEvents.php?error=stmtfailed");
        exit();
    }

    
    mysqli_stmt_bind_param($stmt, "ssssssss", $ename, $ecategory, $edescription, $etime, $edate, $ecnumber, $ecemail, $etype);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: register.php?error=none");
    exit();

}

