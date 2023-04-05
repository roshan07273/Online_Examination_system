<?php
include("header.php");
$delresult="";
if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM students where regno='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><center><strong>Record deleted successfully..</strong></font>";
	}
}
$selstudent = "select students.*,course.coursename from students LEFT JOIN course ON course.courseid = students.courseid";
$selresult = mysqli_query($con,$selstudent);
?>
<div class="slider_top2">
<h2>View students</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
   <?php
   echo $delresult;
?>
<center>
<table class="content-table table table-striped table-bordered" id="datatable" border='1' >
<thead>
  <tr>
    <th width="85" scope='col'>&nbsp;Reg No.</th>
    <th width="70" scope='col'>&nbsp;Course</th>
    <th width="200" scope='col'>&nbsp;Name</th>
     <th width="200" scope='col'>&nbsp;DOB</th>   
    <th width="179" scope='col'>&nbsp;Contact no</th>
    <th width="179" scope='col'>&nbsp;Status</th>
	<th width="380" scope='col'>&nbsp;Action</th>
  </tr>
  </thead>
<?php
while($rs = mysqli_fetch_array($selresult))
{
	echo "
	<tr>
		<td>&nbsp;$rs[regno]</td>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[name] </td>
		<td>&nbsp;$rs[dob] </td>
		<td>&nbsp;$rs[contactnumber]</td>
		<td style='text-align:center'>&nbsp;$rs[status]</td>
		<td style='text-align:center'>&nbsp;
		&nbsp;<a class='btn btn-success' style='color:white' href='student.php?regno=$rs[regno]'>Edit</a>&nbsp;&nbsp;
		<a class='btn btn-danger' style='color:white' href='viewstudent.php?delid=$rs[regno]'>Delete</a></td>

  	</tr>
	";
}
?>

 
</table>

 
               </p>
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