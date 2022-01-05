<?php 
 
require '../config.php';

$user_id = $_GET['user_id'];
$book_id = $_GET['book_id'];
$payment_id_razorpay = $_GET['payment_id_razorpay'];



//insert
if (isset($user_id) && isset($book_id)
    && isset($payment_id_razorpay) ) {

$dbConn->query("INSERT INTO `payment` (
    `user_id`,
    `book_id`,
    `payment_id_razorpay`
    ) 
    VALUES (
    '{$user_id}',
    '{$book_id}',
    '{$payment_id_razorpay}'
    )
    ;");

//update payment status
$dbConn->query("UPDATE `user` SET `payment_status` = '$inactive' WHERE user_id IN ('$user_id')");

    $returnArr = array("api"=>"payment_status","result"=>"success");
}
else{

	$returnArr = array("api"=>"payment_status","result"=>"failed");

}


echo json_encode($returnArr);


?> 