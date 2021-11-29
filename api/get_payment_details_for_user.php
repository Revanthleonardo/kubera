<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];

//get_payment_details_for_user
$get_payment_details_for_user = $dbConn->query("SELECT
    *
 FROM payment
 WHERE user_id IN ('$user_id')
    ");

while($row = $get_payment_details_for_user->fetch(PDO::FETCH_ASSOC)) {
    $get_payment_details_for_user_api[] = $row;
}

if (isset($get_payment_details_for_user_api)) {
$returnArr = array("api"=>"get_payment_details_for_user","result"=>"success","get_payment_details_for_user_api"=>$get_payment_details_for_user_api);
}
else {
    $returnArr = array("api"=>"get_payment_details_for_user","result"=>"error");
}	

echo json_encode($returnArr);


?>