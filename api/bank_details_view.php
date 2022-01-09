<?php 
require '../config.php';


//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];

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

//bank_details_data
$bank_details_data = $dbConn->query("SELECT
    *
 FROM bank_details
 WHERE status IN ('$active') 
 AND mobile_number IN ('$mobile_number')
    ");

while($row = $bank_details_data->fetch(PDO::FETCH_ASSOC)) {
    $bank_details_data_api[] = $row;
}

if (isset($bank_details_data_api)) {
$returnArr = array("api"=>"bank_details_data","result"=>"success","bank_details_data_api"=>$bank_details_data_api);
}
else {
    $returnArr = array("api"=>"bank_details_data","result"=>"error");
}	

echo json_encode($returnArr);


?>