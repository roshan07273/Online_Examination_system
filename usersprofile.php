<?php
include("header.php");
if($_POST['setid'] == $_SESSION['setid'])
{
  if(isset($_POST['submit']))
  {	 
		$sql="UPDATE users SET courseid='$_POST[course]', name='$_POST[name]', designation='$_POST[designation]',username='$_POST[username]',password='$_POST[password]' WHERE userid='$_SESSION[examinerid]'";		
			if (!mysqli_query($con,$sql))
			  {
				die('Error: ' . mysqli_error($con));
			  }
			  else
			  {
				$res =  "<font color='green'><center>Record updated successfully...</font>";
				$resi=1;
			  }
  }
}
$_SESSION['setid']=rand();
$sql="SELECT * FROM users where userid='$_SESSION[examinerid]'";
$qres= mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qres);
?>
<div class="slider_top2">
<h2>Teacher Profile</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
	
                 <form name="formname" method=post action="" onsubmit="return validation()">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<center>
<table  class="content-table" border="1" style="width: 100%;">
<thead>
	<th colspan="2" style="text-align:center;">Update your Profile </th>
</thead>
		   <?php
if($resi==1)
{
echo "<tr>  <th colspan='2'>&nbsp;$res</th>  </tr>";
}
?>
<tbody>
  <tr>
    <th width="169" scope="col">Name</th>
    <td width="415" scope="col">
    <input type="text" name="name" id="name" value="<?php echo $rs['name']; ?>" placeholder="Enter Name" /></td>
  </tr>
  <tr>
    <th scope="row">Course</th>
    <td><label for="course"></label>
       <?php
	$result = mysqli_query($con,"Select * from course where status='Enabled'");
	?>
      <select name="course" id="course">
      <?php
	  while($rs1 = mysqli_fetch_array($result))
	  {
		  if($rs['courseid'] == $rs1['courseid'])
		  {
		  echo "<option value='$rs1[courseid]' selected>$rs1[coursename]</option>";
		  }
	  }
	  ?>
      </select></td>
  </tr>
  <tr>
    <th scope="row">Designation</th>
    <td><label for="designation"></label>
    <input type="text" name="designation" id="designation" value="<?php echo $rs['designation']; ?>" placeholder="Enter Designation"/></td>
  </tr>
  <tr>
    <th scope="row">User Type</th>
    <td><select name="usertype">
<?php
$arr = array("Examiner","Administrator");
foreach($arr as $val)
{
	if($val == $rs['usertype'])
	{
	echo "<option value='$val' selected >$val</option>";
	}
}
?>
    </select></td>
  </tr>
  <tr>
    <th scope="row">User Name</th>
    <td><label for="username"></label>
    <input type="text" name="username" id="username" value="<?php echo $rs['username']; ?>" placeholder="Enter User Name" /></td>
  </tr>
  <tr>
    <th scope="row">Password</th>
    <td><label for="password"></label>
    <input type="password" name="password" id="password" value="<?php echo $rs['password']; ?>" placeholder="Enter Password"/></td>
  </tr>
  <tr>
    <th scope="row">Confirm Password</th>
    <td><input type="password" name="confirmpassword" id="confirmpassword" value="<?php echo $rs['password']; ?>" placeholder="Enter Password"/></td>
  </tr>
 <thead>
  <tr>
    <th colspan="2" scope="row" style="text-align:center"><input type="submit" name="submit" id="submit" style="background-color:#fff; color:black; height: 40px; width:40%; border-radius:5px;" value="Update Profile" /></th>
  </tr>
 </thead>
 </tbody>
</table>
</form>
 
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
<script type="application/javascript">
function validation()
{ 

	if(formname.name.value=="")
	{
		alert("Please Enter Name...");
		formname.name.focus();
		return false;
	}		 
	else if(formname.course.value=="Select")
	{
		alert("Please Select Course...");
		formname.course.focus();
		return false;
	}
	else if(formname.designation.value=="")
	    {
			alert("Please Enter Designation...");
			formname.designation.focus();
		return false;
		 }
		 
	else if(formname.usertype.value=="")
		{
			alert("Please Enter Usertype...")
			formname.usertype.focus();
			return false;
		}
		else if(formname.username.value=="")
		{
			alert("Please Enter Username...")
			formname.username.focus();
			return false;
		}
		else if(formname.password.value=="")
		{
			alert("Please Enter Password...")
			formname.password.focus();
			return false;
		}
		else if(formname.password.value != formname.confirmpassword.value)
		{
			alert("Password and confirm password not matching..")
			formname.password.value="";
			formname.confirmpassword.value="";
			formname.password.focus();
			return false;			
		}
		else if(formname.status.value=="")
		{
			alert("Please Enter Status...")
			formname.status.focus();
			return false;
		}
	else
	{
		return true;
	}
	}

</script>