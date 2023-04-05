<?php
include("header.php");
if($_POST['setid'] == $_SESSION['setid'])
{
if(isset($_POST['submit']))
{ 

				if($_FILES["uploads"]["name"]== "")
				{
				$filename = $_POST['imgset'];
				}
				else
				{
					$filename = rand().$_FILES["uploads"]["name"];
				move_uploaded_file($_FILES["uploads"]["tmp_name"],"uploads/" . $filename);
				}
		  if(isset($_GET['queid']))
			{
			$sql="UPDATE questions SET subjectcode='$_POST[subjectid]',question='$_POST[question]', uploads='$filename', option1='$_POST[optiona]', option2='$_POST[optionb]', option3='$_POST[optionc]', option4='$_POST[optiond]', answer='$_POST[answerid]', description='$_POST[description]', status='$_POST[status]' WHERE queid='$_GET[queid]'";		
				if (!mysqli_query($con,$sql))
				  {
					die('Error: ' . mysqli_error($con));
				  }
				  else
				  {
					$res =  "<font color='green'><center>1 record updated</center></font>";
					$resi=1;
				  }
			}
			else
			{
				$sql="INSERT INTO questions( subjectcode,  question, uploads, option1, option2, option3, option4, answer, description, status)
VALUES('$_POST[subjectid]','$_POST[question]','$filename','$_POST[optiona]','$_POST[optionb]','$_POST[optionc]','$_POST[optiond]','$_POST[answerid]','$_POST[description]','$_POST[status]')";
				
				if(!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
				else
				{
								$res =  "<font color='green'><center>1 record added</center></font>";
							$resi=1;
				}
	  }
}
  
}
$_SESSION['setid']=rand();

$sqledit="SELECT * FROM questions where queid='$_GET[queid]'";
$qresedit= mysqli_query($con,$sqledit);
$rsedit = mysqli_fetch_array($qresedit);
?>
<div class="slider_top2">
<h2>Questions </h2>

    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
                <form name="formname" method=post action="" onsubmit="return validation()" enctype="multipart/form-data"> 
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />

<center>
               <table  class="content-table" width="565">
			   <thead>
			   <th colspan="2" style="text-align:center; font-size:20px;"> Question Table</th>
				</thead>
               <?php
if($resi==1)
{
echo "<tr>  <th colspan='2'>&nbsp;$res</th>  </tr>";
}

if(!isset($_GET['queid']))
{
	if($_SESSION['usertype'] == "Administrator")
	{
?>
	 <tr>
	   <th width="196">Course <font color='#FF0033'> * </font></th>
	   <td width="357"><select name="select" size="1"  onchange="showUser(this.value)">
	   <option value="Select">Select</option>
		 <?php
		$sql = "SELECT * FROM course where status='Enabled'";
		$qresult = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qresult))
			{
				echo "<option value='$rs[courseid]'>$rs[coursename]</option>";
			}
	
	 ?>
	   </select></td>
	 </tr>
<?php
	}
}
?>
 <tr>
   <th>Subject <font color='#FF0033'>*</font></th>
 <td>
 <div id="txtHint">
 <select size=1 name="subjectid" >
 <option>Select</option>

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
 </div>
 </td>
 </tr>
 
 <tr>
 <th>Question<font color='#FF0033'> *</font></th>
 <td><textarea rows=2 cols=35 name="question" placeholder="Enter The Question"><?php echo $rsedit['question']; ?></textarea>
 </td>
 </tr>
 
 <tr>
 <th>Uploads <font color='#FF0033'>*</font></th>
 <td> <input type=file name=uploads>
 <input type="hidden" name="imgset" value="<?php echo $rsedit['uploads']; ?>" />
 <?php
 if($rsedit['question'] != "") 
 {
	 echo "<img src='uploads/$rsedit[uploads]' width='100' height='75'></img>";
 }
 ?>
 </td>
 </tr>
 
 <tr>
 <th>Option A <font color='#FF0033'>*</font></th>
 <td><textarea rows=2 cols=35 name="optiona" placeholder="Enter The Option"><?php echo $rsedit['option1']; ?></textarea>
</td>
</tr>

 <tr>
 <th>Option B <font color='#FF0033'>*</font></th>
 <td><textarea rows=2 cols=35  name="optionb" placeholder="Enter The Option" ><?php echo $rsedit['option2']; ?></textarea>
</td>
</tr>

 <tr>
 <th>Option C <font color='#FF0033'>*</font></th>
 <td><textarea rows=2 cols=35  name="optionc" placeholder="Enter The Option"><?php echo $rsedit['option3']; ?></textarea>
</td>
</tr>

 <tr>
 <th>Option D <font color='#FF0033'>*</font></th>
 <td><textarea rows=2 cols=35  name="optiond" placeholder="Enter The Option"><?php echo $rsedit['option4']; ?></textarea>
</td>
</tr>

<tr><th>Answer<font color='#FF0033'>*</font></th>
<td>
<select size=1 name="answerid">
<option>Select</option>
<?php
$arr =  array("1","2","3","4");
foreach($arr as $val)
{
	if($val == $rsedit['answer'])
	{
	echo "<option selected value='$val'>$val</option>";
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

<tr>
<th>Description</th>
<td><textarea rows=2 cols=35 name="description" placeholder="Enter The Description"><?php echo $rsedit['description']; ?></textarea>
</td>
</tr>

<tr>
<th>Status<font color='#FF0033'> *</font></th>
<td><select size=1 name="status">
<?php
$arr =  array("Select","Enabled","Disabled");
foreach($arr as $val)
{
	if($val == $rsedit['status'])
	{
	echo "<option selected value='$val'>$val</option>";
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
<thead>
<tr>
<td colspan="2" align="center" style="text-align:center;">
<input type=submit value=submit name="submit" style="background-color:#fff; color:black; height: 40px; width:40%; border-radius:5px;">
</td>
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
<script type="application/javascript">
function validation()
{ 
	if(formname.subjectid.value=="Select")
	{
		alert("Please Select Subject...");
		formname.subjectid.focus();
		return false;
	}
	else if(formname.question.value=="")
	    {
			alert("Please Enter Question...");
			formname.question.focus();
		return false;
		 }
		 else if(formname.optiona.value=="")
	    {
			alert("Please Enter Option A...");
			formname.optiona.focus();
		return false;
		 }
		  else if(formname.optionb.value=="")
	    {
			alert("Please Enter Option B...");
			formname.optionb.focus();
		return false;
		 }
		  else if(formname.optionc.value=="")
	    {
			alert("Please Enter Option C...");
			formname.optionc.focus();
		return false;
		 }
		  else if(formname.optiond.value=="")
	    {
			alert("Please Enter Option D...");
			formname.optiond.focus();
		return false;
		 }
		 
	else if(formname.answerid.value=="")
		{
			alert("Please Enter Answer...")
			formname.answerid.focus();
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