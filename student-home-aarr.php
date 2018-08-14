<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>

<html>
<head>
<style>
 
  #report {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
   
    box-shadow: 10px 10px 5px skyblue;
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
	color: RED;
	text-width:bold;
	}

#report th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: RED;
    color: white;
}
 </style>
</head>
<body>
<div class="card-header">
		

<form  method="post"  autocomplete="off">
<br>
<br>
    
        
<p align = "center">
<button type="submit" class = "button" name="student-assess-grade"/>GRADE-ASSESSMENT</button>
<button type="submit" class = "button" name="student-assess-conduct"/>CONDUCT-ASSESSENT</button>

<button type="submit" class = "button" name="student-report"/>VIEW REPORT</button>
<!--<button type="submit" class = "button" name="student-review"/>REVIEW</button>
<a href = "index.php"><button type="submit" class = "button" />ADDRESS</button></a>
--></p>
<br/>
		<h2 align="center">CONDUCT REDORDING LIST</h2>
		 
	
	
<?php
if($_REQUEST)
{
    if(isset($_REQUEST['student-report']))
	{
		
		$sqlStr = "SELECT * FROM student_behaviour b
		LEFT JOIN sky_student s USING (studentid)
		LEFT JOIN conduct g USING (group_id)
		LEFT JOIN conduct_breakdown c USING (conduct_id)
		LEFT JOIN user u USING (user_id)
		
		";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '
						<table id="report" align = "center">
								<thead><tr>
								<th>Student ID</th>
								<th>Student Name</th>
								<th>Conduct Group</th>
								<th>Conduct Name</th>
								<th>Date</th>
								<th>Generate</th>
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
									<td><a href = "teacher-assign-intervention.php">GENERATE</a></td>									
								</tr>';

						}
						echo '
						</table>';
		
	}
	
	if(isset($_REQUEST['student-assess-grade']))
	{
		$sqlStr = "SELECT * FROM conduct_breakdown";
		echo '	<h4 align="center">Analysis of Student Grade</h4>';
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

					

						echo'
						<p align = "center">
										
							<iframe width="1500" height="900" src="https://app.powerbi.com/view?r=eyJrIjoiODFkMGJjM2YtY2Y5MS00MGQ0LTgwMGUtNmMyODc1YjdkYzM1IiwidCI6IjdmZGJmMDRlLTU0MzAtNDBjZi1iMjk3LWQ3ZmIzNmI1NjE0MyIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>
							
						</p>';
		
	}
	if(isset($_REQUEST['student-assess-conduct']))
	{
		$sqlStr = "SELECT * FROM conduct_breakdown";
		echo '	<h4 align="center">Analysis of Student Conduct</h4>';
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

					

						echo'
						<p align = "center">
										
							<iframe width="1500" height="900" src="https://app.powerbi.com/view?r=eyJrIjoiMDYyOGRjNGUtMTRhMC00YWJmLTk4N2YtZGRjNjVmYTNmYzhhIiwidCI6IjdmZGJmMDRlLTU0MzAtNDBjZi1iMjk3LWQ3ZmIzNmI1NjE0MyIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>
						</p>';
		
	}
	
  
     

}		
?>
</div>
</form>
</body>
</html>

