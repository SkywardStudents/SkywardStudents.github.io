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
    include '_database/database.php';
    @session_start();
    $current_user = $_SESSION['user_username'];
    
	
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
            <h1 class="text-center">Principal's Dashboard</h1>
        </div>
		
			
<div class="container">
	<div class="row clearfix">
		<div class="col-md-7 column">
			<div class='panel panel-default'>
				<div class='panel-body'>
				<div id='chart-2'></div>
				</div>
			</div>
		</div>

		<div class="col-md-5 column">
			<div class='panel panel-default'>
				<div class='panel-body'>
				<div id='chart-3'></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
		  <div class="row clearfix">
			<div class='panel panel-default'>
				<div class='panel-body'>
				<div id='chart-1'></div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
	
<?php
$columns =array();
$rows =array();
$date_keys = array();
$records= array();
$result = mysqli_query($database,"SELECT * FROM `conduct`") or die(mysqli_error($database));
	
    while($rws = mysqli_fetch_array($result)){
		$columns[] = $rws;
	}
$sql = "SELECT count(*) as num_beh, group_id,year(reg_date) as yr, month(reg_date) as mon 
FROM `student_behaviour` group by group_id, year(reg_date), month(reg_date) ORDER BY reg_date";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));
    while($rws = mysqli_fetch_array($result)){
		$records[] = $rws;
		$date_keys[] = "{$rws['yr']}-{$rws['mon']}";
	}
	$date_keys = array_unique($date_keys);
	
	foreach($date_keys as $dk){
		$row =array($dk);
		$i = 0;
		foreach($columns as $group){
			$i++;
			foreach($records as $rws){
				if (("{$rws['yr']}-{$rws['mon']}" == $dk) && ($rws['group_id'] == $group['group_id'])){
					$row[$i] = (int)$rws['num_beh'];
				}
			}
			if (!isset($row[$i])){
				$row[$i] = 0;
			}
		}
		$rows[] = $row;
	}
	
	
	
	
	$behaviour_count= array();
$sql = "SELECT group_id, count(distinct studentid) as count_beh FROM `student_behaviour` group by group_id";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));
    while($rws = mysqli_fetch_array($result)){
		$behaviour_count[$rws['group_id']] = $rws['count_beh'];
	}
	$total_students = 1;
$sql = "SELECT count(*) as count_stu FROM `sky_student`";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));
    if($rws = mysqli_fetch_array($result)){
		$total_students = $rws['count_stu'];
	}	
	
	$bar_data = array();
	$bar_data[] = array('Group','Percentage');
	foreach($columns as $group){
		$row = array($group['group_name']);
		if (isset($behaviour_count[$group['group_id']])){
			$value = $behaviour_count[$group['group_id']];
			$row[] = round( $value / $total_students * 100,1);
		} else {
			$row[] = 0;
 		}
		$bar_data[] = $row;
	}
	
	
	$sql = "SELECT  count(distinct studentid) as count_beh FROM `student_behaviour`";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));
    if($rws = mysqli_fetch_array($result)){
		$count_beh = (int)$rws['count_beh'];
	} else {
		$count_beh = 0;
	}
	$pie_data = array();
	$pie_data[] = array('Behaviour Type','Number of students');
	$pie_data[] = array('Good behaviour',$total_students - $count_beh);
	$pie_data[] = array('Misbehaviour',$count_beh);
	
?>                     

		    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
		
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'month');
		<?php
			foreach($columns as $group){
				echo "data.addColumn('number', '{$group['group_name']}');";
			}
		?>
        data.addRows(
          <?php echo json_encode($rows); ?>
        );

        // Set chart options
        var options = {'title':'Trend in Misbehaviour',
          curveType: 'function',
		  chartArea: {width: '60%'},
          legend: { position: 'right' },
                       'width':900,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart-1'));
        chart.draw(data, options);
		
		
		
		
		//CHART 2 the bars
		     var data = google.visualization.arrayToDataTable(
			 <?php echo json_encode($bar_data); ?>
			 );

      var view = new google.visualization.DataView(data);
     

      var options = {
        title: "Percentage of Population with Misbehaviours",
        /* width: 600,
        height: 400, */
		  chartArea: {width: '90%'},
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart-2"));
      chart.draw(view, options);
	
	
	var data = google.visualization.arrayToDataTable(<?php echo json_encode($pie_data); ?>);

        var options = {
          title: 'Students with Misbehaviour'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart-3'));

        chart.draw(data, options);
		
		
      }
	  
	  
	  
	  
    </script>	
