<?php
//Include the database configuration file
include 'db.php';
if(empty($_POST["studentid"])){
	return "a valid studentid is required";
}


if(empty($_POST["conduct_id"])){
	echo "";
	return;
}
if(empty($_POST["strategy_id"])){
	echo "<div class='alert alert-info'>Select a strategy to view the description.</div>";
	return;
}

echo "<ul class='list-group' >";
$strategy_id = (int)$_POST["strategy_id"];
$query = $db->query("SELECT * FROM conduct_breakdown_strategy WHERE strategy_id = '$strategy_id'");

if($query->num_rows == 0){
	echo '<li class="list-group-item">Strategies not available</li>';
} else {
	while($row = $query->fetch_assoc()){ 
		echo "<li class='list-group-item'>
		<h4 class='list-group-item-heading'>{$row['strategy_name']}</h4>
		<p class='list-group-item-text'>{$row['strategy_description']}</p>
		</li>";
	}
}
echo "<ul>";