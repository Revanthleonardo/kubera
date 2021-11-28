<?php

require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = "1";
$book_id = "1";

//user_data
$user_data = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
    ");

while($row = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $mobile_number = $row['mobile_number'];
    $email = $row['email'];
}


//book_data
$book_data = $dbConn->query("SELECT
    *
 FROM book
 WHERE book_id IN ('$book_id')
    ");

while($row = $book_data->fetch(PDO::FETCH_ASSOC)) {
    $book_name = $row['book_name'];
    $amount = $row['amount'];
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:f8976716a8a4c0b382047a7834faf49d",
                  "X-Auth-Token:c272b9b3e08ee23b1623ae254f91c0e1"));
$payload = Array(
    'purpose' => $book_name."-".$user_id."-".$book_id,
    'amount' => $amount,
    'phone' => $mobile_number,
    'buyer_name' => $name,
    'redirect_url' => 'http://gymtech.besttech.in/kubera/api/payment_status.php',
    'send_email' => false,
    'webhook' => 'http://gymtech.besttech.in/kubera/api/payment_status.php',
    'send_sms' => false,
    'email' => $email,
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