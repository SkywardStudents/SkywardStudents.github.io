<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>  
<?php include 'controllers/navigation/admin-navigation.php' ?>  
<html>
<head>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#getUser').on('click',function(){
        var user_id = $('#user_id').val();
        $.ajax({
            type:'POST',
            url:'getData.php',
            dataType: "json",
            data:{user_id:user_id},
            success:function(data){
                if(data.status == 'ok'){
                    $('#partyname').text(data.result.partyname);
					$('#address').text(data.result.address);
                    $('#group_name').text(data.result.group_name);
                    $('#conduct_name').text(data.result.conduct_name);
					$('#strategy_name').text(data.result.strategy_name);
					$('#points').text(data.result.points);
                    $('#reg_date').text(data.result.reg_date);
                    $('.user-content').slideDown();
                }else{
                    $('.user-content').slideUp();
                    alert("User not found...");
                } 
            }
        });
    });
});
</script>
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
		

<form  method="post" action = "getStudentData.php" autocomplete="off">
<br>
<br>
<p align = "center">
<button type="submit" class = "button" name="getStudentGrade"/>GRADE</button>
<button type="submit" class = "button" name="getStudentBehaviour"/>BEHAVIOUR</button>
<button type="submit" class = "button" name="getStudentInfo"/>INFO </button>
</p>

<br/>
		<h2 align="center">360 STUDENT vIEWS</h2>
		<h4 align="center">See Recommended Suggestions Below For Intervention</h4> 
<?php
if(!empty($_POST['user_id']))
{
	include 'db.php';
	
    if(isset($_REQUEST['getStudentGrade']))
	{
		
		//$sqlStr = "SELECT * FROM student_behaviour WHERE studentid= {$_POST['user_id']}";
		$query = $db->query("SELECT * FROM student_behaviour WHERE studentid= {$_POST['user_id']}");
   	
			
		//echo $sqlStr . "<br>";
		//$result = mysqli_query($database, $sqlStr);
		//$count = mysqli_num_rows($result);

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
									<td>'.$row['group_name'].'</td>
									<td>'.$row['group_name'].'</td>
									<td>'.$row['strategy_name'].'</td>
								</tr>';

						}
						echo '
						</table>';
		
	}
	elseif(isset($_REQUEST['getStudentgRADE']))
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
	elseif(isset($_REQUEST['getStudentBehaviour']))
	{
		
	
	
	$sqlStr = "SELECT * FROM conduct JOIN conduct_breakdown ON conduct.group_id=conduct_breakdown.group_id
			   JOIN conduct_breakdown_strategy ON conduct_breakdown.conduct_id=conduct_breakdown_strategy.conduct_id";
		$result = mysqli_query($database, $sqlStr);
		$count = mysqli_num_rows($result);

						echo ' <table id="report" align = "center">
								<thead><tr>
								
								<th>Conduct Group</th>								
								<th>Conduct Name</th>
								
								<th>Strategy</th>
								</tr></thead>';

						while ($row = mysqli_fetch_array($result)) 
						{
							echo '
								<tr>
									<td>'.$row['group_name'].'</td>
									<td>'.$row['conduct_name'].'</td>
									
									<td>'.$row['strategy_name'].'</td>
													
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

