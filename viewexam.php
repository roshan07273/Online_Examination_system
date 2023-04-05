<?php
include("header.php");
$delresult="";
if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM exam where examid='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><strong>Record deleted successfully..</strong></font>";
	}
}
?>
    <div class="slider_top2">
<h2>View Students</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
               
<table  class="tftable" width='612' border='1'>
  <tr>
    <th width="105" scope='col'>&nbsp;Course</th>
    <th width="105" scope='col'>&nbsp;Subject code</th>
    <th width="105" scope='col'>&nbsp;Subject</th>
    <th width="170" scope='col'>&nbsp;Datetime</th>   
  </tr>
<?php
$selexam = "SELECT exam.*, subjects.subjectcode,subjects.subjectname, course.coursename FROM exam left join subjects ON exam.subjectcode=subjects.subjectcode  LEFT JOIN course ON course.courseid=subjects.courseid WHERE exam.subjectcode='$_GET[subjectcode]' AND exam.datetime='$_GET[datetime]' GROUP BY exam.subjectcode,exam.datetime";
$selresult = mysqli_query($con,$selexam);
echo mysqli_error($con);
while($rs = mysqli_fetch_array($selresult))
{
	$sqlstudentprofile = "SELECT * FROM students where regno='$rs[regno]'";
	$querystudentprofile = mysqli_query($con,$sqlstudentprofile);
	$rsstudentprofile = mysqli_fetch_array($querystudentprofile);
	echo "
	<tr>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[subjectcode]</td>
		<td>&nbsp;$rs[subjectname]</td>
		<td>&nbsp;" . date("d-M-Y h:i A",strtotime($rs['datetime'])) ."</td>

  	</tr>
	";
}
?>

</table>
<hr>
<?php
echo $delresult;
?>
<b>Students List : </b>
<table  class="tftable" width='612' border='1'>
  <tr>
    <th width="121" scope='col'>&nbsp;Name</th>
    <th width="121" scope='col'>&nbsp;Registration number</th>
    <th width="105" scope='col'>&nbsp;Course</th>
    <th width="105" scope='col'>&nbsp;Subject code</th>
    <th width="105" scope='col'>&nbsp;Subject</th>
    <th width="170" scope='col'>&nbsp;Datetime</th>   
	<th width="83" scope='col'>&nbsp;Action</th>
  </tr>
<?php

$selexam = "SELECT     exam.*, subjects.*, course.*
FROM         course INNER JOIN
                      subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN
                      exam ON subjects.subjectcode = exam.subjectcode WHERE exam.subjectcode='$_GET[subjectcode]' AND exam.datetime='$_GET[datetime]'";
$selresult = mysqli_query($con,$selexam);
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
		<td>&nbsp;$rs[subjectcode]</td>
		<td>&nbsp;$rs[subjectname]</td>
		<td>&nbsp;$rs[datetime] </td>
		<td>&nbsp;<a href='viewexam.php?delid=$rs[examid]&subjectcode=$_GET[subjectcode]&datetime=$_GET[datetime]' style='color: white;' class='btn btn-danger'>Delete</a></td>

  	</tr>
	";
}
?>

 
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