<?php
include("dbconnection.php");

$queid = $_GET['queid'];

$q = "delete from questions where queid = $queid";

mysqli_query($con,$q);

header('location:questions.php');
?>