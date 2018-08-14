<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>  
 
<html>
<head>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



</head>

<body>
    <div class="container">
	   <div class="no-gutter row"> 
           <div class="col-md-12">
               <div class="panel panel-default">
                   
<?php				   
	if (isset($_GET['studentid'])){
		echo "<input type='hidden' name='select_studentid' id='select_studentid' value='{$_GET['studentid']}'/>";
	} else {
		echo "
		<div class='panel-heading'> 
					<h2 align='center'>STUDENT 360 PROFILE</h2>
					<h4 align='center'>View Full Student Details Below</h4> 
					<hr>
		
		
		";
		//Include the database configuration file
				include 'db.php';

				//Fetch all the country data
				$query = $db->query("SELECT studentid, partyname FROM sky_student
				WHERE studentid IN (SELECT studentid FROM student_behaviour)
				ORDER BY partyname");
																
				//Count total number of rows
				$rowCount = $query->num_rows;
		
		echo "
					<div class='row'>     
                         <div class='col-lg-6' >
                            <div  class='form-group' > 
                              <label >SELECT STUDENT NAME:</label><br>
									<select class='form-control input-lg' id='select_studentid' name = 'studentid'>
										<option value=''>Select Student</option>";
										if($rowCount > 0)
										{
											while($row = $query->fetch_assoc())
											{ 
												echo '<option value="'.$row['studentid'].'">'.$row['partyname'].'</option>';
												
											}
																					
										}
		echo "						</select>
							</div>
							<input type='button' id='getUser' class='btn btn-primary ladda-button' value='Run Student 360 Profile '/>
                         </div>
						 
                     </div>";
		echo "</div>"; //END OF THE panel-heading
	}			   
				   
				   
				   
				   
				   
?>				   


<div class='panel-body'> 									
<div class="row">
<?php
							echo '<div class="user-content" style="display: none;">';
												
												echo'
												<b>
												<h2><b><small>Full Name: </small> <span id="partyname"></b> </span></h2>
												<h2><b><small>Average: </small> <span id="final_average"> </span>%</b></h2>	
												<br>
												
												
												
												<h4> <b>Personal Details </b></h4>	
												<br><table width = "80%" align = "center" class="table table-striped table-bordered">
												<tr><th>ID : </th><td><span id="studentid"></span></td></tr>
												<tr><th>Middlename : </th><td><span id="middlename"></span></td></tr>
												<tr><th>Address: </th><td><span id="address"></span></td></tr>
												<tr><th>Gender : </th><td><span id="sex"></span></td></tr>
												<tr><th>Date Of Birth: </th><td><span id="dob"></span></td></tr>
												<tr><th>Grade : </th><td><span id="grade"></span></td></tr>
											
												<tr><th>Class : </th><td><span id="class"></span></td></tr>
												<tr><th>Parent : </th><td><span id="parent"></span></td></tr>
												
												</table>
												<br>';
										echo '
												
												
												
												
												<h4> <b>Student Behaviour Details </b></h4>	
												<br>
												<table width = "80%" id="behaviour_table" class="table table-striped table-bordered">
												<thead>
												<tr><th>Group </th> <th>Behaviour </th>  <th>Date </th><th>Recorded by  </th> </tr>
												</thead>
												<tbody></tbody>
												</table>
												<br>
												
												<div id="strategy_section">
													<h4><b>Suggested Strategies</b></h4>	
													<br>
													<table  id="strategy_table" class="table table-striped table-bordered">
													<thead
													<tr><th>Behaviour </th>  <th>Strategies </tr>
													</thead>
													<tbody></tbody>
													</table>
												</div>
												
												
												<br>
												
											    <div id="alert_section" class="animated text-warning">This student is frequently involved in: <span></span> </div>
												
												<div class="row">    
												<div class="col-lg-6">
													
												</div>	
												</div>
												
												';
												
												
												echo'
												<br><h4><b>Student Academic Details</b></h4>	
												<br>
												
												<table id="grade_table" class="table table-striped table-bordered">
												<thead>
												<tr><th>Subject </th> <th>Average </th></tr>
												</thead>
												<tbody></tbody>
												</table>
												<br>';															
												
												
												echo'
												<br><h4><b>Student Attendance Records</b></h4>	
												<br>
												
												<table id="attendance_table" class="table table-striped table-bordered">
												<thead>
												<tr><th>Key </th>  <th>Value </th> </tr>
												</thead>
												<tbody></tbody>
												</table>
												
												<br>';
										
										echo '	</div>';
										
										?>
</div>
</div></div></div></div>

<script>
$(document).ready(function(){
	function load_student()
	{
        var studentid = $('#select_studentid').val();
        $.ajax(
		{
            type:'POST',
            url:'getData.php',
            dataType: "json",
            data:{studentid:studentid},
            success:function(data)
			{
                if(data.status == 'ok')
				{
                    $('.user-content').slideDown();
					
					load_info();
					load_grades();
					load_attendance();
					var behaviour_table_tbody = $('#behaviour_table').find('tbody');
					$.each(data.result, function(){
						var a = [];
						a.push('<tr>');
						a.push('<td>');
						a.push(this.group_name);
						a.push('</td>');
						a.push('<td>');
						a.push(this.conduct_name);
						a.push('</td>');
						a.push('<td>');
						a.push(this.reg_date);
						a.push('</td>');
						a.push('<td>');
						a.push(this.user_firstname);
						a.push(" ");
						a.push(this.user_lastname);
						a.push('</td>');
						a.push('</tr>');
						
						behaviour_table_tbody.append(a.join(''));
					});
					
					if (data.interventions && (data.interventions.length)){
						var strategy_table_tbody = $('#strategy_table').find('tbody');
						$.each(data.interventions, function(){
							var a = [];
							a.push('<tr>');
							a.push('<td>');
							a.push(this.conduct_name);
							a.push('</td>');
							a.push('<td>');
							a.push(this.strategy_name);
							a.push('</td>');
							a.push('</tr>');
							
							strategy_table_tbody.append(a.join(''));
						});
						$('#strategy_section').show();
					} else {
						$('#strategy_section').hide();
					}
					var alert_section = $("#alert_section");
					if (data.alerts && (data.alerts.length)){
						var a = [];
						$.each(data.alerts, function(){
							a.push(this.conduct_name);
						});
						alert_section.find('span').append(a.join(', '));
						alert_section.show().addClass('flash');
					} else {
						alert_section.hide();
					}
					
                }
				else
				{
                    $('.user-content').slideUp();
                    alert("User not found...");
                } 
            }
        });
}
	function load_info()
	{
        var studentid = $('#select_studentid').val();
        $.ajax(
		{
            type:'POST',
            url:'getStudentInfo.php',
            dataType: "json",
            data:{studentid:studentid},
            success:function(data)
			{
                if(data.status == 'ok')
				{
                    $('#studentid').text(data.result.studentid);
					$('#partyname').text(data.result.partyname);
					$('#middlename').text(data.result.middlename);
					$('#sex').text(data.result.sex);
					$('#dob').text(data.result.dob);
					$('#address').text(data.result.address);
                    $('#contactno').text(data.result.contactno);
					$('#grade').text(data.result.grade);
					$('#form').text(data.result.form);
					$('#class').text(data.result.class);
					$('#parent').text(data.result.parent);
                    $('.user-content').slideDown();
                }
				else
				{
                    $('.user-content').slideUp();
                    alert("User not found...");
                } 
            }
        });
    };
	function load_attendance()
	{
       var studentid = $('#select_studentid').val();
        $.ajax(
		{
            type:'POST',
            url:'getStudentAttendance.php',
            dataType: "json",
            data:{studentid:studentid},
            success:function(data)
			{
                if(data.status == 'ok')
				{
                    $('.user-content').slideDown();
					
					var attendance_table_tbody = $('#attendance_table').find('tbody');
					$.each(data.result, function(){
						var a = [];
						
						a.push('<tr>');
						//a.push('<td>');
						//a.push(this.periodid);
						//a.push('</td>');
						a.push('<td>');
						a.push(this.attendancekey);
						a.push('</td>');
						a.push('<td>');
						a.push(this.value);
						a.push('</td>');
						a.push('</tr>');
						
						attendance_table_tbody.append(a.join(''));
					});
					$('.user-content').slideDown();
                }
				else
				{
                    $('.user-content').slideUp();
                    alert("User not found...");
                } 
            }
        });
    };
	function load_grades()
	{
        var studentid = $('#select_studentid').val();
        $.ajax(
		{
            type:'POST',
            url:'getStudentGrades.php',
            dataType: "json",
            data:{studentid:studentid},
            success:function(data)
			{
                if(data.status == 'ok')
				{
					
					
					var grade_table_tbody = $('#grade_table').find('tbody');
					$.each(data.result, function(){
						var a = [];
						a.push('<tr');
						if (this.subjectaverage < 50){
							a.push(' style="color:red;"');
						}
						a.push('>');
						a.push('<td>');
						a.push(this.subjectname);
						a.push('</td>');
						a.push('<td>');
						a.push(this.subjectaverage);
						a.push('</td>');
						a.push('</tr>');
						
						grade_table_tbody.append(a.join(''));
					});
					$('#final_average').text(data.final_average);
					if (data.final_average < 50){
						$('#final_average').css('color','red');
					}
					$('.user-content').slideDown();
                }
				else
				{
                    $('.user-content').slideUp();
                    alert("User not found...");
                } 
            }
        });
    };
    $('#getUser').on('click',load_student);
	if ($('#select_studentid').val()){
		load_student(); //this IF loads student data when the studentid is passed in url
	}
});
</script>
</body>
</html>
