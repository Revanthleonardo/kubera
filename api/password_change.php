<?php 
 
require '../config.php';


$password = addslashes($_GET['password']);
$mobile_number = $_GET['mobile_number'];
$otp = $_GET['otp'];

//error_message
if (!isset($mobile_number) || !isset($password) || !isset($otp)) {
  $returnArr = array("api"=>"password_change","result"=>"error");
}

else{

//update referral count for referrer
        $dbConn->query("UPDATE `user` SET `password` = '$password' WHERE mobile_number IN ('$mobile_number')");

    $returnArr = array("api"=>"password_change","result"=>"success");
}


echo json_encode($returnArr);

?> 