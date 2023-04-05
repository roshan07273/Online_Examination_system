<?php
include("dbconnection.php");
?>

<select size=1 name="subjectid" >
 <option>Select</option>

 <?php
	$sql = "SELECT * FROM subjects where status='Enabled' and courseid='$_GET[q]'";
	$qresult = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qresult))
		{
			echo "<option value='$rs[subjectcode]'>$rs[subjectname]</option>";
		}
 ?>

 </select>