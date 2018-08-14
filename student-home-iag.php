<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>  

<html>
<head>

</head>
<body>
<div class="card-header">
		

<form  method="post" action = "student-home-iag.php" autocomplete="off">
<br>
<br>
<p align = "center">
<button type="submit" name="student-view-all"/>INFORMATION</button>
<button type="submit" name="student-view-attendance"/>ATTENDANCE</button>
<button type="submit" name="student-view-grade"/>ACADEMICS</button>
<button type="submit" name="student-view-conduct"/>CONDUCT</button>
</p><br>


		<h2 align="center">	REVIEW STUDENT RECORDS</h2>
		 


<?php
if($_REQUEST)
{
    if(isset($_REQUEST['student-view-all']))
	{
		$sqlStr = "SELECT * FROM sky_student ";
			
		echo "<h4 align='center'>Student Personal Records</h4>";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '
                  <table  id="bootstrap-data-table" class="table table-striped table-bordered">
								<thead><tr>
								<th>Student ID</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Address</th>
								<th>Contact</th>
								<th>Parent</th>
								<th>Grade</th><th>Class</th>
								<th>DOB</th>
																
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['studentid'].'</td>
									<td>'.$row['lastname'].'</td>
									<td>'.$row['firstname'].'</s></td>
									<td>'.$row['address'].'</td>
									<td>'.$row['contactno'].'</td>
									<td>'.$row['parent'].'</td>
									<td>'.$row['grade'].'</td>
									<td>'.$row['class'].'</td>
									<td>'.$row['dob'].'</td>
																
								</tr>';

						}
						echo '
						</table>';
		
	}
	if(isset($_REQUEST['student-view-attendance']))
	{
		$sqlStr = "SELECT * FROM sky_student_attendance INNER JOIN sky_student ON sky_student_attendance.studentid=sky_student.studentid WHERE value >0";
		echo "<h4 align='center'>Student Attendance Records</h4>";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '<table id="bootstrap-data-table" class="table table-striped table-bordered">
								<thead><tr>
								<th>ID</th>
								<th>Last Name</th>
								<th>FirstName</th>
								<th>Period</th>
								<th>Key</th>
								<th>Value</th>
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['studentid'].'</s></td>
								<td>'.$row['lastname'].'</s></td>
								<td>'.$row['firstname'].'</s></td>
								<td>'.$row['periodid'].'</td>
									<td>'.$row['attendancekey'].'</td>
									<td>'.$row['value'].'</td>
																
								</tr>';

						}
						echo '
						</table>';
		
	}
	elseif(isset($_REQUEST['student-view-grade']))
	{
		$sqlStr = "SELECT * FROM sky_grades JOIN sky_student ON sky_student.studentid=sky_grades.studentid
				JOIN sky_subjects ON sky_grades.subjectid=sky_subjects.subjectid";
		echo "<h4 align='center'>Student Academic Records</h4>";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '<table id="bootstrap-data-table" class="table table-striped table-bordered">
								<thead><tr>
								<th>ID</th>
								<th>Full Name</th>
								<th>SubjectID</th>
								<th>Subject</th>
								<th>Grade</th>
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['studentid'].'</td>
									<td>'.$row['partyname'].'</s></td>
									<td>'.$row['subjectid'].'</s></td>
									<td>'.$row['subjectname'].'</td>
									<td>'.$row['subjectgrade'].'</td>
									
																
								</tr>';

						}
						echo '
						</table>';
		
	}
	elseif(isset($_REQUEST['student-view-conduct']))
	{
		$sqlStr = "SELECT * FROM sky_conduct_student_subject JOIN sky_student ON sky_conduct_student_subject.studentid=sky_student.studentid 
				   JOIN sky_subjects ON sky_conduct_student_subject.subjectid=sky_subjects.subjectid";
		echo "<h4 align='center'>Student Behavioural Records</h4>";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '<table id="bootstrap-data-table" class="table table-striped table-bordered">
								<thead><tr>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Period</th>
								<th>Subject</th>
								<th>Conduct</th>
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
								<td>'.$row['lastname'].'</s></td>
								<td>'.$row['firstname'].'</s></td>
								<td>'.$row['periodid'].'</td>
								<td>'.$row['subjectname'].'</td>
								<td>'.$row['conduct'].'</td>
																
								</tr>';

						}
						echo '
						</table>';
		
	}
   
	
}	?>	
 <!--<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

 -->
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
</div>
</form>
</body>
</html>

