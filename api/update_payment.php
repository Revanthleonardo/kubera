<?php 
 
require '../config.php';

$user_id = $_GET['user_id'];
$book_id = $_GET['book_id'];
$payment_id_razorpay = $_GET['payment_id_razorpay'];


//user_id_input
//mobile_number_data
$mobile_number_data = $dbConn->query("SELECT
    mobile_number
 FROM user
 WHERE user_id IN ('$user_id')
 LIMIT 1
    ");
while($row = $mobile_number_data->fetch(PDO::FETCH_ASSOC)) {
    $mobile_number = $row['mobile_number'];
}


//insert
if (isset($mobile_number) && isset($book_id)
    && isset($payment_id_razorpay) ) {

$dbConn->query("INSERT INTO `payment` (
    `mobile_number`,
    `book_id`,
    `payment_id_razorpay`
    ) 
    VALUES (
    '{$mobile_number}',
    '{$book_id}',
    '{$payment_id_razorpay}'
    )
    ;");

//update payment status
$dbConn->query("UPDATE `user` SET `payment_status` = '$inactive' WHERE mobile_number IN ('$mobile_number')");

    $returnArr = array("api"=>"payment_status","result"=>"success");
}
else{

	$returnArr = array("api"=>"payment_status","result"=>"failed");

}


echo json_encode($returnArr);


?> 