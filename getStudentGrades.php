
<?php
if(!empty($_POST['studentid'])){
    $data = array();
    
    //database details
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'userprofile';
    
    //create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($db->connect_error){
        die("Unable to connect database: " . $db->connect_error);
    }
    
    //get user data from the database
    $query = $db->query("SELECT s.subjectname, round(avg(g.subjectgrade),2) as subjectaverage 
	FROM sky_grades g LEFT JOIN sky_subjects s USING (subjectid) 
	WHERE studentid='{$_POST['studentid']}' 
	GROUP BY subjectid");
   
    if($query->num_rows > 0){
        $userData = array();
		$grades = array();
		while($row = $query->fetch_assoc()){
			$userData[] = $row;
			$grades[] = $row['subjectaverage'];
		}
		if (count($grades)){
			$avg = round(array_sum($grades) / count($grades),2);
		} else {
			$avg = 'abs';
		}
		$data['status'] = 'ok';
        $data['result'] = $userData;
        $data['final_average'] = $avg;
		
    }else{
        $data['status'] = 'err';
        $data['result'] = '';
    }
		//returns data as JSON format
    echo json_encode($data);
}
?>