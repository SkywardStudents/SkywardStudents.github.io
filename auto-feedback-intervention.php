<?php
if(isset($_REQUEST['intervention_id']))			  
{
	include '_database/database.php';
	$feedback=(int)$_REQUEST['feedback'];
	$intervention_id= (int)$_REQUEST['intervention_id'];
	$sql="UPDATE student_intervention SET is_successful='$feedback' WHERE `intervention_id`=$intervention_id";
	mysqli_query($database,$sql) or die(mysqli_error($database));
	
	echo "INTERVENTION RECORD UPDATED";
	
} else {
	echo "Err";
}