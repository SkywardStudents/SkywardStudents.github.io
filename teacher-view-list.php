<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>  
<html>
<head>
<script src="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

</head>
<body>
<div class="card-header">
		

<form  method="post" action = "student-home-cbs.php" autocomplete="off">
<br>
<br>
<p align = "center">

<br/>
		<h2 align="center">STUDENT LIST</h2>
		<h4 align="center">See Current Students Below</h4> 
		
	
<?php

   // include 'db.php';

		//$current_user = $_SESSION['user_username'];
   //  $sql = "SELECT * FROM user WHERE user_username='$current_user'";
   // $result = mysqli_query($database,$sql);
	
	//if ($user_id = '3')
	//{
//$sql="SELECT * FROM sky_student WHERE class ='7M'";
	//}
	//else if ($user_id = '4')
	//{
	//		$sql="SELECT * FROM sky_student WHERE class ='7D'";
	//}
	
		
		
		$sql="SELECT * FROM sky_student";
		$result = mysqli_query($database,$sql);
		
					echo '<table class="table table-striped table-bordered">
								<thead><tr>
								<th>ID</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Address</th>
								<th>Contact</th>
								<th>Grade</th>
								<th>Class</th>
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
									<td>'.$row['grade'].'</td>
									<td>'.$row['class'].'</td>
									<td>'.$row['dob'].'</td>
																
								</tr>';

						}
						echo '
						</table>';
		
		
 
	
	?>	



    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
</div>
</form>
</body>
</html>

