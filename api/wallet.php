<?php 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];

//wallet_level_data
$wallet_level_data = $dbConn->query("SELECT
    level
 FROM user
 WHERE user_id IN ('$user_id')
    ");

while($row = $wallet_level_data->fetch(PDO::FETCH_ASSOC)) {
    $level = $row['level'];

    //level 2 - 4
    if ($level == "2") {
        $actual_level = "1";
    }

    if ($level == "3") {
        $actual_level = "2";
    }

    if ($level == "4") {
        $actual_level = "3";
    }

    if ($level == "1") {
        $actual_level = "0";
    }


}


//wallet
$wallet = $dbConn->query("SELECT
    wallet.reward
 FROM wallet
 WHERE level IN ('$actual_level')
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