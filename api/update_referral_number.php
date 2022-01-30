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


function referralCount( $user_id_input , $level_input  ) {
include '../config.php';
//stage_1
$stage_1_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE referral_id IN ('$user_id_input')
  AND level IN ('$level_input')
");
while($row = $stage_1_data->fetch(PDO::FETCH_ASSOC)) {

$stage_1_user_id[] = $row['user_id'];
}
//stage_1

//stage_2
foreach ($stage_1_user_id as $key => $stage_1_user_id_value) {
$stage_2_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE referral_id IN ('$stage_1_user_id_value')
  AND level IN ('$level_input')
  
");
while($row = $stage_2_data->fetch(PDO::FETCH_ASSOC)) {

$stage_2_user_id[] = $row['user_id'];
}
}
//stage_2

//stage_3
foreach ($stage_2_user_id as $key => $stage_2_user_id_value) {
$stage_3_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE referral_id IN ('$stage_2_user_id_value')
  AND level IN ('$level_input')
");
while($row = $stage_3_data->fetch(PDO::FETCH_ASSOC)) {

$stage_3_user_id[] = $row['user_id'];
}
}
//stage_3


// 1_stages
if (isset($stage_1_user_id) && !isset($stage_2_user_id) && !isset($stage_3_user_id)) {
  $total_count =  count($stage_1_user_id);

}

// 2_stages
if (isset($stage_1_user_id) && isset($stage_2_user_id) && !isset($stage_3_user_id)) {
  $total_count =  count($stage_1_user_id) + count($stage_2_user_id);

}

// 3_stages
if (isset($stage_1_user_id) && isset($stage_2_user_id) && isset($stage_3_user_id)) {
  $total_count =  count($stage_1_user_id) + count($stage_2_user_id) + count($stage_3_user_id);

}


$dbConn->query("UPDATE `user` 
       SET 
       `avg_count` = '$total_count' WHERE user_id IN ('$user_id_input') AND level_update_count_status IN ('$active')");

if ($total_count == 84 && $level < 4) {
       
       $dbConn->query("UPDATE `user` 
       SET 
       `level_update_count` = '$total_count' WHERE user_id IN ('$user_id_input') AND level_update_count_status IN ('$active')");

     }

}



$user_level_check = $dbConn->query("SELECT
    *
 FROM user
 WHERE referral_count NOT IN ('$active')
 AND status IN ('$inactive')
    ");

while($row = $user_level_check->fetch(PDO::FETCH_ASSOC)) {
    $user_id = $row['user_id'];
    $level = $row['level'];
    referralCount($user_id,$level); 
}

echo json_encode($returnArr);



?>
