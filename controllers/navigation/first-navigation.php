<?php
    $current_user = $_SESSION['user_username'];
     $sql = "SELECT * FROM user WHERE user_username='$current_user'";
    $result = mysqli_query($database,$sql);
	
	    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) 
		{
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
                                <a href="home.php"><i class="fa fa-edit"></i> View All Students</a>
                            </li>
							
                        </ul>
                    </li>	
                </ul>    
	        </div><!--/.nav-collapse -->
	      </div>
		<?php
	}
	
		//include 'db.php';
			$user_level = $_SESSION['user_level'];
			if($user_level == '1')
			{?>
				<div class="topnavg">
		  	  		<h6>
						<a href="home.php" >Home</a>
						<!--<a href="teacher-view-list.php">Student List</a> -->
						<a href="get-Student-360-Profile.php">Student Profile</a>
						<a href="teacher-record-behaviour.php">Record Behaviour</a>
						<a href="teacher-view-behaviour-list.php">Logged Behaviour</a>
						<a href="teacher-view-intervention-list.php">Logged Intervention</a>
						
						  
					</h6> 
				</div>
                <?php
                }
			else if($user_level == '3')
				 {?>
               <div class="topnavg">
		  	  		<h6>
						<a href="home.php">Home</a>
						<a href="student-home-iag.php">View Student Data</a>
						<a href="create-user.php">Create User</a>
						<a href="update-user.php">Update User</a>
						
					</h6> 
				</div> 
                <?php
                }
				else if($user_level == '2')
				{?>
				<div class="topnavg">
					<h6>
						<a href="home.php">Home</a>
						<a href="get-Student-360-Profile.php">Student Profile</a>
						<a href="supervisor-view-list-academic.php">Low Achievers</a> 
						<a href="teacher-view-behaviour-list.php">Logged Behaviour</a>
						<a href="supervisor-assign-intervention.php">Assign Intervention</a> 
						<a href="supervisor-view-intervention-list.php">Logged Intervention</a>
					</h6> 
				</div>  
				<?php
				}
				else 
				{?>
				<div class="topnavg">
					<h6>
						<a href="home.php">Home</a>
						<!--<a href="student-home-iag.php">Student</a>
						<a href="student-home-cbs.php">Behaviour</a>
						<a href="student-home-aarr.php">Intervention</a> -->
						<a href="principal-dashboard.php">View Dashboard</a>
						<a href="get-Student-360-Profile.php">Student Profile</a>
						<a href="teacher-view-behaviour-list.php">Logged Behaviour</a>
						<a href="teacher-view-intervention-list.php">Logged Intervention</a>
					</h6> 
				</div>  
				<?php
				}?> 
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
	