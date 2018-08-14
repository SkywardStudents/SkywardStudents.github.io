<?php
   
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


    //require '../_database/database.php';
    $student_firstnamee = mysqli_real_escape_string($database,$_REQUEST['student_firstname']);
    if(!$_SESSION['student_firstname']){
        header("location:student-profile.php?$student_firstname");
		
    }
?>