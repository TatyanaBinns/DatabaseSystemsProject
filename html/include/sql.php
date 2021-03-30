<?php
$hostname = "localhost";
$username = "webuser";
$password = "e3p6ihg93tgj5u97jhcghlkmgrti90bo";
$db = "exampledb";
$dbconnect=mysqli_connect($hostname,$username,$password,$db);
if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}
?>