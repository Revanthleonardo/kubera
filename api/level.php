<?php

include '../config.php';


//user_list
$user_list = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('6')

    ");
while($row = $user_list->fetch(PDO::FETCH_ASSOC)) {
    $level_user_id_input = $row['user_id'];

//stage_1
$stage_1_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE referral_id IN ('$level_user_id_input')
  
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
  
");
while($row = $stage_3_data->fetch(PDO::FETCH_ASSOC)) {

$stage_3_user_id[] = $row['user_id'];
}
}

//stage_3
echo json_encode($stage_1_user_id);
echo json_encode($stage_2_user_id);
echo json_encode($stage_3_user_id);


$total_count =  count($stage_1_user_id) + count($stage_2_user_id) + count($stage_3_user_id);

echo "<br>";

echo $total_count;
}








?>