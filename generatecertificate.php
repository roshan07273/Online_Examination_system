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
<h2>Certificate</h2>

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
    <th colspan="2" scope="col"><center>Candidate details</center></th>
    </tr>
  <tr>
    <th scope="col">Roll No</th>
    <td scope="col">&nbsp; <?php echo $rsstudentprofile['regno']; ?></td>
  </tr>
  <tr>
    <th width="183" scope="col">Student Name</th>
    <td width="249" scope="col">&nbsp; <?php echo $rsstudentprofile['name']; ?></td>
  </tr>
  <tr>
    <th scope="row"> Course</th>
    <td><label for="certificateid"></label> <?php echo $rscourse['coursename']; ?></td>
  </tr>
  </table>
<table width="610" border="1"  class="tftable">
  <tr>
    <th colspan="5" scope="col"><center>
      Marks details
      </center></th>
  </tr>
  <tr>
    <th width="136" scope="row">Subject name</th>
    <th width="139" scope="row">Subject code</th>
    <th width="104"><label for="studentid2"><strong>Total marks</strong></label></td>
    <th width="37"><strong>Maks obtained</strong></td>
    <th width="37">Marks obtained (In percentage %)</td>
  </tr>
  <tr>
    <td scope="row"><?php echo $rssubjects['subjectname']; ?></td>
    <td scope="row"><?php echo $rssubjects['subjectcode']; ?></td>
    <td><label for="queid2">
      <?php
	$sqlexamresult = "SELECT * FROM results where examid='$_SESSION[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$rsexamresult = mysqli_fetch_array($qexamresult);
	echo $totalquestions = mysqli_num_rows($qexamresult);
	?>
    </label></td>
    <td><?php echo $canswer; ?></td>
    <td><?php
    echo  $totpercentagemarks = (($canswer*100) /$totalquestions);	
	?>
% </td>
  </tr>
</table>
<p>&nbsp;</p>
                </form>
<br />
<table border="2" width='612' align="center">
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