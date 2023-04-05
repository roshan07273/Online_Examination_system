<?php
include("header.php");
$selst = "SELECT     students.*, course.*, students.regno AS Expr1 FROM students LEFT OUTER JOIN course ON students.courseid = course.courseid WHERE (students.regno = '$_SESSION[regno]')";
$qst = mysqli_query($con,$selst);
$rsqst = mysqli_fetch_array($qst);

$selexam = "SELECT     exam.*, subjects.*, course.* FROM  course INNER JOIN subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN exam ON subjects.subjectcode = exam.subjectcode where exam.regno='$_SESSION[regno]'";
$selresult = mysqli_query($con,$selexam);
?>
<div class="slider_top2">
<h2>Hall Ticket</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full"><center>
                <table  class="content-table" width="200" border="1" style="font-family: 'Sanchez', serif;">
                  <tr align="left">
                    <th scope="col" style="font-size:17px;">&nbsp; Registration No. : <?php echo $rsqst['regno']; ?></th>
                    <th scope="col" style="font-size:17px;">&nbsp; Course : <?php echo $rsqst['coursename']; ?></th>
                  </tr>
                  <tr align="left">
                    <th width="319" scope="col" style="font-size:17px;">&nbsp; Name :  <?php echo $rsqst['name']; ?>
                    
                    </th>
                    <th width="287" scope="col" style="font-size:17px;">&nbsp; DOB : <?php echo $rsqst['dob']; ?></th>
                  </tr>
                  <tr>
                    <td colspan="2">
                    <strong>Exam Time table: </strong><br />
                      <table width='100%' border='1'>
  <tr>
    <th width="121" scope='col' style="font-size:17px;">Registration No.</th>
    <th width="105" scope='col' style="font-size:17px;">&nbsp;Course</th>
    <th width="105" scope='col' style="font-size:17px;">&nbsp;Subject</th>
    <th width="170" scope='col' style="font-size:17px;">&nbsp;Datetime</th>   
 	<th width="99" scope='col' style="font-size:17px;">&nbsp;Signature</th>
  </tr>
<?php
while($rs = mysqli_fetch_array($selresult))
{
	echo "
	<tr>
		<td>&nbsp;$rs[regno]</td>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[subjectname]</td>
		<td>&nbsp;$rs[datetime] </td>
 		<td>&nbsp;	</td>
  	</tr>
	";
}
?>

 
</table>
                    </td>
                  </tr>
                </table>


<script>
function myFunction()
{
window.print();
}
</script>
 </table>
 <button onclick="myFunction()" class="btn btn-success">Print this page</button>
              </div>

        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>