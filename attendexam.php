<?php
include("header.php");
unset($_SESSION['examid']);
$selexam = "SELECT     exam.*, subjects.*, course.* FROM  course INNER JOIN subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN exam ON subjects.subjectcode = exam.subjectcode where exam.regno='" . $_SESSION['regno'] . "' ";
$selresult = mysqli_query($con,$selexam);
?>
<br>
<script>
function countdowntimer(id, time,enddate)
{
		// Set the date we're counting down to
		var countDownDate = new Date(time).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;
		
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Output the result in an element with id="demo"
		document.getElementById("countdowntime"+id).innerHTML = "<b class='btn btn-warning'> <b  style='color: red;' >Exam starts in </b><br>" + days + " Days " + hours + " hrs <br>" + minutes + " min " + seconds + " sec</b>";
		
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			countdowntimer2(id, time,enddate);
			//document.getElementById("countdowntime"+id).innerHTML = "<center><b  style='color: red;'>EXPIRED</b></center>";
		}
	}, 1000);
	
}

function countdowntimer2(id, time,enddate)
{
		// Set the date we're counting down to
		var countDownDate = new Date(enddate).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;
		
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Output the result in an element with id="demo"
		document.getElementById("countdowntime"+id).innerHTML = "<b  style='color: red;'>Attend Exam in</b> <br><b>" + hours + "hrs " + minutes + "min " + seconds + "sec</b><hr> <a class='btn btn-info' href='examstart.php?examid=" + id + "'><b>Attend Exam</b></a>";
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdowntime"+id).innerHTML = "<center><b  style='color: white;' class='btn btn-danger'>EXPIRED</b></center>";
		}
	}, 1000);
	
}
</script> 
    <div class="slider_top2">
<h2>Attend exam</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
			  <div class="full">
              <div >
               <p >
<?php
while($rs = mysqli_fetch_array($selresult))
{
?>
<table class="content-table" width='100%' border='1' style="consolas;">
<thead>
  <tr>
    <th width="125" style="font-size:17px;" >&nbsp;Subject</th>
    <th width="300" scope='col' style="font-size:17px;">&nbsp;Exam rules</th>
    <th width="125"  scope='col' style="font-size:17px;">&nbsp;Exam Detail</th>
    <th  width="65" scope='col' style="font-size:17px;">&nbsp;Exam <br>Datetime</th>   
 	<th width="150" scope='col' style="font-size:17px;">&nbsp;Attend Exam</th>
  </tr>
 </thead>
 <tbody>
<?php
	echo "
	<tr>
		<td>$rs[subjectname]</td>
		<td>$rs[rules]</td>
		<td>
		<b>Total Marks -</b> $rs[totalmarks] <br>
		<b>Pass Mark -</b> $rs[passmarks] <br>
		<b>Exam duration -</b> $rs[examduration] Min<br>
		</td>
		<td>" . date("d-M-Y",strtotime($rs['datetime'])) . "<br>" . date("h:i A",strtotime($rs['datetime'])) . "</td>
 		<td>&nbsp;";
	$sqlq = "SELECT * FROM results where examid='$rs[examid]' ";
	$qquery = mysqli_query($con,$sqlq);
	
	if(mysqli_num_rows($qquery) >= 1)
	{
		echo "Exam finished";
	}
	else
	{
		$minut = round($rs['examduration']/4);
		$enddate = date("Y-m-d H:i:s", strtotime("+$minut minutes",strtotime($rs['datetime'])));
	?>
<p id="countdowntime<?php echo $rs[0]; ?>"></p>
<script type="application/javascript">countdowntimer('<?php echo $rs[0]; ?>', '<?php echo date("M d, Y H:i:s",strtotime($rs['datetime'])); ?>', '<?php echo $enddate; ?>');</script>	
	<?php		
	}
		echo "</td>
  	</tr>";
?> 
</tbody>
</table>
<hr>
<?php
}
?>
              </div>
        
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>