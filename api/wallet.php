<?php 
require '../config.php';

$user_id = $_GET['user_id'];

//wallet_level_data
$wallet_level_data = $dbConn->query("SELECT
    level
 FROM user
 WHERE user_id IN ('$user_id')
    ");

while($row = $wallet_level_data->fetch(PDO::FETCH_ASSOC)) {
    $level_data_input = $row['level'];

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
 WHERE level IN ('$level_data_input')
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