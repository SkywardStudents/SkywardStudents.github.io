
<?php
  
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
	

	if (!empty($_SESSION['user_username'])) 
	{
        header("location:create-user.php");
    }
   
   }
?>