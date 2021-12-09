<?php 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];

//bank_details_data
$bank_details_data = $dbConn->query("SELECT
    *
 FROM bank_details
 WHERE status IN ('$active') 
 AND user_id IN ('$user_id')
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