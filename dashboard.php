<?php
include("header.php");
include("dbconnection.php");
if(!isset($_SESSION['userid']))
{
	header("Location: index.php");
}
?>
<br>

<style>
stati{
  background: url("http://rybd.com/wp-content/uploads/2014/12/blue-polygon.png");

} 
stati h1{
  color:white;
  margin-top: 2em;
}
stati p{
  color:white;
}

.stati{
  background: #e7717d;
  height: 8em;
  padding:1em;
  margin:1em 0; 
    -webkit-transition: margin 0.5s ease,box-shadow 0.5s ease; /* Safari */
    transition: margin 0.5s ease,box-shadow 0.5s ease; 
  -moz-box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
-webkit-box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
}

.stati:hover{ 
 /* margin-top:0.5em;  */
  -moz-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
-webkit-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
}
.stati i{
  font-size:3.5em; 
} 
.stati div{
  width: calc(100% - 3.5em);
  display: block;
  float:right;
  text-align:right;
}

.stati .icon{
	float:left;		
}

.stati div b {
	color: #fff;
	text-align:center;
  font-size:2.5em;
  width: 100%;
  padding-top:0px;
  margin-top:-0.2em;
  margin-bottom:-0.4em;
  display: block;
}
.stati div span {
  font-size:1.6em;
  width: 100%;
  color: #fff !important;
  display: block;
}

.stati.left div{ 
  float:left;
  text-align:left;
}

icon-wallet-icons{
	background-color:blue;
}
</style>
     <div class="slider_top2">
<h2>Dashboard</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
<?php
$qresult = mysqli_query($con,"SELECT * FROM  students");
$numstudents = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  users");
$numusers = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  course");
$numcourse = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  subjects");
$numsubjects = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  exam");
$numexam = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  questions");
$numquestions = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  results");
$numresults = mysqli_num_rows($qresult);

$qresult = mysqli_query($con,"SELECT * FROM  certificate");
$numcertificate = mysqli_num_rows($qresult);
?>            

<center>
<div class="row" STYLE="margin-right: 0px; margin-left: 0px;">
	<div class="stati col-md-6">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-users" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numstudents; ?></b>
		  <br>
		  <span>Number of Students</span>
		</div> 
	</div>
	<div class="stati col-md-6" style="background-color:#c2b9b0;">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-users" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numusers; ?></b>
		  <br>
		  <span>Number of Users</span>
		</div> 
	</div>
	<div class="stati col-md-6" style="background-color:#73685a;">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-file-text-o" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numcourse; ?></b>
		  <br>
		  <span>Number of Course</span>
		</div> 
	</div>
	<div class="stati col-md-6" style="background-color:#afd275;">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-book" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numsubjects; ?></b>
		  <br>
		  <span>Number of Subjects</span>
		</div> 
	</div>
	<br>
	
	<div class="stati col-md-6" style="background-color:#c2cad0;">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-laptop" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numexam; ?></b>
		  <br>
		  <span>Number of Exam held yet</span>
		</div> 
	</div>
	<br>
	<div class="stati col-md-6" style="background-color:#e8a87c;">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-question" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numexam; ?></b>
		  <br>
		  <span>Number of Questions</span>
		</div> 
	</div>
	<br>
	
	<div class="stati col-md-6" style="background-color:#d79922; ">           
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-question" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numresults; ?></b>
		  <br>
		  <span>Number of Results</span>
		</div> 
	</div>
	<br>
	
	<div class="stati col-md-6" style="background-color:#e27d60;">            
		<i class="icon-wallet-icons"></i>
		 <div>
			<div class="icon" style="text-align:left; color:#fff;">
				<i class="fa fa-certificate"" aria-hidden="true"></i>
			</div>
		  <b><?php echo $numcertificate; ?></b>
		  <br>
		  <span>Number of certificate</span>
		</div> 
	</div>
</div>
	<br>
</center>
  <!--
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of students: <?php echo $numstudents; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of users: <?php echo $numusers; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of course: <?php echo $numcourse; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of subjects: <?php echo $numsubjects; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of exam: <?php echo $numexam; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of questions: <?php echo $numquestions; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp; No. of results: <?php echo $numresults; ?></h2>
              <h2 class="about"> &nbsp; &nbsp;&nbsp;  No. of certificate: <?php echo $numcertificate; ?></h2></h2>
                <p>&nbsp;</p>
           -->  
              </div>
        
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>