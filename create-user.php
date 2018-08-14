<?php include 'components/authentication.php' ?>
<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>          
    <div class="container">
	   <div class="no-gutter row"> 
           <div class="col-md-12">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body">                
					
					<h2 align="center">CREATE NEW USER</h2>
					<h4 align="center">Enter User Details Below</h4> 
                    <form class="form col-md-12 center-block" action="components/registration.php" method="post" autocomplete="off">
                        <div class="row">     
                            <div class="col-lg-6" style="z-index: 9;">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" placeholder="First Name" name="user_firstname" required>
                                </div>
                            </div>
						 
							<div class="col-lg-6" style="z-index: 9;">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" placeholder="Last Name" name="user_lastname" required>
                                </div>
                            </div>
                        </div>
                     <div class="row">     
                         <div class="col-lg-12">
                            <div class="form-group">
                                <input type="email" class="form-control input-lg" placeholder="Email Address" name="user_email" required>
                            </div>
                         </div>
                     </div>
					 <div class="row">     
                         <div class="col-lg-12">
                            <div class="form-group">
                                <input type="username" class="form-control input-lg" placeholder="Username" name="user_username" id="user_username" required>
                            </div>
                         </div>
                     </div>
                     <div class="row">     
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="form-control input-lg" placeholder="Password" name="user_password" required>
                                </div>
                            </div>
                        </div>
						<div class="row">     
                            <div class="col-lg-12">
                                <div class="form-group">
								  <select option="profession" class="form-control input-lg" name="user_profession">
									<option value="Job Title">Select Job Title</option>
									<option value="Administrator">Administrator</option>
									<option value="Teacher">Teacher</option>
									<option value="Block Supervisor">Coordinaton</option>
									<option value="Dean of Discipline">Dean</option>
									<option value="Principal">Principal</option>
								  </select>
							
                                </div>
                            </div>
                        </div>
						<div class="row">     
                            <div class="col-lg-12">
                                <div class="form-group">
								  <select option="gender" class="form-control input-lg" name="user_gender">
									<option value="Gender">Select Gender </option>
									<option value="Male"> Male</option>
									<option value="Female">Female</option>
								</select>
							
                                </div>
                            </div>
                        </div>
						<div class="row">     
                            <div class="col-lg-12">
                                <div class="form-group">
									<select option="class" class="form-control input-lg" name="class">
										<option value="Class">Select Class</option>
										<option value="7D">7D</option>
										<option value="7E">7E</option>
										<option value="7M">7M</option>
									</select>
							    </div>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  id="SubmitButton" value="Upload" style="float:left;" name="signup_button"/>REGISTER USER</button>
                                </div>
								
                            </div>
                        </div>
                    </form>
                   </div>
               </div>
           </div>
        </div>
    </div>