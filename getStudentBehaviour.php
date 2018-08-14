<?php
if(!empty($_GET['studentid'])){
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
    $studentid = $_GET['studentid'];

    //get user data from the database
    $query = $db->query("SELECT * FROM student_behaviour b 
		LEFT JOIN conduct g USING (group_id)
		LEFT JOIN conduct_breakdown c USING (conduct_id)
		LEFT JOIN user u USING (user_id)
		WHERE b.studentid= '{$studentid}'");
   
   if($query->num_rows > 0){
		$userData = array();
		$alerts = array();
		$interventions = array();
		while($row = $query->fetch_assoc()){
			$userData[] = $row;
		}
		$days_to_check = 15;
		$num_of_conduct = 3;
		$sql1  ="SELECT `conduct_id` , count(*) as count_conduct FROM `student_behaviour` b WHERE b.studentid= '{$studentid}' AND (reg_date between (NOW()- INTERVAL $days_to_check DAY) AND NOW()) group by b.studentid, b.conduct_id having count_conduct >= $num_of_conduct";

		$query = $db->query("SELECT g.group_name, cb.conduct_name,GROUP_CONCAT( s.strategy_name) as  strategy_name FROM 
		($sql1) AS ct1 
		left join `conduct_breakdown_strategy` s USING (conduct_id)
		left join `conduct_breakdown` cb USING (conduct_id)
		LEFT JOIN conduct g ON (cb.group_id = g.group_id)
		GROUP BY  cb.conduct_id");
		
		
		while($row = $query->fetch_assoc()){
			$interventions[] = $row;
		}
		$days_to_check = 15;
		$num_of_conduct = 3;
		$sql1  ="SELECT `conduct_id` , count(*) as count_conduct FROM `student_behaviour` b WHERE b.studentid= '{$studentid}' AND (reg_date between (NOW()- INTERVAL $days_to_check DAY) AND NOW()) group by b.studentid, b.conduct_id having count_conduct >= $num_of_conduct";

		$query = $db->query("SELECT g.group_name, cb.conduct_name,GROUP_CONCAT( s.strategy_name) as  strategy_name FROM 
		($sql1) AS ct1 
		left join `conduct_breakdown_strategy` s USING (conduct_id)
		left join `conduct_breakdown` cb USING (conduct_id)
		LEFT JOIN conduct g ON (cb.group_id = g.group_id)
		GROUP BY cb.conduct_id");
		
		
		while($row = $query->fetch_assoc()){
			$alerts[] = $row;
		}
		
        $data['status'] = 'ok';
        $data['result'] = $userData;
        $data['interventions'] = $interventions;
        $data['alerts'] = $alerts;
		
		
    }else{
        $data['status'] = 'err';
        $data['error'] = mysqli_error($db);
    }
		//returns data as JSON format
		function utf8_encode_all($dat) // -- It returns $dat encoded to UTF8 
		{ 
		  if (is_string($dat)) return utf8_encode($dat); 
		  if (!is_array($dat)) return $dat; 
		  $ret = array(); 
		  foreach($dat as $i=>$d) $ret[$i] = utf8_encode_all($d); 
		  return $ret; 
		} 
		$data = utf8_encode_all($data);
    echo json_encode($data,JSON_UNESCAPED_UNICODE );
}
?>