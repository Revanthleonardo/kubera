<?php 
 
require '../config.php';

$user_id = $_GET['user_id'];
$message = addslashes($_GET['message']);
$sent_by = "user";


if (isset($user_id) && isset($message)) {

//inserting_user
  $dbConn->query("INSERT INTO `message` (
    `user_id`,
    `message`,
    `sent_by`,
    `date`,
    `time`
    ) 
    VALUES (
    '{$user_id}',
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