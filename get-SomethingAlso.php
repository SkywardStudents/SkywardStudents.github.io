<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>  
<?php include 'controllers/navigation/admin-navigation.php' ?>  
<html>
<head>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#getUser').on('click',function()
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
    });
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
					$('#class').text(data.result.contactno);
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
});
</script>
<style>
 
  #report {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
   
    box-shadow: 10px 10px 5px skyblue;
    width: 70%;
}

#report  td, #customers th {
    border: 1px solid skyblue;
    padding: 8px;
    
}

#report  tr:nth-child(even)
{
	background-color: #f2f2f2;
	}

#report  tr:hover 
{
	color: BLUE;
	text-width:bold;
	}

#report  th {
    padding-top: 2px;
    padding-bottom: 12px;
    text-align: left;
    background-color: SKYBLUE;
    color: BLACK;
	

}
</style>
</head>

<body >
<p align = "center">
<br><br>
<!--<input type="text" id="studentid" /> -->
<?php
				//Include the database configuration file
				include 'db.php';

				//Fetch all the country data
				$query = $db->query("SELECT studentid, partyname FROM sky_student
				WHERE studentid IN (SELECT studentid FROM student_behaviour)
				ORDER BY partyname");
																
				//Count total number of rows
				$rowCount = $query->num_rows;
				
									
				?>
				
					<div class="row">     
                         <div class="col-lg-6" >
                            <div  class="form-group" > 
                              <label align = "center">SELECT STUDENT NAME:</label><br>
									<select class="form-control input-lg" id="select_studentid" name = "studentid">
										<option value="">Select Student</option>
										<?php
										if($rowCount > 0)
										{
											while($row = $query->fetch_assoc())
											{ 
												echo '<option value="'.$row['studentid'].'">'.$row['partyname'].'</option>';
												
											}
																					
										}
										?>

									</select>
							</div>
							<input type="button" id="getUser" value="Run 360 Profile "/>
                         </div>
						 
                     </div>
<div class="row">
<?php
							echo '<div class="user-content" style="display: none;">';
												
												echo'
												<h2>
												<small style="text-muted">Full Name: </small><span id="partyname"> </span>
												</h2>
												<br>
												<table width = "50%" align = "center" border = "5">
												<tr><th>ID : </th><td><span id="studentid"></span></td></tr>
												<tr><th>Middlename : </th><td><span id="middlename"></span></td></tr>
												<tr><th>Address: </th><td><span id="address"></span></td></tr>
												<tr><th>Sex : </th><td><span id="sex"></span></td></tr>
												<tr><th>DOB: </th><td><span id="dob"></span></td></tr>
												<tr><th>Grade : </th><td><span id="grade"></span></td></tr>
												<tr><th>From : </th><td><span id="form"></span></td></tr>
												<tr><th>Class : </th><td><span id="class"></span></td></tr>
												<tr><th>Parent : </th><td><span id="parent"></span></td></tr>
												
												</table>
												<br>';
										echo '
												
												
												
												
												<h4> Student Behaviour Details</h4>	
												<br>
												<table width = "50%" id="behaviour_table" align = "center" border = "5">
												<thead>
												<tr><th>Group </th> <th>Behaviour </th>  <th>Date  </th><th>Recorded by  </th> </tr>
												</thead>
												<tbody></tbody>
												</table>
												<br>
												
												<div id="strategy_section">
													<h4> Suggested Strategies</h4>	
													<br>
													<table width = "50%"  id="strategy_table" border = "5">
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
													<div class="form-group">
														<button class="btn btn-primary ladda-button" onclick="assign-intervention.html"   style="float:left;" name="record"/>FIND & ASSIGN</button>
													</div>
												</div>	
												</div>
												
												
												';
												
												
												echo'
												<br><h4>Student Academic Details</h4>	
												<br>
												<h4><small>Final average</small> <span id="final_average"> </span></h4>	
												<br>
												<table width = "50%" id="grade_table" align = "center" border = "5">
												<thead>
												<tr><th>Subject </th> <th>Average </th></tr>
												</thead>
												<tbody></tbody>
												</table>
												<br>';															
												
										
										echo '	</div>';
										
										?>
</div>

</html>
