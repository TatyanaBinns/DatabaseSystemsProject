<?php 

$serverName = "localhost"; 
$dBUsername = "root";
$dBPassword = "";
$dbName = "collegeeventwebsite";


$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dbName);

//if connection fails 
if(!$conn)
{
    die("Connection failed : " . mysqli_connect_error());
}