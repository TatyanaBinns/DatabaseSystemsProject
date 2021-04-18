<?php
$hostname = "localhost";
$username = "webuser";
$password = "e3p6ihg93tgj5u97jhcghlkmgrti90bo";
$db = "SchoolEventApp";
$dbconn=mysqli_connect($hostname,$username,$password,$db);
if ($dbconn->connect_error) {
  die("Database connection failed: " . $dbconn->connect_error);
}
?>