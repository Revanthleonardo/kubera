<?php

include '../config.php';


$user_id = $_GET['user_id'];

$level_data = $dbConn->query("SELECT 
level
  FROM user   
  WHERE user_id IN ('$user_id')
");
while($row = $level_data->fetch(PDO::FETCH_ASSOC)) {
$level = $row['level'];
}

if (isset($user_id)){
//view_tree_user_data
//and status whether referral_number updated
$view_tree_user_data = $dbConn->query("SELECT
    user_id,
    name,
    referral_number,
    level
 FROM user
 WHERE referral_id IN ('$user_id')
 AND level IN ('$level')
    ");

while($row = $view_tree_user_data->fetch(PDO::FETCH_ASSOC)) {
    $view_tree_api[] = $row;
}
}

if (isset($view_tree_api)) {
$returnArr = array("api"=>"view_tree","result"=>"success","view_tree_api"=>$view_tree_api);
}
else {
    $returnArr = array("api"=>"view_tree","result"=>"error");
}   

echo json_encode($returnArr);




?>
