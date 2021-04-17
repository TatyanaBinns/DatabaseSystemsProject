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
        <h2 class="display-5 text-center text-light">Create Event</h2>
               
</div>
</div>

<div class = "container mt-5">
    
    <form action= createEvent.inc.php method= "post">

        <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Event Name" aria-label="Event name" name = "event_name" required>   
        </div>

        <div class="col">
            <input type = "text" name = "event_category" class="form-control" placeholder="Event Category" aria-label="Event Category" required>
        </div>

        </div>

        <div class="row mb-3">

        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Event Description" aria-label="Event Description" name = "event_description" required>   
        </div>

        <div class="col-md-6">
            <input type = "time" name = "event_time" class="form-control" placeholder="Event Time" aria-label="Event Time" required>
        </div>

        </div>


        <div class="row mb-3">

        <div class="col">
            <input type="date" class="form-control" placeholder="Event Date" aria-label="Event Date" name = "event_date" required>   
        </div>

        <div class="col">
            <input type = "text" name = "event_cont_num" class="form-control" placeholder="Event Contact Number" aria-label="Event Contact Number" required>
        </div>

        </div>


        <div class="row mb-3 text-center">

        <div class="col-6">
            <input type="email" class="form-control" placeholder="Event Contact Email" aria-label="Event Contact Email" name = "event_cont_email" required>   
        </div>

        <div class="col-6">
            <select class="form-select" aria-label="Default select example" name = "event_type" required>
                <option selected>Select Event Type</option>
                <option value="1">Private</option>
                <option value="2">Public</option>
                <option value="3">RSO Event</option>
            </select>   
        </div>

        </div>


        <div class="row mb-3 text-center">
        <div class="col">
            <button type="submit" name="createEvent" class="btn btn-danger col-6 mt-3"> Create Event </button>
        </div>
        </div>
        
    </form>

</div>