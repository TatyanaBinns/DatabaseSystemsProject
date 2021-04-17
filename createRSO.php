
<?php 
    include_once 'header.php';
?>

<body style="background-color:#adb5bd;">

<style>
body {
  background-image: url('bg3.jpg');

  background-attachment: fixed;
  background-size: cover;
  background-color: transparent;

}
</style>

<div class = "container">
<div class = "header mt-5">
        <h2 class="display-5 text-center text-light">Create RSO</h2>
        <p></p>
        <p></p>   
</div>
</div>


<div class = "container mt-5">


    <form action= createRSO.inc.php method= "post">


        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="RSO Name" aria-label="rso name" name = "rso_name" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Admin Email" aria-label="Admin Email" name = "admin_email" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email Member 1" aria-label="Email Member 1" name = "email_1" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email Member 2" aria-label="Email Member 2" name = "email_2" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email Member 3" aria-label="Email Member 3" name = "email_3" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email Member 4" aria-label="Email Member 4" name = "email_4" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email Member 5" aria-label="Email Member 5" name = "email_5" required>   
        </div>
        </div>

        <div class="row mb-3 justify-content-md-center">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="University ID" aria-label="University ID" name = "university_id" required>   
        </div>
        </div>


        <div class="row mb-3 text-center">
        <div class="col">
            <button type="submit" name="createRSO" class="btn btn-danger col-6 mt-3"> Create RSO </button>
            </div>
        </div>

    </form>


</div>

<style>
#err {
    align: center;
    color: red;
    font-size: 150%;
    text-align: center;

}

#ok {
    align: center;
    color: green;
    font-size: 150%;
    text-align: center;

}
</style>

<?php

//$_GET[]  something you can see in the url
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "emptyinput")
        {
            echo "<p id='err'>Fill in all fields!</p>";
        }
        else if ($_GET["error"] == "none")
        {
            echo "<p id='ok'>RSO Created!</p>";
        }
    }


?>

<?php 
    include_once 'footer.php';
?>