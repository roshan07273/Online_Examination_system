<?php
include("header.php");
 
 	$sqlstudentprofile = "SELECT * FROM students where regno='$_SESSION[regno]'";
	$querystudentprofile = mysqli_query($con,$sqlstudentprofile);
	$rsstudentprofile = mysqli_fetch_array($querystudentprofile);

	$sqlcourse = "SELECT * FROM course where courseid='$rsstudentprofile[courseid]'";
	$qcourse = mysqli_query($con,$sqlcourse);
	$rscourse = mysqli_fetch_array($qcourse);
	
	$sqlsubjects = "SELECT * FROM subjects where courseid='$rscourse[courseid]'";
	$qsubjects = mysqli_query($con,$sqlsubjects);
	$rssubjects = mysqli_fetch_array($qsubjects);
	
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
	$sqlanswered = "SELECT * FROM results where examid='$_GET[examid]' AND answerid<>'0'";
	$qanswered = mysqli_query($con,$sqlanswered);
	$rsanswered = mysqli_fetch_array($qanswered);
	
	//Correct answers
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$_GET[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$canswer = 0; $wanswer=0;
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
	
	
?>
<div class="slider_top2">
<h2 style="font-size:45px">Examination result</h2>

    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
                <form method=post action="">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<center>
<table width="610" border="1"  class="content-table" style="font-family: 'Sanchez', serif;">
<thead>
  <tr>
    <th colspan="2" scope="col"><center>Candidate details</center></th>
    </tr>
</thead>
  <tr>
    <th scope="col">Roll No</th>
    <td scope="col">&nbsp; <?php echo $rsstudentprofile['regno']; ?></td>
  </tr>
  <tr>
    <th width="183" scope="col">Student Name</th>
    <td width="249" scope="col">&nbsp; <?php echo $rsstudentprofile['name']; ?></td>
  </tr>
  <td colspan="2"></td>
 <thead>
  <tr>
    <th colspan="2" scope="row"><center>Course details</center></th>
    </tr>
</thead>
  <tr>
    <th scope="row"> Course</th>
    <td><label for="certificateid"></label> <?php echo $rscourse['coursename']; ?></td>
  </tr>
  <tr>
    <th scope="row">Subject code</th>
    <td><label for="studentid"></label> <?php echo $rssubjects['subjectcode']; ?></td>
  </tr>
  <tr>
    <th scope="row">Subject name</th>
    <td><label for="queid"></label> <?php echo $rssubjects['subjectname']; ?></td>
  </tr>
  <td colspan="2"></td>
  <thead>
  <tr>
    <th colspan="2" scope="row"><center>Result details</center></th>
    </tr>
</thead>
  <tr>
    <th scope="row">Total questions</th>
    <td>&nbsp;
    <?php
	$sqlexamresult = "SELECT * FROM results where examid='$_GET[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$rsexamresult = mysqli_fetch_array($qexamresult);
	echo $totalquestions = mysqli_num_rows($qexamresult);
	?></td>
  </tr>
  <tr>
    <th scope="row">Maximum Marks</th>
    <td>&nbsp;
    <?php echo $totalmarks = $rssubject['totalmarks']; ?>
    </td>
  </tr>
  <tr>
    <th scope="row">Pass marks</th>
    <td>&nbsp;<?php echo $passmarks = $rssubject['passmarks']; ?> %</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Answered questions</th>
    <td>&nbsp; <?php echo mysqli_num_rows($qanswered); ?></td>
  </tr>
  <tr>
    <th scope="row">Unanswered questions</th>
    <td>&nbsp; <?php echo mysqli_num_rows($qunanswered); ?></td>
  </tr>
  <tr>
    <th scope="row">Correct answers</th>
    <td>&nbsp; <?php echo $canswer; ?></td>
  </tr>
  <tr>
    <th scope="row">Incorrect answers</th>
    <td>&nbsp; <?php echo $wanswer; ?></td>
  </tr>
  <tr>
    <th scope="row">Marks obtained (In percentage %)</th>
    <td>&nbsp;<?php
    echo  $totpercentagemarks = (($canswer*100) /$totalquestions);	
	?> %
    </td>
  </tr>
  <tr>
    <th scope="row">Exam result</th>
    <td>&nbsp; <?php 
	if($totpercentagemarks < $passmarks)
	{
			echo "Fail"; 
	}
	else if($totpercentagemarks > 70)
	{
			echo "Distinction"; 		
	}
	else if($totpercentagemarks > 60)
	{
			echo "First class"; 		
	}
	else if($totpercentagemarks > 45)
	{
			echo "Second Class"; 			
	}
	else if($totpercentagemarks > 35)
	{
			echo "Pass Class"; 			
	}
	?></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td><label for="answer"></label></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><center><a href="viewanswers.php?examid=<?php echo $rssubject['examid'];?>">View Answers</a></center></th>
  </tr>
</table>
</form>
<br />
<table border="2" width='612' align="center">
<tr>

<script>
function myFunction()
{
window.print();
}
</script>
 </tr>
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