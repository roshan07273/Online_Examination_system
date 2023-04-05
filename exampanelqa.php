<?php
session_start();
include("dbconnection.php");
?>
<script>
function changequestion(qid)
{

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
		document.getElementById("exampanel").innerHTML=xmlhttp.responseText;
		}
  	}
xmlhttp.open("GET","exampanelqa.php?qid="+qid+"&changeid=1",true);
xmlhttp.send();
}

function updateanswer(qid,qaid,ansid)
{

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
    document.getElementById("exampanel").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","exampanelqa.php?qid="+qid+"&qaid="+qaid+"&ansid="+ansid,true);
xmlhttp.send();

}
</script> 
<?php
if(isset($_GET['ansid']))
{
	$sqlans ="UPDATE results SET answerid='$_GET[ansid]' WHERE resultid='$_GET[qaid]'";
	if(!mysqli_query($con,$sqlans))
	{
		echo mysqli_error($con);
	}
}
//The exam ID should come from session
$examid = $_SESSION['examid'];

//Code for total questions
$sqlquestiontot ="SELECT * FROM results where examid='$examid'";
$queryquestiontot = mysqli_query($con,$sqlquestiontot);
$totquestion= mysqli_num_rows($queryquestiontot);

if(!isset($_GET['qid']))
{
	$_GET['qid']=0;		
}
			
if(isset($_GET['changeid']))
{
	$resultid = $_GET['qid'];
	$sqlquestion ="SELECT @a:=1  AS serial_number,results.*, questions.* FROM results INNER JOIN questions ON results.queid = questions.queid where results.examid='$examid' LIMIT $_GET[qid] , 1  ";	
}
else
{
$sqlquestion ="SELECT @a:=1  AS serial_number,results.*, questions.* FROM results INNER JOIN questions ON results.queid = questions.queid where results.examid='$examid' LIMIT $_GET[qid] , 1  ";			
}
$queryquestion = mysqli_query($con,$sqlquestion);
$fetchquestion = mysqli_fetch_array($queryquestion);
$resultid=$fetchquestion['resultid'];
?>

<table width="931" height="240" border="1" class="table table-bordered">
<input type="hidden" name="queid" value="1" />
  <tr>
    <td width="83" rowspan="7" style=" vertical-align: middle;"><strong>
<?php
 $questionpreid = $_GET['qid']-1; 
echo "<input type='button' name='btnpre' value='<< Previous' class='btn btn-info' onclick='changequestion($questionpreid)' ";
	if($questionpreid<0)
	{
		echo  "disabled";
	}
echo ">";
?>
    
    </strong></a></td>
    <td>&nbsp;<strong>Question No</strong></td>
    <td><?php echo $_GET['qid']+1; ?></td>
    <td width="57" rowspan="7"  style=" vertical-align: middle;">
<?php
$questionnextid = $_GET['qid']+1;
echo "<input type='button' name='btnnext' value='Next >>' class='btn btn-info' onclick='changequestion($questionnextid)' ";
	if($questionnextid>=$totquestion)
	{
		echo  "disabled";
	}
echo ">";
?>        
    </td>
  </tr>
  <tr>
    <td width="247"><strong>&nbsp;Question</strong></td>
    <td width="516"><?php echo $fetchquestion['question']; ?></td>
    </tr>
  <tr>
    <td><strong>&nbsp; Option A</strong></td>
    <td><input type="radio" name="option" id="option1" value="1" onclick="updateanswer(<?php echo $_GET['qid']; ?>,<?php echo $resultid; ?>,this.value)" 
    <?php
		if($fetchquestion['answerid'] == 1)
		{
			echo "checked='checked'";
		}
	?>
    />
      <span for="option1"><?php echo $fetchquestion['option1']; ?></span></td>
    </tr>
  <tr>
    <td><strong>&nbsp; Option B</strong></td>
    <td><input type="radio" name="option" id="option2" value="2" onclick="updateanswer(<?php echo $_GET['qid']; ?>,<?php echo $resultid; ?>,this.value)" 
    <?php
		if($fetchquestion['answerid'] == 2)
		{
			echo "checked='checked'";
		}
	?>/> 
	<span for="option2"><?php echo $fetchquestion['option2']; ?></span></td>
    </tr>
  <tr>
    <td><strong>&nbsp; Option C</strong></td>
    <td><input type="radio" name="option" id="option3" value="3" onclick="updateanswer(<?php echo $_GET['qid']; ?>,<?php echo $resultid; ?>,this.value)" 
    <?php
		if($fetchquestion['answerid'] == 3)
		{
			echo "checked='checked'";
		}
	?>/>  
	<span for="option3"><?php echo $fetchquestion['option3']; ?></span></td>
    </tr>
    <tr>
      <td><strong>&nbsp; Option D</strong></td>
    <td><input type="radio" name="option" id="option4" value="4" onclick="updateanswer(<?php echo $_GET['qid']; ?>,<?php echo $resultid; ?>,this.value)" 
    <?php
		if($fetchquestion['answerid'] == 4)
		{
			echo "checked='checked'";
		}
	?>/> 
	<span for="option4"><?php echo $fetchquestion['option4']; ?></span></td>
    </tr>
  <tr>
    <td>&nbsp;<strong>Hints or Description</strong></td>
    <td>
    <?php echo $fetchquestion['description']; ?><br />
    <?php
	if($fetchquestion['uploads'] != "")
	{
    echo "<img src='uploads/$fetchquestion[uploads]' height='175' width='250' />";
	}
	?>
	
    </td>
  </tr>
</table>
<table class="tftable" border="1"  width="100%">
<tr>
<td>
<?php
echo "<b>Total Questions: ". $totquestion. "</b><br>"; 
$j=0;
for($i=0; $i<$totquestion; $i++)
{
	$j= $j+1;
	echo "&nbsp;<input type='button'	onclick='changequestion($i)' value='$j' class='btn btn-primary' > | ";
}
?>
</td>
</tr>
</table>