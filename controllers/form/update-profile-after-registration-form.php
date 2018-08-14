
<form action="components/update-profile-after-registration.php" method="post" enctype="multipart/form-data" id="UploadForm" autocomplete="off">
<?php

	require '_database/database.php'; 
	//$user_username = $_SESSION['user_username'];
    $user_username = mysqli_real_escape_string($database,$_REQUEST['user_username']);
    $sql = "SELECT * FROM user WHERE user_username='$user_username'";
    $result = mysqli_query($database,$sql);
    $rws = mysqli_fetch_array($result);
?>
    <div class="col-md-6">
        <div class="form-group float-label-control">
            <label for="">First Name</label>
            <input type="text" class="form-control" placeholder="<?php echo $rws['user_firstname'];?>" name="user_firstname" value="<?php echo $rws['user_firstname'];?>" required>
        </div>
        <div class="form-group float-label-control">
            <label for="">Last Name</label>
            <input type="text" class="form-control"  placeholder="<?php echo $rws['user_lastname'];?>" name="user_lastname" value="<?php echo $rws['user_lastname'];?>" required>
        </div>
		
		<div class="form-group float-label-control">
			<label for="">Profession</label>
			<div class="form-group float-label-control">
				<div class="input-group">
					<fieldset disabled> 
					<input type="text" class="form-control" placeholder="<?php echo $rws['user_profession'];?>" name="user_profession" value="<?php echo $rws['user_profession'];?>" id="disabledTextInput" autocomplete="off" required>
					</fieldset>
				</div>
			</div>
		</div>
		
        <div class="form-group float-label-control">
            <label for="">Avatar</label>
            <center><input name="ImageFile"  class="btn btn-primary ladda-button" data-style="zoom-in"  type="file"/></center>
        </div>           
    </div>    
    <div class="col-md-6">
        <label for="">Username</label>
        <div class="form-group float-label-control">
			<div class="input-group">
                <fieldset disabled> 
                    <input type="text" class="form-control" placeholder="<?php echo $rws['user_username'];?>" name="user_username" value="<?php echo $rws['user_username'];?>" id="disabledTextInput" autocomplete="off" required>
                </fieldset>
                </div>
        </div>
        <div class="form-group float-label-control">
            <label for="">Password</label>
            <input type="password" class="form-control" placeholder="<?php echo $rws['user_password'];?>" name="user_password" value="<?php echo $rws['user_password'];?>" required>
        </div>
        <div class="form-group float-label-control">
            <label for="">Email</label>
            <input type="text" class="form-control" placeholder="<?php echo $rws['user_email'];?>" name="user_email" value="<?php echo $rws['user_email'];?>" required>
        </div>
    </div>          
     
    <hr>                 
    <div class="submit">           
        <center>
            <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  id="SubmitButton" value="Upload" />Save Your Profile</button>
        </center>
    </div>
</form>