<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>
 
<html>
<head>
 <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
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
button.btn.active {
	box-shadow: inset 2px 3px 5px rgba(0, 0, 0, 1);
}
 </style>
</head>
<body>
    <div class="container">
	   <div class="no-gutter row"> 
           <div class="col-md-12">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body"> 

		

<br/>
 
		<h2 align="center">STUDENT INTERVENTION RECORD</h2>
		<h4 align="center">List of Logged Student Interventions</h4>
<br/>	
	
<?php

		
		$sqlStr = "SELECT * FROM student_intervention i
		LEFT JOIN sky_student s USING (studentid)
		LEFT JOIN conduct_breakdown c USING (conduct_id)
		LEFT JOIN conduct g USING (group_id)
		LEFT JOIN conduct_breakdown_strategy bs USING (strategy_id)
		LEFT JOIN user u USING (user_id)
		
		";
		$result = mysqli_query($database, $sqlStr);
		$result or die(mysqli_error($database));
		
		$count = mysqli_num_rows($result);

						echo '
						<table id="bootstrap-data-table"  class="table table-striped table-bordered" align = "center">
								<thead><tr>
								
								<th>Student Name</th>
								<th>Conduct Name</th>
								
								<th>Strategy Applied</th>
								<th>Recorded By</th>
								<th>Date</th>
							
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									
									
									<td>'.$row['partyname'].'</td>
									<td>'.$row['conduct_name'].'</td>
									<td>'.$row['strategy_name'].'</td>
									<td>'.$row['user_username'].'</td>	
									<td>'.$row['imp_date'].'</td>	';
	
								echo '</tr>';

						}
						echo '
						</table>';
		?>
						
                                
                                    <a href="get-Student-360-Profile.php" class="btn btn-primary ladda-button" role="button">View Individual Student Profile</a>
                               
								
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
		  
		  $('.feedback-btn').on('click',function(event){
			  event.preventDefault();
			  var el = $(this);
			  var postData = {};
			  postData.intervention_id = el.data('intervention_id');
			  postData.feedback = el.data('feedback');
			  
			  el.parent().find('button').removeClass('active');
			  el.addClass('active');
			  $.ajax({
                type:'POST',
                url:'auto-feedback-intervention.php',
                data:postData,
                success:function(html){
                    alert('Feedback noted'); 
                }
            }); 
		  });
        });
    </script>                         

</div></div></div></div></div>

</body>
</html>

