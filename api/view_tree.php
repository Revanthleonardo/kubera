<?php

include '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $_data['user_id'];
$level = $_data['level'];


//view_tree_user_data
//and status whether referral_number updated
$view_tree_user_data = $dbConn->query("SELECT
    name,
    mobile_number,
    email,
    registered_date,
    referral_number,
    payment_status,
    referral_count,
    stage,
    level
 FROM user
 WHERE referral_id IN ('$user_id')
 AND level IN ('$level')
    ");

while($row = $view_tree_user_data->fetch(PDO::FETCH_ASSOC)) {
    $view_tree_api[] = $row;
}

if (isset($view_tree_api)) {
$returnArr = array("api"=>"view_tree","result"=>"success","view_tree_api"=>$view_tree_api);
}
else {
    $returnArr = array("api"=>"view_tree","result"=>"error");
}	

echo json_encode($returnArr);




?>
