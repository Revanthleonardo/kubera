<?php 
 
require '../config.php';
date_default_timezone_set("Asia/Kolkata");
$time = date("hi");

$password = addslashes($_GET['password']);
$mobile_number = $_GET['mobile_number'];
$otp = $_GET['otp'];

$mobile_number_sub = substr($mobile_number, 7, 9); //last 3 digit
$otp_decode = abs($mobile_number_sub - $otp) ; //otp_decode
$otp_check = abs($otp_decode - $time);


//for 3 min
//valid
if ($otp_check < 4){
        //update referral count for referrer
        $dbConn->query("UPDATE `user` SET `password` = '$password' WHERE mobile_number IN ('$mobile_number')");

    $returnArr = array("api"=>"password_change","result"=>"success");
    
}
//not_valid
else{
    $returnArr = array("api"=>"password_change","result"=>"error");
}



echo json_encode($returnArr);

?> 