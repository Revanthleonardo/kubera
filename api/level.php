<?php
include '../config.php';

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



echo "user_id  - ".$user_id_input;
echo "_______________";
echo "referral count  - ".$total_count;


//update data
/*
      //update stage
      //stage_1
      if ($actual_level_referral_count == 4) {
        $dbConn->query("UPDATE `user` SET `stage` = '1' WHERE referral_number IN ('$level_referral_number') AND level IN ('$level')");
      }
      //stage_2
      if ($actual_level_referral_count == 20) {
        $dbConn->query("UPDATE `user` SET `stage` = '2' WHERE referral_number IN ('$level_referral_number') AND level IN ('$level')");
      }
      //stage_2
      if ($actual_level_referral_count == 84) {
        $dbConn->query("UPDATE `user` SET `stage` = '3' WHERE referral_number IN ('$level_referral_number') AND level IN ('$level')");
      }
      */
}



$user_level_check = $dbConn->query("SELECT
    *
 FROM user
 WHERE status IN ('$inactive')
    ");

while($row = $user_level_check->fetch(PDO::FETCH_ASSOC)) {
    $user_id = $row['user_id'];
    $level = $row['level'];
    referralCount($user_id,$level);
    echo "<br>";    
}











?>