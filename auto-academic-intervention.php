<?php
if(isset($_REQUEST['studentid']))			  
{
	include '_database/database.php';
	@session_start();
	$studentid=$_REQUEST['studentid'];
	$conduct=41;
	$strategy=92;
	$reg_date = $imp_date = date('Y-m-d');
	$user_id = $_SESSION['user_id'];
	
	$group=1;

	$sql="INSERT INTO student_behaviour(studentid,group_id,conduct_id, reg_date,user_id) VALUES('$studentid','$group','$conduct', '$reg_date','$user_id')";
	mysqli_query($database,$sql) or die(mysqli_error($database));
	
	$sql="INSERT INTO student_intervention (studentid,conduct_id, strategy_id, imp_date,user_id) VALUES('$studentid','$conduct','$strategy', '$imp_date','$user_id')";
	mysqli_query($database,$sql) or die(mysqli_error($database));
	
	echo "INTERVENTION RECORD SAVED";

} else {
	echo "Err";
}