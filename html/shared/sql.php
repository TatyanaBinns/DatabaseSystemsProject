<?php
$hostname = "localhost";
$username = "webuser";
$password = "e3p6ihg93tgj5u97jhcghlkmgrti90bo";
$db = "SchoolEventApp";
$dbconn=mysqli_connect($hostname,$username,$password,$db);
if ($dbconn->connect_error) {
  die("Database connection failed: " . $dbconn->connect_error);
}
function hasActiveRSO($conn){
	$stmt = mysqli_prepare($conn, 
	'SELECT IF(COUNT(*) > 0, "true", "false") AS hasRole
	FROM (
		 SELECT count(*) 
		 FROM RStudentOrg r
		 JOIN Membership m 
		 ON m.OrgID =r.OrgID
		 WHERE r.AdminUserID = ? 
		 AND m.Accepted = 1
		 GROUP BY m.OrgID 
		 HAVING COUNT(m.MembershipID ) > 4
	 ) as Other;');
	mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
	mysqli_stmt_execute($stmt);
	$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
	mysqli_stmt_close($stmt);
	return $row["hasRole"] == "true";
}

function hasRole($conn, $role){
	$stmt = mysqli_stmt_init($conn); // this makes code more secure
	switch($role){
		case "SuperAdmin":
			mysqli_stmt_prepare($stmt, 
				   "SELECT IF(COUNT(*) > 0, 'true', 'false') AS hasRole
					FROM University r
					WHERE r.AdminID = ?;");
			mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
		break;
		case "Admin":
			mysqli_stmt_prepare($stmt, 
				   "SELECT IF(COUNT(*) > 0, 'true', 'false') AS hasRole
					FROM RStudentOrg r
					WHERE r.AdminUserID = ?;");
			mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
		break;
		default:
			$stmt = mysqli_stmt_init($conn); // this makes code more secure
			mysqli_stmt_prepare($stmt, 
				   "SELECT IF(COUNT(RoleType) > 0, 'true', 'false') AS hasRole
					FROM Roles r
					WHERE r.UserID = ?
					AND r.RoleType = ?;");
			mysqli_stmt_bind_param($stmt, "is", $_SESSION["userid"], $role);
		break;
	}
	mysqli_stmt_execute($stmt);
	$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
	mysqli_stmt_close($stmt);
	return $row["hasRole"] == "true";
}
?>