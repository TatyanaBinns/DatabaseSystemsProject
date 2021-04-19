<?php 
function emptyInputsRegister($fname, $lname, $email, $phone, $password_1, $password_2)
{
	return empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($password_1) || empty($password_2);
}

function invalidEmail($email)
{
	return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pwdMatch($password_1, $password_2)
{
	return $password_1 !== $password_2;
}

function emailExists($conn, $email)
{
    $sql = "SELECT * FROM Users WHERE Email = ?;";

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
	$row = mysqli_fetch_assoc($resultData);
	
    mysqli_stmt_close($stmt);
    if ($row)
        return $row;
    else 
    	return false;
}

function getUniversityMatching($conn, $email){
	$sql = "SELECT UniversityID FROM University WHERE `Domain` = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql))
		return;
	
	mysqli_stmt_bind_param($stmt, "s", explode('@', $email)[1]);
	
	mysqli_stmt_execute($stmt);

	$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
	
	if($data)
		return $data['UniversityID'];
	else
		return "";

}

function createUser($conn, $fname, $lname, $email, $phone, $password_1)
{
    $sql = "INSERT INTO Users (FirstName, LastName, Email, PasswordHash, PhoneNumber) VALUES (?, ?, ?, ?, ?);";

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
    
    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $hashedPwd,  $phone);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
	
	$uid = getUserIdFromEmail($conn, $email);
	addRole($conn, $uid, "Public");
	$uni = getUniversityMatching($conn, $email);
	
	if($uni){
		addRole($conn, $uid, "Student");
		$stmt = mysqli_stmt_init($conn); // this makes code more secure

		// check for any mistakes before running sql code 
		if (mysqli_stmt_prepare($stmt, "UPDATE Users SET UniversityID=? WHERE UserID=?;")){
			mysqli_stmt_bind_param($stmt, "ii", $uni, $uid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}

    header("location: register.php?error=none");
    exit();
}

function emptyInputsLogin($email, $password_1)
{
	return empty($email) || empty($password_1);
}

function getUserIdFromEmail($conn, $email){
	$sql = "SELECT * FROM Users WHERE Email = ?;";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
		return;
		
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // if theres is info in the data base with this email grab data 
    // assigns data to var row
	$row = mysqli_fetch_assoc($resultData);
	
    mysqli_stmt_close($stmt);
    if ($row)
        return $row['UserID'];
    else 
    	return false;
}

function addRole($conn, $userid, $role){
	$sql = "INSERT INTO Roles (RoleType, UserID) VALUES (?, ?);";

    // prevents the user from entering malicious code into the registration form
    // prevents code injection
    $stmt = mysqli_stmt_init($conn); // this makes code more secure

    // check for any mistakes before running sql code 
    if (!mysqli_stmt_prepare($stmt, $sql))
		return;
    
    mysqli_stmt_bind_param($stmt, "si", $role, $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function loginUser($conn, $email, $password_1)
{
    $userdata = emailExists($conn, $email);

    // if false the email is not in the database 
    if($userdata === false)
    {
        header("location: login.php?error=wrongcredentials");
        exit();
    }

    // now check the pwd if email is in databse 
    //if match return true else false
    if (!password_verify($password_1, $userdata["PasswordHash"]))
    {
        header("location: login.php?error=wrongcredentials");
        exit();
    }
    else
    {
        session_start();

        $_SESSION["userid"] = $userdata["UserID"];
        $_SESSION["fname"] = $userdata["FirstName"];
        $_SESSION["uniId"] = $userdata["UniversityID"];

        header("location: login.php?error=none");
        exit();
    }
}