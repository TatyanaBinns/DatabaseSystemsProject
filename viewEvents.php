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
        <h2 class="display-5 text-center text-light">View Events</h2>
        <p></p>
        <p></p>   
</div>
</div>

<div class = "container mt-5">


    <table class="table table-striped table-dark">
    <thead>
        <tr>
        <th scope="col">Event Name</th>
        <th scope="col">Event Category</th>
        <th scope="col">Event Description</th>
        <th scope="col">Event Time</th>
        <th scope="col">Event Date</th>
        <th scope="col">Event Contact Number</th>
        <th scope="col">Event Contact Email</th>
        <th scope="col">Event Type</th>
        </tr>
    </thead>

    <?php

    if (isset($_POST["search_events"]))
    {

        require_once 'dbh.inc.php';

        $sql = "SELECT * FROM events;";

        $stmt = mysqli_stmt_init($conn);

        // check for any mistakes before running sql code 
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);



        while ($row = mysqli_fetch_assoc($resultData))
        {
            ?>
            <tbody>
                <tr>
                <td> <?php echo $row["eName"] ?> </td>
                <td> <?php echo $row["eCategory"] ?> </td>
                <td> <?php echo $row["eDescription"] ?> </td>
                <td> <?php echo $row["eTime"] ?> </td>
                <td> <?php echo $row["eDate"] ?> </td>
                <td> <?php echo $row["eContctNumber"] ?> </td>
                <td> <?php echo $row["eContctEmail"] ?> </td>
                <td> <?php echo $row["eType"] ?> </td>
                </tr>
            </tbody>

            <?php
        }

    }
    else
    {
        header("location: index.php");
        exit();
    }
        
        

    ?>

</table>

</div>