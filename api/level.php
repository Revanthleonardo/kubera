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
  echo json_encode($stage_1_user_id);
}

// 2_stages
if (isset($stage_1_user_id) && isset($stage_2_user_id) && !isset($stage_3_user_id)) {
  $total_count =  count($stage_1_user_id) + count($stage_2_user_id);
  echo json_encode($stage_1_user_id);
  echo "------------";
  echo json_encode($stage_2_user_id);
}

// 3_stages
if (isset($stage_1_user_id) && isset($stage_2_user_id) && isset($stage_3_user_id)) {
  $total_count =  count($stage_1_user_id) + count($stage_2_user_id) + count($stage_3_user_id);
  echo json_encode($stage_1_user_id);
  echo "------------";
  echo json_encode($stage_2_user_id);
  echo "------------";
  echo json_encode($stage_3_user_id);
}


echo "------------";
echo "user_id  - ".$user_id_input;
echo "------------";
echo "referral count  - ".$total_count;


if ($total_count == 84 && $level < 4) {

        $actual_level = $level_input + 1;

       
       $dbConn->query("UPDATE `user` 
       SET 
       `referral_count` = '$total_count' WHERE user_id IN ('$user_id_input')");

     }


}



$user_level_check = $dbConn->query("SELECT
    *
 FROM user
 WHERE referral_count NOT IN ('$active')
    ");

while($row = $user_level_check->fetch(PDO::FETCH_ASSOC)) {
    $user_id = $row['user_id'];
    $level = $row['level'];
    referralCount($user_id,$level);
    echo "<br>";  
}











?>