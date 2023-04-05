<?php
include("header.php");
$delresult="";
if(isset($_GET['subjectcode']))
{
	//subjectcode datetime
	$sqldel ="DELETE FROM exam where subjectcode='$_GET[subjectcode]' AND datetime='$_GET[datetime]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><strong>Record deleted successfully..</strong></font>";
		echo "<script>window.location='viewexamlist.php';</script>";
	}
}
$selexam = "SELECT     exam.*, subjects.*, course.*
FROM         course INNER JOIN
                      subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN
                      exam ON subjects.subjectcode = exam.subjectcode WHERE exam.datetime >= '$dttim' GROUP BY exam.subjectcode,exam.datetime ORDER BY exam.datetime DESC";
$selresult = mysqli_query($con,$selexam);
?>
<div class="slider_top2">
<h2>View exam</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
               
<?php
echo $delresult;
?>
<table  class="content-table" width='100%' border='1'>
<thead>
  <tr>
    <th width="105" scope='col'>&nbsp;Course</th>
    <th width="105" scope='col'>&nbsp;Subject code</th>
    <th width="105" scope='col'>&nbsp;Subject</th>
    <th width="170" scope='col'>&nbsp;Datetime</th>
	<th width="83" scope='col'>&nbsp;Action</th>
	<th width="83" scope='col'>&nbsp;View Students</th>
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
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[subjectcode]</td>
		<td>&nbsp;$rs[subjectname]</td>
		<td>&nbsp;" . date("d-M-Y h:i A",strtotime($rs['datetime'])) ."</td>
		<td>&nbsp;<a href='viewexamlist.php?subjectcode=$rs[subjectcode]&datetime=$rs[datetime]' style='color: white;' class='btn btn-danger'>Delete</a></td>
		<td>&nbsp;<a href='viewexam.php?subjectcode=$rs[subjectcode]&datetime=$rs[datetime]' style='color: white;' class='btn btn-info'>View students</a></td>

  	</tr>
	";
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