<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$mobile_number = $data['mobile_number'];
$password = $data['password'];
$email = $data['email'];
$otp = $data['otp'];



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
$random_number = rand(0,99999999);
$referral_number = str_pad($user_id, 8, '0', STR_PAD_LEFT)."".str_pad($random_number, 8, '0', STR_PAD_LEFT);

//error_message
if (isset($duplicate_data) || !isset($name) || !isset($mobile_number)
    || !isset($password) || !isset($email) || !isset($otp)) {
  $returnArr = array("api"=>"registration","result"=>"error");
}

//register_user
else{

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
    '{$date}',
    '{$email}',
    '{$password}',
    '{$referral_number}'
    )
    ;");


    $returnArr = array("api"=>"registration","result"=>"success");
}


echo json_encode($returnArr);

?> 