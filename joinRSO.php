
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
        <h2 class="display-5 text-center text-light">Join RSO</h2>
        <p></p>
        <p></p>   
</div>
</div>

<div class = "container mt-5">


<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">RSO ID</th>
      <th scope="col">RSO Name</th>
      <th scope="col">University ID</th>
      <th scope="col">Join</th>
    </tr>
  </thead>

  <?php

    if (isset($_POST["search_rso"]))
    {

        require_once 'dbh.inc.php';

        $sql = "SELECT * FROM rso;";

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
                <td> <?php echo $data["rsoID"] ?> </td>
                <td> <?php echo $data["rsoName"] ?> </td>
                <td> <?php echo $data["universityID"] ?> </td>
                <td> 
                    
                    <form action="joinRequestRSO.php" method="POST">
                        <button type="submit" name="search_rso" class="btn btn-outline-light col-10"><strong> Join RSO </strong> </button>
                    </form>
                    
                </td>

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



<?php 
    include_once 'footer.php';
?>