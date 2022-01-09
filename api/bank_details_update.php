<?php 
require '../config.php';


//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$account_holder_name = $data['account_holder_name'];
$account_no = $data['account_no'];
$ifsc_code = $data['ifsc_code'];
$bank_name = $data['bank_name'];


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

//bank_details_data
$bank_details_data = $dbConn->query("SELECT
    status
 FROM bank_details
 WHERE status IN ('$active') 
 AND mobile_number IN ('$mobile_number')
    ");

while($row = $bank_details_data->fetch(PDO::FETCH_ASSOC)) {
    $status = $row['status'];
}

if (isset($status)) {

    if (isset($account_holder_name)) {
        $dbConn->query("UPDATE `bank_details` SET `account_holder_name` = '$account_holder_name' WHERE mobile_number IN ('$mobile_number')");
    }

    if (isset($account_no)) {
        $dbConn->query("UPDATE `bank_details` SET `account_no` = '$account_no' WHERE mobile_number IN ('$mobile_number')");
    }

    if (isset($ifsc_code)) {
        $dbConn->query("UPDATE `bank_details` SET `ifsc_code` = '$ifsc_code' WHERE mobile_number IN ('$mobile_number')");
    }

    if (isset($bank_name)) {
        $dbConn->query("UPDATE `bank_details` SET `bank_name` = '$bank_name' WHERE mobile_number IN ('$mobile_number')");
    }    

    $returnArr = array("api"=>"bank_details_update","result"=>"success");
}
else {

    if (isset($mobile_number) && isset($account_holder_name) && isset($account_no)
        && isset($ifsc_code) && isset($bank_name)) {

    $dbConn->query("INSERT INTO `bank_details` (
    `account_holder_name`,
    `account_no`,
    `ifsc_code`,
    `bank_name`,
    `mobile_number`
    ) 
    VALUES (
    '{$account_holder_name}',
    '{$account_no}',
    '{$ifsc_code}',
    '{$bank_name}',
    '{$mobile_number}'
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