<?php
$title="BS ExamplePage";
$descr="Example Bootstrap Page for Learning Bootstrap";
include $_SERVER['DOCUMENT_ROOT'].'/include/header.php';
?>
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">University Events</h1>
      <p class="lead">Easily search untold universities for events, create your own, and run your Registered Student Organization events more easily!</p>
    </div>

    <div class="container">
      <div class="card-columns mb-3 text-center">
        <?php
            $query = mysqli_query($dbconn, 'SELECT 
					e.EventID as "EventID",
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
				LEFT JOIN RStudentOrg ro on ro.OrgID = e.OrgID 
				WHERE e.EventVisibility = "Public" AND e.Published = 1;')
                or die (mysqli_error($dbconn));

            while ($row = mysqli_fetch_array($query)) {
				
                echo '<div class="card shadow-sm">
                        <div class="card-header">
                          <h4 class="my-0 font-weight-normal">Organized at '.$row['University'].'</h4>
                        </div>
                        <div class="card-body">
                          <h1 class="card-title pricing-card-title">'.$row['EventName'].'</h1>
						  '.$row['Where'].' at '.$row['When'].'
                          <a href="mailto:'.$row['CoordinatorEmail'].'" class="btn btn-lg btn-block btn-outline-primary">Contact '.$row['Coordinator'].'!</a>
                        </div>
                      </div>
                      ';
            }
        ?>
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <h5>COP 4710 Term Project</h5>
          </div>
        </div>
      </footer>
    </div>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php';
?>
