
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

<div class ="mt-5" >

    <h1 class="display-4 text-center text-light"><strong>University Events</strong></h1>

    <div class="row mt-5 text-center">

        <div class="col">
        <form action="viewEvents.php" method="POST">
                <button type="submit" name="search_events" class="btn btn-outline-light col-10"><strong> View Events </strong> </button>
        </form>
        </div>

        <div class="col">
        <form action="creatEvent.php" method="POST">
                <button type="submit" name="create_event" class="btn btn-outline-light col-10"><strong> Create Events </strong> </button>
        </form>
        </div>

        <div class="col">
        <a href = "createRSO.php"><button type="button" class="btn btn-outline-light col-10"><strong>Create RSO</strong></button></a>
        </div>
        
        <div class="col">
            <form action="joinRSO.php" method="POST">
                <button type="submit" name="search_rso" class="btn btn-outline-light col-10"><strong> Join RSO </strong> </button>
            </form>
            
        </div>

    </div>
   

</div>


<?php 
    include_once 'footer.php';
?>