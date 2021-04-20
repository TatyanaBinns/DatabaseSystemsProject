<?php
$title="Events - Approve Public Events";
$descr="School Event Application Public Events Management Page";
$navitem="";
$reqRole="SuperAdmin";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>

<div class="container">
<?php
	if (isset($_GET["result"]))
		switch($_GET["result"]){
			case "internalerror": 	printError("Internal Error!", "danger"); 	break;
			case "invalid": 		printError("Invalid Request!", "warning"); 	break;
			case "success": 		printError("Event Approved!", "success"); 	break;
		}
?>
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Visibility</th>
				<th scope="col">Coordinator</th>
				<th scope="col">Category</th>
				<th scope="col">Where</th>
				<th scope="col">When</th>
				<th scope="col">Description</th>
				<th scope="col"></th>
			</tr>
		</thead>
	<tbody>
<?php
$query = mysqli_query($dbconn, 'SELECT Name,
									   EventID, 
									   EventVisibility , 
									   ContactName, 
									   Category , 
									   AddressDesc , 
									   Scheduled , 
									   Description 
								FROM SchoolEventApp.Events
								WHERE Published=0;')
                or die (mysqli_error($dbconn));
	while ($row = mysqli_fetch_array($query))
		echo '  <tr>
				  <th scope="row">'.$row['Name'].'</th>
				  <td>'.$row['EventVisibility'].'</td>
				  <td>'.$row['ContactName'].'</td>
				  <td>'.$row['Category'].'</td>
				  <td>'.$row['AddressDesc'].'</td>
				  <td>'.$row['Scheduled'].'</td>
				  <td>'.$row['Description'].'</td>
				  <td><button class="btn btn-sm btn-success approveEveButton" type="submit" data-value="'.$row['EventID'].'">Approve</button></td>
				</tr>';
?>
	  </tbody>
	</table>
</div>

<div class="modal fade" id="approver" tabindex="-1" role="dialog" aria-labelledby="approverLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	 <form class="form-signin" action="approve_event.form.php" method= "post">
	  <div class="modal-header">
		<h5 class="modal-title" id="approverLabel">Approve Event</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" name="eventId" id="eveId" value="">
		<input type="hidden" name="actionType" value="approveEvent">
		<button id="confirmChange" type="submit" class="btn btn-primary" >Confirm Approval</button>
	  </div>
	 </form>
	</div>
  </div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) { 
		$(".approveEveButton").click(function (){
			$('#eveId').val($(this).attr("data-value"));
			$('#approver').modal('show');
		});
	});
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>

