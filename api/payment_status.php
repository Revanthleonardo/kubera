<?php

require '../config.php';

$payment_id = $_GET['payment_id'];
$payment_status = $_GET['payment_status'];

$base_url = "https://www.instamojo.com/api/1.1/payments/".$payment_id;

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
$longurl = $response['payment_request']['longurl'];
}

?>