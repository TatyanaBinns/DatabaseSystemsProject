<?php
$title="Events - Create University";
$descr="School Event Application University Creation Page";
$navitem="";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>

<?php 
	if (isset($_GET["result"]))
		switch($_GET["result"]){
			case "internalerror": 	printError("Internal Error!", "danger"); 			break;
			case "invalid": 		printError("Invalid Request!", "warning"); 			break;
			case "badloc": 			printError("Please select a location!", "warning"); break;
			case "success": 		printError("University Created!", "success"); 		break;
		}
?>
<div class="container">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Domain</th>
				<th scope="col">Admin</th>
				<th scope="col"></th>
			</tr>
		</thead>
	<tbody>
<?php
$query = mysqli_query($dbconn, 'SELECT u.UniversityID, u.Name , u.`Domain` , 
								CONCAT(u2.FirstName, " ", u2.LastName) AS adminname
								FROM University u
								JOIN Users u2 
								on u.AdminID =u2.UserID;')
                or die (mysqli_error($dbconn));
	while ($row = mysqli_fetch_array($query))
		echo '  <tr>
				  <th scope="row">'.$row['Name'].'</th>
				  <td>'.$row['Domain'].'</td>
				  <td>'.$row['adminname'].'</td>
				  <td><button class="btn btn-sm btn-danger modUniButton" type="submit" data-value="'.$row['UniversityID'].'">Change Admin</button></td>
				</tr>';
?>
	  </tbody>
	</table>
</div>

<div class="modal fade" id="adminChanger" tabindex="-1" role="dialog" aria-labelledby="adminChangerLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	 <form class="form-signin" action="change_university_admin.form.php" method= "post">
	  <div class="modal-header">
		<h5 class="modal-title" id="adminChangerLabel">Choose New Admin</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<label for="uni_admin">University Admin</label>
			<select class="form-control" id="uni_admin" name="uni_admin" required>
			<?php
				$query = mysqli_query($dbconn, 'SELECT UserID, Email, FirstName, LastName FROM Users;')
					or die (mysqli_error($dbconn));
				while ($row = mysqli_fetch_array($query))
					echo '<option value='.$row['UserID'].'>'.$row['FirstName']." ".$row['LastName'].' ('.$row['Email'].')</option>';
			?>
			</select>
			<input type="hidden" name="universityId" id="uniId" value="">
	  </div>
	  <div class="modal-footer">
		<button id="confirmChange" type="submid" class="btn btn-primary" >Confirm Admin</button>
	  </div>
	 </form>
	</div>
  </div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) { 
		$(".modUniButton").click(function (){
			$('#uniId').val($(this).attr("data-value"));
			$('#adminChanger').modal('show');
		});
	});
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>

