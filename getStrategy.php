<?php
//Include the database configuration file
include 'db.php';
if(empty($_POST["studentid"])){
	return "a valid studentid is required";
}

$studentid = (int)$_POST["studentid"];
if(empty($_POST["conduct_id"])){
	//show behaviours|conduct_id
	$sql0 = "SELECT b.studentid, `conduct_id`, count(*) as count_beh, c.intervention_trigger FROM student_behaviour b LEFT JOIN conduct c USING (group_id) GROUP BY b.studentid HAVING count_beh >= c.intervention_trigger";
	$sql1  ="SELECT DISTINCT `conduct_id` FROM ($sql0) b WHERE b.studentid= '{$studentid}'";

	$query = $db->query("SELECT g.group_name, cb.conduct_id, cb.conduct_name FROM 
		($sql1) AS ct1 
		left join `conduct_breakdown` cb USING (conduct_id)
		LEFT JOIN conduct g ON (cb.group_id = g.group_id)
		GROUP BY  cb.conduct_id
		ORDER BY g.group_name, cb.conduct_name");
	
	
    if($query->num_rows > 0){
        echo '<option value="">Select Conduct</option>';
		$group = '';
        while($row = $query->fetch_assoc()){ 
			if ($row['group_name'] != $group){
				if ($group ){
					echo '</optgroup>';
				}
				$group = $row['group_name'];
				echo '<optgroup label="'.$row['group_name'].'">';
			}
		
            echo '<option value="'.$row['conduct_id'].'">'.$row['conduct_name'].'</option>';
        }
		echo '</optgroup>';
    }else{
        echo '<option value="">Conduct not available</option>';
    }
	return;
}

$conduct_id = (int)$_POST["conduct_id"];
$query = $db->query("SELECT * FROM conduct_breakdown_strategy WHERE conduct_id = '$conduct_id' ORDER BY base_rank DESC");

if($query->num_rows == 0){
	echo '<option value="">Strategy not available</option>';
	return;
}
$strategy = $strategy_sorted = array();
while($row = $query->fetch_assoc()){ 
	$strategy[$row['strategy_id']] =  $row;
}


//get student behaviour data
$query = $db->query("SELECT strategy_id, count(*) as count_strategy FROM student_intervention WHERE conduct_id ='$conduct_id' AND studentid='$studentid' AND `is_successful` GROUP BY strategy_id ORDER BY count_strategy DESC");
if($query->num_rows){
	while($row = $query->fetch_assoc()){
		if (isset($strategy[$row['strategy_id']] )){
			$strategy_sorted[] = $strategy[$row['strategy_id']];
			unset($strategy[$row['strategy_id']]);
		}
	}
} else {
	//get SYSTEM behaviour data
	$query = $db->query("SELECT strategy_id, count(*) as count_strategy FROM student_intervention WHERE conduct_id ='$conduct_id' AND `is_successful` GROUP BY strategy_id  HAVING count_strategy >=3 ORDER BY count_strategy DESC");
	while($row = $query->fetch_assoc()){
		if (isset($strategy[$row['strategy_id']] )){
			$strategy_sorted[] = $strategy[$row['strategy_id']];
			unset($strategy[$row['strategy_id']]);
		}
	}
}

//add back any item without stored data 
foreach($strategy as $row){
	$strategy_sorted[] = $row;
}


echo '<option value="">Select Strategy</option>';
foreach($strategy_sorted as $key => $row){ 
	echo '<option value="'.$row['strategy_id'].'">'.$row['strategy_name'];
	if ($key == 0){
		echo " (preferred)";
	}
	echo '</option>';
}