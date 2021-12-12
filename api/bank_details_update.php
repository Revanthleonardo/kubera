<?php 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$account_holder_name = $data['account_holder_name'];
$account_no = $data['account_no'];
$ifsc_code = $data['ifsc_code'];
$bank_name = $data['bank_name'];


//bank_details_data
$bank_details_data = $dbConn->query("SELECT
    status
 FROM bank_details
 WHERE status IN ('$active') 
 AND user_id IN ('$user_id')
    ");

while($row = $bank_details_data->fetch(PDO::FETCH_ASSOC)) {
    $status = $row['status'];
}

if (isset($status)) {

    if (isset($account_holder_name)) {
        $dbConn->query("UPDATE `bank_details` SET `account_holder_name` = '$account_holder_name' WHERE user_id IN ('$user_id')");
    }

    if (isset($account_no)) {
        $dbConn->query("UPDATE `bank_details` SET `account_no` = '$account_no' WHERE user_id IN ('$user_id')");
    }

    if (isset($ifsc_code)) {
        $dbConn->query("UPDATE `bank_details` SET `ifsc_code` = '$ifsc_code' WHERE user_id IN ('$user_id')");
    }

    if (isset($bank_name)) {
        $dbConn->query("UPDATE `bank_details` SET `bank_name` = '$bank_name' WHERE user_id IN ('$user_id')");
    }    

    $returnArr = array("api"=>"bank_details_update","result"=>"success");
}
else {

    if (isset($user_id) && isset($account_holder_name) && isset($account_no)
        && isset($ifsc_code) && isset($bank_name)) {

    $dbConn->query("INSERT INTO `bank_details` (
    `user_id`,
    `account_holder_name`,
    `account_no`,
    `ifsc_code`,
    `bank_name`
    ) 
    VALUES (
    '{$user_id}',
    '{$account_holder_name}',
    '{$account_no}',
    '{$ifsc_code}',
    '{$bank_name}'
    )
    ;");

    $returnArr = array("api"=>"bank_details_update","result"=>"success");

    }
    else{

    $returnArr = array("api"=>"bank_details_update","result"=>"error");
          
    }

}

echo json_encode($returnArr);

?>