<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM subjects where subjectcode='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><center><strong>Record deleted successfully..</strong></font>";
	}
}
$selsubjects = "select subjects.*,course.coursename from subjects INNER JOIN course ON subjects.courseid=course.courseid ";
$selresult = mysqli_query($con,$selsubjects);
?>
<div class="slider_top2">
<h2>View Subjects</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body" style="padding: 10px;">
              <div class="">
               <p>
               
               <?php
			   echo $delresult;
			    echo "<center><table   class='content-table table table-striped table-bordered' id='datatable'  width='100%' border='1'>
				<thead>
  <tr>
    <th scope='col'>&nbsp;Course</th>
	<th scope='col'>&nbsp;Subject code</th>
    <th scope='col'>&nbsp;Subject name</th>
    <th scope='col'>&nbsp;Rules</th>
    <th scope='col'>&nbsp;Total marks</th>
    <th scope='col'>&nbsp;Pass marks</th>
    <th scope='col'>&nbsp;Status</th>
	<th scope='col' style='text-align:center;'>&nbsp;Action</th>
  </tr>
  </thead>";
  while($rs = mysqli_fetch_array($selresult))
   {
	   echo "
  <tr>
    <td>&nbsp;$rs[coursename]</td>
	<td>&nbsp;$rs[subjectcode]</td>
    <td>&nbsp;$rs[subjectname]</td>
    <td style='text-align:center;'>&nbsp;$rs[rules]</td>
    <td>&nbsp;$rs[totalmarks]</td>
    <td>&nbsp;$rs[passmarks]</td>
    <td>&nbsp;$rs[status]</td>
	<td style='text-align:center;'>&nbsp;<a class='btn btn-success' href='subjects.php?subjectcode=$rs[subjectcode]' style='width: 100%;'>Edit</a><hr>";echo "<a class='btn btn-danger' href='viewsubjects.php?delid=$rs[subjectcode]'style='width: 100%;'>Delete</a></td></tr>";
   }
      ?>
   </table>                   </p>
              </div>
        
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>