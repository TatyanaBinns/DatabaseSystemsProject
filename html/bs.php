<?php
$title="BS ExamplePage";
$descr="Example Bootstrap Page for Learning Bootstrap";
include $_SERVER['DOCUMENT_ROOT'].'/include/header.php';
?>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <nav class="my-0 mr-md-auto font-weight-normal">
        <a class="p-2 text-dark" href="#">Home Page</a>
        <a class="p-2 text-dark" href="#">Events</a>
      </nav>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">My Dashboard</a>
        <a class="p-2 text-dark" href="#">My Profile</a>
      </nav>
      <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Pricing</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>

    <div class="container">
      <div class="card-columns mb-3 text-center">
        <?php
            $query = mysqli_query($dbconnect, "SELECT userkey, name, email FROM exampledb.ExampleTable;")
                or die (mysqli_error($dbconnect));

            while ($row = mysqli_fetch_array($query)) {
                echo '<div class="card shadow-sm">
                        <div class="card-header">
                          <h4 class="my-0 font-weight-normal">'.$row['name'].'</h4>
                        </div>
                        <div class="card-body">
                          <h1 class="card-title pricing-card-title">'.$row['email'].' </h1>
                          <button type="button" class="btn btn-lg btn-block btn-outline-primary">Contact Me!</button>
                        </div>
                      </div>
                      ';
            }
        ?>
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <div class="mb-2">IMG</div>
     <!--   <img class="mb-2" src="/docs/4.6/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24"> -->
            <small class="d-block mb-3 text-muted">&copy; 2017-2021</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Cool stuff</a></li>
              <li><a class="text-muted" href="#">Random feature</a></li>
              <li><a class="text-muted" href="#">Team feature</a></li>
              <li><a class="text-muted" href="#">Stuff for developers</a></li>
              <li><a class="text-muted" href="#">Another one</a></li>
              <li><a class="text-muted" href="#">Last time</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Resource</a></li>
              <li><a class="text-muted" href="#">Resource name</a></li>
              <li><a class="text-muted" href="#">Another resource</a></li>
              <li><a class="text-muted" href="#">Final resource</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Team</a></li>
              <li><a class="text-muted" href="#">Locations</a></li>
              <li><a class="text-muted" href="#">Privacy</a></li>
              <li><a class="text-muted" href="#">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php';
?>
