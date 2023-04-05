<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel ="DELETE FROM users where userid='$_GET[delid]'";
	$seldelresult = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$delresult = "<font color='green'><center><strong>Record deleted successfully..</strong></font>";
	}
}
?>
<style>
/*by me table for students*/
	.con-table{
		border-collapse: collapse;
		margin: 25px 0;
		font-size: 0.6em;
		min-width: 800px;
		border-radius: 5px 5px 0 0 ;
		overflow: hidden;
		box-shadow: 0 0 20px rgba(0,0,0,0.15);
		font-family: 'Roboto', sans-serif;
		font-size:15px;
	}
	
	.con-table thead tr{
		background-color: #c3073f;
		color: #ffffff;
		text-align:left;
		font-weight: bold;
		font-family: 'Roboto', sans-serif;
	}
	
	.con-table th, 
	.con-table td{
		padding: 10px 13px ;
	}
	
	.con-table tbody tr{
		border-bottom: 1px solid #dddddd;
	}
	
	.con-table tbody tr:nth-of-type(even){
		background-color: #f3f3f3;
	}
	
	.con-table tbody tr:last-of-type{
		border-bottom: 2px solid #ad9ca3;
	}
	
	.con-table tbody tr:hover {
		font-weight:bold;
		color: #009879;
	}
</style>
<div class="slider_top2">
<h2>View Users</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="">
               <p>
<?php
$selusers = "select users.*,course.coursename from users INNER JOIN course ON users.courseid = course.courseid ";
$selresult = mysqli_query($con,$selusers);
if(isset($_REQUEST['searchbtn']))
{
$coursename=$_REQUEST['search'];
$output=$coursename."%";
$sql =  "select users.*,course.coursename from users INNER JOIN course ON users.courseid = course.courseid  '".$output."' ";
}
else
{
$sql = "select users.*,course.coursename from users INNER JOIN course ON users.courseid = course.courseid";
}
echo $delresult;			 

echo "<table  class='con-table table table-striped table-bordered' id='datatable'  width='100%' border='1'>
<thead>
  <tr>
    <th scope='col'>&nbsp;Course</th>
    <th scope='col'>&nbsp;Name</th>
    <th scope='col'>&nbsp;Designation</th>   
    <th scope='col'>&nbsp;User type</th>
    <th scope='col'>&nbsp;Username</th>
    <th scope='col'>&nbsp;Created at</th>
 
    <th scope='col'>&nbsp;Status</th>
	<th scope='col'>&nbsp;Action</th>
  </tr>
  </thead>";

while($rs = mysqli_fetch_array($selresult))
{
	echo "
	<tr>
		<td>&nbsp;$rs[coursename]</td>
		<td>&nbsp;$rs[name]</td>
		<td>&nbsp;$rs[designation]</td>
		<td>&nbsp;$rs[usertype]</td>
		<td>&nbsp;$rs[username]</td>
		<td>&nbsp;" . date("d-m-Y",strtotime($rs['createdat'])) ."</td>
		<td>&nbsp;$rs[status]</td>
		<td>&nbsp;
		<a class='btn btn-success' style='color:white;' href='users.php?userid=$rs[userid]'>Edit</a> 
		<a class='btn btn-danger' style='color:white;' href='viewusers.php?delid=$rs[userid]' onclick='return confirmdelete()'>Delete</a>
		</td>
  	</tr>
	";
}
?>

 
</table>

   </table>             </p>

              </div>
        
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>
<script>
function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>