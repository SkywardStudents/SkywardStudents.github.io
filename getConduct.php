<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
//Include the database configuration file
include 'db.php';

if(!empty($_POST["group_id"])){
    //Fetch all state data
    $query = $db->query("SELECT * FROM conduct_breakdown WHERE group_id = ".$_POST['group_id']." ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select Conduct</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['conduct_id'].'">'.$row['conduct_name'].'</option>';
        }
    }else{
        echo '<option value="">Conduct not available</option>';
    }
}
else if(!empty($_POST["conduct_id"]))
{
    //Fetch all city data
    $query = $db->query("SELECT * FROM conduct_breakdown_strategy WHERE conduct_id = ".$_POST['conduct_id']." ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //City option list
    if($rowCount > 0){
        echo '<option value="">Select Strategy</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['strategy_id'].'">'.$row['strategy_name'].'</option>';
        }
    }else{
        echo '<option value="">Strategy not available</option>';
    }
}
?>