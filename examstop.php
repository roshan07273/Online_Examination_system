<?php
include("header.php");
//The exam ID should come from session
$sqlqexam ="SELECT * FROM exam where examid='$_SESSION[examid]'";
$quexam = mysqli_query($con,$sqlqexam);
$tqexam= mysqli_fetch_array($quexam);
/*
$sqlqcertificate ="SELECT * FROM certificate where examid='$_SESSION[examid]' 	AND regno='$tqexam[regno]'";
$qcertificate = mysqli_query($con,$sqlqcertificate);
if(mysqli_num_rows($qcertificate) == 0)
{
	$sqlinscertificate = "INSERT INTO certificate(examid,regno,scoredmarks,result,datetime,status) VALUES('$_SESSION[examid]','$tqexam[regno]','0','0','$tqexam[datetime]','Active')";
	$qsqlcerificateins = mysqli_query($con,$sqlinscertificate);
}
*/
?>

    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">             
                <p align="center">&nbsp;
             
<center><span id="timer" style="font-size: 50px;font-family: initial;" class="btn btn-info"></span></center>
<script>
var count=10;
var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
function timer()
{
  count=count-1;
  if (count <= 0)
  {
	 window.location="result.php?examid=<?php echo $_SESSION['examid']; ?>";
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML= "<br>Calculating Examination result.. <br>Please wait <br>" + count + " Seconds..<br>&nbsp;"; // watch for spelling
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