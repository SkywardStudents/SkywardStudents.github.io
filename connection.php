<?php 
  
    $server="localhost"; 
    $user="root"; 
    $pass=""; 
    $db="userprofile"; 
      
    // connect to mysql 
      
    mysqli_connect($server, $user, $pass, $db) or die("Sorry, can't connect to the mysql."); 
      
    // select the db 
      
    //mysql_select_db($db) or die("Sorry, can't select the database."); 
  
?>