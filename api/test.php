<?php

include '../config.php';


$user_id = $_GET['user_id'];
$level = $_GET['level'];
$referral_number = $_GET['referral_number'];

echo "user_id = ".$user_id;
echo "<br>";
echo "referral_number = ".$referral_number;
echo "<br>";
echo "<br>";

//user_payment_check
//and status whether referral_number updated
$user_payment_check = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
 AND payment_status IN ('$inactive')
 AND level IN ('$level')
 AND status IN ('$active')
    ");

while($row = $user_payment_check->fetch(PDO::FETCH_ASSOC)) {
    $payment_status = $row['payment_status'];
}

//if paid
if (isset($payment_status)) {


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
    	//
    	echo "less than 4 insert and update count";

    	//update status for user
    	$dbConn->query("UPDATE `user` SET `status` = '$inactive',
    	`referral_id` = '$referral_number_user_data_user_id' WHERE user_id IN ('$user_id')");

    	//update referral count for the tree
    	$update_data = 1;

    }
    else{
    	echo "positions filled";
    }


}//query

		if (isset($update_data)) {
		//update referral count for the tree
    	//level_data updating for referral_number_user_id
		$level_user_id_input = $referral_number_user_data_user_id;

		while ($level_user_id_input > 0) {

		$level_get_level_data = $dbConn->query("SELECT 
		*
		  FROM user   
		  WHERE user_id IN ('$level_user_id_input')
		  LIMIT 1
		");
		if($row = $level_get_level_data->fetch(PDO::FETCH_ASSOC)) {

		$level_user_id = $row['user_id'];
		$level_referral_id = $row['referral_id'];
		$level_referral_count = $row['referral_count'];
		$level_referral_number = $row['referral_number'];

		//add 1 to referral count to user
    	$actual_level_referral_count = $level_referral_count + 1;

    	//update stage
    	//stage_1
    	if ($actual_level_referral_count == 4) {
    		$dbConn->query("UPDATE `user` SET `stage` = '1' WHERE referral_number IN ('$level_referral_number')");
    	}
    	//stage_2
    	if ($actual_level_referral_count == 20) {
    		$dbConn->query("UPDATE `user` SET `stage` = '2' WHERE referral_number IN ('$level_referral_number')");
    	}
    	//stage_2
    	if ($actual_level_referral_count == 84) {
    		$dbConn->query("UPDATE `user` SET `stage` = '3' WHERE referral_number IN ('$level_referral_number')");
    	}

    	//update referral count for referrer
    	$dbConn->query("UPDATE `user` SET `referral_count` = '$actual_level_referral_count' WHERE referral_number IN ('$level_referral_number')");

		$level_user_id_input = $level_referral_id;

		echo $level_user_id;
		echo "<br>";
		}
		}
		}//update_data


}//payment_status
else{
    	echo "already updated";
}





?>
