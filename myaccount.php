<?php
include("header.php");
if(!isset($_SESSION['regno']))
{
	header("Location: index.php");
}
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<div class="slider_top2">
<h2>My Account</h2>

    </div>

    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <p>
		<center>
<table>
	<tr>
		<td><center><h2><a href="studentprofile.php">
			<div class="card text-white bg-warning mb-3" style="max-width: 18rem; font-size:25px; background-color: #E27D60; color:white;">
			<br>
			  <div class="card-header"><i class="fa fa-user" aria-hidden="true" style="color:black;"></i> &nbsp;<b>Profile</div><br>
			  <div class="card-body">
				<h5 class="card-title"><b>View or Update your Account here</h5><br>
			  </div>
			</div>
		</a></h2></center></td>
		
		<td><center><h2><a href="reset.php">
			<div class="card text-white bg-success mb-3" style="max-width: 18rem; font-size:23px; background-color: #d79922; color:white;" >
			<br>
			  <div class="card-header"><i class="fa fa-unlock-alt" aria-hidden="true"></i> <b>Change Password</div><br>
			  <div class="card-body">
				<h5 class="card-title"><b>Password Settings</h5><br>
			  </div>
			</div>
		</a></h2></center></td>
		
		<td><center><h2><a href="examtimetable.php">
			<div class="card text-white bg-success mb-3" style="max-width: 18rem; font-size:21px; background-color: #ee4c7c; color:white;" >
			<br>
			  <div class="card-header"><i class="fa fa-table" aria-hidden="true" style="color:brown;"></i> <b>Exam Time-Table</div><br>
			  <div class="card-body">
				<h5 class="card-title"><b>View your Exam Details here</h5><br>
			  </div>
			</div>
		</a></h2></center></td>
	</tr>	
	<tr>
		<td><center><h2><a href="attendexam.php">
		<div class="card text-white bg-success mb-3" style="max-width: 18rem; font-size:23px; background-color: #101357; color:white;" >
			<br>
			  <div class="card-header"><i class="fa fa-book" aria-hidden="true"></i> <b>Attend Exam</div><br><br>
			  <div class="card-body">
				<h5 class="card-title"><b>visualize your capability</h5><br>
			  </div>
			</div>
		</a></h2></center></td>
		
		<td><center><h2><a href="userExamresult.php">
		<div class="card text-white bg-success mb-3" style="max-width: 18rem; font-size:23px; background-color: #478559; color:white;" >
			<br>
			  <div class="card-header">&nbsp;<i class="fa fa-file" aria-hidden="true"></i> <b>Exam Results</div>
			  <div class="card-body">
				<h5 class="card-title"><b>Preview your Investments on Knowledge</h5><br>
			  </div>
			</div>
		</a></h2></center></td>
		<td><center><h2><a href="userexamcertificate.php">
		<div class="card text-white bg-success mb-3" style="max-width: 18rem; font-size:23px; background-color: #6B7A8F; color:white;" >
			<br>
			  <div class="card-header"><i class="fa fa-certificate" aria-hidden="true" style="color:red;"></i> <b>Exam Certificates</div><br>
			  <div class="card-body">
				<h5 class="card-title"><b>Certify yourself with approval</h5><br>
			  </div>
			</div>
		</a></h2></center></td>
	</tr>
</table>  
			  
			  </p>
              <div class="bg"></div>
              </div>
        
         <div class="right">
     		<?php
			include("studentsidebar.php");
			?>                          
         </div>
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>