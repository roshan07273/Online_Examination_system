<?php
session_start();
include("dbconnection.php");

  if($_POST['setid'] == $_SESSION['setid'])
{
  if(isset($_POST['submit']))
  {
	 
   $sql="INSERT INTO certificates(certificateid, studentid,  totalmarks, scoredmarks, result, status)
VALUES('$_POST[certificateid]','$_POST[studentid]','$_POST[totalmarks]','$_POST[scoredmarks]','$_POST[result]','$_POST[status]')";

if(!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
}
else
{
	echo "one record is added";
}
  }
}
$_SESSION['setid']=rand();

$sql ="SELECT     students.*, students.courseid AS Expr1,course.* FROM         students INNER JOIN  course ON students.courseid = course.courseid";
$qrecc = mysqli_query($con,$sql);
include("header.php");
?>
    <div class="slider_top2">
<h2>Certificate</h2>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="full">
               <p>
                </p>
                <table  class="tftable" width="935" border="1">
                  <tr>
                    <th width="216" scope="col">Registraton No.</th>
                    <th width="193" scope="col">Student name</th>
                    <th width="127" scope="col">Course</th>
                    <th width="133" scope="col">Exam status</th>
                    <th width="33" scope="col">Action</th>
                  </tr>
                 <?php
				 while($rsrec = mysqli_fetch_array($qrecc))
				 {
                 echo "<tr>
                    <td>&nbsp;$rsrec[regno]</td>
                    <td>&nbsp;$rsrec[name]</td>";
				echo "<td>&nbsp;$rsrec[coursename]</td>";

echo "<td>&nbsp;";				
/* #######################################################################################*/
$sqlexamresult1 = "SELECT * FROM exam where regno='$rsrec[regno]'";
$qexamresult1 = mysqli_query($con,$sqlexamresult1);
while($rsexamresult1 = mysqli_fetch_array($qexamresult1));
{
	$sqlexamresult = "SELECT * FROM results INNER JOIN questions ON questions.queid = results.queid where examid='$rsexamresult1[examid]'";
	$qexamresult = mysqli_query($con,$sqlexamresult);
	$totalquestions = mysqli_num_rows($qexamresult);
	while($rsexamresult = mysqli_fetch_array($qexamresult))
	{
		if($rsexamresult['answerid'] == $rsexamresult['answer'])
		{
			$canswer = $canswer  + 1;
		}
		else
		{
			$wanswer = $wanswer  + 1;
		}
	}
			if($totalquestions == 0)
			{
				echo $resultst = "Result pending";
			}
			else
			{
					 $totpercentagemarks = (($canswer*100) /$totalquestions);
					

					if($totpercentagemarks > 70)
					{
							echo $resultst = "Distinction"; 		
					}
					else if($totpercentagemarks > 60)
					{
							echo $resultst = "First class"; 		
					}
					else if($totpercentagemarks > 45)
					{
							echo $resultst = "Second Class"; 			
					}
					else if($totpercentagemarks > 35)
					{
							echo $resultst = "Pass"; 			
					}	
					else
					{
						echo $resultst = "Failed";
					}
				}		
}
/* #######################################################################################*/
echo "</td>";
      echo "<td>&nbsp;";
	  if($resultst == "Result pending")
	  	{
			echo "Pending";
		}
		else if($resultst == "Failed")
		{
			echo "Failed";
		}
		else
		{
			echo "<a href='generatecertificate.php?regno=$rsrec[regno]'>Generate certificate</a>";
		}
	echo "  </td>
                  </tr>";
				  
				 }
					?>
                </table>               
              </div>
              <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>