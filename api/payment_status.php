<?php

require '../config.php';

$payment_id = $_GET['payment_id'];
$payment_status = $_GET['payment_status'];
$payment_request_id = $_GET['payment_request_id'];

$base_url = "https://www.instamojo.com/api/1.1/payment-requests/".$payment_request_id;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $base_url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:f8976716a8a4c0b382047a7834faf49d",
                  "X-Auth-Token:c272b9b3e08ee23b1623ae254f91c0e1"));
$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response, true);

if ($payment_status == "Credit") {
$purpose = $response['payment_request']['purpose'];
$purpose_array = explode("-",$purpose);
$book_id = $purpose_array[1];
$user_id = $purpose_array[2];

$dbConn->query("INSERT INTO `payment` (
    `user_id`,
    `book_id`,
    `payment_id_instamojo`,
    `payment_request_id_instamojo`
    ) 
    VALUES (
    '{$user_id}',
    '{$book_id}',
    '{$payment_id}',
    '{$payment_request_id}'
    )
    ;");

	$returnArr = array("api"=>"payment_status","result"=>"payment success");

}
else{

	$returnArr = array("api"=>"payment_status","result"=>"payment failed");

}

echo json_encode($returnArr);

?>