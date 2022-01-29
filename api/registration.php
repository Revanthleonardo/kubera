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
 LIMIT 1
    ");
while($row = $duplicate_mobile_number->fetch(PDO::FETCH_ASSOC)) {
    $duplicate_data = "1";
}

//user_id_count
$user_id_count = $dbConn->query("SELECT referral_number FROM user 
ORDER BY user_id DESC LIMIT 1
    ");
while($row = $user_id_count->fetch(PDO::FETCH_ASSOC)) {
    $existing_referral_number = $row['referral_number'];
}
/*

$alphabet = substr("AAA9907",0,3);
echo "<br>";
echo substr("AAA9907",3,4);
echo "<br>";
$increment  = ++$alphabet;
echo "$increment";

*/

$referral_number_prefix = substr($existing_referral_number,0,3);  
$referral_number_suffix = substr($existing_referral_number,3,4); 

//change both prefix and suffix
if ($referral_number_suffix == 9999) {
    $referral_number_prefix_increment  = ++$referral_number_prefix;
    $referral_number_suffix_increment  = $referral_number_suffix + 1;
    $referral_number = $referral_number_prefix_increment . str_pad($active, 4, '0', STR_PAD_LEFT);
}
else{
    $referral_number_suffix_increment  = $referral_number_suffix + 1;
    $referral_number = $referral_number_prefix . str_pad($referral_number_suffix_increment, 4, '0', STR_PAD_LEFT);
}



//error_message
if (isset($duplicate_data) || !isset($name) || !isset($mobile_number)
    || !isset($password) || !isset($otp)) {
  $returnArr = array("api"=>"registration","result"=>"error");
}
else{

//for 3 min
//valid
if ($otp_check < 4){

//inserting_user
  $dbConn->query("INSERT INTO `user` (
    `name`,
    `mobile_number`,
    `email`,
    `password`,
    `referral_number`
    ) 
    VALUES (
    '{$name}',
    '{$mobile_number}',
    '{$email}',
    '{$password}',
    '{$referral_number}'
    )
    ;");


    $returnArr = array("api"=>"registration","result"=>"success");
}
else{
    $returnArr = array("api"=>"registration","result"=>"error");
}

}


echo json_encode($returnArr);

?> 