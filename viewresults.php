<?php
session_start();
include("dbconnection.php");

if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM results where resultid='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><strong>Record deleted successfully..</strong></font>";
	}
}
$selresults = "SELECT results.*,students.fname,students.lname FROM results INNER JOIN students ON results.studentid = students.studentid";
$selresult = mysqli_query($con,$selresults);
?>
<?php
include("header.php");
?>
    <div class="slider_top2">
<h2>View results</h2>

    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="left">
              
               <p>
<?php 
echo $delresult;            
echo "<table class='tftable' width='200' border='1'>
  <tr>
    <th scope='col'>&nbsp;result id</th>
    <th scope='col'>&nbsp;certificate id</th>
    <th scope='col'>&nbsp;student name</th>
    <th scope='col'>&nbsp;que id</th>
    <th scope='col'>&nbsp;answer</th>
	<th scope='col'>&nbsp;Action</th>
  </tr>";
  while($rs = mysqli_fetch_array($selresult))
{
	echo "
  <tr>
    <td>&nbsp;$rs[resultid]</td>
    <td>&nbsp;$rs[certificateid]</td>
    <td>&nbsp;$rs[fname] $rs[lname]</td>
    <td>&nbsp;$rs[queid]</td>
    <td>&nbsp;$rs[answer]</td>
	<td>&nbsp;<a href='results.php?resultid=$rs[resultid]'>Edit</a> |
		<a href='viewresults.php?delid=$rs[resultid]'>Delete</a>
		</td>
  </tr>";
}
?>
</table>
           </p>
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