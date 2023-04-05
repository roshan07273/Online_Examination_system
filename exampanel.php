<?php
include("header.php");
$qid=0;
$sqlexamtimer ="SELECT * FROM exam where examid='" . $_SESSION['examid'] . "'";
$queryexamtimer = mysqli_query($con,$sqlexamtimer);
echo mysqli_error($con);
$rsexamtimer = mysqli_fetch_array($queryexamtimer);
$selexamexam_schedule = "SELECT  * FROM subjects WHERE subjectcode='$rsexamtimer[subjectcode]' ";
$selresultexam_schedule = mysqli_query($con,$selexamexam_schedule);
echo mysqli_error($con);
$rsexam_schedule = mysqli_fetch_array($selresultexam_schedule);
//echo $rsexamtimer['datetime'];
$min = $rsexam_schedule['examduration'];
$examendttime = date("Y-m-d H:i:s",strtotime("$rsexamtimer[datetime] $min minutes"));
$exm_month = date('M',strtotime($examendttime));
$exm_dt = date('d',strtotime($examendttime));
$exm_yr = date('Y',strtotime($examendttime));
$exm_hr = date('H',strtotime($examendttime));
$exm_mm = date('i',strtotime($examendttime));
$exm_ss = date('s',strtotime($examendttime));
?>
<br>
<div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
<table  class="tftable" style="width:100%" >
	<tr>
		<td>
<CENTER><div id="strclock" class="btn btn-warning" >Running Timer</div></CENTER>
		</td>
	</tr>
</table>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $exm_month ?> <?php echo $exm_dt; ?>, <?php echo $exm_yr; ?> <?php echo $exm_hr; ?>:<?php echo $exm_mm; ?>:<?php echo $exm_ss; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("strclock").innerHTML = "Remaining Time : " + hours + " Hours "
  + minutes + " Minutes " + seconds + " Seconds ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("strclock").innerHTML = "TIME UP";
	window.location="examstop.php";
  }
}, 1000);
</script>
<form name="form1" method="post" action="" >
<div id="exampanel">
<?php
include("exampanelqa.php");
?>
</div>
<table  class="tftable" style="width:100%" >
  <tr>
    <td style="padding-left: 300px;"><center><a href="examstop.php" onclick="return confirmtoclose()"><img src="images/finishexam.png" width="300" height="50" /></a></center></td>
  </tr>
</table>
</form>
 <div class="bg"></div>
              </div>
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>
<script>
function confirmtoclose()
{
	if(confirm("Are you sure want to close Exam Panel?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>