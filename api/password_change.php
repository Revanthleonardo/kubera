<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$password = addslashes($data['password']);
$user_id = $data['user_id'];

//error_message
if (!isset($user_id) || !isset($password)) {
  $returnArr = array("api"=>"password_change","result"=>"error");
}

else{

//update referral count for referrer
        $dbConn->query("UPDATE `user` SET `password` = '$password' WHERE user_id IN ('$user_id')");

    $returnArr = array("api"=>"password_change","result"=>"success");
}


echo json_encode($returnArr);

?> 