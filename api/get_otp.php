<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$mobile_number = $data['mobile_number'];


date_default_timezone_set("Asia/Kolkata");
$time = date("hi");
$mobile_number_sub = substr($mobile_number, 7, 9); //last 3 digit
$actual = $mobile_number_sub + $time; //adding time


	// Authorisation details.
	$username = "kuberaatechnologies@gmail.com";
	$hash = "952d864be5d8d4bbb35f695b9b2978e7356c854271e7b4834afdfe76a5db0651";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";
	$otp = "12345";

	// Data for text message. This is the text message data.
	$sender = "KUBSOF"; // This is who the message appears to be from.
	$numbers = $mobile_number; // A single number or a comma-seperated list of numbers
	
	$message = rawurlencode('Your OTP is '.$actual.' valid for 3 min - KUBERA');
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);

//if mobile_number and password match
if (isset($mobile_number)) {
    $returnArr = array("api"=>"get_otp","result"=>"success","otp"=>$actual,"text_local"=>$result);
}
else{
    $returnArr = array("api"=>"get_otp","result"=>"error","text_local"=>$result);
}
  

echo json_encode($returnArr);


?> 