<?php
include("header.php");
if(isset($_POST['changepassword']))
{
	$sql = "UPDATE students SET password='$_POST[password]' where regno='$_SESSION[regno]' AND password='$_POST[opassword]' ";
	$result = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated successfully...');</script>";
		echo "<script>window.location='reset.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to Change password...');</script>";
	}
}
?><div class="slider_top2">
<h2 style="font-size:45px;">Change Password</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="left">
               <p>

<form name="formname" method="post" action="" onsubmit="return validation()" style="font-family: 'Sanchez', serif; font-size:35px;">
	<table  class="tftable" width="464" height="25%" border="1">
	  <tr>
		<th width="166" height="37%"  style="font-size:18px;" scope="col">Old Password</th>
		<td width="144" scope="col">
		<input name="opassword"   style="font-size:18px;" class="form-control" type="Password" id="opassword" size="30" placeholder="Enter Old Password"></td>
	  </tr>
	  <tr>
		<th height="20%" scope="row"  style="font-size:18px;">New Password</th>
		<td><label for="new password"></label>
		<input name="password"  style="font-size:18px;" class="form-control" type="password" id="password" size="30" placeholder="Enter New Password"></td>
	  </tr>
	  <tr>
		<th height="20%" scope="row"  style="font-size:18px;">Confirm Password</th>
		<td><label for="password"></label>
		<input name="cpassword"  style="font-size:18px;" class="form-control" type="password" id="cpassword" size="30" placeholder="Enter Confirm Password"></td>
	  </tr>
	</table> <br><center>
		<th height="23%" colspan="2" scope="row"><input type="Submit" class="btn btn-warning" style="font-size:18px;" name="changepassword" id="changepassword" value="Change password"></th>
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

	if(document.formname.opassword.value=="")
	{
		alert("Old Password should not be empty...");
		formname.opassword.focus();
		return false;
	}
	if(document.formname.password.value=="")
	{
		alert("Please Enter New Password...");
		formname.password.focus();
		return false;
	}
	if(document.formname.cpassword.value=="")
	{
		alert("Please Enter Confirm Password...");
		formname.cpassword.focus();
		return false;
	}
	
	if(document.formname.cpassword.value!=document.formname.password.value)
	{
		alert("Password and Confirm Password not matching...");
		formname.cpassword.focus();
		return false;
	}
	else
	{
		return true;
	}
	}

</script>