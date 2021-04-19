<?php
$title="Events - Home";
$descr="School Event Application Home Page";
$navitem="homepage";
include $_SERVER['DOCUMENT_ROOT'].'/shared/header.php';
?>
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">University Events</h1>
      <p class="lead">Easily search untold universities for events, create your own, and run your Registered Student Organization events more easily!</p>
    </div>

    <div class="container">
      <div class="card-columns mb-3 text-center">
        <?php
			$stmt = mysqli_stmt_init($dbconn);
			mysqli_stmt_prepare($stmt, 
			   'SELECT 
					e.EventID as "EventID",
					e.EventVisibility as "Visibility",
					e.Category as "EventCategory",
					e.Name as "EventName",
					e.ContactName as "Coordinator",
					e.ContactPhoneNumber as "CoordinatorNumber",
					e.ContactEmailAddr as "CoordinatorEmail",
					e.AddressDesc as "Where",
					e.Scheduled as "When",
					u.Name as "University",
					ro.Name as "Org"
				FROM SchoolEventApp.Events e
				JOIN University u on u.UniversityID = e.UniversityID
				LEFT JOIN Membership m on m.OrgID = e.OrgID 
				LEFT JOIN RStudentOrg ro on m.OrgID = ro.OrgID
				WHERE (
				   e.EventVisibility ="Public"
				OR
				   u.UniversityID  = ?
				OR
				   m.UserID = ?
				)
				AND
				   e.Published = 1
				;');
			mysqli_stmt_bind_param($stmt, "ii", $_SESSION["uniId"], $_SESSION["userid"]);
			mysqli_stmt_execute($stmt);
			$data=mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($data)){
				switch($row['Visibility']){
					case "Public": $color="bg-primary"; break;
					case "Private": $color="bg-info"; break;
					case "RSO": $color="bg-secondary"; break;
				}
                echo '<div class="card shadow-sm">
                        <div class="card-header '.$color.'">
                          <h4 class="my-0 font-weight-normal">Organized at '.$row['University'].'</h4>
                        </div>
                        <div class="card-body">
                          <h1 class="card-title pricing-card-title">'.$row['EventName'].'</h1>
						  '.$row['Where'].' at '.$row['When'].'
                          <a href="mailto:'.$row['CoordinatorEmail'].'" class="btn btn-lg btn-block btn-outline-secondary">Contact '.$row['Coordinator'].'!</a>
                        </div>
                      </div>
                      ';
			}
			mysqli_stmt_close($stmt);
        ?>
      </div>
    </div>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/footer.php';
?>
