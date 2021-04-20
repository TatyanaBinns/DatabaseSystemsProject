<?php
session_start();
function res($msg){
	header("location: create_event.php?result=$msg");
	exit();
}

if (isset($_POST["actionType"]) && ($_POST["actionType"] == "createEvent"))
{ 
	
    require $_SERVER['DOCUMENT_ROOT'].'/shared/sql.php';
    require $_SERVER['DOCUMENT_ROOT'].'/shared/functions.php';
	
	$name = $_POST['name'];
	$eventVisibility = $_POST['eventVisibility'];
	$category = $_POST['category'];
	$contactName = $_POST['contactName'];
    $contactPhone = $_POST['contactPhone'];
	$contactEmail = $_POST['contactEmail'];
	if(hasRole($dbconn, "Admin"))
		$orgId = $_POST['orgID'];
	else
		$orgId = "";
	$addrDesc = $_POST['addrDesc'];
	$latlon = explode(",", $_POST['latlong']);
	$lat = floatval($latlon[0]);
	$long = floatval($latlon[1]);
	$description = $_POST['description'];
	//Take input of type 04/18/2021 10:46 PM
	//and create a nice sql-style date-timestamp
	//of type: 2021-04-19 02:43:36
	//So, change timezone from eastern time, and change i/o format as well as being in 24-hour time
	$dt = DateTime::createFromFormat('m/d/Y g:i a', $_POST['datetime']);
	$dt->setTimeZone('UTC');
	$datetime = $dt->format('Y-m-d G:i');


    //catch any sort of errors 
	
	if (!isset($_POST['latlong']))
		res("badloc");

    
	if(hasRole($dbconn, "Admin")){
		$sql = "INSERT INTO SchoolEventApp.Events
				(EventVisibility, Published, Category, Name, CreatorUserID, UniversityID, OrgID, ContactName, ContactPhoneNumber, ContactEmailAddr, LatLon, AddressDesc, Scheduled, Description)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, POINT(?, ?), ?, ?, ?);";
		$stmt = mysqli_stmt_init($dbconn);
		if(!mysqli_stmt_prepare($stmt, $sql))
			res("internalerror");
		
		$pub = 1;
		
		mysqli_stmt_bind_param($stmt, "sissiiisssddsss", $eventVisibility, $pub, $category, $name, $_SESSION['userid'], $_SESSION['uniId'], $orgId, $contactName, $contactPhone, $contactEmail, $lat, $long, $addrDesc, $datetime, $description);
	}else{
		$sql = "INSERT INTO SchoolEventApp.Events
				(EventVisibility, Published, Category, Name, CreatorUserID, UniversityID, ContactName, ContactPhoneNumber, ContactEmailAddr, LatLon, AddressDesc, Scheduled, Description)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, POINT(?, ?), ?, ?, ?);";
		$stmt = mysqli_stmt_init($dbconn);
		if(!mysqli_stmt_prepare($stmt, $sql))
			res("internalerror");
		
		$pub = 0;
		
		mysqli_stmt_bind_param($stmt, "sissiisssddsss", $eventVisibility, $pub, $category, $name, $_SESSION['userid'], $_SESSION['uniId'], $contactName, $contactPhone, $contactEmail, $lat, $long, $addrDesc, $datetime, $description);
	}
	mysqli_stmt_execute($stmt);
	//$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
	res("success");
}
else 
	res("invalid");
?>