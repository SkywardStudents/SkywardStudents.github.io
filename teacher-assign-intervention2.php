<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    



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
                url:'getStrategy.php',
                data:'conduct_id='+conductID,
                success:function(html){
                    $('#strategy').html(html);
                }
            }); 
        }else{
            $('#strategy').html('<option value="">Select state first</option>'); 
        }
    });

        $('#conduct_name').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "autocomplete.php",
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
  });

</script>

<br>
<br>      
<h2 align="center">RECORD INTERVENTION</h2>
   <h4 align="center">Assign Students Recommended for Intervention</h4> 
	
	
              
             
                    <form class="form col-md-12 center-block"  method="post" action="assign-intervention.php" autocomplete="off">
                        
					<?php
				//Include the database configuration file
				include 'db.php';

				//Fetch all the country data
				//$query = $db->query("SELECT distincy partyname FROM student_behaviour ORDER BY partyname //JOIN sky_student ON sky_student.studentid = student_behaviour.studentid ");
				
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
											while($row = $query->fetch_assoc())
											{ 
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
				
					<div class="row">     
                         <div class="col-lg-6">
                            <div class="form-group" >
                              <label>SELECT DISPLAYED BEHAVIOUR :</label>
									<input type = "text" class="form-control input-lg" id="conduct_name" name ="conduct_name" required>
										
							
								 
                            </div>
                         </div>
                     </div>
                     <div class="row">     
                        <div class="col-lg-6">
                            <div class="form-group">
					    	<label>SELECT STRATEGY:</label>
								<select class="form-control input-lg"  id="strategy"> 
								<option>SELECT STRATEGY FIRST </option>		
									
									</select>
							
                               </div>
                            </div>
                        </div>	
						

		
                        <div class="row">    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"   name="assign" value="Upload" style="float:left;" name="record"/>ASSIGN INTERVENTION</button>
                                </div>
								
                            </div>
                        </div>
						
						<div class="row">    
                            <div class="col-lg-6">
                                <div class="form-group">
                           
								<?php 
								 //include 'server.php';
									 if(isset($_REQUEST['assign']))//{
										 //if(isset($_POST['record'])) 
										{
											
											$studentid=$_REQUEST['studentid'];
											$conduct=$_REQUEST['conduct'];
											$strategy=$_REQUEST['strategy'];
											$imp_date = $_REQUEST['date'];
											$user_id = $_SESSION['user_id'];
										
											$sql="INSERT INTO student_intervention(studentid,conduct_id, strategy_id, imp_date,user_id) VALUES('$studentid','$group','$conduct', '$imp_date','$user_id')";
											mysqli_query($db,$sql) or die(mysqli_error($db));
											echo "RECORD SAVED";
									   
										}
								 ?>	
                            </div>
                        </div>
						
						
						
						
						
                    </form>
