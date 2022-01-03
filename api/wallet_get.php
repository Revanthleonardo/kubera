<?php 
require '../config.php';

$user_id = $_GET['user_id'];

//wallet
$wallet = $dbConn->query("SELECT
    wallet.level,
    wallet.reward
 FROM user
  LEFT JOIN 
  wallet ON
  user.level = wallet.level
 WHERE user.user_id IN ('$user_id')
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