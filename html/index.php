<?php 
$pagename="FunPage";

$hostname = "localhost";
$username = "webuser";
$password = "e3p6ihg93tgj5u97jhcghlkmgrti90bo";
$db = "exampledb";
$dbconnect=mysqli_connect($hostname,$username,$password,$db);
if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}
?>
<html>
    <head>
        <title>PAGE <?php echo $pagename?></title>
    </head>
    <body>
    <p>This is static content!</p>
    <?php 
        echo "<h1>PAGENAME: $pagename</h1>\n";
        for ($x = 0; $x <= 10; $x++) {
          echo "<p>The number is: $x </p>\n";
        }
    ?>
    <table border="1" align="center">
    <tr>
      <th>UserID</th>
      <th>Name</th>
      <th>Email</th>
    </tr>
    <?php

    $query = mysqli_query($dbconnect, "SELECT userkey, name, email FROM exampledb.ExampleTable;")
       or die (mysqli_error($dbconnect));

    while ($row = mysqli_fetch_array($query)) {
      echo
       "<tr>
        <td>".$row['userkey']."</td>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
       </tr>";
    }

    ?>
    </table>
    <table border="1" align="center">
    <tr>
      <th>UserID</th>
      <th>Name</th>
      <th>Email</th>
    </tr>
    <?php

    $query = mysqli_query($dbconnect, "SELECT userkey, name, email FROM exampledb.ExampleTable 
                                       WHERE email LIKE '%gmail.com';")
       or die (mysqli_error($dbconnect));

    while ($row = mysqli_fetch_array($query)) {
      echo
       "<tr>
        <td>".$row['userkey']."</td>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
       </tr>";
    }

    ?>
    </table>
    </body>
</html>