<?php
include("header.php");
$_SESSION['examid'] = $_GET['examid'];
$sqlq = "SELECT * FROM results where examid='$_GET[examid]' ";
$qquery = mysqli_query($con,$sqlq);
if(mysqli_num_rows($qquery) >= 1)
{
	echo "<script>window.location='attendexam.php';</script>";
}
else
{
	$sqlq = "SELECT * FROM exam where examid='$_GET[examid]' ";
	$qquery = mysqli_query($con,$sqlq);
	echo mysqli_error($con);
	$rsrec = mysqli_fetch_array($qquery);

	$sqlq1 = "SELECT * FROM subjects where subjectcode='$rsrec[subjectcode]' ";
	$qquery1 = mysqli_query($con,$sqlq1);
	echo mysqli_error($con);
	$rsrec1 = mysqli_fetch_array($qquery1);

	$sqlq = "SELECT * FROM questions where subjectcode='$rsrec[subjectcode]' ORDER BY rand() LIMIT 0 , $rsrec1[totalmarks]";
	$qquery = mysqli_query($con,$sqlq);
	echo mysqli_error($con);
	$i=0;
	while($rs = mysqli_fetch_array($qquery))
	{
		$sql = "INSERT INTO results(examid,queid) VALUES('$_GET[examid]','$rs[queid]')";
		if(!mysqli_query($con,$sql))
		{
		die('Error: ' . mysqli_error($con));
		}
	}
}
?>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">             
                <p align="center">&nbsp;

<span id="timer" style="font-size: 100px;font-family: initial;" class="btn btn-info"></span>

<script>
var count=10;
var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
function timer()
{
  count=count-1;
  if (count <= 0)
  {
	 window.location="exampanel.php";
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML= "<br>Your Exam starts in <br>" + count + " Seconds..<br>&nbsp;"; // watch for spelling
}
</script>
                </p>
              </div>
        
        <div class="clr"></div>
      </div>
    </div>

<?php
include("footer.php");
?>