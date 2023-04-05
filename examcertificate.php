<?php
session_start();
include("dbconnection.php");
 
 	$sqlstudentprofile = "SELECT * FROM students where regno='$_SESSION[regno]'";
	$querystudentprofile = mysqli_query($con,$sqlstudentprofile);
	$rsstudentprofile = mysqli_fetch_array($querystudentprofile);

	$sqlcourse = "SELECT * FROM course where courseid='$rsstudentprofile[courseid]'";
	$qcourse = mysqli_query($con,$sqlcourse);
	$rscourse = mysqli_fetch_array($qcourse);
	
	$sqlsubjects = "SELECT * FROM subjects where courseid='$rscourse[courseid]'";
	$qsubjects = mysqli_query($con,$sqlsubjects);
	$rssubjects = mysqli_fetch_array($qsubjects);
	
	$sqlsubject = "SELECT * FROM exam INNER JOIN subjects ON subjects.subjectcode=exam.subjectcode where exam.examid='$_SESSION[examid]'";
	$qsubject = mysqli_query($con,$sqlsubject);
	$rssubject = mysqli_fetch_array($qsubject);
	
	$sqlexamresult = "SELECT * FROM results where examid='$_SESSION[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$rsexamresult = mysqli_fetch_array($qexamresult);
	
	//unanswered questions
	$sqlunanswered = "SELECT * FROM results where examid='$_SESSION[examid]' AND answerid='0'";
	$qunanswered = mysqli_query($con,$sqlunanswered);
	$rsunanswered = mysqli_fetch_array($qunanswered);
	
	//answered questions
	$sqlanswered = "SELECT * FROM results where examid='$_SESSION[examid]' AND answerid<>'0'";
	$qanswered = mysqli_query($con,$sqlanswered);
	$rsanswered = mysqli_fetch_array($qanswered);
	
	//Correct answers
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$_SESSION[examid]'";
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
<table width="610" border="1"  class="tftable">
  <tr>
    <th colspan="4" scope="col"><center>Candidate details</center></th>
    </tr>
  <tr>
    <th colspan="2" scope="col">Roll No</th>
    <td colspan="2" scope="col">&nbsp; <?php echo $rsstudentprofile['regno']; ?></td>
  </tr>
  <tr>
    <th width="183" colspan="2" scope="col">Student Name</th>
    <td width="249" colspan="2" scope="col">&nbsp; <?php echo $rsstudentprofile['name']; ?></td>
  </tr>
  <tr>
    <th colspan="4" scope="row"><center>Course details</center></th>
    </tr>
  <tr>
    <th colspan="2" scope="row"> Course</th>
    <td colspan="2"><label for="certificateid"></label> <?php echo $rscourse['coursename']; ?></td>
  </tr>
  <tr>
    <th colspan="2" scope="row">Subject code</th>
    <td colspan="2"><label for="studentid"></label> <?php echo $rssubjects['subjectcode']; ?></td>
  </tr>
  <tr>
    <th colspan="2" scope="row">Subject name</th>
    <td colspan="2"><label for="queid"></label> <?php echo $rssubjects['subjectname']; ?></td>
  </tr>
  <tr>
    <th colspan="4" scope="row"><center>Result details</center></th>
  </tr>
  <tr>
    <th scope="row">Subject</th>
    <th scope="row">Maximum Marks</th>
    <th>Maximum marks</th>
    <th>Result</th>
  </tr>
  <tr>
    <td scope="row">Subject</th>
    <td scope="row">Maximum Marks</th>
    <td>Maximum marks</th>
    <td>Result</th>
  </tr>
  <tr>
    <th colspan="3" scope="row">Total Marks</th>
    <td colspan="1">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="3" scope="row">Percentage</th>
    <td colspan="1"><label for="answer"></label></td>
  </tr>
  </table>
</form>
<br />
<table border="2" width='612' align="center"  class="tftable">
<tr>
<td align="center">
<button onclick="myFunction()">Print this page</button>

<script>
function myFunction()
{
window.print();
}
</script>
 </td>
 </tr>
 </table>
       </p>

              </div>
         

         
        <div class="clr"></div>
      </div>
    </div>
<?php
unset($_SESSION['examid']);
include("footer.php");
?>