<?php 
 
require '../config.php';

$user_id = $_GET['user_id'];
$message = addslashes($_GET['message']);
$sent_by = "user";

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

if (isset($mobile_number) && isset($message)) {

//inserting_user
  $dbConn->query("INSERT INTO `message` (
    `mobile_number`,
    `message`,
    `sent_by`,
    `date`,
    `time`
    ) 
    VALUES (
    '{$mobile_number}',
    '{$message}',
    '{$sent_by}',
    '{$date}',
    '{$time}'
    )
    ;");


    $returnArr = array("api"=>"send_message","result"=>"success");
}
else{
	$returnArr = array("api"=>"send_message","result"=>"error");
}


echo json_encode($returnArr);

?> 