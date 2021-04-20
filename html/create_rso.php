<?php
$title="Events - Create RSO";
$descr="School Event Application Create RSO Page";
$navitem="";
$reqRole="Student";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>
	<div class="container col-md-4 text-center">
		<form class="form-signin" action="create_rso.form.php" method= "post">
		  <h1 class="h2 mb-3 font-weight-normal">School Event App</h1>
		  <h1 class="h4 mb-3 font-weight-normal">Create a Registered Student Organization!</h1>
<?php 
	if (isset($_GET["result"]))
		switch($_GET["result"]){
			case "internalerror": 	printError("Internal Error!", "danger"); 			break;
			case "invalid": 		printError("Invalid Request!", "warning"); 			break;
			case "badloc": 			printError("Please select a location!", "warning"); break;
			case "success": 		printError("Event Created!", "success"); 		break;
		}
    // id must be unique
	// placeholder is what will be displayed
	// name is what is passed to the target form
	// type is what the input type will be set as
    function writeInput($id, $placeholder, $name, $type, $xtraClasses="", $defaultVal = '', $ro=false){
		echo '
		    <label for="'.$id.'" class="sr-only">'.$placeholder.'</label>
		    <input type="'.$type.'" id="'.$id.'" class="form-control '.$xtraClasses.'" placeholder="'.$placeholder.'" name="'.$name.'" value="'.$defaultVal.'" required autofocus';
		if($ro)
			echo ' readonly ';
		echo '>';
	}?>
		
<?php writeInput("name", "Organization Name", "name", "text"); ?>
<?php $userInfo = getUserInfo($dbconn); ?>
			<label for="descArea">RSO Admin will be you (<?php echo $userInfo['FirstName']." ".$userInfo['LastName']; ?>)</label>
			<textarea class="form-control" id="descArea" name="description" rows="4" placeholder="RSO Description"></textarea>
			<input type="hidden" name="actionType" value="createRSO">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Create RSO!</button>
		</form>
    </div>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>

