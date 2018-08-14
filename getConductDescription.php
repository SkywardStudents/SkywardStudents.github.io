<?php
//Include the database configuration file
include 'db.php';

if(empty($_POST["conduct_id"])){
	echo "";
	return;
}

echo "<ul class='list-group' >";
$conduct_id = (int)$_POST["conduct_id"];
$query = $db->query("SELECT * FROM conduct_breakdown WHERE conduct_id = '$conduct_id'");

if($query->num_rows == 0){
	echo '<li class="list-group-item">Conduct description not available</li>';
} else {
	while($row = $query->fetch_assoc()){ 
		echo "<li class='list-group-item'>
		<h4 class='list-group-item-heading'>{$row['conduct_name']} Behaviour </h4>
		<b class ='text-danger'>The Student May...</b>
		<p class='list-group-item-text'>{$row['conduct_description']}</p>
		</li>";
	}
}
echo "<ul>";