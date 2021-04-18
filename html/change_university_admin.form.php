<?php
function res($msg){
	header("location: manage_university.php?result=$msg");
	exit();
}

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "changeUniversityAdmin"))
{
	$uniId = $_POST['universityId'];
	$uni_admin = $_POST['uni_admin'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';

    //catch any sort of errors 
	
	$sql = "UPDATE University
			SET AdminID = ?
			WHERE UniversityID = ?;";
	$stmt = mysqli_stmt_init($dbconn);
	if(!mysqli_stmt_prepare($stmt, $sql))
		res("internalerror");
	
	mysqli_stmt_bind_param($stmt, "ii", $uni_admin, $uniId);
	mysqli_stmt_execute($stmt);
	//$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
	res("success");
}
else 
	res("invalid");
?>