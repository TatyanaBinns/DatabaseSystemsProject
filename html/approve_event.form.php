<?php
function res($msg){
	header("location: approve_events.php?result=$msg");
	exit();
}

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "approveEvent"))
{
	$eventId = $_POST['eventId'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';

    //catch any sort of errors 
	
	$sql = "UPDATE Events
			SET Published = 1
			WHERE EventID = ?;";
	$stmt = mysqli_stmt_init($dbconn);
	if(!mysqli_stmt_prepare($stmt, $sql))
		res("internalerror");
	
	mysqli_stmt_bind_param($stmt, "i", $eventId);
	mysqli_stmt_execute($stmt);
	//$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
	res("success");
}
else 
	res("invalid");
?>