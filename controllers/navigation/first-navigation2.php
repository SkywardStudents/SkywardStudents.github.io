<?php
    $current_user = $_SESSION['user_username'];
     $sql = "SELECT * FROM user WHERE user_username='$current_user' AND user_profession = 'Principal'";
    $result = mysqli_query($database,$sql);
	
	
    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
?>
    <!-- Navbar1 -->
	    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
	        <div class="navbar-collapse collapse" id="navbar-collapse1">
	           <ul class="nav navbar-nav">
	               <li>
                       <a href="home.php"><i class="fa fa-home"></i> Skyward Home</a>
                   </li>
	           </ul>
                <form class="navbar-form navbar-left" role="search" method="post" autocomplete="off" action="search-result.php">
                    <div class="form-group">
                        <input type="text" class="search form-control" id="searchbox" placeholder="Search Users" name="search-form"/><br />
                        <div id="display"></div>
				    </div> 
				</form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $row['user_firstname'];?> <?php echo $row['user_lastname'];?><strong class="caret"></strong></a>                  
                        <ul class="dropdown-menu">
                            <li>
                                <a href="edit-profile.php"><i class="fa fa-edit"></i> Edit Profile</a>
                            </li>
							<li>
                                <a href="all-users.php"><i class="fa fa-edit"></i> View Users</a>
                            </li>
							<li>
                                <a href="components/logout.php"><i class="fa fa-mail-reply"></i> Logout</a>
                            </li>
						</ul>
                    </li>
				
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars" style="font-size: 1.27em;"></i>
                        </a>
                        <ul class="dropdown-menu">
                             <li>
                                <a href="all-students.php"><i class="fa fa-edit"></i> View All Students</a>
                            </li>
							<li>
                                <a href="view-student.php"><i class="fa fa-edit"></i> Display Student Data</a>
                            </li>
							
                        </ul>
                    </li>	
                </ul>    
	        </div><!--/.nav-collapse -->
	      </div>
		<div class="topnavg">
		  
		  
		  <h6>
		 <a href="home.php">Home</a>
		 <a href="student-home-iag.php">Student</a>
		 
		 <a href="student-home-cbs.php">Behaviour</a>
		 <a href="student-home-aarr.php">Intervention</a>
		 <a href="get-Something.php">Student 360</a>
		 <a href="record-behaviour.php">Record</a>
		<a href="assign-intervention.php">Assign</a>
		
		</h6> 
		</div 
		
      <!-- ./Navbar1 -->
	  


<?php
    }
?>
<style>




body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnavg {
  overflow: hidden;
  background-color: black;
}

.topnavg a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnavg a:hover {
  background-color: lightskyblue;
  color: black;
}

.topnavg a.active {
  background-color: dodgerblue;
  color: white;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
</style>