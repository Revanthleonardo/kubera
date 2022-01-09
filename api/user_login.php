<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$mobile_number = $data['mobile_number'];
$password = $data['password'];


//user_login
$user_login = $dbConn->query("SELECT
    user_id,
    name,
    mobile_number,
    password,
    email,
    registered_date
 FROM user
 WHERE mobile_number IN ('$mobile_number')
 AND password IN ('$password')
 ORDER BY DESC user_id
 LIMIT 1
    ");
while($row = $user_login->fetch(PDO::FETCH_ASSOC)) {
    $user_login_api = $row;
}

//payment_data
$payment_data = $dbConn->query("SELECT
    *
 FROM payment
 WHERE mobile_number IN ('$mobile_number')
 LIMIT 1
    ");
while($row = $payment_data->fetch(PDO::FETCH_ASSOC)) {
    $payment_id = $row['payment_id'];
}

//if payment made
if (isset($payment_id)) {
    //referral_number_data
$referral_number_data = $dbConn->query("SELECT
    referral_number
 FROM user
 WHERE mobile_number IN ('$mobile_number')
 LIMIT 1
    ");
while($row = $referral_number_data->fetch(PDO::FETCH_ASSOC)) {
    $referral_number = $row['referral_number'];
}
}
else{
    $referral_number = "-";
}

//if mobile_number and password match
if (isset($user_login_api)) {
    $returnArr = array("api"=>"user_login","result"=>"success","user_login_api"=>$user_login_api,"referral_number"=>$referral_number);
}
else{
    $returnArr = array("api"=>"user_login","result"=>"error");
}
  

echo json_encode($returnArr);

?> 