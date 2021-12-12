<?php

include '../config.php';

//level_data
$level_user_id_input = $_GET['user_id'];

while ($level_user_id_input >= 1) {

$level_get_level_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE user_id IN ('$level_user_id_input')
  LIMIT 1
");
if($row = $level_get_level_data->fetch(PDO::FETCH_ASSOC)) {

$level_user_id = $row['user_id'];
$level_referral_id = $row['referral_id'];

$level_user_id_input = $level_referral_id;

echo $level_user_id;
echo "<br>";
}
}

?>