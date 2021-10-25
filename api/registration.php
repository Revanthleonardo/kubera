<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$mobile_number = $data['mobile_number'];
$password = $data['password'];
$referral_mobile_number = $data['referral_mobile_number'];
$book_id = $data['book_id'];
	

//referral_mobile_number_data
$referral_mobile_number_data = $dbConn->query("SELECT
    *
 FROM user
 WHERE mobile_number IN ('$referral_mobile_number')
    ");
while($row = $referral_mobile_number_data->fetch(PDO::FETCH_ASSOC)) {
    $referral_id = $row['user_id'];
}

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
if ($referral_id == "" || $duplicate_data == "1" || $book_id == "") {
  $returnArr = array("api"=>"registration","result"=>"error");
}

//register_user
else{

//inserting_user
  $dbConn->query("INSERT INTO `user` (
    `name`,
    `mobile_number`,
    `referral_id`,
    `password`
    ) 
    VALUES (
    '{$name}',
    '{$date}',
    '{$referral_id}',
    '{$password}'
    )
    ;");

  $user_id = $dbConn->lastInsertId();

//inserting_payment_data
  $dbConn->query("INSERT INTO `payment` (
    `user_id`,
    `book_id`
    ) 
    VALUES (
    '{$user_id}',
    '{$book_id}'
    )
    ;");


	$returnArr = array("api"=>"registration","result"=>"success");
}


echo json_encode($returnArr);

?> 