<!-- 
Based on one month of lowere infrequency the student is 
said be whole 


-->

<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>  
<html>
<head>
<style>
 
  #report {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
   
    box-shadow: 10px 10px 5px green;
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
	color: BLUE;
	text-width:bold;
	}

#report th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: SKYBLUE;
    color: BLACK;
	

}
 </style>
</head>
<body>
<div class="card-header">
		

<form  method="post" action = "student-home-cbs.php" autocomplete="off">
<br>
<br>
<p align = "center">
<button type="submit" class = "button" name="student-view-conduct"/>BEHAVIOUR GROUPS</button>
<button type="submit" class = "button" name="student-view-behaviour"/>BEHAVIOUR BREAKDOWN</button>
<button type="submit" class = "button" name="student-view-strategies"/>INTERVENTION STRATEGIES</button>
</p>

<br/>
		<h2 align="center">BEHAVIOURS & INTERVENTION STRATEGIES</h2>
		<h4 align="center">See Recommended Suggestions Below For Intervention</h4> 
<?php
if($_REQUEST)
{
    if(isset($_REQUEST['student-view-conduct']))
	{
		$sqlStr = "SELECT * FROM conduct ";
			
		//echo $sqlStr . "<br>";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo '<table id="report" align = "center">
								<thead><tr>
								<th>ID</th>
								<th>Conduct Group</th>
								<th>Definition</th>
							</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['group_id'].'</td>
									<td>'.$row['group_name'].'</td>
									<td>'.$row['definition'].'</td>
								</tr>';

						}
						echo '
						</table>';
		
	}
	elseif(isset($_REQUEST['student-view-behaviour']))
	{

		$sqlStr = "SELECT * FROM conduct_breakdown JOIN conduct ON conduct.group_id=conduct_breakdown.group_id";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo ' <table id="report" align = "center">
								<thead><tr>
								<th>Conduct ID</th>								
								<th>Conduct Group Name</th>
								<th>Conduct Name</th>
								</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['conduct_id'].'</td>
									<td>'.$row['group_name'].'</td>
									<td>'.$row['conduct_name'].'</td>
													
								</tr>';

						}
						echo '
						</table>';
		
	}
	elseif(isset($_REQUEST['student-view-strategies']))
	{
		//$sqlStr = "SELECT * FROM sky_grades JOIN sky_student ON sky_student.studentid=sky_grades.studentid
			//	JOIN sky_subjects ON sky_grades.subjectid=sky_subjects.subjectid";
	
	
	$sqlStr = "SELECT * FROM conduct JOIN conduct_breakdown ON conduct.group_id=conduct_breakdown.group_id
			   JOIN conduct_breakdown_strategy ON conduct_breakdown.conduct_id=conduct_breakdown_strategy.conduct_id ORDER BY strategy_name";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo ' <table id="report" align = "center">
								<thead><tr>
								
								<th>Conduct Group</th>								
								<th>Conduct Name</th>
								<th>Strategy</th>
								<th>Description</th>
								</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['group_name'].'</td>
									<td>'.$row['conduct_name'].'</td>
									<td>'.$row['strategy_name'].'</td>
									<td>'.$row['strategy_description'].'</td>
													
								</tr>';

						}
						echo '
						</table>';
		
	}
	
   
	
}	?>	

</div>
</form>
</body>
</html>

