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
    'purpose' => 'Book',
    'amount' => '10',
    'phone' => '8883388393',
    'buyer_name' => 'Test',
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


$response = json_decode($response, true);
$longurl = $response['payment_request']['longurl'];

header("Location: $longurl");

?>