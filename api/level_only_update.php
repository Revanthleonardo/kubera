<?php

include '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $_data['user_id'];

//level_only_update
$level_only_update = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
 AND payment_status IN ('$inactive')
 AND status IN ('$inactive')
    ");

while($row = $level_only_update->fetch(PDO::FETCH_ASSOC)) {
    $stage = $row['stage'];
    $referral_count = $row['referral_count'];
    $level = $row['level'];

    //reset stage and referral_count and add level
    if ($stage == 3 && $referral_count >= 84 && $level < 4) {

    	$actual_level = $level + 1;

    	$dbConn->query("UPDATE `user` SET `stage` = '$active',`referral_count` = '$active',
    	`level` = '$actual_level' WHERE user_id IN ('$user_id')");

    	$returnArr = array("api"=>"level_only_update","result"=>"success");
    }
    else{
    	$returnArr = array("api"=>"level_only_update","result"=>"error");
    }
}

echo json_encode($returnArr);

?>
