<?php
$title="Events - Create Event";
$descr="School Event Application University Event Page";
$navitem="";
$reqRole="Student";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>
	<div class="container col-md-4 text-center">
		<form class="form-signin" action="create_event.form.php" method= "post">
		  <h1 class="h2 mb-3 font-weight-normal">School Event App</h1>
		  <h1 class="h4 mb-3 font-weight-normal">Create an Event</h1>
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
    function writeInput($id, $placeholder, $name, $type, $xtraClasses, $defaultVal = ''){
		echo '
		    <label for="'.$id.'" class="sr-only">'.$placeholder.'</label>
		    <input type="'.$type.'" id="'.$id.'" class="form-control '.$xtraClasses.'" placeholder="'.$placeholder.'" name="'.$name.'" value="'.$defaultVal.'" required autofocus>';
	}?>
		<select class="form-control" id="eventVis" name="eventVisibility" required>
			<option value="Public">Public Event - Open to All</option>
			<option value="Private">Private Event - University Specific</option>
			<?php
			if(hasRole($dbconn, "Admin"))
				echo '<option value="RSO">RSO Event - Registered Student Organization Only</option>';
			?>
		</select>
		<?php
			if(hasRole($dbconn, "Admin")){
				echo '<select class="form-control" id="orgID" name="orgID" required>';
				$stmt = mysqli_stmt_init($dbconn);
				mysqli_stmt_prepare($stmt, 
				   "SELECT r.OrgID, r.Name
					FROM RStudentOrg r
					WHERE r.AdminUserID = ?;");
				mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
				mysqli_stmt_execute($stmt);
				while ($row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt)))
					echo '<option value='.$row['OrgID'].'>'.$row['Name'].'</option>';
				echo '</select>';
			}else
				echo "<div>Note, as you are not an RSO admin, your event will require approval.</div>";	
		?>
<?php writeInput("name", "Event Name", "name", "text", "sea-square-top"); ?>
<?php writeInput("category", "Category (social, fundraising, tech talks, etc)", "category", "text", "sea-square-top sea-square-bot"); ?>
<?php $userInfo = getUserInfo($dbconn); ?>
<?php writeInput("conName", "Contact Name", "contactName", "text", "sea-square-top sea-square-bot", $userInfo['FirstName']." ".$userInfo['LastName'] ); ?>
<?php writeInput("conPhone", "Contact Phone Number", "contactPhone", "text", "sea-square-top sea-square-bot", $userInfo['PhoneNumber']); ?>
<?php writeInput("conEmail", "Contact Email", "contactEmail", "email", "sea-square-top sea-square-bot", $userInfo['Email']); ?>
			<input id="chosen_location" name="latlong" class="form-control" type="text" placeholder="Select Location" readonly data-toggle="modal" data-target="#LocationChooser" required>
<?php writeInput("locationDesc", "Location Description", "addrDesc", "text", "sea-square-top sea-square-bot"); ?>
			<input id="datetimepicker" name="datetime" class="form-control" type="text" placeholder="Select Time" required>
			<label for="descArea">Description</label>
			<textarea class="form-control" id="descArea" name="description" rows="4"></textarea>
			<input type="hidden" name="actionType" value="createEvent">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Create Event!</button>
		</form>
    </div>
	
	</div>
  <style>
  #map {
      width: 100%;
      height: 480px;
    }
  </style>
    <div class="modal fade" id="LocationChooser" tabindex="-1" role="dialog" aria-labelledby="LocationChooserLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="LocationChooserLabel">Choose Location</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div id="map"></div>
		  </div>
		  <div class="modal-footer">
			<button id="confirmPosition" type="button" class="btn btn-primary">Confirm Position</button>
		  </div>
		</div>
	  </div>
	</div>

<br>

<script>
	document.addEventListener("DOMContentLoaded", function(event) { 
		$("#datetimepicker").datetimepicker();
	
		// Get element references
		var confirmBtn = document.getElementById('confirmPosition');
		var onClickPositionView = document.getElementById('onClickPositionView');
		var onIdlePositionView = document.getElementById('onIdlePositionView');
		var map = document.getElementById('map');

		// Initialize LocationPicker plugin
		var lp = new locationPicker(map, {
		setCurrentPosition: true, // You can omit this, defaults to true
		lat: 28.602127260466602,
		lng: -81.20041837939155
		}, {
		zoom: 15 // You can set any google map options here, zoom defaults to 15
		});

		// Listen to button onclick event
		confirmBtn.onclick = function () {
			var location = lp.getMarkerPosition();
			$("#chosen_location").val(location.lat + ',' + location.lng);
			$('#LocationChooser').modal('hide')
		};

		// Listen to map idle event, listening to idle event more accurate than listening to ondrag event
		google.maps.event.addListener(lp.map, 'idle', function (event) {
		// Get current location and show it in HTML
		var location = lp.getMarkerPosition();
		//onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
		});
	});
</script>

	<script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=&language=en"></script>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>

