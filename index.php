<?php
session_start();
include("dbconnection.php");
//error_reporting(0);
$dttim= date("Y-m-d H:is");
$dt= date("Y-m-d");
$tim= date("H:i:s");
$errmsg1="";
$errmsg2="";
$errmsg3="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<link rel="stylesheet" type="text/css" href="new_css.css">
<title>College Examination System</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.hero-image {
  background-image: url("background.jpeg");
  background-color: #cccccc;
 /* height: 2000px;*/
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

/*header on this page only */
nav
{
	  position:fixed;
	  top:0;
	  left:0;
	  width:100%;
	  height:100px;
	  padding: 10px 100px;
	  box-sizing: border-box;
	  transition:0.5s;
}

nav.black
{
	background: rgb(70, 195, 212);
}

nav .logo 
{
	float:left;
}

nav .logo img
{
	margin:10px;
	/*height:130px;*/
	transition: 0.5s;
}

nav ul
{
	float:right;
	margin:0;
	padding:0;
	display:flex;
}

nav ul li
{
	list-style: none;
}

nav ul li a
{
	line-height: 130px;
	color: #262626;
	padding: 5px 20px;
	font-family: 'Russo One', sans-serif;
	text-decoration: none;
	text-transform:uppercase;
	transition:0.5s;
}

nav ul li a.active, 
nav ul li a:hover
{
	color:black;
	background: #A9A9A9;
	text-decoration: none;
}

section.sec1
{
	width:100%;
	height:17vh;
	background:#51e2f5 ;
}

section.content
{
	font-size:20px;
}
</style>

</head>
<?php
if(isset($_SESSION['regno']))
{
	echo "<script>window.location='myaccount.php';</script>";
}
if(isset($_SESSION['userid']))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_SESSION['examinerid']))
{
	echo "<script>window.location='examinerpanel.php';</script>";
}
$dt = date("Y-m-d h:i:s");
if(isset($_POST['submitstudent']))
{
	$sqlstudent ="SELECT * FROM students WHERE regno='$_POST[studentusername]' AND password='$_POST[studentpassword]' AND status='Enabled'";
	$stquery = mysqli_query($con,$sqlstudent);
	echo mysqli_error($con);
	echo mysqli_num_rows($stquery);
	if(mysqli_num_rows($stquery) == 1)
	{	
		$sqlupd = "UPDATE students SET lastlogin='$dt' WHERE regno='$_POST[studentusername]'";
		mysqli_query($con,$sqlupd);
		$_SESSION['regno'] = $_POST['studentusername'];
		echo "<script>window.location='myaccount.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid Student Login credentials entered...');</script>";
		$errmsg1 = "<br><b><font color='red'>Failed to login.</font></b>";
	}
}
if(isset($_POST['submitteacher']))
{
	$sqlteacher ="SELECT * FROM users WHERE username='$_POST[teacherusername]' AND password='$_POST[teacherpassword]' AND usertype='Examiner'";
	$tequery =mysqli_query($con,$sqlteacher);

		if(mysqli_num_rows($tequery) == 1)
		{
			$rs = mysqli_fetch_array($tequery);
				
				$sqlupd = "UPDATE users SET lastlogin='$dt' WHERE userid='$rs[userid]'";
				mysqli_query($con,$sqlupd);
		
			$errmsg2 =  "<br><b><font color='green'>Employee logged in successfully..</font></b>";
			$_SESSION['examinerid'] = $rs['userid'];
			$_SESSION['usertype'] = $rs['usertype'];
			$_SESSION['courseid'] = $rs['courseid'];
			echo "<script>window.location='examinerpanel.php';</script>";
		}
		else
		{
			echo  "<script>alert('Invalid Staff Login credentials entered...');</script>";
			$errmsg2 = "<br><b><font color='red'>Failed to login..</font></b>";
		}
}
if(isset($_POST['submitadmin']))
{
	$sqladmin ="SELECT * FROM users WHERE username='$_POST[adminusername]' AND password='$_POST[adminpassword]' AND usertype='Administrator'";
	$adquery =mysqli_query($con,$sqladmin);
		if(mysqli_num_rows($adquery) == 1)
		{
			$rs = mysqli_fetch_array($adquery);
			$sqlupd = "UPDATE users SET lastlogin='$dt' WHERE userid='$rs[userid]'";
			mysqli_query($con,$sqlupd);
			$errmsg3 =  "<br><b><font color='green'>Administrator Logged in successfully..</font></b>";
			$_SESSION['userid'] = $rs['userid'];
			$_SESSION['usertype'] = $rs['usertype'];
			echo "<script>window.location='dashboard.php';</script>";
		}
		else
		{
			echo  "<script>alert('Invalid Admin Login credentials entered...');</script>";
			$errmsg3 = "<br><b><font color='red'>Failed to login...</font></b>";
		}
}
?>
</head>

<body>
	<div class="hero-image">
	<nav>
		<div class="logo">
			<a href="index.php"><img src="images/collegeexaminationsystem.png" style="border-radius: 10px 10px 10px 10px;"></a>
		</div>
	</nav>

	<section class="sec1"></section>
<div class="form_by_me">
		<div class="hero-image">
		<div class="row">
		  <div class="col-md-4">
				<div class="hero">
						<div class="form-box"><!--Student form -->
						<br>
						<button type="submit" class="submit-btn">Student Panel </button>
							<div class="button-box">
							  <div id="btn"></div>
							  	<button type="button" class="toggle-btn" onclick="login()">Log In</button>
							</div>
							<br><br><br><br><br><br><br>
							<p><strong><center><?php echo $errmsg1; ?> </strong><br /></center>
							<br><br><br><br>
							<form class="input-group" id="login" method="post" action=""  name="formstudent" onsubmit="return validation2()">
								<input type=text id="studentusername" name="studentusername" class="input-field" placeholder="Student Registration No." >
								<input type="password" id="studentpassword" name="studentpassword" class="input-field" placeholder="Student Password" >		
								<br><br>
								<button type="submit" id="submitstudent" name="submitstudent" class="submit-btn">Student Log In </button>
							</form>
							
							<form class="input-group" id="registration">
								<input type="text" class="input-field" placeholder="You can't Register as Student" style="width:250px;">
								<input type="text" class="input-field" placeholder="Ask your Staff to provide Login details" style="width:300px;">
							</form>
						</div>
				</div>
		  </div>
		  
		  
		  <div class="col-md-4">
			<div class="hero">
						<div class="form-box"><!--Staff form -->
						<br>
						<button type="submit" class="submit-btn">Examiner/Staff Panel</button>
							<div class="button-box">
							  <div id="btn"></div>
								<button type="button" class="toggle-btn" onclick="loginstaff()">Log In</button>
							</div>
							<br><br><br><br><br><br><br>
							<p><strong><center> <?php echo $errmsg2; ?> </strong><br /></center>

							<form class="input-group" id="login" method="post" action=""  name="formexaminer"onsubmit="return validation1()">
								<input type=text id="teacherusername" name="teacherusername" class="input-field" placeholder="Examiner/Staff Username" >
								<input type="password" id="teacherpassword" name="teacherpassword" class="input-field" placeholder="Examiner/Staff Password" >		
								<br><br>
								<button type="submit" id="submitteacher" name="submitteacher" class="submit-btn">Staff Log In </button>
							</form>
						</div>
			</div>
		  </div>
		  
		  
		  <div class="col-md-4">
			<div class="hero">
						<div class="form-box"><!--Admin form -->
						<br>
						<button type="submit" class="submit-btn">Admin Panel</button>
							<div class="button-box">
							  <div id="btn"></div>
								<button type="button" class="toggle-btn" onclick="login()">Log In</button>
							</div>
							<br><br><br><br><br><br><br><br>
							<center> <p style="colr:red;"><?php echo $errmsg3; ?></strong><br /><br>
							<form class="input-group" id="login" name="formadministrator" method="post" action="" onsubmit="return validation()" >
								<input type="text"  id="adminusername" name="adminusername" class="input-field" placeholder="Admin Usernamer" >
								<input type="password" id="adminpassword" name="adminpassword" class="input-field" placeholder="Admin Password" >		
								<br><br>
								<button type="submit" id="submitadmin" name="submitadmin" class="submit-btn">Admin Log In </button>
							</form>
						</div>
			</div>
		  </div>
		  
		  
		</div>
	</div>

<script>
//Admin
var x = document.getElementById("login");
var y = document.getElementById("registration");
var z = document.getElementById("btn");

function registration(){
	x.style.left = "-400px";
	y.style.left = "50px";
	z.style.left = "110px";
}

function login(){
	x.style.left = "50px";
	y.style.left = "450px";
	z.style.left = "0";
}


</script>

<script type="application/javascript">
function validation()
{ 
	if(document.formadministrator.adminusername.value=="")
	{
		alert("Please enter user name...");
		document.formadministrator.adminusername.focus();
		return false;
	}
	else if(document.formadministrator.adminpassword.value=="")
	{
		alert("Please enter valid Password..");
		document.formadministrator.adminpassword.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function validation1()
{
	if(formexaminer.teacherusername.value=="")
	{
		alert("Please enter user name...");
		formexaminer.teacherusername.focus();
		return false;
	}
	else if(formexaminer.teacherpassword.value=="")
	{
		alert("Please enter valid Password..");
		formexaminer.teacherpassword.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function validation2()
{
	if(formstudent.studentusername.value=="")
	{
		alert("Please enter Registration No..");
		formstudent.studentusername.focus();
		return false;
	}
	else if(formstudent.studentpassword.value=="")
	{
		alert("Please enter valid Password..");
		formstudent.studentpassword.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</div>
<br>
<?php
include("footer.php");
?>









