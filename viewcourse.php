<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM course where courseid='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><strong>Record deleted successfully..</strong></font>";
	}
}

$selcourse = "select * from course";
$selresult = mysqli_query($con,$selcourse);
?>
<div class="slider_top2">
<h2>View course</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="">
              <div class="full">
    
     <?php 	 
    echo $delresult;           
   echo "<center><table   class='content-table table table-striped table-bordered' id='datatable'  width='100%' border='1'>
   <thead>
  <tr>
    <th scope='col'>&nbsp;Coursename</th>
    <th scope='col'>&nbsp;description</th>
    <th scope='col'>&nbsp;status</th>
	<th scope='col' style='text-align:center'>&nbsp;Action</th>   
  </tr>
  </thead>";
  
   
  while($rs = mysqli_fetch_array($selresult))
  {
  echo "<tr>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[description]</td>
		<td>&nbsp;$rs[status]</td>
		<td style='text-align:center'>&nbsp;<a class='btn btn-success' style='color:white' href='course.php?courseid=$rs[courseid]'>Edit</a>";?> &nbsp;&nbsp
		<?php echo "<a class='btn btn-danger' style='color:white' href='viewcourse.php?delid=$rs[courseid]'>Delete</a></td>
  		</tr>";
  }
?> 
</table>

               </p>
              </div>
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>