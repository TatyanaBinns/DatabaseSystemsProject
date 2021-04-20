<?php
session_start();
function res($msg){
	header("location: manage_rso.php?result=$msg");
	exit();
}

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "addNewRSOMember"))
{
	$name = $_POST['new_member'];
	$orgId = $_POST['orgId'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';

	$stmt = mysqli_prepare($dbconn, 
		   "INSERT INTO Membership
			(UserID, OrgID, Accepted)
			VALUES (?, ?, 0);");
	mysqli_stmt_bind_param($stmt, "ii", $name, $orgId);
	mysqli_stmt_execute($stmt);

	res("success");
}
else 
	res("invalid");
?>