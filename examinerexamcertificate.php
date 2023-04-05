<?php
session_start();
include("dbconnection.php");
 
 	$sqlstudentprofile = "SELECT * FROM students where regno='$_GET[regno]'";
	$querystudentprofile = mysqli_query($con,$sqlstudentprofile);
	$rsstudentprofile = mysqli_fetch_array($querystudentprofile);

	$sqlcourse = "SELECT * FROM course where courseid='$rsstudentprofile[courseid]'";
	$qcourse = mysqli_query($con,$sqlcourse);
	$rscourse = mysqli_fetch_array($qcourse);
	
	$sqlsubjects = "SELECT * FROM subjects where courseid='$rscourse[courseid]'";
	$qsubjects = mysqli_query($con,$sqlsubjects);
	while($rssubjects = mysqli_fetch_array($qsubjects))
	{
	$subjectcode[] = $rssubjects['subjectcode'];
	$subjectname[] = $rssubjects['subjectname'];
	$totalmarks[] = $rssubjects['totalmarks'];
	$passmarks[] = $rssubjects['passmarks'];
	}
	
	$sqlsubject = "SELECT * FROM exam INNER JOIN subjects ON subjects.subjectcode=exam.subjectcode where exam.examid='$_GET[examid]'";
	$qsubject = mysqli_query($con,$sqlsubject);
	$rssubject = mysqli_fetch_array($qsubject);
	
	$sqlexamresult = "SELECT * FROM results where examid='$_GET[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$rsexamresult = mysqli_fetch_array($qexamresult);
	
	//unanswered questions
	$sqlunanswered = "SELECT * FROM results where examid='$_GET[examid]' AND answerid='0'";
	$qunanswered = mysqli_query($con,$sqlunanswered);
	$rsunanswered = mysqli_fetch_array($qunanswered);
	
	//answered questions
	$sqlanswered = "SELECT * FROM results inner join certificate on certificate.examid=exam.examid where examid='$_GET[examid]' AND answerid<>'0'";
	$qanswered = mysqli_query($con,$sqlanswered);
	$rsanswered = mysqli_fetch_array($qanswered);
	
	//Correct answers
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$_GET[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
	
	
include("header.php");
?>
<div class="slider_top2">
<h2>Exam certificate</h2>

    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
                <form method=post action="">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<center>
<table width="610" border="1"  class="content-table">
<thead>
  <tr>
    <th colspan="5" scope="col"><center>Candidate details</center></th>
    </tr>
	</thead>
  <tr>
    <th colspan="3" scope="col">Roll No</th>
    <td colspan="2" scope="col">&nbsp; <?php echo $rsstudentprofile['regno']; ?></td>
  </tr>
  <tr>
    <th width="183" colspan="3" scope="col">Student Name</th>
    <td width="249" colspan="2" scope="col">&nbsp; <?php echo $rsstudentprofile['name']; ?></td>
  </tr>
  <br>
  
  <thead>
  <tr>
    <th colspan="5" scope="row"><center>Course details</center></th>
    </tr>
	</thead>
  <tr>
    <th colspan="3" scope="row"> Course</th>
    <td colspan="2"><label for="certificateid"></label> <?php echo $rscourse['coursename']; ?></td>
  </tr>
  <br>
  <thead>
  <tr>
    <th colspan="5" scope="row"><center>Result details</center></th>
  </tr>
  </thead>
  <br>
  
  <thead>
  <tr>
    <th scope="row">Subject code</th>
    <th scope="row">Subject Name</th>
    <th scope="row">Maximum Marks</th>
    <th>Pass marks </th>
    <th>Scored marks</th>
  </tr>
  </thead>
  <tr>
    <td scope="row"> <?php echo $subjectcode[0]; ?>
    <td scope="row"> <?php echo $subjectname[0]; ?>  
    <td scope="row">  <?php echo $totalmarks[0]; ?>  
    <td>    <?php echo $passmarks[0]; ?><td>    
    <?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[0]' and regno='$_GET[regno]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
		if(mysqli_num_rows($qexam1) != 0)
	{
		$rsexam1 = mysqli_fetch_array($qexam1);
		$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
		$qexamresult = mysqli_query($con,$sqlexamresult);
		while($rsexamresult = mysqli_fetch_array($qexamresult))
		{
			if($rsexamresult['answerid'] == $rsexamresult['answer'])
			{
				$canswer = $canswer  + 1;
			}
			else
			{
				$wanswer = $wanswer  + 1;
			}
		}
		  $marks0 = (100 * $canswer) /$totalmarks[0];
		echo	$ans0 = $canswer;
			$canswer = $wanswer =0;
	}
	?>
  </tr>
  <tr>
    <td scope="row">   <?php echo $subjectcode[1]; ?> 
    <td scope="row">   <?php echo $subjectname[1]; ?> 
    <td scope="row">   <?php echo $totalmarks[1]; ?>
    <td>   <?php echo $passmarks[1]; ?><td><?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[1]' and regno='$_GET[regno]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
		if(mysqli_num_rows($qexam1) != 0)
	{	
	$rsexam1 = mysqli_fetch_array($qexam1);
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
		echo	$ans1 = $canswer;	
	 $marks1 = (100 * $canswer) /$totalmarks[0];
		$canswer = $wanswer =0;
	}
	?>    
    </tr>
  <tr>
    <td scope="row">   <?php echo $subjectcode[2]; ?> 
    <td scope="row">   <?php echo $subjectname[2]; ?> 
    <td scope="row">   <?php echo $totalmarks[2]; ?> 
    <td>   <?php echo $passmarks[2]; ?>
    <td><?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[2]' and regno='$_GET[regno]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
		if(mysqli_num_rows($qexam1) != 0)
	{
		$rsexam1 = mysqli_fetch_array($qexam1);
		$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
		$qexamresult = mysqli_query($con,$sqlexamresult);
		while($rsexamresult = mysqli_fetch_array($qexamresult))
		{
			if($rsexamresult['answerid'] == $rsexamresult['answer'])
			{
				$canswer = $canswer  + 1;
			}
			else
			{
				$wanswer = $wanswer  + 1;
			}
		}
		echo	$ans2 = $canswer;		
		 $marks2 =(100 * $canswer) /$totalmarks[0];
			$canswer = $wanswer =0;
	}
	?>    
    </tr>
  <tr>
    <td scope="row">    <?php echo $subjectcode[3]; ?>
    <td scope="row">   <?php echo $subjectname[3]; ?> 
    <td scope="row">   <?php echo $totalmarks[3]; ?> 
    <td>   <?php echo $passmarks[3]; ?><td><?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[3]' and regno='$_GET[regno]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
		if(mysqli_num_rows($qexam1) != 0)
	{
	$rsexam1 = mysqli_fetch_array($qexam1);
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
		echo	$ans3 = $canswer;	
	 $marks3 =(100 * $canswer) /$totalmarks[0];
		$canswer = $wanswer =0;
	}
	?>    
    </tr>
  <tr>
    <td scope="row">    <?php echo $subjectcode[4]; ?>
    <td scope="row">   <?php echo $subjectname[4]; ?> 
    <td scope="row">   <?php echo $totalmarks[4]; ?> 
    <td>     <?php echo $passmarks[4]; ?><td><?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[4]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
			if(mysqli_num_rows($qexam1) != 0)
	{
	$rsexam1 = mysqli_fetch_array($qexam1);
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
		echo	$ans4 = $canswer;	
	  $marks4 = (100 * $canswer) /$totalmarks[0];
	$canswer = $wanswer =0;
	}
	?>    
    </tr>
  <tr>
    <td scope="row">   <?php echo $subjectcode[5]; ?> 
    <td scope="row">   <?php echo $subjectname[5]; ?> 
    <td scope="row">   <?php echo $totalmarks[5]; ?> 
    <td>     <?php echo $passmarks[5]; ?><td><?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[5]' and regno='$_GET[regno]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
			if(mysqli_num_rows($qexam1) != 0)
	{
	$rsexam1 = mysqli_fetch_array($qexam1);
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
		echo	$ans5 = $canswer;	
	 $marks5 = (100 * $canswer) /$totalmarks[0];
		$canswer = $wanswer =0;
	}
	?>    
    </tr>
  <tr>
    <td scope="row">    <?php echo $subjectcode[6]; ?>
    <td scope="row">    <?php echo $subjectname[6]; ?>
    <td scope="row">    <?php echo $totalmarks[6]; ?>
    <td>     <?php echo $passmarks[6]; ?><td><?php
		$sqlexam1 = "SELECT * FROM exam where subjectcode='$subjectcode[6]' and regno='$_GET[regno]'";
	$qexam1 = mysqli_query($con,$sqlexam1);
			if(mysqli_num_rows($qexam1) != 0)
	{
	$rsexam1 = mysqli_fetch_array($qexam1);
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexam1[0]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
		echo	$ans6 = $canswer;	
	 $marks6 = (100 * $canswer) /$totalmarks[0];
		$canswer = $wanswer =0;
	}
	?>    
    </tr>
  <tr>
    <th colspan="4" scope="row">Total Marks</th>
    <td colspan="1">&nbsp;<?php echo $totalmarksall = $ans0 + $ans1+ $ans2 + $ans3 + $ans4 + $ans5 + $ans6 ; ?> </td>
  </tr>
  <tr>
    <th colspan="4" scope="row">Percentage</th>
    <td colspan="1">&nbsp; <?php 
	$totmarksp = $totalmarks[0] + $totalmarks[1] + $totalmarks[2] + $totalmarks[3] + $totalmarks[4] + $totalmarks[5] + $totalmarks[6];
	 $totalpercentageall = (100 * $totalmarksall) /$totmarksp; 
	 echo $totalpercentageall . " %";
	?></td>
  </tr>
  <tr>
    <th colspan="4" scope="row">Result </th>
    <td colspan="1">&nbsp;
     <?php
	  $rsexamresult = $totalpercentageall;
	if($rsexamresult > 70)
					{
							echo "Distinction"; 		
					}
					else if($rsexamresult > 60)
					{
							echo "First class"; 		
					}
					else if($rsexamresult > 45)
					{
							echo "Second Class"; 			
					}
					else if($rsexamresult > 35)
					{
							echo "Pass"; 			
					}	
					else
					{
						echo "Failed";
					}
	?>
    </td>
  </tr>
  </table>
</form>
<br />

<script>
function myFunction()
{
window.print();
}
</script>
 </table>
 
 <button onclick="myFunction()" class="btn btn-success">Print this page</button>
       </p>

              </div>
         

         
        <div class="clr"></div>
      </div>
    </div>
<?php
unset($_GET['examid']);
include("footer.php");
?>