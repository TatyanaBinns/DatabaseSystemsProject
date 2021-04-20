<?php
session_start();
function res($msg){
	header("location: create_rso.php?result=$msg");
	exit();
}

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "createRSO"))
{
	$name = $_POST['name'];
	$description = $_POST['description'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';

	try{
		mysqli_begin_transaction ($dbconn);
		$stmt = mysqli_prepare($dbconn, 
			   "INSERT INTO RStudentOrg
				(AdminUserID, UniversityID, Name, Description)
				VALUES(?, ?, ?, ?);");
		mysqli_stmt_bind_param($stmt, "iiss", $_SESSION['userid'], $_SESSION['uniId'], $name, $description);
		mysqli_stmt_execute($stmt);

		$stmt = mysqli_prepare($dbconn, 
			   "INSERT INTO Membership
				(UserID, OrgID, Accepted)
				VALUES (?, LAST_INSERT_ID(), 1);");
		mysqli_stmt_bind_param($stmt, "i", $_SESSION['userid']);
		mysqli_stmt_execute($stmt);
		
		mysqli_commit($dbconn);
	} catch (mysqli_sql_exception $exception){
		mysqli_rollback($dbconn);
		res("internalerror");
	}
	res("success");
}
else 
	res("invalid");
?>