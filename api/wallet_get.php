<?php 
require '../config.php';

$user_id = $_GET['user_id'];

//user_id_input
//mobile_number_data
$mobile_number_data = $dbConn->query("SELECT
    mobile_number
 FROM user
 WHERE user_id IN ('$user_id')
 LIMIT 1
    ");
while($row = $mobile_number_data->fetch(PDO::FETCH_ASSOC)) {
    $mobile_number = $row['mobile_number'];
}

//wallet
$wallet = $dbConn->query("SELECT
    wallet.level,
    wallet.reward
 FROM user
  LEFT JOIN 
  wallet ON
  user.level = wallet.level
 WHERE user.mobile_number IN ('$mobile_number')
 ORDER BY DESC user.user_id
 LIMIT 1
    ");

while($row = $wallet->fetch(PDO::FETCH_ASSOC)) {
    $wallet_api[] = $row;
}

if (isset($wallet_api)) {
$returnArr = array("api"=>"wallet","result"=>"success","wallet_api"=>$wallet_api);
}
else {
    $returnArr = array("api"=>"wallet","result"=>"error");
}	

echo json_encode($returnArr);


?>