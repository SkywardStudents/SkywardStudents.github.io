<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    

<html>
 <head>
  <title>Webslesson Tutorial | Autocomplete Textbox using Bootstrap Typehead with Ajax PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
 -->
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
					<div class="row">     
                         <div class="col-lg-6">
                            <div class="form-group" >
                              <label>ENTER CONDUCT:</label>
								<input type="text" name="conduct_name" id="conduct_name" class="form-control input-lg" autocomplete="off" placeholder="Type Country Name" />
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
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  name="saveBehave" value="Upload" style="float:left;" />RECORD BEHAVIOUR</button>
							</div>
								<?php 
								 
									 if(isset($_REQUEST['saveBehave']))
										  
										{
											
											$studentid=$_REQUEST['studentid'];
											$conduct_name=$_REQUEST['conduct_name'];
											$reg_date = $_REQUEST['date'];
											$user_id = $_SESSION['user_id'];
										
											$sql="INSERT INTO tester(studentid, conduct_name, reg_date,user_id) VALUES('$studentid', '$conduct_name', '$reg_date','$user_id')";
											mysqli_query($db,$sql) or die(mysqli_error($db));
											echo '<br>RECORD WAS SAVED! ';
									   
										}
								 ?>	
                        </div>
					</div>
 				
					<div class="row">    
                        <div class="col-lg-6">
							<div class="form-group">
								<BR><a href="teacher-view-behaviour-list.php" class="btn btn-success ladda-button" role="button">VIEW CURRENT LIST</a>
							</div>
						</div>
					</div>
				</form>
				</div></div></div></div></div>
 
 
 
 
 
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#conduct_name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"_fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>
