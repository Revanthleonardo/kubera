<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$mobile_number = $data['mobile_number'];

$otp = "9876";

//if mobile_number and password match
if (isset($mobile_number)) {
    $returnArr = array("api"=>"get_otp","result"=>"success","otp"=>$otp);
}
else{
    $returnArr = array("api"=>"get_otp","result"=>"error");
}
  

echo json_encode($returnArr);

?> 