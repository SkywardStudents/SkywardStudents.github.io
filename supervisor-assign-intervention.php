<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    



<script type="text/javascript">

$(document).ready(function(){
	function get_selected_fields(){
		var data = {};
		if ($('#studentid').val()){
			data.studentid = $('#studentid').val();
		}
		if ($('#conduct').val()){
			data.conduct_id = $('#conduct').val();
		}
		if ($('#strategy').val()){
			data.strategy_id = $('#strategy').val();
		}
		
		return data;
	}
	
 	$('#studentid').on('change',function(){
        var studentid = $(this).val();
        if(studentid){
			var postData = {};
			postData.studentid = studentid;
            $.ajax({
                type:'POST',
                url:'getStrategy.php',
                data:postData,
                success:function(html){
                    $('#conduct').html(html);
					$('#strategy').html('<option value="">Select conduct first</option>'); 
                }
            }); 
        }else{
            $('#conduct').html('<option value="">Select student first</option>'); 
            $('#strategy').html('<option value="">Select conduct first</option>'); 
        }
    });
	$('#conduct').on('change',function(){
        var conductID = $(this).val();
        if(conductID){
			var postData = get_selected_fields();
            $.ajax({
                type:'POST',
                url:'getStrategy.php',
                data:postData,
                success:function(html){
                    $('#strategy').html(html);
                }
            });
			$.ajax({
                type:'POST',
                url:'getStrategyDescription.php',
                data:postData,
                success:function(html){
                    $('#strategy_description').html(html);
                }
            });
        }else{
            $('#strategy').html('<option value="">Select conduct first</option>'); 
        }
    });
	$('#strategy').on('change',function(){
			var postData = get_selected_fields();
			$.ajax({
                type:'POST',
                url:'getStrategyDescription.php',
                data:postData,
                success:function(html){
                    $('#strategy_description').html(html);
                }
            });
    });
});

</script>
<div class="container">
	   <div class="no-gutter row"> 
           <div class="col-md-12">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body">
					<br>
					   
					<h2 align="center">ASSIGN INTERVENTION</h2>
					<h4 align="center">Assign Students Recommended for Intervention</h4> 
					<br>
					<hr>
	
              
             
                    <form class="form col-md-6 center-block"  method="post" autocomplete="off">
                        
					<?php
				//Include the database configuration file
				include 'db.php';

				$sql = "SELECT b.studentid, count(*) as count_beh, c.intervention_trigger FROM student_behaviour b LEFT JOIN conduct c USING (group_id) GROUP BY b.studentid HAVING count_beh >= c.intervention_trigger";
				//Fetch all the country data
				$query = $db->query("SELECT studentid, partyname FROM sky_student
				WHERE studentid IN ( SELECT studentid FROM ($sql) AS t)
				ORDER BY partyname");						
				
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
					 
					 
					 
					 
				<?php
				
								 
				//Include the database configuration file
				include 'db.php';

				
				//Fetch all the country data
				$query = $db->query("SELECT * FROM conduct ");
				
			

				//Count total number of rows
				$rowCount = $query->num_rows;
				?>
				
					<div class="row">     
                         <div>
                            <div class="form-group" >
                              <label>SELECT DISPLAYED BEHAVIOUR :</label>
									<select class="form-control input-lg" id="conduct" name ="conduct" required>
									<option value="">SELECT GROUP FIRST </option>		
							
								</select>  
                            </div>
                         </div>
                     </div>
                     <div class="row">     
                        <div>
                            <div class="form-group">
					    	<label>SELECT STRATEGY:</label>
								<select class="form-control input-lg"  id="strategy" name ="strategy" required> 
								<option value="">SELECT STRATEGY FIRST </option>		
									
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
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"   name="saveIntervention" value="Upload" style="float:left;" />ASSIGN INTERVENTION</button>
                                </div>
								
                	
								<?php 
								 
									 if(isset($_REQUEST['saveIntervention']))
										  
										{
											
											$studentid=$_REQUEST['studentid'];
											$conduct=$_REQUEST['conduct'];
											$strategy=$_REQUEST['strategy'];
											$imp_date = $_REQUEST['date'];
											$user_id = $_SESSION['user_id'];
										
											$sql="INSERT INTO student_intervention (studentid,conduct_id, strategy_id, imp_date,user_id) VALUES('$studentid','$conduct','$strategy', '$imp_date','$user_id')";
											mysqli_query($db,$sql) or die(mysqli_error($db));
											echo "INTERVENTION RECORD SAVED";
									   
										}
								 ?>	
                            </div>
					
						</div>
						
						
						
						
						
						
                    </form>
					<div class="col-md-6" id="strategy_description"></div>
					              </div>
               </div>
           </div>
        </div>
    </div>
