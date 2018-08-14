<?php
//_fetch.php
$connect = mysqli_connect("localhost", "root", "", "userprofile");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "
 SELECT * FROM conduct_breakdown WHERE conduct_name LIKE '%".$request."%'
";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["conduct_name"];
 }
 echo json_encode($data);
}

?>