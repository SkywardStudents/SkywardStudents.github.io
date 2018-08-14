                    <form class="form col-md-12 center-block" action="components/record-intervention.php" method="post" autocomplete="off">
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
								  <select option="profession" class="form-control input-lg">
									<option value="SELECT">	User Type</option>
									<option value="ADMIN">Administrator</option>
									<option value="TEACHER">Teacher</option>
									<option value="BLOCK SUPERVISOR">Block Supervisor</option>
									<option value="DEAN">Dean</option>
									<option value="PRINCIPAL">Principal</option>
								  </select>
							 </div>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  id="SubmitButton" value="Upload" style="float:left;" name="signup_button"/>Register</button>
                                </div>
						
                            </div>
                        </div>
                    </form>