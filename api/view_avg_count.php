<?php 
require '../config.php';

$user_id = $_GET['user_id'];

//user_id_input
//mobile_number_data
$mobile_number_data = $dbConn->query("SELECT
    mobile_number
 FROM user
 WHERE user_id IN ('$user_id')
 LIMIT 1
    ");
while($row = $mobile_number_data->fetch(PDO::FETCH_ASSOC)) {
    $mobile_number = $row['mobile_number'];
}

//view_avg_count
$view_avg_count = $dbConn->query("SELECT
    avg_count
 FROM user
 WHERE mobile_number IN ('$mobile_number')
 ORDER BY user_id DESC
 LIMIT 1
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