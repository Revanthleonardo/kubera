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


//error_message
if (isset($duplicate_data) || !isset($name) || !isset($mobile_number)
    || !isset($password) || !isset($email) || !isset($otp)) {
  $returnArr = array("api"=>"registration","result"=>"error");
}

//register_user
else{

//inserting_user
  $dbConn->query("INSERT INTO `user` (
    `name`,
    `mobile_number`,
    `email`,
    `password`
    ) 
    VALUES (
    '{$name}',
    '{$date}',
    '{$email}',
    '{$password}'
    )
    ;");


    $returnArr = array("api"=>"registration","result"=>"success");
}


echo json_encode($returnArr);

?> 