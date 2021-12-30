<?php 
require '../config.php';

$user_id = $_GET['user_id'];

//view_avg_count
$view_avg_count = $dbConn->query("SELECT
    avg_count
 FROM user
 WHERE user_id IN ('$user_id')
    ");

while($row = $view_avg_count->fetch(PDO::FETCH_ASSOC)) {
    $view_avg_count_api[] = $row;
}

if (isset($view_avg_count_api)) {
$returnArr = array("api"=>"view_avg_count","result"=>"success","view_avg_count_api"=>$view_avg_count_api);
}
else {
    $returnArr = array("api"=>"view_avg_count","result"=>"error");
}	

echo json_encode($returnArr);


?>