<?php
include("header.php");
$resi=0;
if(isset($_POST['submit']))
{
	if(isset($_GET['subjectcode']))
	{
		$sql="UPDATE subjects SET subjectname='$_POST[subjectname]', courseid='$_POST[course]', rules='$_POST[rules]',totalmarks='$_POST[totalmarks]',passmarks='$_POST[passmarks]',status='$_POST[status]' WHERE subjectcode='$_GET[subjectcode]'";		
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
		else
		{
			$res =  "<font color='green'><center>1 record updated</font>";
			$resi=1;
		}
	}
	else
	{
		$sql="INSERT INTO subjects(subjectcode,subjectname,courseid,  rules,totalmarks, passmarks,examduration, status)
		VALUES('$_POST[subjectcode]','$_POST[subjectname]','$_POST[course]','$_POST[rules]','$_POST[totalmarks]','$_POST[passmarks]','$_POST[examduration]','$_POST[status]')";
		if(!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
		else
		{
			echo "<script>alert('One record is added');</script>";
			echo "<script>window.location='subjects.php';</script>";
			$resi=1;
		}
	}
}
if(isset($_GET['subjectcode']))
{
$sql="SELECT * FROM subjects where subjectcode='$_GET[subjectcode]'";
$qres= mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qres);
}
?>
<div class="slider_top2">
<h2>Subjects</h2>

    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
                <form name="formname" method=post action=""  onsubmit="return validation()">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<center>
<table class="content-table"  width="533" border="1">
<?php
if($resi==1)
{
echo "<tr>  <th colspan='2'>&nbsp;$res</th>  </tr>";
}
?>

  <tr>
    <th height="107" scope="col">Subject code</th>
    <td scope="col"><input name="subjectcode" type="text" id="subjectcode" size="40" 
	<?php
	if(isset($_GET['subjectcode']))
	{
		if($rs['subjectcode'] != "")
		{
		echo "value='$rs[subjectcode]' readonly";
		}
	}
	?>   placeholder="Enter Subject Name" /></td>
  </tr>
  <tr>
    <th width="138" scope="col">Subject Name</th>
    <td width="379" scope="col"><label for="subjectname"></label>
    <input name="subjectname" type="text" id="subjectname" size="40" value="<?php echo $rs['subjectname']; ?>" placeholder="Enter Subject Name" /></td>
  </tr>
  <tr>
    <th scope="row">Course</th>
    <td>
    <select name="course" id="course">
    <option>Select</option>
      <?php
	  $result = mysqli_query($con,"Select * from course where status='Enabled'");
	  while($rs1 = mysqli_fetch_array($result))
	  {
		  if($rs['courseid'] == $rs1['courseid'])
		  {
		  echo "<option value='$rs1[courseid]' selected>$rs1[coursename]</option>";
		  }
		  else
		  {
		  echo "<option value='$rs1[courseid]'>$rs1[coursename]</option>";
		  }
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <th scope="row">Rules</th>
    <td><label for="rules"></label>
    <textarea name="rules" id="rules" cols="35" rows="5" placeholder="Enter Rules"><?php echo $rs['rules']; ?></textarea></td>
  </tr>
  <tr>
    <th scope="row">Total Marks</th>
    <td><label for="totalmarks"></label>
    <input type="text" name="totalmarks" id="totalmarks" value="<?php echo $rs['totalmarks']; ?>" placeholder="Enter Total Marks"/></td>
  </tr>
  <tr>
    <th scope="row">Pass Marks</th>
    <td><label for="passmarks"></label>
    <input type="text" name="passmarks" id="passmarks" value="<?php echo $rs['passmarks']; ?>" placeholder="Enter Pass Marks"/></td>
  </tr>
  <tr>
    <th scope="row">Exam duration (In minutes)</th>
    <td><input type="number"  name="examduration" id="examduration" value="<?php echo $rs['examduration']; ?>" placeholder="Enter Exam duration"/></td>
  </tr>
  <tr>
    <th scope="row">Status</th>
    <td>
      <select name="status" id="status">
		<?php
		$arr  = array("Enabled","Disabled");
		foreach($arr as $val)
		{
			if($rs['status'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
      </select></td>
  </tr>
  </table>
  
  <table class="content-table"> 
  <thead>
  <tr>
    <th colspan="2" scope="row" style="text-align:center"><input type="submit" name="submit" id="submit" style="height:30px; width:40%; color:black" value="Submit" /></th>
  </tr>
  </thead>
</table>
</form>

 
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
<script type="application/javascript">
function validation()
{ 
	if(formname.subjectcode.value=="")
	{
		alert("Please Enter Subject code...");
		formname.subjectcode.focus();
		return false; 
	}
	else if(formname.subjectname.value=="")
	{
		alert("Please Enter Subject Name...");
		formname.subjectname.focus();
		return false; 
	}
	else if(formname.course.value=="Select")
	{
		alert("Please Select Course Name...");
		formname.course.focus();
		return false; 
	}
	else if(formname.rules.value=="")
	{
		alert("Please Enter Rules...");
		formname.rules.focus();
		return false; 
	}
	else if(formname.totalmarks.value=="")
	{
		alert("Please Enter Total Marks...");
		formname.totalmarks.focus();
		return false; 
	}
	else if(formname.passmarks.value=="")
	{
		alert("Please Enter Pass Marks...");
		formname.passmarks.focus();
		return false; 
	}
	else if(formname.examduration.value=="")
	{
		alert("Please Enter Exam Duration...");
		formname.examduration.focus();
		return false; 
	}
	else if(formname.status.value=="Select")
	{
		alert("Please Select Status...");
		formname.status.focus();
		return false; 
	}
	else
	{
		return true;
	}
	}
	</script>