<?php include 'components/authentication.php' ?>     
<?php include 'components/session-check.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>    
 
<?php 


    if(isset($_GET["request"])=="profile-update" && $_GET["status"]=="success"){
        $dialogue="Your profile update was successful! ";
    }
    else if(isset($_GET["request"])=="profile-update" && $_GET["status"]=="unsuccess"){
        $dialogue="Your profile update was not at all successful! ";
    }
    else if(isset($_GET["request"])=="login" && $_GET["status"]=="success"){
        $dialogue="Welcome back again! ";
    }
?>
    <script>
        $.growl("<?php echo $dialogue; ?> ", {
            animate: {
                enter: 'animated zoomInDown',
                exit: 'animated zoomOutUp'
            }								
        });
    </script>
<?php
    //include '_database/database.php';
    //session_start();
    //$current_user = $_SESSION['user_username'];
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));
    while($rws = mysqli_fetch_array($result)){ 
?>
<style>

.box{
    float:left;
    margin-right:30Px;
}
.clear{
    clear:both;
}
.student-element{
	height: 124px;
}
.student-element .label{
	
}
.student-element .name-container{
	max-height: -webkit-fill-available;
}
.student-element h2{
	max-height: -webkit-fill-available;
	font-size: 24px;
}


</style>
<div class="container">
    
        
		
		<div class="col-md-12" align = "center">
            <h1 class="text-center">Welcome <?php echo $rws['user_firstname']; ?>...</h1>
        </div>
		
			
<div class="container">
                                                      <div class="row clearfix">
                                                          <div class="col-md-12 column">
                                                              <div class="row clearfix">
<?php
    include '_database/database.php';
    //session_start();
    $current_user = $_SESSION['user_username'];
    $user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
	$result = mysqli_query($database,$sql) or die(mysqli_error($database));
    if($rws = mysqli_fetch_array($result)){ 
		$class = $rws['class'];
	} else {
		$class = '';
	}
    $sql = "SELECT s.*, bc.count_behaviour FROM sky_student s
	LEFT JOIN (SELECT studentid, count(*) count_behaviour FROM `student_behaviour` GROUP BY `studentid`) bc ON (bc.studentid = s.studentid)";
	if ($class){
		$sql .= " WHERE s.class = '$class'";
	}
	$sql .= " ORDER BY count_behaviour DESC, partyname";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));
	
	$records = array();
    while($rws = mysqli_fetch_array($result)){
		$records[] = $rws;
	} 
	
	foreach($records as $rws){
		if (!$rws['count_behaviour']){
			continue;
		}
		$css_class ="";
		if ($rws['count_behaviour'] >= 3){
			$css_class .= " label-danger";
		} else{
			$css_class .= " label-default";
		}
		echo "
		<a href='get-Student-360-Profile?studentid={$rws['studentid']}'>
		<div class='col-md-4'>
			<div class='panel panel-default student-element'>
			<div class='panel-body'>
			<div class='col-md-4 column'>
				<img src='studentfiles/avatars/default.jpg' class='img-responsive' width = '80px' height = '80px'>                                  
			</div>
			<div class='col-md-8 column name-container'>
				<span class='pull-right'>
					<span class='label $css_class'>{$rws['count_behaviour']}</span>
				</span>
				<h2>{$rws['partyname']}</h2>
			</div>
			</div>
			</div>
		</div>
		</a>
		";
	} 
	foreach($records as $rws){
		if ($rws['count_behaviour'] ){
			continue;
		}
		$css_class ="";
		if ($rws['count_behaviour'] >= 3){
			$css_class .= " label-danger";
		} else{
			$css_class .= " label-default";
		}
		echo "
		<a href='get-Student-360-Profile?studentid={$rws['studentid']}'>
		<div class='col-md-4'>
			<div class='panel panel-default student-element'>
			<div class='panel-body'>
			<div class='col-md-4 column'>
				<img src='studentfiles/avatars/default.jpg' class='img-responsive' width = '80px' height = '80px'>                                  
			</div>
			<div class='col-md-8 column name-container'>
				<span class='pull-right'>
					<span class='label $css_class'>{$rws['count_behaviour']}</span>
				</span>
				<h2>{$rws['partyname']}</h2>
			</div>
			</div>
			</div>
		</div>
		</a>
		";
	} 
	
	
	?>                                                         
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
	
                     
                    
                    
           
			 
    </div>

<?php
	}
?>
