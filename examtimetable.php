<?php
include("header.php");
$selexam = "SELECT     exam.*, subjects.*, course.* FROM  course INNER JOIN subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN exam ON subjects.subjectcode = exam.subjectcode where exam.regno='$_SESSION[regno]'";
$selresult = mysqli_query($con,$selexam);
?>

<head>
	<link rel="shortcut icon" href="/assets/favicon.ico">
	<link rel="stylesheet" href="/assets/dcode.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<br>
  
	<div class="clr"></div>
	
	<div class="body_resize">					
		<div class="slider_top2">
			<h2>Exam Time Table</h2>
		</div>
		
		<div>
				<div>
					<div class="full">
						<p>
							<center>
								<?php
									$selexam = "SELECT     exam.*, subjects.*, course.* FROM  course INNER JOIN subjects ON course.courseid = subjects.courseid RIGHT OUTER JOIN exam ON subjects.subjectcode = exam.subjectcode where exam.regno='$_SESSION[regno]'";
									$selresult = mysqli_query($con,$selexam);
								?>
								
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Registration No.</th>
											<th>Course</th>
											<th>Subject</th>
											<th>Exam Date</th>
											<th>Exam Time</th>
										</tr>
									</thead>
									
									<tbody>
										<?php
											while($rs = mysqli_fetch_array($selresult))
											{
												echo "	
													<tr>
														<td>&nbsp;$rs[regno]</td>
														<td>&nbsp;$rs[coursename]</td>
														<td>&nbsp;$rs[subjectname]</td>
														<td>&nbsp; " . date("d-M-Y",strtotime($rs['datetime'])) . " </td>
														<td>&nbsp; " . date("h:i A",strtotime($rs['datetime'])) . " </td>
													</tr>
													";
											}
										?>
									</tbody>
								</table>
							</center>
						</p>	
					</div>
				</div>	
		</div>
	
	
<?php
include("footer.php");
?>