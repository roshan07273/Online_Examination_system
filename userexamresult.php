<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM exam where examid='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><strong>Record deleted successfully..</strong></font>";
	}
}

$selexam = "SELECT     exam.*, subjects.*, course.*
FROM         course INNER JOIN
                      subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN
                      exam ON subjects.subjectcode = exam.subjectcode where exam.regno='$_SESSION[regno]'";
$selresult = mysqli_query($con,$selexam);
?>
<div class="slider_top2">
<h2>View exam result</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
               
              <?php
echo $delresult;
?><center>
<table  class="content-table" width='612' border='1'>
<thead>
  <tr>
    <th width="121" scope='col' style="font-size:17px;">&nbsp;Name</th>
    <th width="121" scope='col' style="font-size:17px;">&nbsp;Registration No</th>
    <th width="105" scope='col' style="font-size:17px;">&nbsp;Course</th>
    <th width="105" scope='col' style="font-size:17px;">&nbsp;Subject</th>
    <th width="170" scope='col' style="font-size:17px;">&nbsp;Datetime</th>   
 	<th width="99"  scope='col' style="font-size:17px;">&nbsp;Result</th>
 	<th width="99"  scope='col' style="font-size:17px;">&nbsp;View</th>
  </tr>
 </thead>
 <tbody>
<?php
while($rs = mysqli_fetch_array($selresult))
{
	 	$sqlstudentprofile = "SELECT * FROM students where regno='$rs[regno]'";
	$querystudentprofile = mysqli_query($con,$sqlstudentprofile);
	$rsstudentprofile = mysqli_fetch_array($querystudentprofile);
	
	echo "
	<tr>
		<td>&nbsp;$rsstudentprofile[name]</td>
		<td>&nbsp;$rs[regno]</td>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[subjectname]</td>
		<td>&nbsp;$rs[datetime] </td>
 		<td>&nbsp;";
 


	$sqlcourse = "SELECT * FROM course where courseid='$rs[courseid]'";
	$qcourse = mysqli_query($con,$sqlcourse);
	$rscourse = mysqli_fetch_array($qcourse);
	
	$sqlsubjects = "SELECT * FROM subjects where courseid='$rs[courseid]'";
	$qsubjects = mysqli_query($con,$sqlsubjects);
	$rssubjects = mysqli_fetch_array($qsubjects);
	
	$sqlsubject = "SELECT * FROM exam INNER JOIN subjects ON subjects.subjectcode=exam.subjectcode where exam.examid='$rs[examid]'";
	$qsubject = mysqli_query($con,$sqlsubject);
	$rssubject = mysqli_fetch_array($qsubject);
	
	$sqlexamresult = "SELECT * FROM results where examid='$rs[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$rsexamresult = mysqli_fetch_array($qexamresult);
	
	//unanswered questions
	$sqlunanswered = "SELECT * FROM results where examid='$rs[examid]' AND answerid='0'";
	$qunanswered = mysqli_query($con,$sqlunanswered);
	$rsunanswered = mysqli_fetch_array($qunanswered);
	
	//answered questions
	$sqlanswered = "SELECT * FROM results where examid='$rs[examid]' AND answerid<>'0'";
	$qanswered = mysqli_query($con,$sqlanswered);
	$rsanswered = mysqli_fetch_array($qanswered);
	
	//Correct answers
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rs[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$totalquestions = mysqli_num_rows($qexamresult);
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
			if($totalquestions == 0)
			{
				echo "Result pending";
			}
			else
			{
					 $totpercentagemarks = (($canswer*100) /$totalquestions);
					

					if($totpercentagemarks > 70)
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
							echo "Pass"; 			
					}	
					else
					{
						echo "Failed";
					}
			}	
echo "</td>

<td><a href='result.php?examid=$rs[0]' target='_blank' class='btn btn-info'>View More</a></td>
</tr>";

}
?>

 </tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
              </div>
        
         <div class="right">
			<?php
		  include("usersidebar.php");
		  ?>
         </div>
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>