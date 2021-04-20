<?php
$title="Events - Manage RSO";
$descr="School Event Application RSO Management Page";
$navitem="";
$reqRole="Admin";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>

<div class="container">
<?php
	if (isset($_GET["result"]))
		switch($_GET["result"]){
			case "internalerror": 	printError("Internal Error!", "danger"); 	break;
			case "invalid": 		printError("Invalid Request!", "warning"); 	break;
			case "success": 		printError("Member Added!", "success"); 	break;
		}
?>
<?php
$stmt = mysqli_prepare($dbconn, 
	   "SELECT 
			ro.Name as 'OrgName',
			CONCAT(u.FirstName, ' ', u.LastName) as 'MemberName',
			CASE m.Accepted
				WHEN 0 THEN 'No'
				WHEN 1 THEN 'Yes'
			END Accepted,
			ro.OrgID
		FROM RStudentOrg ro
		JOIN Membership m on ro.OrgID =m.OrgID 
		JOIN Users u on u.UserID =m.UserID 
		WHERE ro.AdminUserID = ?;");
mysqli_stmt_bind_param($stmt, "i", $_SESSION['userid']);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
$rsos=array();
while ($row = mysqli_fetch_assoc($data)){
	if(!isset($rsos[$row['OrgName']]))
		$rsos[$row['OrgName']] = array();
	$tmp = array();
	$rsos[$row['OrgName']][] = $row;
}
foreach ($rsos as $orgname => $memberdata){
	echo '	
	<h1 class="h2 text-center">'.$orgname.'</h1>
	<button class="btn btn-sm btn-success addMemberButton" type="submit" data-value="'.$memberdata[0]['OrgID'].'" >Invite New Member</button>
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Accepted</th>
			</tr>
		</thead>
	<tbody>';
	foreach($memberdata as $member)
		echo '
		<tr>
			<td>'.$member['MemberName'].'</td>
			<td>'.$member['Accepted'].'</td>
		</tr>
		';
	echo '
	</tbody>
</table>';
}
?>

<div class="modal fade" id="userAdder" tabindex="-1" role="dialog" aria-labelledby="userAdderLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	 <form class="form-signin" action="add_new_rso_member.form.php" method= "post">
	  <div class="modal-header">
		<h5 class="modal-title" id="userAdderLabel">Choose New Member</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<label for="uni_admin">New Member</label>
			<select class="form-control" id="new_member" name="new_member" required>
			<?php
				$query = mysqli_query($dbconn, 'SELECT UserID, Email, FirstName, LastName FROM Users ORDER BY LastName, FirstName;')
					or die (mysqli_error($dbconn));
				while ($row = mysqli_fetch_array($query))
					echo '<option value='.$row['UserID'].'>'.$row['FirstName']." ".$row['LastName'].' ('.$row['Email'].')</option>';
			?>
			</select>
			<input type="hidden" name="orgId" id="orgId" value="">
			<input type="hidden" name="actionType" value="addNewRSOMember">
	  </div>
	  <div class="modal-footer">
		<button id="confirmChange" type="submid" class="btn btn-primary" >Confirm User Add</button>
	  </div>
	 </form>
	</div>
  </div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function(event) { 
		$(".addMemberButton").click(function (){
			$('#orgId').val($(this).attr("data-value"));
			$('#userAdder').modal('show');
		});
	});
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>

