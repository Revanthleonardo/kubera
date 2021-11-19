<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:f8976716a8a4c0b382047a7834faf49d",
                  "X-Auth-Token:c272b9b3e08ee23b1623ae254f91c0e1"));
$payload = Array(
    'purpose' => 'FIFA 16',
    'amount' => '2500',
    'phone' => '8883388393',
    'buyer_name' => 'John Doe',
    'redirect_url' => 'http://www.google.com/',
    'send_email' => false,
    'webhook' => 'http://www.google.com/',
    'send_sms' => false,
    'email' => 'revanthapollo@gmail.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

$response_array = explode(",",$response);
/*
$long_url_with_double_quote = str_replace('"longurl":',"",$response_array[14]);
$long_url_with_space = str_replace('"',"",$long_url_with_double_quote);
$long_url = str_replace(" ","",$long_url_with_double_quote);


    header("Location: $long_url");
    exit();
*/

$response_url = $response_array[14];

$long_url_with_double_quote = str_replace('"longurl":',"",$response_url);
$long_url = str_replace('"',"",$long_url_with_double_quote);
$trim =  trim($long_url,"\n");


header("Location: $trim");
?>