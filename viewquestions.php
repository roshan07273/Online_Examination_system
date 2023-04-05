<?php 
include("header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript" charset="utf-8"></script>

</head>
<style>
/*by me table for students*/
	.content-table{
		border-collapse: collapse;
		margin: 25px 0;
		font-size: 0.9em;
		min-width: 800px;
		border-radius: 5px 5px 0 0 ;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0,0,0,0.15);
		font-family: 'Roboto', sans-serif;
		font-size:15px;
	}
	
	.content-table thead tr{
		background-color: #c3073f;
		color: #ffffff;
		text-align:left;
		font-weight: bold;
		font-family: 'Roboto', sans-serif;
	}
	
	.content-table th, 
	.content-table td{
		padding: 12px 15px ;
	}
	
	.content-table tbody tr{
		border-bottom: 1px solid #dddddd;
	}
	
	.content-table tbody tr:nth-of-type(even){
		background-color: #f3f3f3;
	}
	
	.content-table tbody tr:last-of-type{
		border-bottom: 2px solid #ad9ca3;
	}
	
	.content-table tbody tr:hover {
		font-weight: bold;
		color: #009879;
		font-family: 'Roboto', sans-serif;
		font-size:16px;
	}
	
	<!--button 
	.cont{
		text-align: center;
		margin-top:360px;
	}
	
	.btn{
		border: 1px solid #3498db;
		background-color: none;
		padding: 10px 20px;
		font-size:20px;
		letter-spacing: 2px;
		cursor: pointer;
		margin: 10px;
		transition: 0.8s;
		position: relative;
		overflow:hidden;
	}
	
	.btn1, .btn2{
		color: #3498db;
	}
	
	.btn1:hover, .btn2:hover{
		color:#fff;
	}
	
	.btn:before{
		content:"";
		position: absolute;
		left:0;
		width: 100%;
		height: 100%;
		background-color: #3498db;
		z-index: -1;
		transition: 0.8s;
	}
	
	.btn1:before{
		top:0;
		border-radius:0 0 50% 50%;
	}
	
	.btn2:before{
		bottom:0;
		border-radius:50% 50% 0 0;
	}
	
	.btn1:hover:before, .btn2:hover::before{
		height: 180%;
	}-->
	
	#my:hover{
		background-color:white;
		color:black;
		font-size:16px;
		border: 1px solid #3498db;
		border-radius : 5px 5px 5px 5px;
		transition:0.3s;
		height:180%;
		 box-shadow: 5px 10px #888888;
	}
</style>
<div class="slider_top2">
<h2>View questions</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
              <p>

<script>
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajaxsubject.php?q="+str,true);
xmlhttp.send();
}
</script>
<form method="get" action="">
<?php
if($_SESSION['usertype'] == "Administrator")
{
?>
<table width="541" border="1" class="content-table">
<thead>
  <tr>
    <th scope="col"><select name="select" size="1" style="color:black;" onchange="showUser(this.value)">
               		<option value="" style="color:black;">Select</option>
                 	<?php
					$sql = "SELECT * FROM course where status='Enabled'";
					$qresult = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qresult))
						{
							echo "<option value='$rs[courseid]'>$rs[coursename]</option>";
						}
				
             		?>
               	</select></th>
    <th scope="col"><div id="txtHint">
    <select size=1 name="subjectid" style="color:black;">
     <option value="">Select</option>
    
     <?php
     if(isset($_SESSION['courseid']))
     {
        $sql = "SELECT * FROM subjects where status='Enabled' and courseid='$_SESSION[courseid]'";
     }
     else
     {
        $sql = "SELECT * FROM subjects where status='Enabled'";	 
     }
        $qresult = mysqli_query($con,$sql);
        while($rs = mysqli_fetch_array($qresult))
            {
                if($rs['subjectcode'] == $_GET['subjectid'])
                {
                echo "<option value='$rs[subjectcode]' selected>$rs[subjectname]</option>";
                }
                else
                {
                echo "<option value='$rs[subjectcode]'>$rs[subjectname]</option>";			
                }
            }
     ?>
    
     </select>
 				</div></th>
    <th scope="col">&nbsp; <input type="submit" name="submit" id="submit" value="Submit" style="color:black;" /> </th>
  </tr>
 </thead>
</table>
              </p>
<?php
}
?> 		
<!-- delete questions by me-->
<?php
if(isset($_GET['delidd']))
{
	$sqldel ="DELETE FROM questions where queid='$_GET[delidd]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><strong>Record deleted successfully..</strong></font>";
	}
}

$selquestions = "select * from questions";
$selresult = mysqli_query($con,$selquestions);
?>
<!-- code overs here of delete questions by me-->	  

<?php
if($_SESSION['usertype'] == "Examiner")
{
?>
<center>
<table width="541" border="1" class='content-table' >
<thead>
  <tr>
    <th scope="col"><div id="txtHint">
    <select size=1 name="subjectid"  style="color:black;" >
     <option value="" style="color:black;">Select subject</option>
    
     <?php
        $sql = "SELECT * FROM subjects where status='Enabled' and courseid='$_SESSION[courseid]'";
        $qresult = mysqli_query($con,$sql);
        while($rs = mysqli_fetch_array($qresult))
            {
                if($rs['subjectcode'] == $_GET['subjectid'])
                {
                echo "<option value='$rs[subjectcode]' selected>$rs[subjectname]</option>";
                }
                else
                {
                echo "<option value='$rs[subjectcode]'>$rs[subjectname]</option>";			
                }
            }
     ?>
    
     </select>
 				</div></th>
    <th scope="col">&nbsp; <input type="submit" name="submit" id="submit" value="Submit"  style="color:black"/> </th>
  </tr>
  </thead>
</table>
    </form>
              </p>
<?php
}
?> 			  
<?php
if(isset($_GET['submit']))
{
?>
              <p>
<?php
$selquestions = "SELECT     questions.*, subjects.*, course.*
FROM         course INNER JOIN
                      subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN
                      questions ON subjects.subjectcode = questions.subjectcode where questions.subjectcode='$_GET[subjectid]'";
$selresult = mysqli_query($con,$selquestions);     
/*
echo "<h3>No of questions: ".mysqli_num_rows($selresult). "</h3>";     
*/ 
echo "<table class='content-table' width='595' border='1'>
	   <thead>
	   <th  style='text-align:center; font-size:20px;'><center>No of questions: ".mysqli_num_rows($selresult). "</th>
	   </thead></table>";
	   $qno=1;
  while($rs = mysqli_fetch_array($selresult))
{
	   echo "<table class='content-table' width='595' border='1'>
	   <thead>
	   <th colspan='2' style='text-align:center; font-size:20px;'><center>Question No. :- ".$qno. "</th>
	   </thead>
  <tr>
    <td width='28'><strong>Course name: </strong></td>
    <td width='291'><strong> $rs[20]</strong></td>
  </tr>
  <tr>
    <td width='28'><strong>Subject</strong></td>
    <td width='291'><strong>$rs[13]</strong></td>
  </tr>
  <tr>
    <td><strong>Question</strong></td>
    <td>&nbsp;$rs[question]</td>
  </tr>
  <tr>
    <td><strong>Image</strong></td>
    <td>&nbsp;";
	if($rs['uploads'] != "")
	{
	echo "<img src='uploads/$rs[uploads]' width='100' height='100'>";
	}
	
	echo "</td>
  </tr>
  <tr>
    <td><strong>Option A:</strong> </td>
    <td>$rs[option1]$rs[option2]</td>
  </tr>
  <tr>
    <td><strong>Option B:</strong></td>
    <td>$rs[option2]</td>
  </tr>
  <tr>
    <td><strong>Option C:</strong></td>
    <td>$rs[option3]</td>
  </tr>
    <tr>
    <td><strong>Option D:</strong></td>
    <td>$rs[option4]</td>
  </tr>
  <tr>
    <td><strong>Correct answer : </strong> </td>
    <td>";
	if($rs['answer']==1)
	{
		echo $rs['option1'];
	}
	else if($rs['answer']==2)
	{
		echo $rs['option2'];
	}
	if($rs['answer']==3)
	{
		echo $rs['option3'];
	}
	if($rs['answer']==4)
	{
		echo $rs['option4'];
	}
echo "	&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Description:</strong><br /></td><td>";
	echo $rs[9];
echo "	</td>
  </tr>
<tr>
    <td><strong>Status</strong></td>   
    <td>$rs[status]</td>
</tr>
<tr>
  <td colspan='2'>&nbsp;
    <center><a  id='my' class='btn btn-warning' href='questions.php?queid=$rs[queid]'>Edit</a>  |
 <a id='my' class='btn btn-danger' href='delete_question_by_me.php?queid=$rs[queid]'>Delete</a></center>
  </td>
</tr>
</table>
</table>
  <hr>";
  $qno = $qno + 1;
}
 ?> 


 
 
 
               </p>
<?php
}
?>
              </div>
        
 
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>