<?php 
	
    include 'db.php';


    if(isset($_POST['record'])){
	
		//$studentid=$_REQUEST['studentid'];
		//$partyname=$_REQUEST['partyname'];
		//$group_name=$_REQUEST['group_name'];
		//$conduct_name=$_REQUEST['conduct_name'];
		//$strategy_name=$_REQUEST['strategy_name'];
		
       $sql = "INSERT INTO student_behaviour (studentid, partytname, group_name, conduct_name, strategy_name, reg_date)
		VALUES (1001, 'John Doe', 'Violent Behaviour', 'Kicking', 'Referred to Dean', CURRENT_TIMESTAMP,)";

       mysqli_query($db,$sql) or die(mysqli_error($db));
       
        
	
/*
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
*/
 }
?>
	


