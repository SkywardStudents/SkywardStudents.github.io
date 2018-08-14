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
<div class="container">
	   <div class="no-gutter row"> 
           <div class="col-md-12">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body">
					<br>
										
					<h2 align="center">LOW ACHIEVERS LIST</h2>
					<h4 align="center">See Current Students Below</h4> 
					<br>
					
	
<?php

 
		
		$sql_grade = "SELECT studentid, round(avg(subjectgrade),1) as grade_avg FROM sky_grades GROUP BY studentid";
		$sql="SELECT s.* , g.grade_avg FROM sky_student s LEFT JOIN ($sql_grade) g USING (studentid)";
		$sql .= " WHERE g.grade_avg < 60";
		$result = mysqli_query($database,$sql);
		
					echo '<table class="table table-striped table-bordered">
								<thead><tr>
								<th>ID</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Grade</th>
								<th>Class</th>
								<th>Subject Grade</th>
								<th></th>
																
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['studentid'].'</td>
									<td>'.$row['lastname'].'</td>
									<td>'.$row['firstname'].'</s></td>
									<td>'.$row['grade'].'</td>
									<td>'.$row['class'].'</td>
									<td>'.$row['grade_avg'].'</td>
									<td><button class="btn btn-primary assign-intervention"
									data-studentid='.$row['studentid'].'
									>assign intervention</button> </td>
																
								</tr>';

						}
						echo '
						</table>';
		
		
 
	
	?>	



    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
		  
		  $('.assign-intervention').on('click',function(event){
			  event.preventDefault();
			  var el =$(this);
			  el.hide();
			  var postData = {};
			  postData.studentid = el.data('studentid');
			  $.ajax({
                type:'POST',
                url:'auto-academic-intervention.php',
                data:postData,
                success:function(html){
                    el.replaceWith('<span class="label label-success">placed on intervention</span>'); 
                }
            }); 
			  
		  })
		  
		  
        } );
    </script>
</div>
</form>
</body>
</html>

