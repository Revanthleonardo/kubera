<?php 
 
require '../config.php';

date_default_timezone_set("Asia/Kolkata");
$time = date("hi");

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$mobile_number = $data['mobile_number'];
$password = $data['password'];
$email = $data['email'];
$otp = $data['otp'];

$mobile_number_sub = substr($mobile_number, 7, 9); //last 3 digit
$otp_decode = abs($mobile_number_sub - $otp) ; //otp_decode
$otp_check = abs($otp_decode - $time);


//duplicate_mobile_number
$duplicate_mobile_number = $dbConn->query("SELECT
    *
 FROM user
 WHERE mobile_number IN ('$mobile_number')
    ");
while($row = $duplicate_mobile_number->fetch(PDO::FETCH_ASSOC)) {
    $duplicate_data = "1";
}

//user_id_count
$user_id_count = $dbConn->query("SELECT
    max(user_id) as max_user_id
 FROM user
    ");
while($row = $user_id_count->fetch(PDO::FETCH_ASSOC)) {
    $max_user_id = $row['max_user_id'];
}

$user_id = $max_user_id + 1;
$referral_number = "AAA".str_pad($user_id, 4, '0', STR_PAD_LEFT);


//error_message
if (isset($duplicate_data) || !isset($name) || !isset($mobile_number)
    || !isset($password) || !isset($email) || !isset($otp)) {
  $returnArr = array("api"=>"registration","result"=>"error");
}

//for 3 min
//valid
if ($otp_check < 4){

//inserting_user
  $dbConn->query("INSERT INTO `user` (
    `user_id`,
    `name`,
    `mobile_number`,
    `email`,
    `password`,
    `referral_number`
    ) 
    VALUES (
    '{$user_id}',
    '{$name}',
    '{$mobile_number}',
    '{$email}',
    '{$password}',
    '{$referral_number}'
    )
    ;");


    $returnArr = array("api"=>"registration","result"=>"success");
}


echo json_encode($returnArr);

?> 