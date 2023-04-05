<?php
session_start();
include("dbconnection.php");
if(isset($_POST['changepassword']))
{
$sql = "UPDATE users SET password='$_POST[password]' where
username='$_POST[username]'";
		if(!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
		else
		{
			echo "Password updated successfully...";
		}
}
?>
<?php
include("header.php");
?>
    <div class="slider_top2">
<h2>Services</h2>
<p>“It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.Content here, content here', making it look like readable English.”<br />
  <a href="#">by: John S., businessman</a></p>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="left">
              <h2 class="serv">Userreset</h2>
               <p>
             
            

   <form method="post" action="">
<table  class="tftable" width="464" height="25%" border="1">
  <tr>
    <th width="166" height="37%" scope="col">User Name</th>
    <td width="144" scope="col">
    <input name="username" type="text" id="username" size="30" placeholder="Enter User Name"></td>
  </tr>
  <tr> 
    <th height="20%" scope="row">New Password</th>
    <td><label for="new password"></label>
    <input name="password" type="password" id="password" size="30" placeholder="Enter New Password"></td>
  </tr>
  <tr>
    <th height="20%" scope="row">Confirm Password</th>
    <td><label for="password"></label>
    <input name="cpassword" type="password" id="cpassword" size="30" placeholder="Enter Confirm Password"></td>
  </tr>
  <tr>
    <th height="23%" colspan="2" scope="row"><input type="Submit" name="changepassword" id="changepassword" value="Change password"></th>
  </tr>
</table> 
</form>             </p>
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