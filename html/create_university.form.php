<?php

var_dump($_POST);

function res($msg){
	header("location: create_university.php?result=$msg");
	exit();
}

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "createUniversity"))
{
	$name = $_POST['name'];
	$domain = $_POST['domain'];
	$latlon = explode(",", $_POST['latlong']);
	$lat = floatval($latlon[0]);
	$long = floatval($latlon[1]);
	$uni_admin = $_POST['uni_admin'];
	$description = $_POST['description'];

    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';

    //catch any sort of errors 
	
	if (!isset($_POST['latlong']))
		res("badloc");

    
	$sql = "INSERT INTO University
			(Name, Location, Description, `Domain`, AdminID)
			VALUES(?, POINT(?, ?), ?, ?, ?);";
	$stmt = mysqli_stmt_init($dbconn);
	if(!mysqli_stmt_prepare($stmt, $sql))
		res("internalerror");
	
	mysqli_stmt_bind_param($stmt, "sssssi", $name, $lat, $long, $description, $domain, $uni_admin);
	mysqli_stmt_execute($stmt);
	//$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
	res("success");
}
else 
	res("invalid");
?>