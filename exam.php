<?php
include("header.php");
$resi="";
$res ="";
if(isset($_POST['submitstudent']))
{
				
	$sqlquery = "SELECT * FROM  `students` where courseid='$_POST[excourseid]'";
	$rs = mysqli_query($con,$sqlquery);
	while($rsqueryst = mysqli_fetch_array($rs))
	{
		$dttime = $_POST['exdate']. " ". $_POST['extime'];
		$sql="INSERT INTO exam (regno,subjectcode,datetime,status)VALUES ('$rsqueryst[regno]', '$_POST[exsubjectid]',  '$dttime',  'Enabled')";
		if(!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
		else
		{
			$insid= mysqli_insert_id($con);
			$resi=1;
			echo "<script>alert('Student Records inserted with exam schedule..');</script>";
			echo "<script>window.location='viewexamlist.php?examid=$insid';</script>";
		}
	}
}
$_SESSION['setid']=rand();
if(isset($_GET['subjectcode']))
{
$sql="SELECT * FROM subjects where subjectcode='$_GET[subjectcode]'";
$qres= mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qres);
}
?>
<div class="slider_top2">
<h2>Exam</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
<?php
if($resi == 1)
{
	echo $res;
}
else
{
?>               
                 <form name="formname" method=get action="" onsubmit="return validation()">
<center>
<table width="597" border="1" class="content-table">
<?php
if($_SESSION['usertype'] == "Administrator")
{
?>
  <tr>
    <th width="205" scope="col">Course</th>
    <th width="659" scope="col" align="left">&nbsp;<select name="select" size="1"  onchange="showUser(this.value)">
               		<option value="">Select</option>
                 	<?php
					$sql = "SELECT * FROM course where status='Enabled'";
					$qresult = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qresult))
						{
							echo "<option value='$rs[courseid]'>$rs[coursename]</option>";
						}
				
             		?>
               	</select></th>
  </tr>
<?php
}
else
{
?>
<input type="hidden" name="select" id="select" value="<?php echo $_SESSION['courseid']; ?>">
<?php
}
?>
  <tr>
    <th height="26" scope="col">Subject</th>
    <th scope="col" align="left"><div id="txtHint">
      &nbsp;<select size=1 name="subjectid" >
        <option value="">Select</option>
        <?php
     if(isset($_SESSION['courseid']))
     {
        $sql = "SELECT * FROM subjects where status='Enabled' and courseid='$_SESSION[courseid]'";
     }
     else
     {
        $sql = "SELECT * FROM subjects where status='Enabled'";	 
     }
        $qresult = mysqli_query($con,$sql);
        while($rs = mysqli_fetch_array($qresult))
            {
                if($rsedit['subjectcode'] == $rs['subjectcode'])
                {
                echo "<option value='$rs[subjectcode]' selected>$rs[subjectname]</option>";
                }
                else
                {
                echo "<option value='$rs[subjectcode]'>$rs[subjectname]</option>";			
                }
            }
     ?>
        
        </select>
    </div></th>
    </tr>

  <?php
if($resi==1)
{
echo "<tr>  <th colspan='2'>&nbsp;$res</th>  </tr>";
}
?>
  <tr>
    
    <th scope="row">Date</th>
    <td><label for="date"></label>
      <input type="date" name="date" id="date" min="<?php echo date("Y-m-d"); ?>" /></td>
  </tr>
  <tr>
    <th scope="row">Time</th>
    <td><label for="time"></label>
    <input type="time" name="time" id="time" /></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center"><input type="submit" name="submitloadstudent" id="submit" class="btn btn-success" value="Load students record to add Exam" /></td>
  </tr>
</table>
</form>
               </p>
<?php
if(isset($_GET['select']))
{
?>
               <table width="876" border="1" class="content-table">
			   <thead>
                 <tr>
                   <th width="22%" scope="col">&nbsp;Registration No.</th>
                   <th width="32%" scope="col">&nbsp;Name</th>
                   <th width="22%" scope="col">&nbsp;DOB</th>
                   <th width="24%" scope="col">&nbsp;Contact No.</th>
                 </tr>
                 </thead>
                <?php
 $sqlquery = "SELECT * FROM  `students` where courseid='" . $_GET['select'] . "'";
$rs = mysqli_query($con,$sqlquery);
			while($rsqueryst = mysqli_fetch_array($rs))
			{
                echo "<tr>
                   <td>&nbsp;$rsqueryst[regno]</td>
                   <td>&nbsp;$rsqueryst[name]</td>
                   <td>&nbsp;$rsqueryst[dob]</td>
                   <td>&nbsp;$rsqueryst[contactnumber]</td>
                 </tr>";
			}
			    ?>
                 <tr>
                   <td  colspan="4" align="center">&nbsp;
                   <form method="post" action="" name="form1st">
                   <input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" /> 
                   <input type="hidden" name="excourseid" value="<?php echo $_GET['select']; ?>" />
                   <input type="hidden" name="exsubjectid" value="<?php echo $_GET['subjectid']; ?>" />
                   <input type="hidden" name="exdate" value="<?php echo $_GET['date']; ?>" />
                   <input type="hidden" name="extime" value="<?php echo $_GET['time']; ?>" />
                   <input type="submit" name="submitstudent" id="submit" value="Add this students record"  class="btn btn-success" style="height:40px; width:40%; color:white"/>
                   </form>
                   </td>
                 </tr>
               </table>
<?php
}
}
?>
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
	if(formname.regno.value=="")
	{
		alert("Please Enter Registration Number...");
		formname.regno.focus();
		return false; 
	}
	else if(formname.subjectcode.value=="")
	{
		alert("Please Enter Subject Code...");
		formname.subjectcode.focus();
		return false; 
	}
	else if(formname.date.value=="")
	{
		alert("Please Enter Date...");
		formname.date.focus();
		return false; 
	}
	else if(formname.time.value=="")
	{
		alert("Please Enter Time...");
		formname.time.focus();
		return false; 
	}
	else if(formname.status.value=="Select")
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
    
    <script>
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajaxsubject.php?q="+str,true);
xmlhttp.send();
}
</script>