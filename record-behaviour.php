<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    
<?php include 'controllers/navigation/admin-navigation.php' ?> 


<script type="text/javascript">

$(document).ready(function(){
 	$('#group').on('change',function(){
        var groupID = $(this).val();
        if(groupID){
            $.ajax({
                type:'POST',
                url:'getStrategy.php',
                data:'group_id='+groupID,
                success:function(html){
                    $('#conduct').html(html);
                    $('#strategy').html('<option value="">Select conduct first</option>'); 
                }
            }); 
        }else{
            $('#conduct').html('<option value="">Select Group First</option>');
            $('#strategy').html('<option value="">Select conduct first</option>'); 
        }
    });
	$('#conduct').on('change',function(){
        var conductID = $(this).val();
        if(conductID){
            $.ajax({
                type:'POST',
                url:'get-strategy.php',
                data:'conduct_id='+conductID,
                success:function(html){
                    $('#strategy').html(html);
                }
            }); 
        }else{
            $('#strategy').html('<option value="">Select state first</option>'); 
        }
    });
});

</script>

<br>
<br>      
<h2 align="center">RECORD INTERVENTION</h2>
   <h4 align="center">Assign Students Recommended for Intervention</h4> 
	
	
              
             
                    <form class="form col-md-12 center-block"  method="post" autocomplete="off">
                        
					<?php
				//Include the database configuration file
				include 'db.php';

				//Fetch all the country data
				$query = $db->query("SELECT * FROM sky_student ORDER BY partyname");

				//Count total number of rows
				$rowCount = $query->num_rows;
				?>
					<div class="row">     
                         <div class="col-lg-6">
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
                         <div class="col-lg-6">
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
                         <div class="col-lg-6">
                            <div class="form-group" >
                              <label>SELECT DISPLAYED BEHAVIOUR :</label>
									<select class="form-control input-lg" id="conduct" name ="conduct" required>
									<option>SELECT GROUP FIRST </option>		
							
								</select>  
                            </div>
                         </div>
                     </div>
                     <div class="row">     
                        <div class="col-lg-6">
                            <div class="form-group">
					    	<label>DATE:</label>
								
							<input  class="form-control input-lg" type = "date" id = "date" name = "date" required value="<?php echo date("Y-m-d"); ?>">
                               </div>
                            </div>
                        </div>	
						

		
                        <div class="row">    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  name="save" value="Upload" style="float:left;" name="record"/>RECORD BEHAVIOUR</button>
                                </div>
								<?php 
								 //include 'server.php';
									 if(isset($_REQUEST['save']))//{
										 //if(isset($_POST['record'])) 
										{
											
											$studentid=$_REQUEST['studentid'];
											$group=$_REQUEST['group'];
											$conduct=$_REQUEST['conduct'];
											$reg_date = $_REQUEST['date'];
											$user_id = $_SESSION['user_id'];
										
											$sql="INSERT INTO student_behaviour(studentid,group_id,conduct_id, reg_date,user_id) VALUES('$studentid','$group','$conduct', '$reg_date','$user_id')";
											mysqli_query($db,$sql) or die(mysqli_error($db));
											echo "RECORD SAVED";
									   
										}
								 ?>	
                            </div>
                        </div>
                    </form>
