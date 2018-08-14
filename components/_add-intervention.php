<?php
    session_start();
    include '../_database/database.php';

	if(isset($_POST['add_intervention'])){
        $student_id=$_POST['student_id'];
        $student_firstname=$_POST['student_firstname'];
        $student_lastname=$_POST['student_lastname'];
        $student_grade=$_POST['student_grade'];
		$student_class=$_POST['student_class'];
        $behaviour_category=$_POST['$behaviour_category'];
		
        $sql="INSERT INTO student_behaviour(student_id, student_firstname,student_lastname,student_grade, student_class,behaviour_category) VALUES('$student_id','$student_lastname','$student_firstname','$student_grad','$student_class', '$behaviour_category')";
        mysqli_query($database,$sql) or die(mysqli_error($database));
       // $_SESSION['student_id'] = $student_id;
       // header('Location: ../intervention-list.php?student_firstname='.$student_firstname);
    }
	
	
	
	
?>