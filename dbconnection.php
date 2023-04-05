<?php
if (session_status() === PHP_SESSION_NONE) 
{
session_start();
}
$dttim= date("Y-m-d H:i:s");
$dt= date("Y-m-d");
$tim= date("H:i:s");
$con=mysqli_connect("localhost","root","","collegeexam");
echo mysqli_connect_error();
?>