<?php

include '../config.php';

$user_id = $_GET['user_id'];
$referral_number = $_GET['referral_number'];


//user_payment_check
//and status whether referral_number updated
$user_payment_check = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
 AND payment_status IN ('$inactive')
 AND status IN ('$active')
    ");

while($row = $user_payment_check->fetch(PDO::FETCH_ASSOC)) {
    $referral_number_user = $row['referral_number'];
    $payment_status = $row['payment_status'];
    $level = $row['level'];
}

//if paid
if (isset($payment_status) && $referral_number != $referral_number_user) {


	//referral_number_user_data
$referral_number_user_data = $dbConn->query("SELECT
    *
 FROM user
 WHERE referral_number IN ('$referral_number')
 AND payment_status IN ('$inactive')
 AND level IN ('$level')
    ");

while($row = $referral_number_user_data->fetch(PDO::FETCH_ASSOC)) {
    $referral_number_user_data_referral_count = $row['referral_count'];
    $referral_number_user_data_user_id = $row['user_id'];

    //if less than 4 insert and update count
    if ($referral_number_user_data_referral_count < 4) {
    	
    	//echo "less than 4 insert and update count";

    	//update status for user
    	$dbConn->query("UPDATE `user` SET `status` = '$inactive',
    	`referral_id` = '$referral_number_user_data_user_id' WHERE user_id IN ('$user_id')");


    	//data update
    	$actual_level_referral_count = $referral_number_user_data_referral_count + 1;

    	//update referral count for referrer
    	$dbConn->query("UPDATE `user` SET `referral_count` = '$actual_level_referral_count' WHERE referral_number IN ('$referral_number') AND level IN ('$level')");

    	//update referral count for the tree
    	$update_data = 1;

    	$returnArr = array("api"=>"update_referral_number","result"=>"success");

    }
    else{
    	//echo "positions filled";
    	$returnArr = array("api"=>"update_referral_number","result"=>"positions filled already try another referral_number");
    }


}//query

		


}//payment_status
else{
    	//echo "already updated";
    	$returnArr = array("api"=>"update_referral_number","result"=>"error or already filled");
}


echo json_encode($returnArr);



?>
