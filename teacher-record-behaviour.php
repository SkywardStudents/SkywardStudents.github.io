<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    

<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
   

<script type="text/javascript">

$(document).ready(function(){
 	$('#group').on('change',function(){
        var groupID = $(this).val();
        if(groupID){
            $.ajax({
                type:'POST',
                url:'getConduct.php',
                data:'group_id='+groupID,
                success:function(html){
                    $('#conduct').html(html);
                    $('#strategy').html('<option value="">Select conduct first</option>'); 
					$('#conduct_description').html('<p class="alert alert-info">Select conduct</p>'); 
                }
            }); 
        }else{
            $('#conduct').html('<option value="">Select Group First</option>');
            $('#strategy').html('<option value="">Select conduct first</option>'); 
            $('#conduct_description').html('<p class="alert alert-info">Select conduct</p>'); 
        }
    });
	$('#conduct').on('change',function(){
        var conductID = $(this).val();
        if(conductID){
            $.ajax({
                type:'POST',
                url:'getConduct.php',
                data:'conduct_id='+conductID,
                success:function(html){
                    $('#strategy').html(html);
                }
            });
			$.ajax({
                type:'POST',
                url:'getConductDescription.php',
                data:'conduct_id='+conductID,
                success:function(html){
                    $('#conduct_description').html(html);
                }
            });
        }else{
            $('#strategy').html('<option value="">Select state first</option>'); 
        }
    });
});

</script>

</head>
<div class="container">
	<div class="no-gutter row"> 
        <div class="col-md-12">
            <div class="panel panel-default" id="sidebar">
                <div class="panel-body">

				<br> 
				<h2 align="center">RECORD BEHAVIOUR</h2>
				<h4 align="center">Record Students Behaviour Below</h4> 
				<hr>
				<br>	           
                <form class="form col-md-6 center-block"  method="post" autocomplete="off">
                        
				<?php
				//Include the database configuration file
				include 'db.php';
				$user_id = $_SESSION['user_id'];
				$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
				$result = mysqli_query($database,$sql) or die(mysqli_error($database));
				if($rws = mysqli_fetch_array($result)){ 
					$class = $rws['class'];
				} else {
					$class = '';
				}
				//Fetch all the country data
				$sql = "SELECT * FROM sky_student";
				if ($class){
					$sql .= " WHERE class = '$class'";
				}
				$sql .= ' ORDER BY partyname';
				$query = $db->query($sql);
				 
				

				//Count total number of rows
				$rowCount = $query->num_rows;
				?>
					<div class="row">     
                         <div>
                            <div class="form-group" >
                              <label>SELECT STUDENT NAME:</label>
									<select class="form-control input-lg" id="studentid" name ="studentid" required>
										<option value="">Select Student</option>
										<?php
										if($rowCount > 0){
											while($row = $query->fetch_assoc()){ 
												echo '<option value="'.$row['studentid'].'">'.$row['partyname'].'</option>';
											}
										}else{
											echo '<option value="">Student not available</option>';
										}
										?>
									</select>
							</div>
                         </div>
                     </div>
					  
					
				<?php
				//Include the database configuration file
				include 'db.php';

				//Fetch all the country data
				$query = $db->query("SELECT * FROM conduct");

				//Count total number of rows
				$rowCount = $query->num_rows;
				?>
					<div class="row">     
                         <div>
                            <div class="form-group" >
                              <label>SELECT GROUP OF BEHAVIOUR :</label>
									<select class="form-control input-lg" id="group" name = "group" required>
										<option value="">Select Group</option>
										<?php
										if($rowCount > 0){
											while($row = $query->fetch_assoc()){ 
												echo '<option value="'.$row['group_id'].'">'.$row['group_name'].'</option>';
																			
											} 
											
											}else{
											echo '<option value="">Group not available</option>';
											}
											?>
									</select>
							</div>
                         </div>
                     </div>
					<div class="row">     
                         <div>
                            <div class="form-group" >
                              <label>SELECT DISPLAYED BEHAVIOUR :</label>
							  
									<select class="form-control input-lg" id="conduct" name ="conduct" required>
									<option>SELECT GROUP FIRST </option>		
							
								</select>  
                            </div>
                         </div>
                     </div>
                     <div class="row">     
                        <div>
                            <div class="form-group">
					    	<label>DATE:</label>
								
							<input  class="form-control input-lg" type = "date" id = "date" name = "date" required value="<?php echo date("Y-m-d"); ?>">
                               </div>
                            </div>
                        </div>	
						

		
                        <div class="row">    
                            <div>
                                <div class="form-group">
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  name="saveBehave" value="Upload" style="float:left;" />RECORD BEHAVIOUR</button>
								</div>
								<?php 
								 
									 if(isset($_REQUEST['saveBehave']))//{
										{
											
											$studentid=$_REQUEST['studentid'];
											$group=$_REQUEST['group'];
											$conduct=$_REQUEST['conduct'];
											$reg_date = $_REQUEST['date'];
											$user_id = $_SESSION['user_id'];
										
											$sql="INSERT INTO student_behaviour(studentid,group_id,conduct_id, reg_date,user_id) VALUES('$studentid','$group','$conduct', '$reg_date','$user_id')";
											mysqli_query($db,$sql) or die(mysqli_error($db));
											echo '<br>RECORD WAS SAVED! ';
									   
										}
								 ?>	
                            </div>
					
						</div>
                 
                  
					
					<div class="row">    
                        <div>
							<div class="form-group">
								<BR><a href="teacher-view-behaviour-list.php" class="btn btn-success ladda-button" role="button">VIEW CURRENT LIST</a>
							</div>
						</div>
					</div>
				</form>
				
					<div class="col-md-6" id="conduct_description"></div>
					
				</div></div></div></div></div>

				<script>


</script>