<?php include 'components/authentication.php' ?>     
<?php include 'components/session-check.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?> 

                                                    <div class="container">
                                                      <div class="row clearfix">
                                                          <div class="col-md-12 column">
                                                              <div class="row clearfix">
<?php
    include '_database/database.php';
    //session_start();
    $current_user = $_SESSION['user_username'];
											
    $sql = "SELECT * FROM sky_student order by studentid asc";
	
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));
    while($rws = mysqli_fetch_array($result)){ 
?>

                                                                  <div class="col-md-4 column">
                                                                    <div class="panel-group" id="panel-<?php echo $rws['studentid']; ?>">
                                                                        <div class="panel panel-default">
                                                                            <div id="panel-element-<?php echo $rws['partyname']; ?>" class="panel-collapse collapse in">
                                                                                <div class="panel-body">
                                                                                    <div class="col-md-6 column">
                                                                                        <img src="studentfiles/avatars/default.jpg" name="aboutme" class="img-responsive" width = "80px" height = "80px">                                  
                                                                                    </div>
                                                                                    <div class="col-md-6 column">
                                                                                        <h2><span><a href="get-Student-360-Profile.php?partyname=<?php echo $rws['partyname'];?>"><?php echo $rws['partyname'];?></span></h2>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                  </div>
 <?php } ?>                                                         
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>