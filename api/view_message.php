<?php 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

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

//view_message
$view_message = $dbConn->query("SELECT
    *
 FROM message
 WHERE mobile_number IN ('$mobile_number')
    ");

while($row = $view_message->fetch(PDO::FETCH_ASSOC)) {
    $view_message_api[] = $row;
}

if (isset($view_message_api)) {
$returnArr = array("api"=>"view_message","result"=>"success","view_message_api"=>$view_message_api);
}
else {
    $returnArr = array("api"=>"view_message","result"=>"error");
}	

echo json_encode($returnArr);


?>