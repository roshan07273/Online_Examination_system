<?php
include("header.php");
if($_POST['setid'] == $_SESSION['setid'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['courseid']))
		{
				$sql="UPDATE course SET coursename='$_POST[coursename]', description='$_POST[dse]', status='$_POST[status]' WHERE courseid='$_GET[courseid]'";		
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
			$sql="INSERT INTO course (coursename, description, status)VALUES	('$_POST[coursename]','$_POST[dse]','$_POST[status]')";		
			if (!mysqli_query($con,$sql))
			{
				die('Error: ' . mysqli_error($con));
			}
			else
			{
				$res =  "<font color='green'><center>1 record added</font>";
				$resi=1;
			}
		}
	}	
}
$_SESSION['setid'] = rand();
if(isset($_GET['courseid']))
{
$sql="SELECT * FROM course where courseid='$_GET[courseid]'";
$qres= mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qres);
}
?>
<div class="slider_top2">
<h2>Course</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
                <form name="formname" method=post action="" onsubmit="return validation()"> 
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<center>
<table  class="content-table">

<?php
if($resi==1)
{
echo "<tr>  <th colspan='2'>&nbsp;$res</th>  </tr>";
}
?>
<tr>
<th>Course Name: </th>
<td><input type="text" name="coursename" size=30 value="<?php echo $rs['coursename']; ?>"  placeholder="Enter Course Name Eg. BCA, BSC" class="form-control"/></td>  
</tr>

<tr>
<th> Description</th>
<td> <textarea name=dse rows="2" cols="24" placeholder="Enter Description"  class="form-control"/><?php echo $rs['description']; ?></textarea></td> 
</tr>

<tr>
<th> Status</th>
<td> 
<select name="status" class="form-control">
<option>Select</option>
<?php
$arr = array("Enabled","Disabled");
foreach($arr as $val)
{
	if($val == $rs['status'])
	{
	echo "<option value='$val' selected >$val</option>";
	}
	else
	{
	echo "<option value='$val'>$val</option>";
	}
}
?>
</select>
</td>
</tr>
</table>
<table class="content-table">
<thead>
<tr>
<td colspan="2" align="center" > <input type="submit" name="submit" value="Submit"  style="height:30px; width:40%; color:black"></td>
</tr>
</thead>
</table></form>
 
               </p>
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

	if(formname.coursename.value=="")
	{
		alert("Please Enter Course Name...");
		formname.coursename.focus();
		return false; 
	}
	else if(formname.Description.value=="")
	{
		alert("Please Enter Description...");
		formname.Description.focus();
		return false; 
	}
	else if(formname.status.value=="")
	{
		alert("Please Enter Status...");
		formname.status.focus();
		return false; 
	}
	else
	{
		return true;
	}
}
</script>