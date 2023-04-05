<?php
session_start();
include("dbconnection.php");
$selcertificates = "SELECT certificate . * , students . * , course.coursename
FROM certificate
INNER JOIN students
INNER JOIN course ON certificate.regno = students.regno
AND students.courseid = course.courseid";
$selresult = mysqli_query($con,$selcertificates);
?>
<?php
include("header.php");
?>
    <div class="slider_top2">
<h2>View certificate</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="left">
               <p>
              
               <p>
   <?php
   echo "<table class='tftable' width='200' border='1'>
  <tr>
    <th scope='col'>&nbsp;Registration</th>
	<th scope='col'>&nbsp;student name</th>
	<th scope='col'>&nbsp;course</th>
    <th scope='col'>&nbsp;Totalmarks</th>
    <th scope='col'>&nbsp;Scoredmarks</th>   
    <th scope='col'>&nbsp;Result</th>
    <th scope='col'>&nbsp;Status</th>
  </tr>";

while($rs = mysqli_fetch_array($selresult))
{
	echo "
	<tr>
	    <td>&nbsp;$rs[regno]</td>
		<td>&nbsp;$rs[fname] $rs[lname]</td>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[totalmarks]</td>
		<td>&nbsp;$rs[scoredmarks]</td>
		<td>&nbsp;$rs[result]</td>
		<td>&nbsp;$rs[status]</td>
  	</tr>
	";
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