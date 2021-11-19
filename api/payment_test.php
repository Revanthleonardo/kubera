<?php 
$purpose = "Payment";
$amount = "10";
$name = "rev";
$phone = "8883388393";
$email = "revanthapollo@gmail.com";
include 'instamojo.php';
$api = new Instamojo\Instamojo('f8976716a8a4c0b382047a7834faf49d', 'c272b9b3e08ee23b1623ae254f91c0e1','https://www.instamojo.com/api/1.1/');
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $purpose,
        "amount" => $amount,
        "buyer_name" => $name,
        "phone" => $phone,
        "email" => $email,
        "send_email" => true,
        "send_sms" => true,
        'allow_repeated_payments' => false,
        "redirect_url" => "https://google.com",
        "webhook" => "https://google.com"
        ));
   $pay_ulr = $response['longurl'];
    header("Location: $pay_ulr");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
 ?>