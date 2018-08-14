<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>
 
<html>
<head>
<style>
 
  #report {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
   
    box-shadow: 10px 10px 5px red;
    width: 70%;
}

#report td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    
}

#report tr:nth-child(even)
{
	background-color: #f2f2f2;
	}

#report tr:hover 
{
	color: green;
	text-width:bold;
	}

#report th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: red;
    color: white;
}
 </style>
</head>
<body>
    <div class="container">
	   <div class="no-gutter row"> 
           <div class="col-md-12">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body"> 

		

<form  method="post"  autocomplete="off">
<br/>
 
		<h2 align="center">STUDENT BEHAVIOUR RECORD</h2>
		<h4 align="center">List of Logged Student Behaviour</h4>
<br/>	
	
<?php

		
		$sqlStr = "SELECT * FROM student_behaviour b
		LEFT JOIN sky_student s USING (studentid)
		LEFT JOIN conduct g USING (group_id)
		LEFT JOIN conduct_breakdown c USING (conduct_id)
		LEFT JOIN user u USING (user_id)
		ORDER BY reg_date desc
		";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '
						<table id="bootstrap-data-table" class="table table-striped table-bordered" align = "center">
								<thead><tr>
								<th>Student ID</th>
								<th>Student Name</th>
								<th>Conduct Group</th>
								<th>Conduct Name</th>
								<th>Date</th>
								
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									
									<td>'.$row['studentid'].'</td>
									<td>'.$row['partyname'].'</td>
									<td>'.$row['group_name'].'</td>
									<td>'.$row['conduct_name'].'</td>	
									<td>'.$row['reg_date'].'</td>	
																		
								</tr>';

						}
						echo '
						</table>';
		?>
						
                                
                                    <a href="get-Student-360-Profile.php" class="btn btn-success ladda-button" role="button">View Individual Student Profile</a>
                               
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
                            

</div></div></div></div></div>
</form>
</body>
</html>

